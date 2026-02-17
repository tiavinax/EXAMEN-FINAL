<?php

namespace app\controllers;

use app\models\BesoinModel;
use app\models\AttributionModel;
use app\models\AchatModel;
use Flight;

class RecapitulatifController
{
    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = Flight::get('flight.base_url') ?: '';
    }

    /**
     * Afficher la page récapitulative
     */
    public function index()
    {
        Flight::render('recapitulatif/index', [
            'title' => 'Récapitulatif - BNGRC'
        ]);
    }

    /**
     * API: Récupérer les données récapitulatives (AJAX)
     */
    public function getData()
    {
        $besoinModel = new BesoinModel();
        $attributionModel = new AttributionModel();
        $achatModel = new AchatModel();

        // 1. Calculer les besoins totaux (quantité × prix_unitaire)
        $besoinsTotaux = $besoinModel->getTotalValeurBesoins();

        // 2. Calculer les attributions totales (dons déjà attribués)
        $attributionsTotales = $attributionModel->getTotalValeurAttributions();

        // 3. Calculer les achats totaux
        $achatsTotaux = $achatModel->getTotalValeurAchats();

        // 4. Calculer les besoins restants
        $besoinsRestants = $besoinsTotaux - $attributionsTotales;

        // 5. Récupérer les détails par ville (optionnel)
        $detailsParVille = $besoinModel->getRecapParVille();

        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => [
                'besoins_totaux' => $besoinsTotaux,
                'attributions_totales' => $attributionsTotales,
                'achats_totaux' => $achatsTotaux,
                'besoins_restants' => $besoinsRestants,
                'details_par_ville' => $detailsParVille
            ]
        ]);
    }
}