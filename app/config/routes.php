<?php
// Routes pour le dashboard
Flight::route('/dashboard', ['app\controllers\DashboardController', 'index']);
Flight::route('/dashboard/detailVille/@id', ['app\controllers\DashboardController', 'detailVille']);

// Route par défaut (redirection vers dashboard)
Flight::route('/', function() {
    Flight::redirect('/dashboard');
});