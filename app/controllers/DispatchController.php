<?php

namespace app\controllers;

use app\models\DispatchModel;
use app\models\AttributionModel;
use Flight;

class DispatchController
{
    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = Flight::get('flight.base_url') ?: '';
    }

    /**
     * Page principale du dispatch
     */
    public function index()
    {
        $attributionModel = new AttributionModel();
        $attributions = $attributionModel->getAllWithDetails();

        Flight::render('dispatch/index', [
            'title' => 'Gestion des attributions - BNGRC',
            'attributions' => $attributions
        ]);
    }

    /**
     * Lancer le dispatch automatique
     */
    public function run()
    {
        $dispatchModel = new DispatchModel();
        $result = $dispatchModel->run();

        if ($result['success']) {
            $_SESSION['success'] = $result['message'];
        } else {
            $_SESSION['error'] = "Erreur lors du dispatch";
        }

        Flight::redirect('/dispatch');
    }

    /**
     * Réinitialiser et redistribuer
     */
    public function redistribute()
    {
        $dispatchModel = new DispatchModel();
        $result = $dispatchModel->redistribute();

        if ($result['success']) {
            $_SESSION['success'] = "Réinitialisation et redistribution: " . $result['message'];
        } else {
            $_SESSION['error'] = "Erreur lors de la redistribution";
        }

        Flight::redirect('/dispatch');
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
}