<?php
// /app/views/accueil.php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* ===== VARIABLES ===== */
        :root {
            --primary: #003366;
            --primary-dark: #002244;
            --primary-light: #E8EEF5;
            --secondary: #D32F2F;
            --secondary-light: #FEF2F2;
            --success: #2E7D32;
            --success-light: #E8F3E9;
            --info: #0288D1;
            --info-light: #E6F0F9;
            --warning: #ED6C02;
            --warning-light: #FEF3E2;
            --gray-50: #F9FAFB;
            --gray-100: #F3F4F6;
            --gray-200: #E5E7EB;
            --gray-300: #D1D5DB;
            --gray-400: #9CA3AF;
            --gray-500: #6B7280;
            --gray-600: #4B5563;
            --gray-700: #374151;
            --gray-800: #1F2937;
            --gray-900: #111827;
            --white: #FFFFFF;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        /* ===== RESET & BASE ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: var(--white);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            line-height: 1.5;
            color: var(--gray-900);
        }

        /* ===== LAYOUT PRINCIPAL ===== */
        .site-wrapper {
            flex: 1 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 2rem 1rem;
        }

        .main-container {
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
        }

        /* ===== CARD PRINCIPALE ===== */
        .welcome-card {
            background: var(--white);
            border-radius: 48px;
            padding: 3rem;
            box-shadow: var(--shadow-xl);
            border: 1px solid var(--gray-200);
            width: 100%;
        }

        /* ===== HEADER ===== */
        .portal-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .logo-item {
            padding: 1rem 2.5rem;
            background: var(--gray-50);
            border-radius: 100px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            transition: transform 0.2s;
        }

        .logo-item:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .logo-item img {
            height: 60px;
            width: auto;
            display: block;
        }

        .portal-title {
            font-size: 2.75rem;
            font-weight: 800;
            color: var(--gray-900);
            margin-bottom: 0.75rem;
            letter-spacing: -0.02em;
            line-height: 1.2;
        }

        .portal-title span {
            color: var(--secondary);
            position: relative;
            display: inline-block;
        }

        .portal-title span::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--secondary), transparent);
            border-radius: 2px;
        }

        .portal-subtitle {
            font-size: 1.125rem;
            color: var(--gray-500);
            max-width: 600px;
            margin: 0 auto;
        }

        /* ===== STATS ===== */
        .stats-row {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-bottom: 2.5rem;
            flex-wrap: wrap;
        }

        .stat-item {
            background: var(--gray-50);
            padding: 0.75rem 1.75rem;
            border-radius: 100px;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            font-size: 0.95rem;
            transition: transform 0.2s;
        }

        .stat-item:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .stat-item i {
            color: var(--secondary);
            font-size: 1.1rem;
        }

        .stat-item strong {
            color: var(--primary);
            font-size: 1.2rem;
            margin-right: 0.25rem;
        }

        .urgent-badge {
            background: var(--secondary);
            color: var(--white);
            padding: 0.25rem 0.75rem;
            border-radius: 100px;
            font-size: 0.7rem;
            font-weight: 600;
            margin-left: 0.5rem;
            letter-spacing: 0.5px;
        }

        /* ===== SEARCH ===== */
        .search-section {
            margin-bottom: 2.5rem;
        }

        .search-container {
            max-width: 500px;
            margin: 0 auto;
            position: relative;
        }

        .search-container i {
            position: absolute;
            left: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            font-size: 1.1rem;
            pointer-events: none;
        }

        .search-container input {
            width: 100%;
            padding: 1.1rem 1.5rem 1.1rem 3.5rem;
            border: 2px solid var(--gray-200);
            border-radius: 60px;
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s;
            background: var(--white);
            box-shadow: var(--shadow-sm);
        }

        .search-container input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(0, 51, 102, 0.1);
        }

        .search-container input::placeholder {
            color: var(--gray-400);
        }

        /* ===== MODULES GRID ===== */
        .modules-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .module-card {
            background: var(--white);
            border-radius: 28px;
            padding: 1.75rem;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid var(--gray-200);
            box-shadow: var(--shadow-md);
            position: relative;
            overflow: hidden;
        }

        .module-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            opacity: 0;
            transition: opacity 0.3s;
        }

        .module-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-xl);
            border-color: var(--primary);
        }

        .module-card:hover::before {
            opacity: 1;
        }

        .module-icon {
            width: 64px;
            height: 64px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.25rem;
            font-size: 1.75rem;
            transition: transform 0.3s;
        }

        .module-card:hover .module-icon {
            transform: scale(1.1);
        }

        .module-icon.bg-primary-soft { background: var(--primary-light); color: var(--primary); }
        .module-icon.bg-success-soft { background: var(--success-light); color: var(--success); }
        .module-icon.bg-warning-soft { background: var(--warning-light); color: var(--warning); }
        .module-icon.bg-info-soft { background: var(--info-light); color: var(--info); }

        .module-title {
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 0.5rem;
            letter-spacing: -0.02em;
        }

        .module-description {
            color: var(--gray-500);
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 1.25rem;
        }

        .module-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary);
            font-weight: 500;
            font-size: 0.95rem;
            transition: gap 0.2s;
        }

        .module-card:hover .module-link {
            gap: 0.75rem;
        }

        .module-link i {
            transition: transform 0.2s;
        }

        .module-card:hover .module-link i {
            transform: translateX(4px);
        }

        /* ===== QUICK LINKS ===== */
        .quick-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn {
            padding: 0.9rem 2rem;
            border-radius: 100px;
            font-size: 0.95rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
        }

        .btn-primary {
            background: var(--primary);
            color: var(--white);
            box-shadow: 0 4px 12px rgba(0, 51, 102, 0.2);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 51, 102, 0.3);
        }

        .btn-success {
            background: var(--success);
            color: var(--white);
            box-shadow: 0 4px 12px rgba(46, 125, 50, 0.2);
        }

        .btn-success:hover {
            background: #1E5A22;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(46, 125, 50, 0.3);
        }

        .btn-info {
            background: var(--info);
            color: var(--white);
            box-shadow: 0 4px 12px rgba(2, 136, 209, 0.2);
        }

        .btn-info:hover {
            background: #026AA2;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(2, 136, 209, 0.3);
        }

        /* ===== FOOTER ===== */
        .site-footer {
            flex-shrink: 0;
            width: 100%;
            background: var(--gray-50);
            color: var(--gray-600);
            padding: 1.5rem 0;
            border-top: 1px solid var(--gray-200);
        }

        .footer-content {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-content p {
            margin: 0;
            font-size: 0.9rem;
        }

        .footer-links {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .footer-links a {
            color: var(--gray-600);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: var(--primary);
        }

        .footer-version {
            background: var(--gray-200);
            padding: 0.25rem 1rem;
            border-radius: 100px;
            font-size: 0.8rem;
            color: var(--gray-700);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .modules-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .site-wrapper {
                padding: 1.5rem 1rem;
            }

            .welcome-card {
                padding: 2rem 1.5rem;
                border-radius: 32px;
            }

            .portal-title {
                font-size: 2.25rem;
            }

            .logo-item {
                padding: 0.75rem 1.5rem;
            }

            .logo-item img {
                height: 40px;
            }

            .modules-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .quick-links {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .stats-row {
                flex-direction: column;
                align-items: center;
                gap: 0.75rem;
            }

            .stat-item {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }

            .footer-content {
                flex-direction: column;
                text-align: center;
                padding: 0 1.5rem;
            }

            .footer-links {
                justify-content: center;
                gap: 1rem;
            }
        }

        @media (max-width: 480px) {
            .portal-title {
                font-size: 1.875rem;
            }

            .portal-subtitle {
                font-size: 0.95rem;
            }

            .module-card {
                padding: 1.5rem;
            }

            .module-icon {
                width: 56px;
                height: 56px;
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="site-wrapper">
        <div class="main-container">
            <div class="welcome-card">
                <!-- Header -->
                <div class="portal-header">
                    <div class="logo-container">
                        <div class="logo-item">
                            <img src="/assets/images/republique.png" alt="République de Madagascar">
                        </div>
                        <div class="logo-item">
                            <img src="/assets/images/interieure.png" alt="Ministère de l'Intérieur">
                        </div>
                        <div class="logo-item">
                            <img src="/assets/images/bngrc.png" alt="BNGRC">
                        </div>
                    </div>
                    <h1 class="portal-title">
                        <span>BNGRC</span> Portal
                    </h1>
                    <p class="portal-subtitle">
                        Bureau National de Gestion des Risques et des Catastrophes
                    </p>
                </div>

                <!-- Stats -->
                <div class="stats-row">
                    <div class="stat-item">
                        <i class="fas fa-city"></i>
                        <span><strong>12</strong> villes actives</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span><strong>45</strong> besoins</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-gift"></i>
                        <span><strong>28</strong> dons</span>
                        <span class="urgent-badge">3 urgents</span>
                    </div>
                </div>

                <!-- Search -->
                <div class="search-section">
                    <div class="search-container">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Rechercher une ville, un besoin, un don..." id="globalSearch">
                    </div>
                </div>

                <!-- Modules Grid -->
                <div class="modules-grid">
                    <a href="/dashboard" class="module-card">
                        <div class="module-icon bg-primary-soft">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <h3 class="module-title">Dashboard</h3>
                        <p class="module-description">Vue d'ensemble des statistiques et indicateurs clés</p>
                        <div class="module-link">
                            <span>Accéder</span>
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <a href="/villes/liste" class="module-card">
                        <div class="module-icon bg-success-soft">
                            <i class="fas fa-city"></i>
                        </div>
                        <h3 class="module-title">Villes</h3>
                        <p class="module-description">Gérer les villes et leurs informations</p>
                        <div class="module-link">
                            <span>Accéder</span>
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <a href="/besoins/liste" class="module-card">
                        <div class="module-icon bg-warning-soft">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <h3 class="module-title">Besoins</h3>
                        <p class="module-description">Gérer les besoins d'aide humanitaire</p>
                        <div class="module-link">
                            <span>Accéder</span>
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <a href="/dons/liste" class="module-card">
                        <div class="module-icon bg-info-soft">
                            <i class="fas fa-gift"></i>
                        </div>
                        <h3 class="module-title">Dons</h3>
                        <p class="module-description">Gérer les dons reçus et leur répartition</p>
                        <div class="module-link">
                            <span>Accéder</span>
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>
                </div>

                <!-- Quick Actions -->
                <div class="quick-links">
                    <a href="/besoins/ajouter" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Nouveau besoin
                    </a>
                    <a href="/dons/ajouter" class="btn btn-success">
                        <i class="fas fa-gift"></i>
                        Nouveau don
                    </a>
                    <a href="/dispatch" class="btn btn-info">
                        <i class="fas fa-rocket"></i>
                        Dispatch
                    </a>
                </div>
            </div>
        </div>
    </div>

    <footer class="site-footer">
        <div class="footer-content">
            <p>&copy; 2023-2026 BNGRC – Tous droits réservés</p>
            <div class="footer-links">
                <a href="/mentions-legales">Mentions légales</a>
                <a href="/confidentialite">Confidentialité</a>
                <a href="/contact">Contact</a>
            </div>
            <div class="footer-version">Version 2.0</div>
        </div>
    </footer>

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script>
        const searchInput = document.getElementById('globalSearch');
        if(searchInput) {
            searchInput.addEventListener('keypress', function(e) {
                if(e.key === 'Enter') {
                    const query = this.value.trim();
                    if(query) {
                        window.location.href = `/recherche?q=${encodeURIComponent(query)}`;
                    }
                }
            });
        }
    </script>
</body>
</html>