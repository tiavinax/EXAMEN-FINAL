<?php

namespace app\controllers;

use app\models\BesoinModel;
use app\models\DonModel;
use app\models\ParametreModel;
use Flight;
use app\models\AttributionModel;
use app\models\AchatModel;
use app\controllers\Exception;

class AchatController
{
    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = Flight::get('flight.base_url') ?: '';
    }

    /**
     * Afficher la page des besoins restants (achats)
     */
    public function besoinsRestants()
    {
        $besoinModel = new BesoinModel();
        $besoins = $besoinModel->getBesoinsRestants();

        Flight::render('achats/besoins_restants', [
            'title' => 'Achats - Besoins restants',
            'besoins' => $besoins
        ]);
    }

    /**
     * Récupérer les données pour le modal (AJAX)
     */
    public function getModalData()
    {
        $besoinId = $_GET['besoin_id'] ?? 0;

        $besoinModel = new BesoinModel();
        $donModel = new DonModel();
        $parametreModel = new ParametreModel();

        $besoin = $besoinModel->getById($besoinId);
        $dons = $donModel->getDonsArgentDisponibles();
        $frais = $parametreModel->getFraisAchat();

        if (!$besoin) {
            header('HTTP/1.0 404 Not Found');
            echo json_encode(['error' => 'Besoin non trouvé']);
            return;
        }

        // Récupérer le reste du besoin
        $besoinAvecReste = $besoinModel->getBesoinsRestants();
        $besoinData = null;
        foreach ($besoinAvecReste as $b) {
            if ($b->id == $besoinId) {
                $besoinData = $b;
                break;
            }
        }

        header('Content-Type: application/json');
        echo json_encode([
            'besoin' => $besoinData,
            'dons' => $dons,
            'frais' => $frais
        ]);
    }

    /**
     * Simuler un achat (AJAX)
     */
    public function simuler()
    {
        $donId = $_POST['don_id'] ?? 0;
        $besoinId = $_POST['besoin_id'] ?? 0;
        $quantite = $_POST['quantite'] ?? 0;

        $besoinModel = new BesoinModel();
        $donModel = new DonModel();
        $parametreModel = new ParametreModel();

        $besoin = $besoinModel->getById($besoinId);
        $don = $donModel->getDonAvecSolde($donId);
        $frais = $parametreModel->getFraisAchat();

        if (!$besoin || !$don) {
            header('HTTP/1.0 404 Not Found');
            echo json_encode(['error' => 'Don ou besoin non trouvé']);
            return;
        }

        // Calculs
        $montantBesoin = $quantite * $besoin->prix_unitaire;
        $montantFrais = $montantBesoin * ($frais / 100);
        $totalADeduire = $montantBesoin + $montantFrais;

        $peutAcheter = ($totalADeduire <= $don->solde);
        $resteApresAchat = $don->solde - $totalADeduire;

        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'calculs' => [
                'montant_besoin' => $montantBesoin,
                'frais_pourcentage' => $frais,
                'montant_frais' => $montantFrais,
                'total_a_deduire' => $totalADeduire,
                'solde_don' => $don->solde,
                'peut_acheter' => $peutAcheter,
                'reste_apres_achat' => $resteApresAchat
            ]
        ]);
    }

    /**
     * Valider et enregistrer l'achat
     */
    public function valider()
    {
        // Récupérer les données POST
        $donId = $_POST['don_id'] ?? 0;
        $besoinId = $_POST['besoin_id'] ?? 0;
        $quantite = $_POST['quantite'] ?? 0;

        // Validation simple
        if (!$donId || !$besoinId || !$quantite) {
            $_SESSION['error'] = "Données incomplètes";
            Flight::redirect('/achats/besoins-restants');
            return;
        }

        // Initialiser les modèles
        $besoinModel = new BesoinModel();
        $donModel = new DonModel();
        $parametreModel = new ParametreModel();
        $attributionModel = new AttributionModel();
        $achatModel = new AchatModel();

        // Récupérer les données nécessaires
        $besoin = $besoinModel->getById($besoinId);
        $don = $donModel->getDonAvecSolde($donId);
        $frais = $parametreModel->getFraisAchat();

        // Vérifications préalables
        if (!$besoin || !$don) {
            $_SESSION['error'] = "Don ou besoin non trouvé";
            Flight::redirect('/achats/besoins-restants');
            return;
        }

        // Récupérer le total attribué pour ce besoin
        $totalAttribue = $attributionModel->getTotalByBesoin($besoinId);

        // Calculer le reste
        $reste = $besoin->quantite - $totalAttribue;

        // Vérifier la quantité
        if ($quantite <= 0 || $quantite > $reste) {
            $_SESSION['error'] = "Quantité invalide (max: $reste)";
            Flight::redirect('/achats/besoins-restants');
            return;
        }

        // Calculs
        $montantBesoin = $quantite * $besoin->prix_unitaire;
        $montantFrais = $montantBesoin * ($frais / 100);
        $totalADeduire = $montantBesoin + $montantFrais;

        // Vérifier le solde
        if ($totalADeduire > $don->solde) {
            $_SESSION['error'] = "Solde insuffisant";
            Flight::redirect('/achats/besoins-restants');
            return;
        }

        // Juste avant $achatModel->executeAchat()
        error_log("Données achat: " . print_r([
            'don_id' => $donId,
            'besoin_id' => $besoinId,
            'quantite' => $quantite,
            'montant_besoin' => $montantBesoin,
            'montant_total' => $totalADeduire
        ], true));

        // Tout est bon, on exécute la transaction
        $result = $achatModel->executeAchat([
            'don_id' => $donId,
            'besoin_id' => $besoinId,
            'ville_id' => $besoin->ville_id,
            'quantite' => $quantite,
            'montant_besoin' => $montantBesoin,
            'frais_pourcentage' => $frais,
            'montant_frais' => $montantFrais,
            'montant_total' => $totalADeduire
        ]);

        if ($result['success']) {
            $_SESSION['success'] = $result['message'];
        } else {
            $_SESSION['error'] = $result['message'];
        }

        Flight::redirect('/achats/besoins-restants');
    }

    /**
     * Afficher l'historique des achats
     */
    public function historique()
    {
        $achatModel = new AchatModel();
        $achats = $achatModel->getAllWithDetails();

        Flight::render('achats/historique', [
            'title' => 'Historique des achats',
            'achats' => $achats
        ]);
    }
}
