<?php

namespace app\controllers;

use app\models\DispatchModel;
use app\models\AttributionModel;
use app\models\BesoinModel;
use Flight;

class DispatchController
{
    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = Flight::get('flight.base_url') ?: '';
    }

    /**
     * API: Récupérer les attributions en JSON
     */
    public function apiGetAttributions()
    {
        $attributionModel = new AttributionModel();
        $attributions = $attributionModel->getAllWithDetails();

        header('Content-Type: application/json');
        echo json_encode($attributions);
    }

    /**
     * API: Lancer le dispatch (retour JSON)
     */
    public function apiRun()
    {
        $dispatchModel = new DispatchModel();
        $result = $dispatchModel->run();

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function index()
    {
        $mode = $_GET['mode'] ?? 'fifo';

        $besoinModel = new BesoinModel();
        $besoinsData = $besoinModel->getAllWithDetails();

        Flight::render('dispatch/index', [
            'title' => 'Dispatch automatique - BNGRC',
            'besoinsData' => $besoinsData,
            'currentMode' => $mode
        ]);
    }

    public function run($mode = 'fifo')
    {
        try {
        $dispatchModel = new DispatchModel();

            error_log("=== Début du dispatch en mode $mode ===");

            $dons = $dispatchModel->getDonsNonAttribues();
            error_log("Dons trouvés: " . count($dons));

            $besoins = $dispatchModel->getBesoinsAvecRestes();
            error_log("Besoins trouvés: " . count($besoins));

            if (empty($dons)) {
                return ['success' => true, 'message' => 'Aucun don disponible'];
            }

            if (empty($besoins)) {
                return ['success' => true, 'message' => 'Aucun besoin en attente'];
            }

            $totalAttributions = 0;

            foreach ($dons as $don) {
                error_log("Traitement du don ID: {$don->id}, type: {$don->type}");

                $resteDon = ($don->type === 'argent') ? $don->montant : $don->quantite;

                $besoinsCompatibles = array_filter($besoins, function ($b) use ($don) {
                    return $b->type === $don->type &&
                        $b->libelle === $don->libelle &&
                        $b->reste > 0;
                });

                error_log("Besoins compatibles pour ce don: " . count($besoinsCompatibles));

                if (empty($besoinsCompatibles)) continue;

                $besoinsTries = $dispatchModel->trierBesoins($besoinsCompatibles, $mode);

                switch ($mode) {
                    case 'smallest':
                        $attributions = $dispatchModel->distribuerPlusPetite($don, $besoinsTries, $resteDon);
                        break;

                    case 'proportional':
                        $attributions = $dispatchModel->distribuerProportionnel($don, $besoinsTries, $resteDon);
                        break;

                    default: // fifo
                        $attributions = $dispatchModel->distribuerFIFO($don, $besoinsTries, $resteDon);
                        break;
                }

                $totalAttributions += count($attributions);
                error_log("Attributions créées pour ce don: " . count($attributions));
            }

            error_log("Total attributions créées: $totalAttributions");

            return [
                'success' => true,
                'message' => "$totalAttributions attribution(s) créée(s) en mode $mode"
            ];
        } catch (\Exception $e) {
            error_log("ERREUR dans DispatchModel::run(): " . $e->getMessage());
            error_log("Fichier: " . $e->getFile() . " Ligne: " . $e->getLine());

            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function redistribute()
    {
        $mode = $_GET['mode'] ?? 'fifo';
        $dispatchModel = new DispatchModel();

        $dispatchModel->resetAll();
        $result = $dispatchModel->run($mode);

        if ($result['success']) {
            $_SESSION['success'] = "Réinitialisation : " . $result['message'];
        } else {
            $_SESSION['error'] = $result['message'];
        }

        Flight::redirect('/dispatch?mode=' . $mode);
    }

    /**
     * Lancer le dispatch et retourner le résultat en JSON
     */
    public function runAjax()
    {
        $mode = $_GET['mode'] ?? 'fifo';
        $dispatchModel = new DispatchModel();

        $result = $dispatchModel->run($mode);

        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    /**
     * Réinitialiser et redistribuer en AJAX
     */
    public function redistributeAjax()
    {
        $mode = $_GET['mode'] ?? 'fifo';
        $dispatchModel = new DispatchModel();

        $dispatchModel->resetAll();
        $result = $dispatchModel->run($mode);

        header('Content-Type: application/json');
        echo json_encode([
            'success' => $result['success'],
            'message' => "Réinitialisation : " . ($result['message'] ?? 'Terminé')
        ]);
        exit;
    }
}
