<?php

use app\controllers\AuthController;
use app\controllers\ObjetController;
use app\controllers\CatalogueController;
use app\controllers\EchangeController;
use app\controllers\HistoriqueController;
use app\controllers\HistoriqueGlobalController;
use app\controllers\ProfilController;
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
		$app->render('welcome', ['title' => 'Bienvenue sur Takalo-takalo']);
	});

	// Routes d'authentification
	$router->get('/login', [AuthController::class, 'showLogin']);
	$router->post('/login', [AuthController::class, 'login']);
	$router->get('/register', [AuthController::class, 'showRegister']);
	$router->post('/register', [AuthController::class, 'register']);
	$router->get('/logout', [AuthController::class, 'logout']);

	// Routes objets
	$router->get('/mes-objets', [ObjetController::class, 'showMesObjets']);
	$router->get('/ajouter-objet', [ObjetController::class, 'showAjouterObjet']);
	$router->post('/ajouter-objet', [ObjetController::class, 'ajouterObjet']);
	$router->get('/modifier-objet/@id', [ObjetController::class, 'showModifierObjet']);
	$router->post('/modifier-objet/@id', [ObjetController::class, 'updateObjet']);
	$router->post('/supprimer-objet/@id', [ObjetController::class, 'deleteObjet']);
	
}, [SecurityHeadersMiddleware::class]);
