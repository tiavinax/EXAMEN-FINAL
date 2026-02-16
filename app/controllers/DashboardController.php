<?php
namespace app\controllers;

use flight\Engine;
use app\models\AttributionModel;
use Flight;

class DashboardController {

     private $baseUrl;
    
    public function __construct()
    {
        $this->baseUrl = Flight::get('flight.base_url') ?: '';
    }
    
    private $attributionModel;
    
    
    public function getData() {
        // Récupérer les données
        $attributionModel = new AttributionModel();
        $dashboardData = $attributionModel->getDashboardData();
        return $dashboardData;
    }
    public function statistique() {
        $attributionModel = new AttributionModel();
        $stats = $attributionModel->getStats();
        return $stats;
    }
    
    public function getAttributions($besoinId) {
       return $attributions = $this->attributionModel->getAttributionsByBesoin($besoinId);
    }
}