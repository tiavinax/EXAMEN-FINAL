<?php
// Autoloader de Composer
require_once __DIR__ . '/../../vendor/autoload.php';

// Inclure l'utilitaire de base de données
require_once __DIR__ . '/../utils/Database.php';


$ds = DIRECTORY_SEPARATOR;
require(__DIR__ . $ds . '..' . $ds . '..' . $ds . 'vendor' . $ds . 'autoload.php');

if(file_exists(__DIR__. $ds . 'config.php') === false) {
	Flight::halt(500, 'Config file not found. Please create a config.php file in the app/config directory to get started.');
}

$app = Flight::app();

$config = require('config.php');

// S'assurer que flight.base_url est défini
if (!Flight::get('flight.base_url')) {
    $isLocal = in_array($_SERVER['SERVER_NAME'], ['localhost', '127.0.0.1']);
    if ($isLocal) {
        $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
    } else {
        $baseUrl = '/ETU003955/EXAMEN-FINAL/public';
    }
    Flight::set('flight.base_url', $baseUrl);
}

/* ===== SOLUTION : CONFIGURER LE CHEMIN DES VUES ===== */

// 1. Définir le chemin racine des vues (views/)
Flight::set('flight.views.path', __DIR__ . '/../views/');

// 2. OU si vous utilisez un dossier différent (comme dashboard/)
// Décommentez la ligne ci-dessous si vos vues sont dans /dashboard
// Flight::set('flight.views.path', __DIR__ . '/../../dashboard/');

// 3. Alternative : Ajouter plusieurs chemins de recherche
Flight::map('render', function($template, $data = []) {
	// Chemins possibles pour les templates
	$possiblePaths = [
		__DIR__ . '/../views/',           // Dossier views standard
		__DIR__ . '/../../dashboard/',     // Dossier dashboard
		__DIR__ . '/../../',               // Dossier racine
	];
	
	foreach($possiblePaths as $path) {
		$file = $path . $template . '.php';
		if(file_exists($file)) {
			// Extraire les données
			extract($data);
			// Inclure le template
			require $file;
			return;
		}
	}
	
	// Si aucun template trouvé
	throw new Exception("Template file not found: {$template}");
});

/* ===== FIN DE LA SOLUTION ===== */

require('services.php');

$router = $app->router();

require('routes.php');

$app->start();