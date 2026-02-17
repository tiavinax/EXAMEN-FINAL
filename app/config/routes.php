<?php

use app\controllers\DashboardController;
use app\controllers\DonController;
use app\controllers\BesoinController;
use app\controllers\VilleController;
use app\controllers\DispatchController;
use app\controllers\AchatController;
use app\controllers\RecapitulatifController;
use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;

/** 
 * @var Router $router 
 * @var Engine $app
 */

// This wraps all routes in the group with the SecurityHeadersMiddleware
$router->group('', function (Router $router) use ($app) {

    // Route d'accueil
    $router->get('/', function () use ($app) {
        $app->render('accueil', [
            'title' => 'BNGRC - Accueil'
        ]);
    });

    // Route de test (optionnelle)
    $router->get('/test', function () use ($app) {
        $app->render('accueil', [
            'title' => 'BNGRC - Accueil'
        ]);
    });

    // ============================================
    // ROUTES POUR LE PROJET BNGRC
    // ============================================

    // Route pour le tableau de bord des dons et besoins
    $router->get('/dashboard/reset', [DashboardController::class, 'reset']);
    $router->get('/dashboard', [DashboardController::class, 'index']);
    $router->get('/dashboard/api/data', [DashboardController::class, 'getDataApi']);
    $router->get('/index', function () use ($app) {
        $app->render('index', [
            'title' => 'Tableau de bord - Suivi des dons et besoins'
        ]);
    });

    $router->get('/index', function () use ($app) {
        $app->render('index', [
            'title' => 'Tableau de bord - Suivi des dons et besoins'
        ]);
    });

    // Gestion des dons
    $router->get('/dons/ajouter', [DonController::class, 'ajouter']);
    $router->post('/dons/save', [DonController::class, 'save']);
    $router->get('/dons/liste', [DonController::class, 'liste']);
    $router->get('/dons/supprimer/@id', [DonController::class, 'supprimer']);

    // Gestion des besoins
    $router->get('/besoins/ajouter', [BesoinController::class, 'ajouter']);
    $router->post('/besoins/save', [BesoinController::class, 'save']);
    $router->get('/besoins/liste', [BesoinController::class, 'liste']);
    $router->get('/besoins/modifier/@id', [BesoinController::class, 'modifier']);
    $router->post('/besoins/update/@id', [BesoinController::class, 'update']);
    $router->get('/besoins/supprimer/@id', [BesoinController::class, 'supprimer']);

    // Gestion des villes
    $router->get('/villes/ajouter', [VilleController::class, 'ajouter']);
    $router->post('/villes/save', [VilleController::class, 'save']);
    $router->get('/villes/liste', [VilleController::class, 'liste']);
    $router->get('/villes/modifier/@id', [VilleController::class, 'modifier']);
    $router->post('/villes/update/@id', [VilleController::class, 'update']);
    $router->get('/villes/supprimer/@id', [VilleController::class, 'supprimer']);

    // Gestion du dispatch
    $router->get('/dispatch', [DispatchController::class, 'index']);
    $router->get('/dispatch/run', [DispatchController::class, 'run']);
    $router->get('/dispatch/redistribute', [DispatchController::class, 'redistribute']);
    $router->get('/dispatch/api/get-attributions', [DispatchController::class, 'apiGetAttributions']);
    // Routes AJAX pour le dispatch
    $router->get('/dispatch/run-ajax', [DispatchController::class, 'runAjax']);
    $router->get('/dispatch/redistribute-ajax', [DispatchController::class, 'redistributeAjax']);

    // API endpoints (optionnels)
    $router->get('/api/attributions', [DispatchController::class, 'apiGetAttributions']);
    $router->post('/api/dispatch/run', [DispatchController::class, 'apiRun']);

    // Gestion des achats
    $router->get('/achats/besoins-restants', [AchatController::class, 'besoinsRestants']);
    $router->get('/achats/modal-data', [AchatController::class, 'getModalData']);
    $router->post('/achats/simuler', [AchatController::class, 'simuler']);
    $router->post('/achats/valider', [AchatController::class, 'valider']);
    $router->get('/achats/historique', [AchatController::class, 'historique']);

    // Récapitulatif
    $router->get('/recapitulatif', [RecapitulatifController::class, 'index']);
    $router->get('/recapitulatif/data', [RecapitulatifController::class, 'getData']);
}, [SecurityHeadersMiddleware::class]);
