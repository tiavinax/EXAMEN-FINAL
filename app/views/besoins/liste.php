<?php 
// dashboard/liste_besoins.php
$title = "Liste des besoins - BNGRC";
$page_css = ['liste_besoins'];
include __DIR__ . '/../inc/header.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <!-- Les CSS sont déjà dans header.php (Bootstrap, Font Awesome, etc.) -->
    <style>
        /* Ajustements spécifiques */
        :root {
            --primary: #003366;
            --secondary: #D32F2F;
            --success: #2E7D32;
            --info: #0288D1;
            --warning: #ED6C02;
            --danger: #D32F2F;
            --dark: #1A1A1A;
            --light: #F5F7FA;
            --gray: #6B7280;
            --border: #E5E7EB;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #F3F4F6;
            margin: 0;
            padding: 0;
        }

        /* Ajustement principal - plus de chevauchement */
        .main-container {
            padding-top: 160px; /* Ajusté pour le header fixe */
            min-height: 100vh;
            background: #F3F4F6;
        }

        .content-wrapper {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem 3rem 2rem;
        }

        /* Page Header */
        .page-header {
            background: white;
            border-radius: 20px;
            padding: 1.5rem 2rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            border: 1px solid var(--border);
        }

        .page-header-left h1 {
            font-size: 1.875rem;
            font-weight: 600;
            color: #111827;
            margin: 0 0 0.5rem 0;
            letter-spacing: -0.02em;
        }

        .page-header-left h1 span {
            color: var(--secondary);
            font-weight: 700;
            position: relative;
        }

        .page-header-left h1 span::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--secondary), transparent);
            border-radius: 2px;
        }

        .page-header-left p {
            color: var(--gray);
            font-size: 0.95rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .page-header-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .breadcrumb {
            background: #F3F4F6;
            padding: 0.6rem 1.2rem;
            border-radius: 40px;
            font-size: 0.9rem;
            margin: 0;
        }

        .breadcrumb-item a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .breadcrumb-item.active {
            color: var(--gray);
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 40px;
            font-size: 0.95rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: 0 4px 10px rgba(0,51,102,0.2);
            cursor: pointer;
        }

        .btn-primary:hover {
            background: #002244;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0,51,102,0.3);
            color: white;
        }

        /* Alerts */
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
        }

        .alert-custom.success {
            background: #F0FDF4;
            border-left-color: var(--success);
            color: #166534;
        }

        .alert-custom.error {
            background: #FEF2F2;
            border-left-color: var(--danger);
            color: #991B1B;
        }

        .alert-custom i {
            font-size: 1.25rem;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            border: 1px solid var(--border);
            transition: all 0.2s;
            box-shadow: 0 2px 6px rgba(0,0,0,0.02);
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 20px -8px rgba(0,0,0,0.1);
            border-color: var(--primary);
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
        }

        .bg-primary-soft { background: #E8EEF5; color: var(--primary); }
        .bg-success-soft { background: #E8F3E9; color: var(--success); }
        .bg-warning-soft { background: #FEF3E2; color: var(--warning); }
        .bg-info-soft { background: #E6F0F9; color: var(--info); }

        .stat-content {
            flex: 1;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: #111827;
            line-height: 1.2;
            margin-bottom: 0.2rem;
        }

        .stat-label {
            font-size: 0.85rem;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        /* Filters */
        .filters-section {
            background: white;
            border-radius: 16px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            border: 1px solid var(--border);
            box-shadow: 0 2px 6px rgba(0,0,0,0.02);
        }

        .filters-group {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .filter-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: #F9FAFB;
            padding: 0.5rem 1rem 0.5rem 1.2rem;
            border-radius: 40px;
            border: 1px solid var(--border);
        }

        .filter-item i {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .filter-item select {
            border: none;
            background: transparent;
            color: #111827;
            font-size: 0.9rem;
            font-weight: 500;
            outline: none;
            cursor: pointer;
            padding-right: 1rem;
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
            color: var(--gray);
            font-size: 0.9rem;
        }

        .search-box input {
            width: 100%;
            padding: 0.7rem 1rem 0.7rem 2.8rem;
            border: 1px solid var(--border);
            border-radius: 40px;
            font-size: 0.9rem;
            background: #F9FAFB;
            transition: all 0.2s;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 3px rgba(0,51,102,0.1);
        }

        /* Table */
        .table-container {
            background: white;
            border-radius: 20px;
            border: 1px solid var(--border);
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        }

        .table-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border);
            background: #F9FAFB;
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
            color: var(--secondary);
            font-size: 1.2rem;
        }

        .table-title h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #111827;
            margin: 0;
        }

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
            background: #F9FAFB;
            color: #374151;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            border-bottom: 1px solid var(--border);
        }

        td {
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid var(--border);
            color: #111827;
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: #F9FAFB;
        }

        /* Badges */
        .badge-id {
            background: #F3F4F6;
            padding: 0.3rem 0.8rem;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #374151;
            display: inline-block;
            border: 1px solid var(--border);
        }

        .badge-ville {
            background: #F3F4F6;
            padding: 0.3rem 1rem;
            border-radius: 30px;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            color: #111827;
            border: 1px solid var(--border);
        }

        .badge-ville i {
            color: var(--primary);
            font-size: 0.8rem;
        }

        .badge-ville small {
            color: var(--gray);
            font-size: 0.75rem;
        }

        .badge-type {
            padding: 0.3rem 1rem;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .badge-type.nature {
            background: #E8F3E9;
            color: #166534;
        }

        .badge-type.materiaux {
            background: #F3F4F6;
            color: #4B5563;
        }

        .badge-type.argent {
            background: #FEF3E2;
            color: #9A5B00;
        }

        /* Montants */
        .montant {
            font-weight: 600;
        }

        .montant.nature { color: #166534; }
        .montant.materiaux { color: #4B5563; }
        .montant.argent { color: #B45309; }
        .montant.total { color: var(--primary); font-weight: 700; }

        .montant small {
            font-size: 0.7rem;
            color: var(--gray);
            font-weight: 400;
            margin-left: 2px;
        }

        /* Actions */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: white;
            color: #6B7280;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.15s;
            font-size: 0.9rem;
        }

        .btn-icon:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .btn-icon.warning:hover {
            background: var(--warning);
            border-color: var(--warning);
        }

        .btn-icon.danger:hover {
            background: var(--danger);
            border-color: var(--danger);
        }

        /* Table Footer */
        .table-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border);
            background: #F9FAFB;
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
            border: 1px solid var(--border);
            border-radius: 6px;
            color: #6B7280;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.15s;
            display: block;
        }

        .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .page-link:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state i {
            font-size: 4rem;
            color: #D1D5DB;
            margin-bottom: 1rem;
        }

        .empty-state h5 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: #6B7280;
            margin-bottom: 1.5rem;
        }

        /* Responsive */
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

            .page-header-right {
                width: 100%;
                justify-content: space-between;
            }

            .filters-section {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box {
                width: 100%;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .table-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .action-buttons {
                flex-wrap: wrap;
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
                        Liste des <span>besoins</span>
                    </h1>
                    <p>
                        <i class="fas fa-circle" style="color: var(--secondary); font-size: 0.5rem;"></i>
                        Gérez et consultez tous les besoins d'aide humanitaire
                    </p>
                </div>
                <div class="page-header-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Besoins</li>
                        </ol>
                    </nav>
                    <a href="/besoins/ajouter" class="btn-primary">
                        <i class="fas fa-plus"></i>
                        Nouveau besoin
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
            <?php if(!empty($besoins)): 
                $totalNature = count(array_filter($besoins, fn($b) => $b->type === 'nature'));
                $totalMateriaux = count(array_filter($besoins, fn($b) => $b->type === 'materiaux'));
                $totalArgent = count(array_filter($besoins, fn($b) => $b->type === 'argent'));
                $montantTotal = array_reduce($besoins, function($carry, $b) {
                    return $carry + ($b->quantite * $b->prix_unitaire);
                }, 0);
            ?>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon bg-primary-soft">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value"><?= count($besoins) ?></div>
                        <div class="stat-label">Total besoins</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bg-success-soft">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value"><?= $totalNature ?></div>
                        <div class="stat-label">Nature</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="background: #F3F4F6; color: #4B5563;">
                        <i class="fas fa-tools"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value"><?= $totalMateriaux ?></div>
                        <div class="stat-label">Matériaux</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bg-warning-soft">
                        <i class="fas fa-coins"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value"><?= number_format($montantTotal, 0, ',', ' ') ?> Ar</div>
                        <div class="stat-label">Valeur totale</div>
                    </div>
                </div>
            </div>

            <!-- Filtres -->
            <div class="filters-section">
                <div class="filters-group">
                    <div class="filter-item">
                        <i class="fas fa-filter"></i>
                        <select id="typeFilter">
                            <option value="">Tous types</option>
                            <option value="nature">Nature</option>
                            <option value="materiaux">Matériaux</option>
                            <option value="argent">Argent</option>
                        </select>
                    </div>
                    <div class="filter-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <select id="regionFilter">
                            <option value="">Toutes régions</option>
                            <?php 
                            $regions = array_unique(array_column($besoins, 'region'));
                            foreach($regions as $region): 
                            ?>
                                <option value="<?= htmlspecialchars($region) ?>"><?= htmlspecialchars($region) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Rechercher..." id="searchInput">
                </div>
            </div>
            <?php endif; ?>

            <!-- Tableau -->
            <div class="table-container">
                <div class="table-header">
                    <div class="table-title">
                        <i class="fas fa-list-ul"></i>
                        <h3>Liste des besoins</h3>
                    </div>
                </div>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ville / Région</th>
                                <th>Type</th>
                                <th>Libellé</th>
                                <th>Quantité</th>
                                <th>Prix unitaire</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php if(empty($besoins)): ?>
                                <tr>
                                    <td colspan="8" class="empty-state">
                                        <i class="fas fa-inbox"></i>
                                        <h5>Aucun besoin enregistré</h5>
                                        <p>Commencez par ajouter votre premier besoin</p>
                                        <a href="/besoins/ajouter" class="btn-primary">
                                            <i class="fas fa-plus"></i> Ajouter un besoin
                                        </a>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach($besoins as $besoin): ?>
                                <tr class="besoin-row" data-type="<?= $besoin->type ?>" data-region="<?= htmlspecialchars($besoin->region) ?>">
                                    <td>
                                        <span class="badge-id">#<?= str_pad($besoin->id, 4, '0', STR_PAD_LEFT) ?></span>
                                    </td>
                                    <td>
                                        <span class="badge-ville">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <?= htmlspecialchars($besoin->ville_nom) ?>
                                            <small>(<?= htmlspecialchars($besoin->region) ?>)</small>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge-type <?= $besoin->type ?>">
                                            <i class="fas <?= $besoin->type === 'nature' ? 'fa-seedling' : ($besoin->type === 'materiaux' ? 'fa-tools' : 'fa-coins') ?>"></i>
                                            <?= ucfirst($besoin->type) ?>
                                        </span>
                                    </td>
                                    <td><?= htmlspecialchars($besoin->libelle) ?></td>
                                    <td class="montant <?= $besoin->type ?>">
                                        <?php if($besoin->type === 'argent'): ?>
                                            <?= number_format($besoin->quantite, 0, ',', ' ') ?><small>Ar</small>
                                        <?php else: ?>
                                            <?= number_format($besoin->quantite) ?><small><?= $besoin->type === 'nature' ? 'kg' : 'u' ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td class="montant">
                                        <?= number_format($besoin->prix_unitaire, 0, ',', ' ') ?><small>Ar</small>
                                    </td>
                                    <td class="montant total">
                                        <strong><?= number_format($besoin->quantite * $besoin->prix_unitaire, 0, ',', ' ') ?><small>Ar</small></strong>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="/besoins/modifier/<?= $besoin->id ?>" class="btn-icon warning" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="/besoins/supprimer/<?= $besoin->id ?>" 
                                               class="btn-icon danger" 
                                               title="Supprimer"
                                               onclick="return confirm('Supprimer ce besoin ?')">
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

                <?php if(!empty($besoins)): ?>
                <div class="table-footer">
                    <div class="text-muted">
                        <i class="fas fa-database"></i> <?= count($besoins) ?> besoin(s)
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
        // Recherche en temps réel
        const searchInput = document.getElementById('searchInput');
        if(searchInput) {
            searchInput.addEventListener('keyup', function() {
                const search = this.value.toLowerCase();
                const rows = document.querySelectorAll('.besoin-row');
                
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(search) ? '' : 'none';
                });
            });
        }

        // Filtre par type
        const typeFilter = document.getElementById('typeFilter');
        if(typeFilter) {
            typeFilter.addEventListener('change', function() {
                const type = this.value;
                const rows = document.querySelectorAll('.besoin-row');
                
                rows.forEach(row => {
                    const match = !type || row.dataset.type === type;
                    const currentDisplay = window.getComputedStyle(row).display;
                    if(!match) {
                        row.style.display = 'none';
                    } else {
                        row.style.display = '';
                    }
                });
            });
        }

        // Filtre par région
        const regionFilter = document.getElementById('regionFilter');
        if(regionFilter) {
            regionFilter.addEventListener('change', function() {
                const region = this.value;
                const rows = document.querySelectorAll('.besoin-row');
                
                rows.forEach(row => {
                    const match = !region || row.dataset.region === region;
                    if(!match) {
                        row.style.display = 'none';
                    } else {
                        row.style.display = '';
                    }
                });
            });
        }
    </script>
</body>
</html>