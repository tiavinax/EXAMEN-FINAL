<?php

use app\controllers\DashboardController;
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

}, [SecurityHeadersMiddleware::class]);