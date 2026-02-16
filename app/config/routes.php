<?php

use app\controllers\DashboardController;
use app\controllers\DonController;
use app\controllers\BesoinController;
use app\controllers\VilleController;
use app\controllers\DispatchController;
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
		$app->render('test', ['title' => 'Bienvenue sur Takalo-takalo']);
	});

	// Route de test connexion
	$router->get('/test', function () {
		require_once __DIR__ . '/../../test.php';
	});

	// ============================================
	// ROUTES POUR LE PROJET BNGRC
	// ============================================

	// Route pour le tableau de bord des dons et besoins
	$router->get('/dashboard', function () use ($app) {

		$dashBoardControlleur = new DashboardController();
		$data = $dashBoardControlleur->getData();
		$stats = $dashBoardControlleur->statistique();
		$app->render('dashboard/home', [
			'title' => 'Tableau de bord - Suivi des dons et besoins',
			'data' => $data,
			'stats' => $stats
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

	// API endpoints (optionnels)
	$router->get('/api/attributions', [DispatchController::class, 'apiGetAttributions']);
	$router->post('/api/dispatch/run', [DispatchController::class, 'apiRun']);
}, [SecurityHeadersMiddleware::class]);
