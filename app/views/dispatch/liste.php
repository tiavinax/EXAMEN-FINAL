<?php 
// villes/liste.php
$title = "Liste des villes - BNGRC";
$page_css = ['liste_villes'];
include __DIR__ . '/../inc/header.php';
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
            color: var(--primary);
            position: relative;
        }

        .page-header-left h1 span::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), transparent);
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
            color: var(--primary);
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

        .btn-primary {
            background: var(--primary);
            color: var(--white);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 40px;
            font-size: 0.95rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(0, 51, 102, 0.2);
            cursor: pointer;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 51, 102, 0.3);
            color: var(--white);
        }

        /* ===== ALERTS ===== */
        .alert-custom {
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 0.95rem;
            border-left-width: 4px;
            border-left-style: solid;
            box-shadow: var(--shadow-sm);
        }

        .alert-custom.success {
            background: var(--success-light);
            border-left-color: var(--success);
            color: var(--success);
            border: 1px solid rgba(46, 125, 50, 0.2);
        }

        .alert-custom.error {
            background: var(--secondary-light);
            border-left-color: var(--danger);
            color: var(--danger);
            border: 1px solid rgba(211, 47, 47, 0.2);
        }

        .alert-custom i {
            font-size: 1.25rem;
        }

        /* ===== STATS CARDS ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--white);
            border-radius: 20px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            border: 1px solid var(--gray-200);
            transition: all 0.3s;
            box-shadow: var(--shadow-sm);
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-light);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
        }

        .bg-primary-soft { background: var(--primary-light); color: var(--primary); }
        .bg-success-soft { background: var(--success-light); color: var(--success); }
        .bg-info-soft { background: var(--info-light); color: var(--info); }

        .stat-content {
            flex: 1;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--gray-900);
            line-height: 1.2;
            margin-bottom: 0.2rem;
        }

        .stat-label {
            font-size: 0.85rem;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        /* ===== FILTERS ===== */
        .filters-section {
            background: var(--white);
            border-radius: 16px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            border: 1px solid var(--gray-200);
            box-shadow: var(--shadow-sm);
        }

        .form-select {
            border: 1.5px solid var(--gray-200);
            border-radius: 40px;
            padding: 0.6rem 2rem 0.6rem 1rem;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            background: var(--white);
            cursor: pointer;
            transition: all 0.2s;
        }

        .form-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(0, 51, 102, 0.1);
        }

        .search-box {
            position: relative;
            width: 280px;
        }

        .search-box i {
            position: absolute;
            left: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            font-size: 0.9rem;
            pointer-events: none;
        }

        .search-box input {
            width: 100%;
            padding: 0.7rem 1rem 0.7rem 2.8rem;
            border: 1.5px solid var(--gray-200);
            border-radius: 40px;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s;
            background: var(--white);
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(0, 51, 102, 0.1);
        }

        .search-box input::placeholder {
            color: var(--gray-400);
        }

        /* ===== TABLE CONTAINER ===== */
        .table-container {
            background: var(--white);
            border-radius: 24px;
            border: 1px solid var(--gray-200);
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }

        .table-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--gray-200);
            background: var(--gray-50);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .table-title i {
            color: var(--primary);
            font-size: 1.2rem;
        }

        .table-title h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--gray-900);
            margin: 0;
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
        .badge-id {
            background: var(--gray-100);
            padding: 0.3rem 0.8rem;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--gray-700);
            display: inline-block;
            border: 1px solid var(--gray-200);
        }

        .badge-ville {
            background: var(--primary-light);
            padding: 0.3rem 1rem;
            border-radius: 30px;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            color: var(--primary);
            font-weight: 600;
            border: 1px solid rgba(0, 51, 102, 0.1);
        }

        .badge-ville i {
            color: var(--primary);
            font-size: 0.8rem;
        }

        .badge-region {
            background: var(--gray-100);
            padding: 0.3rem 1rem;
            border-radius: 30px;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            color: var(--gray-700);
            font-weight: 500;
        }

        .badge-region i {
            color: var(--primary);
        }

        /* ===== DATE INFO ===== */
        .date-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--gray-700);
            font-size: 0.9rem;
        }

        .date-info i {
            color: var(--gray-400);
            font-size: 0.85rem;
        }

        .date-info small {
            color: var(--gray-500);
            font-size: 0.8rem;
            margin-left: 0.25rem;
        }

        /* ===== ACTION BUTTONS ===== */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            border: 1px solid var(--gray-200);
            background: var(--white);
            color: var(--gray-600);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.2s;
            font-size: 0.95rem;
        }

        .btn-icon:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--white);
        }

        .btn-icon.warning:hover {
            background: var(--warning);
            border-color: var(--warning);
        }

        .btn-icon.danger:hover {
            background: var(--danger);
            border-color: var(--danger);
        }

        /* ===== TABLE FOOTER ===== */
        .table-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--gray-200);
            background: var(--gray-50);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pagination {
            display: flex;
            gap: 0.3rem;
            margin: 0;
            padding: 0;
        }

        .page-item {
            list-style: none;
        }

        .page-link {
            padding: 0.4rem 0.8rem;
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            color: var(--gray-600);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.2s;
            display: block;
            background: var(--white);
        }

        .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--white);
        }

        .page-link:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--white);
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
            margin-bottom: 1.5rem;
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

            .filters-section {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box {
                width: 100%;
            }

            .form-select {
                width: 100% !important;
            }

            .table-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .table-footer {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .action-buttons {
                flex-wrap: wrap;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .page-header-left h1 {
                font-size: 1.5rem;
            }

            .stat-value {
                font-size: 1.5rem;
            }

            th, td {
                padding: 0.75rem 1rem;
                white-space: nowrap;
            }
        }
    </style>
</head>
<body>

    <div class="main-container">
        <div class="content-wrapper">
            <!-- En-tête -->
            <div class="page-header">
                <div class="page-header-left">
                    <h1>
                        Liste des <span>villes</span>
                    </h1>
                    <p>
                        <i class="fas fa-circle"></i>
                        Gérez les villes et leurs informations
                    </p>
                </div>
                <div class="d-flex gap-3 align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Villes</li>
                        </ol>
                    </nav>
                    <a href="/villes/ajouter" class="btn-primary">
                        <i class="fas fa-plus"></i>
                        Nouvelle ville
                    </a>
                </div>
            </div>

            <!-- Messages -->
            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert-custom success">
                    <i class="fas fa-check-circle"></i>
                    <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert-custom error">
                    <i class="fas fa-exclamation-triangle"></i>
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <!-- Statistiques -->
            <?php if(!empty($villes)): 
                $totalVilles = count($villes);
                $totalRegions = count(array_unique(array_column($villes, 'region')));
                $dateRecent = max(array_column($villes, 'created_at'));
            ?>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon bg-primary-soft">
                        <i class="fas fa-city"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value"><?= $totalVilles ?></div>
                        <div class="stat-label">Total villes</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bg-success-soft">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value"><?= $totalRegions ?></div>
                        <div class="stat-label">Régions</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bg-info-soft">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value"><?= date('d/m/Y', strtotime($dateRecent)) ?></div>
                        <div class="stat-label">Dernière mise à jour</div>
                    </div>
                </div>
            </div>

            <!-- Filtres -->
            <div class="filters-section">
                <div class="d-flex gap-3 align-items-center">
                    <span class="text-muted"><i class="fas fa-filter me-1"></i>Filtrer :</span>
                    <select class="form-select" style="width: auto;" id="regionFilter">
                        <option value="">Toutes les régions</option>
                        <?php 
                        $regions = array_unique(array_column($villes, 'region'));
                        sort($regions);
                        foreach($regions as $region): 
                        ?>
                            <option value="<?= htmlspecialchars($region) ?>"><?= htmlspecialchars($region) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Rechercher une ville..." id="searchInput">
                </div>
            </div>
            <?php endif; ?>

            <!-- Tableau -->
            <div class="table-container">
                <div class="table-header">
                    <div class="table-title">
                        <i class="fas fa-list-ul"></i>
                        <h3>Liste des villes</h3>
                    </div>
                </div>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ville</th>
                                <th>Région</th>
                                <th>Date création</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php if(empty($villes)): ?>
                                <tr>
                                    <td colspan="5" class="empty-state">
                                        <i class="fas fa-city"></i>
                                        <h5>Aucune ville enregistrée</h5>
                                        <p>Commencez par ajouter votre première ville</p>
                                        <a href="/villes/ajouter" class="btn-primary">
                                            <i class="fas fa-plus"></i> Ajouter une ville
                                        </a>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach($villes as $ville): ?>
                                <tr class="ville-row" data-region="<?= htmlspecialchars($ville->region) ?>">
                                    <td>
                                        <span class="badge-id">#<?= str_pad($ville->id, 3, '0', STR_PAD_LEFT) ?></span>
                                    </td>
                                    <td>
                                        <span class="badge-ville">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <?= htmlspecialchars($ville->nom) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge-region">
                                            <i class="fas fa-map-signs"></i>
                                            <?= htmlspecialchars($ville->region) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="date-info">
                                            <i class="fas fa-calendar-alt"></i>
                                            <?= date('d/m/Y', strtotime($ville->created_at)) ?>
                                            <small><?= date('H:i', strtotime($ville->created_at)) ?></small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="/villes/modifier/<?= $ville->id ?>" class="btn-icon warning" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="/villes/supprimer/<?= $ville->id ?>" 
                                               class="btn-icon danger" 
                                               title="Supprimer"
                                               onclick="return confirm('Supprimer cette ville ? Tous les besoins associés seront également supprimés.')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if(!empty($villes)): ?>
                <div class="table-footer">
                    <div class="text-muted">
                        <i class="fas fa-database"></i> <?= count($villes) ?> ville(s) · <?= $totalRegions ?> région(s)
                    </div>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">«</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">»</a></li>
                        </ul>
                    </nav>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../inc/footer.php'; ?>
    
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script>
        const searchInput = document.getElementById('searchInput');
        if(searchInput) {
            searchInput.addEventListener('keyup', function() {
                const search = this.value.toLowerCase();
                const rows = document.querySelectorAll('.ville-row');
                
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(search) ? '' : 'none';
                });
            });
        }

        const regionFilter = document.getElementById('regionFilter');
        if(regionFilter) {
            regionFilter.addEventListener('change', function() {
                const region = this.value;
                const rows = document.querySelectorAll('.ville-row');
                
                rows.forEach(row => {
                    const match = !region || row.dataset.region === region;
                    row.style.display = match ? '' : 'none';
                });
            });
        }
    </script>
</body>
</html>