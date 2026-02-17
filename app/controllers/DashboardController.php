<?php

namespace app\controllers;

use app\models\AttributionModel;
use app\models\BesoinModel;
use app\models\DonModel;
use app\models\VilleModel;
use Flight;

class DashboardController
{

    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = Flight::get('flight.base_url') ?: '';
    }

    public function index()
    {
        $attributionModel = new AttributionModel();
        $attributions = $attributionModel->getAllWithDetails();

        $stats = $this->getStats();

        Flight::render('dashboard/home', [
            'title' => 'Tableau de bord - BNGRC',
            'attributions' => $attributions,
            'stats' => $stats
        ]);
    }

    private function getStats()
    {
        $villeModel = new VilleModel();
        $besoinModel = new BesoinModel();
        $donModel = new DonModel();
        $attributionModel = new AttributionModel();

        return (object)[
            'villes' => count($villeModel->getAll()),
            'besoins' => count($besoinModel->getAll()),
            'dons' => count($donModel->getAll()),
            'attributions' => count($attributionModel->getAll())
        ];
    }

    public function reset()
    {
        $attributionModel = new AttributionModel();
        $attributionModel->resetAll();

        $_SESSION['success'] = "Toutes les attributions ont été réinitialisées";
        Flight::redirect('/dashboard');
    }

    public function getData()
    {
        // Récupérer les données
        $attributionModel = new AttributionModel();
        $dashboardData = $attributionModel->getDashboardData();
        return $dashboardData;
    }
    public function statistique()
    {
        $attributionModel = new AttributionModel();
        $stats = $attributionModel->getStats();
        return $stats;
    }

    public function getAttributions($besoinId)
    {
        $attributionModel = new AttributionModel();
        return $attributions = $attributionModel->getAttributionsByBesoin($besoinId);
    }
}
