<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - BNGRC</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= asset_url('css/bootstrap.min.css') ?>">

    
    <style>
        /* ===== VARIABLES ===== */
        :root {
            --primary: #003366;
            --primary-dark: #002244;
            --primary-light: #e8f0fe;
            --secondary: #D32F2F;
            --secondary-light: #ffebee;
            --success: #2E7D32;
            --success-light: #e8f5e9;
            --info: #0288D1;
            --info-light: #e1f5fe;
            --warning: #ED6C02;
            --warning-light: #fff3e0;
            --danger: #D32F2F;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --white: #ffffff;
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

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--gray-50);
            color: var(--gray-900);
            line-height: 1.5;
        }

        /* ===== LAYOUT PRINCIPAL ===== */
        .main-container {
            padding-top: 160px;
            min-height: 100vh;
            background: var(--gray-50);
        }

        .content-wrapper {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem 3rem 2rem;
        }

        /* ===== PAGE HEADER ===== */
        .page-header {
            background: var(--white);
            border-radius: 20px;
            padding: 1.5rem 2rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--gray-200);
        }

        .page-header-left h1 {
            font-size: 1.875rem;
            font-weight: 700;
            color: var(--gray-900);
            margin: 0 0 0.5rem 0;
            letter-spacing: -0.02em;
        }

        .page-header-left h1 span {
            color: var(--info);
            position: relative;
        }

        .page-header-left h1 span::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--info), transparent);
            border-radius: 2px;
        }

        .page-header-left p {
            color: var(--gray-500);
            font-size: 0.95rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .page-header-left p i {
            color: var(--info);
            font-size: 0.5rem;
        }

        .breadcrumb {
            background: var(--gray-100);
            padding: 0.6rem 1.2rem;
            border-radius: 40px;
            font-size: 0.9rem;
            margin: 0;
        }

        .breadcrumb-item a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .breadcrumb-item a:hover {
            color: var(--primary-dark);
        }

        .breadcrumb-item.active {
            color: var(--gray-500);
        }

        .badge-info {
            background: var(--info-light);
            color: var(--info);
            padding: 0.5rem 1rem;
            border-radius: 40px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .btn-outline-primary {
            background: transparent;
            border: 1.5px solid var(--primary);
            color: var(--primary);
            padding: 0.6rem 1.2rem;
            border-radius: 40px;
            font-size: 0.9rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
            cursor: pointer;
        }

        .btn-outline-primary:hover {
            background: var(--primary);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 51, 102, 0.2);
        }

        .refresh-btn {
            transition: transform 0.5s ease;
        }

        .btn-outline-primary:hover .refresh-btn {
            transform: rotate(180deg);
        }

        /* ===== CARTES STATISTIQUES ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--white);
            border-radius: 24px;
            padding: 1.5rem;
            border: 1px solid var(--gray-200);
            box-shadow: var(--shadow-md);
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
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

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-light);
        }

        .stat-card:hover::before {
            opacity: 1;
        }

        .stat-card.bg-primary {
            background: linear-gradient(135deg, var(--primary) 0%, #1a4a7a 100%);
            color: var(--white);
        }

        .stat-card.bg-success {
            background: linear-gradient(135deg, var(--success) 0%, #1e5a22 100%);
            color: var(--white);
        }

        .stat-card.bg-info {
            background: linear-gradient(135deg, var(--info) 0%, #026aa2 100%);
            color: var(--white);
        }

        .stat-card.bg-warning {
            background: linear-gradient(135deg, var(--warning) 0%, #b85e00 100%);
            color: var(--white);
        }

        .stat-card .card-title {
            font-size: 0.95rem;
            font-weight: 500;
            opacity: 0.9;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .stat-card .card-title i {
            font-size: 1.1rem;
        }

        .stat-card .display-6 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            line-height: 1.2;
        }

        .stat-card small {
            opacity: 0.8;
            font-size: 0.8rem;
        }

        /* ===== CARD PROGRESSION ===== */
        .progress-card {
            background: var(--white);
            border-radius: 24px;
            border: 1px solid var(--gray-200);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            margin-bottom: 2rem;
        }

        .progress-card-body {
            padding: 1.5rem;
        }

        .progress-card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .progress-card-title i {
            color: var(--success);
            font-size: 1.2rem;
        }

        .progress {
            height: 12px;
            border-radius: 30px;
            background: var(--gray-200);
            overflow: hidden;
            margin-bottom: 0.75rem;
        }

        .progress-bar {
            background: linear-gradient(90deg, var(--success), #4caf50);
            border-radius: 30px;
            transition: width 0.5s ease;
            color: var(--white);
            font-size: 0.75rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding-right: 0.5rem;
        }

        .progress-stats {
            display: flex;
            justify-content: space-between;
            color: var(--gray-600);
            font-size: 0.9rem;
        }

        .progress-stats strong {
            color: var(--gray-900);
        }

        /* ===== TABLE CARD ===== */
        .table-card {
            background: var(--white);
            border-radius: 24px;
            border: 1px solid var(--gray-200);
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }

        .table-card-header {
            background: linear-gradient(135deg, var(--primary) 0%, #1a4a7a 100%);
            color: var(--white);
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-card-header h5 {
            margin: 0;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .table-card-header h5 i {
            font-size: 1.1rem;
        }

        .table-card-body {
            padding: 1.5rem;
        }

        /* ===== TABLE ===== */
        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
        }

        th {
            text-align: left;
            padding: 1rem 1.5rem;
            background: var(--gray-50);
            color: var(--gray-700);
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            border-bottom: 1px solid var(--gray-200);
        }

        td {
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid var(--gray-200);
            color: var(--gray-900);
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: var(--gray-50);
        }

        /* ===== BADGES ===== */
        .badge-restant {
            padding: 0.3rem 1rem;
            border-radius: 40px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
        }

        .badge-restant.bg-warning {
            background: var(--warning-light) !important;
            color: var(--warning) !important;
        }

        .badge-restant.bg-success {
            background: var(--success-light) !important;
            color: var(--success) !important;
        }

        .ville-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .ville-info i {
            color: var(--primary);
            font-size: 1rem;
        }

        .region-badge {
            background: var(--gray-100);
            color: var(--gray-600);
            padding: 0.2rem 0.8rem;
            border-radius: 30px;
            font-size: 0.75rem;
            margin-left: 0.5rem;
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state i {
            font-size: 4rem;
            color: var(--gray-300);
            margin-bottom: 1rem;
        }

        .empty-state h5 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: var(--gray-500);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .content-wrapper {
                padding: 0 1rem 2rem 1rem;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .stat-card .display-6 {
                font-size: 1.5rem;
            }

            .table-card-body {
                padding: 1rem;
            }

            th, td {
                padding: 0.75rem 1rem;
                white-space: nowrap;
            }
        }

        @media (max-width: 480px) {
            .page-header-left h1 {
                font-size: 1.5rem;
            }

            .d-flex {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-outline-primary {
                width: 100%;
                justify-content: center;
            }

            .badge-info {
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../inc/header.php'; ?>

    <div class="main-container">
        <div class="content-wrapper">
            <!-- En-tête -->
            <div class="page-header">
                <div class="page-header-left">
                    <h1>
                        Récapitulatif <span>global</span>
                    </h1>
                    <p>
                        <i class="fas fa-circle"></i>
                        Vue d'ensemble des besoins, attributions et achats
                    </p>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge-info" id="lastUpdate">
                        <i class="fas fa-clock me-2"></i>
                        Chargement...
                    </span>
                    <button class="btn-outline-primary" onclick="chargerDonnees()" id="refreshBtn">
                        <i class="fas fa-sync-alt refresh-btn" id="refreshIcon"></i>
                        Actualiser
                    </button>
                </div>
            </div>

            <!-- Cartes statistiques -->
            <div class="stats-grid" id="cartesContainer">
                <div class="stat-card bg-primary">
                    <div class="card-title">
                        <i class="fas fa-clipboard-list"></i>
                        Besoins totaux
                    </div>
                    <div class="display-6" id="besoinsTotaux">0 Ar</div>
                    <small>Valeur totale des besoins</small>
                </div>
                <div class="stat-card bg-success">
                    <div class="card-title">
                        <i class="fas fa-check-circle"></i>
                        Attribué
                    </div>
                    <div class="display-6" id="attributionsTotales">0 Ar</div>
                    <small>Dons déjà attribués</small>
                </div>
                <div class="stat-card bg-info">
                    <div class="card-title">
                        <i class="fas fa-shopping-cart"></i>
                        Achats
                    </div>
                    <div class="display-6" id="achatsTotaux">0 Ar</div>
                    <small>Dont frais inclus</small>
                </div>
                <div class="stat-card bg-warning">
                    <div class="card-title">
                        <i class="fas fa-hourglass-half"></i>
                        Restants
                    </div>
                    <div class="display-6" id="besoinsRestants">0 Ar</div>
                    <small>Besoins non satisfaits</small>
                </div>
            </div>

            <!-- Barre de progression -->
            <div class="progress-card">
                <div class="progress-card-body">
                    <div class="progress-card-title">
                        <i class="fas fa-chart-line"></i>
                        Progression globale
                    </div>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 0%;" id="progressFill">0%</div>
                    </div>
                    <div class="progress-stats">
                        <span>Réalisé: <strong id="realiseLabel">0 Ar</strong></span>
                        <span>Total: <strong id="totalLabel">0 Ar</strong></span>
                    </div>
                </div>
            </div>

            <!-- Tableau par ville -->
            <div class="table-card">
                <div class="table-card-header">
                    <h5>
                        <i class="fas fa-map-marker-alt"></i>
                        Détail par ville
                    </h5>
                    <span class="badge bg-white text-primary" id="villeCount">0 ville(s)</span>
                </div>
                <div class="table-card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Ville / Région</th>
                                    <th class="text-end">Besoins totaux</th>
                                    <th class="text-end">Attribué</th>
                                    <th class="text-end">Reste</th>
                                    <th>Progression</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <tr>
                                    <td colspan="5" class="empty-state">
                                        <i class="fas fa-spinner fa-spin"></i>
                                        <h5>Chargement des données...</h5>
                                        <p>Veuillez patienter</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../inc/footer.php'; ?>

    <script src="<?= asset_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script>
        function chargerDonnees() {
            const refreshIcon = document.getElementById('refreshIcon');
            refreshIcon.style.transform = 'rotate(180deg)';
            
            fetch('http://172.16.7.131/ETU003955/EXAMEN-FINAL/public/recapitulatif/data')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        mettreAJourAffichage(data.data);
                        document.getElementById('lastUpdate').innerHTML = 
                            '<i class="fas fa-clock me-2"></i>' + 
                            new Date().toLocaleTimeString('fr-FR', {
                                hour: '2-digit',
                                minute: '2-digit',
                                second: '2-digit'
                            });
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    document.getElementById('tableBody').innerHTML = `
                        <tr>
                            <td colspan="5" class="empty-state">
                                <i class="fas fa-exclamation-triangle" style="color: var(--danger);"></i>
                                <h5>Erreur de chargement</h5>
                                <p>Impossible de charger les données</p>
                                <button class="btn-outline-primary mt-3" onclick="chargerDonnees()">
                                    <i class="fas fa-redo me-2"></i>
                                    Réessayer
                                </button>
                            </td>
                        </tr>
                    `;
                })
                .finally(() => {
                    setTimeout(() => {
                        refreshIcon.style.transform = 'rotate(0deg)';
                    }, 500);
                });
        }

        function mettreAJourAffichage(data) {
            const formatMoney = (value) => {
                return new Intl.NumberFormat('fr-FR').format(value) + ' Ar';
            };

            // Cartes
            document.getElementById('besoinsTotaux').textContent = formatMoney(data.besoins_totaux);
            document.getElementById('attributionsTotales').textContent = formatMoney(data.attributions_totales);
            document.getElementById('achatsTotaux').textContent = formatMoney(data.achats_totaux);
            document.getElementById('besoinsRestants').textContent = formatMoney(data.besoins_restants);

            // Progression
            const total = data.besoins_totaux;
            const realise = data.attributions_totales;
            const pourcentage = total > 0 ? (realise / total * 100) : 0;
            
            document.getElementById('progressFill').style.width = pourcentage + '%';
            document.getElementById('progressFill').textContent = pourcentage.toFixed(1) + '%';
            document.getElementById('realiseLabel').textContent = formatMoney(realise);
            document.getElementById('totalLabel').textContent = formatMoney(total);

            // Compteur villes
            document.getElementById('villeCount').textContent = 
                (data.details_par_ville?.length || 0) + ' ville(s)';

            // Tableau
            let html = '';
            if (data.details_par_ville && data.details_par_ville.length > 0) {
                data.details_par_ville.forEach(ville => {
                    const reste = ville.total_besoins - ville.total_attribue;
                    const progression = ville.total_besoins > 0 ? 
                        (ville.total_attribue / ville.total_besoins * 100) : 0;
                    
                    html += `<tr>
                        <td>
                            <div class="ville-info">
                                <i class="fas fa-map-marker-alt"></i>
                                <div>
                                    <strong>${ville.ville_nom || 'Inconnue'}</strong>
                                    <span class="region-badge">${ville.region || '-'}</span>
                                </div>
                            </div>
                        </td>
                        <td class="text-end"><strong>${formatMoney(ville.total_besoins || 0)}</strong></td>
                        <td class="text-end text-success">${formatMoney(ville.total_attribue || 0)}</td>
                        <td class="text-end">
                            <span class="badge-restant ${reste > 0 ? 'bg-warning' : 'bg-success'}">
                                ${formatMoney(reste)}
                            </span>
                        </td>
                        <td style="width: 200px;">
                            <div class="progress" style="height: 24px;">
                                <div class="progress-bar bg-success" 
                                     style="width: ${progression}%;">
                                    ${progression.toFixed(1)}%
                                </div>
                            </div>
                        </td>
                    </tr>`;
                });
            } else {
                html = `<tr>
                    <td colspan="5" class="empty-state">
                        <i class="fas fa-database"></i>
                        <h5>Aucune donnée disponible</h5>
                        <p>Les données n'ont pas encore été chargées</p>
                    </td>
                </tr>`;
            }
            document.getElementById('tableBody').innerHTML = html;
        }

        document.addEventListener('DOMContentLoaded', function() {
            chargerDonnees();
            setInterval(chargerDonnees, 30000);
        });
    </script>
</body>
</html>