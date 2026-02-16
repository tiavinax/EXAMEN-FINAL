<?php

// Route d'accueil - Redirige vers dashboard
Flight::route('GET /', function() {
    Flight::redirect('/dashboard');
});

// Dashboard avec le layout BNGRC
Flight::route('GET /dashboard', function() {
    // Données simulées pour le dashboard
    $stats = [
        'villes_sinistrees' => 8,
        'total_besoins' => 150000000,
        'total_dons' => 85000000,
        'pourcentage_couvert' => 57
    ];
    
    $villes = [
        ['id' => 1, 'region_nom' => 'Analamanga', 'ville_nom' => 'Antananarivo', 'population' => 1500000, 'nb_besoins' => 4, 'montant_besoins' => 150000000, 'total_attribue' => 85000000],
        ['id' => 2, 'region_nom' => 'Diana', 'ville_nom' => 'Antsiranana', 'population' => 150000, 'nb_besoins' => 3, 'montant_besoins' => 45000000, 'total_attribue' => 30000000],
        ['id' => 3, 'region_nom' => 'Sava', 'ville_nom' => 'Sambava', 'population' => 120000, 'nb_besoins' => 2, 'montant_besoins' => 25000000, 'total_attribue' => 10000000],
        ['id' => 4, 'region_nom' => 'Itasy', 'ville_nom' => 'Miarinarivo', 'population' => 90000, 'nb_besoins' => 1, 'montant_besoins' => 10000000, 'total_attribue' => 10000000]
    ];
    
    // Utiliser le chemin absolu depuis la racine
    ob_start();
    include __DIR__ . '/../views/dashboard/index.php';
    $content = ob_get_clean();
    
    Flight::render('layout', ['title' => 'Tableau de bord - BNGRC', 'content' => $content]);
});

// Détail d'une ville
Flight::route('GET /dashboard/ville/@id:[0-9]+', function($id) {
    ob_start();
    echo "<div class='bngrc-card'>";
    echo "<div class='bngrc-card-header'>";
    echo "<i class='fas fa-city'></i> Détail de la ville #$id";
    echo "</div>";
    echo "<div class='bngrc-card-body'>";
    echo "<p>Informations détaillées pour la ville sélectionnée.</p>";
    echo "<a href='/dashboard' class='btn btn-bngrc-outline'>";
    echo "<i class='fas fa-arrow-left'></i> Retour au tableau de bord";
    echo "</a>";
    echo "</div>";
    echo "</div>";
    $content = ob_get_clean();
    
    Flight::render('layout', ['title' => "Détail ville #$id - BNGRC", 'content' => $content]);
});

// Autres routes
Flight::route('GET /login', function() {
    $content = "<div class='bngrc-card'><div class='bngrc-card-header'><i class='fas fa-sign-in-alt'></i> Connexion</div><div class='bngrc-card-body'>Page de connexion (à venir)</div></div>";
    Flight::render('layout', ['title' => 'Connexion - BNGRC', 'content' => $content]);
});

Flight::route('GET /villes', function() {
    $content = "<div class='bngrc-card'><div class='bngrc-card-header'><i class='fas fa-city'></i> Villes</div><div class='bngrc-card-body'><p>Liste des villes (en construction...)</p></div></div>";
    Flight::render('layout', ['title' => 'Villes - BNGRC', 'content' => $content]);
});

Flight::route('GET /besoins', function() {
    $content = "<div class='bngrc-card'><div class='bngrc-card-header'><i class='fas fa-hand-holding-heart'></i> Besoins</div><div class='bngrc-card-body'><p>Liste des besoins (en construction...)</p></div></div>";
    Flight::render('layout', ['title' => 'Besoins - BNGRC', 'content' => $content]);
});

Flight::route('GET /dons', function() {
    $content = "<div class='bngrc-card'><div class='bngrc-card-header'><i class='fas fa-gift'></i> Dons</div><div class='bngrc-card-body'><p>Liste des dons (en construction...)</p></div></div>";
    Flight::render('layout', ['title' => 'Dons - BNGRC', 'content' => $content]);
});

Flight::route('GET /attributions', function() {
    $content = "<div class='bngrc-card'><div class='bngrc-card-header'><i class='fas fa-exchange-alt'></i> Attributions</div><div class='bngrc-card-body'><p>Liste des attributions (en construction...)</p></div></div>";
    Flight::render('layout', ['title' => 'Attributions - BNGRC', 'content' => $content]);
});

Flight::route('GET /rapports', function() {
    $content = "<div class='bngrc-card'><div class='bngrc-card-header'><i class='fas fa-chart-bar'></i> Rapports</div><div class='bngrc-card-body'><p>Génération de rapports (en construction...)</p></div></div>";
    Flight::render('layout', ['title' => 'Rapports - BNGRC', 'content' => $content]);
});
Flight::route('GET /don_ajouter', function() {
    require __DIR__ . '/../views/don_ajouter.php';
});