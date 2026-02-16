<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'BNGRC - Suivi des dons'; ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bngrc-red: #E31B23;
            --bngrc-dark-red: #B00F15;
            --bngrc-blue: #003399;
            --bngrc-light-blue: #E6F0FF;
            --bngrc-yellow: #FFD700;
            --bngrc-gray: #F5F5F5;
            --bngrc-dark-gray: #333333;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f9;
            color: #333;
        }
        
        /* Header BNGRC */
        .bngrc-header {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .bngrc-top-bar {
            background: var(--bngrc-red);
            color: white;
            padding: 5px 0;
            font-size: 13px;
        }
        
        .bngrc-top-bar a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
        }
        
        .bngrc-top-bar a:hover {
            text-decoration: underline;
        }
        
        .bngrc-main-header {
            padding: 15px 0;
            background: white;
        }
        
        .bngrc-logo {
            max-height: 80px;
        }
        
        .bngrc-logo-text {
            color: var(--bngrc-red);
            font-weight: 700;
            font-size: 24px;
            line-height: 1.2;
        }
        
        .bngrc-logo-sub {
            color: var(--bngrc-dark-gray);
            font-size: 14px;
            font-weight: 400;
        }
        
        /* Navigation */
        .bngrc-nav {
            background: var(--bngrc-blue);
            padding: 0;
        }
        
        .bngrc-nav .navbar-nav .nav-link {
            color: white;
            padding: 15px 20px;
            font-weight: 500;
            font-size: 15px;
            transition: background 0.3s;
        }
        
        .bngrc-nav .navbar-nav .nav-link:hover {
            background: rgba(255,255,255,0.1);
        }
        
        .bngrc-nav .navbar-nav .nav-link.active {
            background: var(--bngrc-red);
        }
        
        .bngrc-nav .navbar-nav .nav-link i {
            margin-right: 8px;
        }
        
        /* Cards */
        .bngrc-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            border: none;
        }
        
        .bngrc-card-header {
            background: var(--bngrc-blue);
            color: white;
            padding: 15px 20px;
            border-radius: 8px 8px 0 0;
            font-weight: 600;
        }
        
        .bngrc-card-header i {
            margin-right: 10px;
        }
        
        .bngrc-card-body {
            padding: 20px;
        }
        
        /* Stats cards */
        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-left: 4px solid var(--bngrc-red);
            margin-bottom: 20px;
        }
        
        .stat-card .stat-title {
            color: #666;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .stat-card .stat-value {
            color: var(--bngrc-dark-gray);
            font-size: 32px;
            font-weight: 700;
            margin: 10px 0;
        }
        
        .stat-card .stat-icon {
            color: var(--bngrc-red);
            font-size: 48px;
            opacity: 0.2;
            position: absolute;
            top: 10px;
            right: 20px;
        }
        
        /* Tables */
        .bngrc-table {
            width: 100%;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .bngrc-table thead th {
            background: var(--bngrc-blue);
            color: white;
            font-weight: 600;
            font-size: 14px;
            padding: 12px;
            border: none;
        }
        
        .bngrc-table tbody td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }
        
        .bngrc-table tbody tr:hover {
            background: var(--bngrc-light-blue);
        }
        
        /* Badges */
        .badge-besoin {
            background: #ffc107;
            color: #000;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: 500;
        }
        
        .badge-don {
            background: #28a745;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: 500;
        }
        
        .badge-urgence {
            background: var(--bngrc-red);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: 500;
        }
        
        /* Progress bar */
        .progress-bngrc {
            height: 10px;
            border-radius: 5px;
            background: #eee;
        }
        
        .progress-bngrc .progress-bar {
            background: var(--bngrc-red);
            border-radius: 5px;
        }
        
        /* Footer */
        .bngrc-footer {
            background: var(--bngrc-blue);
            color: white;
            padding: 30px 0;
            margin-top: 50px;
        }
        
        .bngrc-footer a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
        }
        
        .bngrc-footer a:hover {
            color: white;
        }
        
        .bngrc-copyright {
            background: #002266;
            padding: 15px 0;
            color: rgba(255,255,255,0.6);
            font-size: 13px;
        }
        
        /* Buttons */
        .btn-bngrc {
            background: var(--bngrc-red);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            font-weight: 500;
            transition: background 0.3s;
        }
        
        .btn-bngrc:hover {
            background: var(--bngrc-dark-red);
            color: white;
        }
        
        .btn-bngrc-outline {
            background: transparent;
            color: var(--bngrc-red);
            border: 2px solid var(--bngrc-red);
            padding: 8px 20px;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-bngrc-outline:hover {
            background: var(--bngrc-red);
            color: white;
        }
        
        /* Alert */
        .alert-bngrc {
            background: var(--bngrc-light-blue);
            border-left: 4px solid var(--bngrc-blue);
            color: var(--bngrc-blue);
            padding: 15px;
            border-radius: 5px;
        }
        
        /* Breadcrumb */
        .bngrc-breadcrumb {
            background: white;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .bngrc-breadcrumb a {
            color: var(--bngrc-red);
            text-decoration: none;
        }
        
        .bngrc-breadcrumb .separator {
            margin: 0 10px;
            color: #ccc;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .bngrc-logo-text {
                font-size: 18px;
            }
            
            .bngrc-nav .navbar-nav .nav-link {
                padding: 10px 15px;
            }
            
            .stat-card .stat-value {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <!-- Top bar -->
    <div class="bngrc-top-bar">
        <div class="container">
            <div class="d-flex justify-content-between">
                <div>
                    <a href="#"><i class="fas fa-phone me-1"></i> 913</a>
                    <a href="#"><i class="fas fa-envelope me-1"></i> contact@bngrc.mg</a>
                </div>
                <div>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter ms-3"></i></a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Main header -->
    <div class="bngrc-main-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <!-- Logo placeholder - à remplacer par le vrai logo BNGRC -->
                        <div class="bg-primary text-white p-3 rounded-3 me-3" style="background: var(--bngrc-red) !important;">
                            <i class="fas fa-shield-alt fa-2x"></i>
                        </div>
                        <div>
                            <div class="bngrc-logo-text">BNGRC</div>
                            <div class="bngrc-logo-sub">Bureau National de Gestion des Risques et Catastrophes</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <div class="text-muted">
                        <i class="fas fa-calendar me-2"></i><?php echo date('l d F Y'); ?>
                    </div>
                    <div class="text-muted small">
                        <i class="fas fa-clock me-2"></i><?php echo date('H:i'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bngrc-nav">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], '/dashboard') === 0 ? 'active' : ''; ?>" href="/dashboard">
                            <i class="fas fa-home"></i> Tableau de bord
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], '/villes') === 0 ? 'active' : ''; ?>" href="/villes">
                            <i class="fas fa-city"></i> Villes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], '/besoins') === 0 ? 'active' : ''; ?>" href="/besoins">
                            <i class="fas fa-hand-holding-heart"></i> Besoins
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], '/dons') === 0 ? 'active' : ''; ?>" href="/dons">
                            <i class="fas fa-gift"></i> Dons
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], '/attributions') === 0 ? 'active' : ''; ?>" href="/attributions">
                            <i class="fas fa-exchange-alt"></i> Attributions
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], '/rapports') === 0 ? 'active' : ''; ?>" href="/rapports">
                            <i class="fas fa-chart-bar"></i> Rapports
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Main content -->
    <main class="py-4">
        <div class="container">
            <?php echo $content; ?>
        </div>
    </main>
    
    <!-- Footer -->
    <footer class="bngrc-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>BNGRC</h5>
                    <p>Bureau National de Gestion des Risques et Catastrophes</p>
                    <p><i class="fas fa-map-marker-alt me-2"></i> Antananarivo, Madagascar</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Liens utiles</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Alertes</a></li>
                        <li><a href="#">Prévisions</a></li>
                        <li><a href="#">Conseils</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Contact</h5>
                    <p><i class="fas fa-phone me-2"></i> 913 (gratuit)</p>
                    <p><i class="fas fa-envelope me-2"></i> contact@bngrc.mg</p>
                </div>
            </div>
        </div>
    </footer>
    
    <div class="bngrc-copyright text-center">
        <div class="container">
            &copy; <?php echo date('Y'); ?> BNGRC - Tous droits réservés
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
