<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - BNGRC</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Variables pour harmonisation */
        :root {
            --primary: #003366;
            --secondary: #D32F2F;
            --success: #2E7D32;
            --info: #0288D1;
            --warning: #ED6C02;
            --danger: #D32F2F;
            --dark: #1A1A1A;
            --light: #F8F9FA;
            --gray: #6C757D;
            --border: #E9ECEF;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            margin: 0;
            padding: 0;
        }

        /* Dashboard wrapper */
        .dashboard-wrapper {
            padding: 2rem 1.5rem;
            max-width: 1400px;
            margin: 0 auto;
            margin-top: 180px;
            /* Espace pour le header fixe */
        }

        /* Page Header */
        .page-header {
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            background: white;
            padding: 1.5rem 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border-left: 4px solid var(--secondary);
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--primary);
            margin: 0;
        }

        .page-title span {
            color: var(--secondary);
            font-weight: 700;
        }

        .breadcrumb {
            background: var(--light);
            padding: 0.75rem 1.5rem;
            border-radius: 30px;
            margin: 0;
        }

        .breadcrumb-item a {
            color: var(--primary);
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), #002244);
            border: none;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(0, 51, 102, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 51, 102, 0.3);
            color: white;
        }

        /* Alert */
        .alert-custom {
            border-radius: 8px;
            border-left: 4px solid var(--success);
            background: rgba(46, 125, 50, 0.05);
            color: var(--success);
            padding: 1rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(46, 125, 50, 0.1);
            display: flex;
            align-items: center;
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
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border);
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border-color: var(--primary);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
        }

        .bg-primary-soft {
            background: rgba(0, 51, 102, 0.1);
            color: var(--primary);
        }

        .bg-success-soft {
            background: rgba(46, 125, 50, 0.1);
            color: var(--success);
        }

        .bg-warning-soft {
            background: rgba(237, 108, 2, 0.1);
            color: var(--warning);
        }

        .bg-info-soft {
            background: rgba(2, 136, 209, 0.1);
            color: var(--info);
        }

        .stat-content {
            flex: 1;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark);
            line-height: 1.2;
        }

        .stat-label {
            font-size: 0.9rem;
            color: var(--gray);
            margin: 0;
        }

        /* Table Container */
        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .table-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            background: #FAFAFA;
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
            color: var(--dark);
            margin: 0;
        }

        .search-box {
            position: relative;
            width: 280px;
        }

        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
        }

        .search-box input {
            width: 100%;
            padding: 0.6rem 1rem 0.6rem 2.5rem;
            border: 1px solid var(--border);
            border-radius: 30px;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 51, 102, 0.1);
        }

        /* Table */
        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 1rem 1.5rem;
            background: #FAFAFA;
            color: var(--primary);
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--border);
        }

        td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border);
            color: var(--dark);
            font-size: 0.95rem;
            vertical-align: middle;
        }

        tr:hover td {
            background: #FAFAFA;
        }

        /* Badges */
        .badge-id {
            background: #E9ECEF;
            padding: 0.3rem 0.8rem;
            border-radius: 30px;
            font-weight: 600;
            color: var(--primary);
            font-size: 0.85rem;
            display: inline-block;
        }

        .badge-nature {
            background: rgba(46, 125, 50, 0.1);
            color: var(--success);
            padding: 0.3rem 1rem;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .badge-materiaux {
            background: rgba(108, 117, 125, 0.1);
            color: var(--gray);
            padding: 0.3rem 1rem;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .badge-argent {
            background: rgba(237, 108, 2, 0.1);
            color: var(--warning);
            padding: 0.3rem 1rem;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .badge-recent {
            background: rgba(0, 51, 102, 0.1);
            color: var(--primary);
            padding: 0.3rem 0.8rem;
            border-radius: 30px;
            font-size: 0.8rem;
        }

        /* Donateur */
        .donateur-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .donateur-info i {
            color: var(--primary);
        }

        /* Montants */
        .montant {
            font-weight: 600;
        }

        .montant.nature {
            color: var(--success);
        }

        .montant.materiaux {
            color: var(--gray);
        }

        .montant.argent {
            color: var(--warning);
        }

        .montant small {
            font-size: 0.75rem;
            color: var(--gray);
            font-weight: normal;
        }

        /* Actions */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn-icon {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            border: 1px solid var(--border);
            background: white;
            color: var(--gray);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
        }

        .btn-icon:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .btn-icon.text-danger:hover {
            background: var(--danger);
            border-color: var(--danger);
            color: white;
        }

        /* Date */
        .date-info {
            font-size: 0.9rem;
        }

        .date-info small {
            color: var(--gray);
            font-size: 0.8rem;
        }

        /* Table Footer */
        .table-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #FAFAFA;
        }

        .pagination {
            display: flex;
            gap: 0.3rem;
            margin: 0;
        }

        .page-link {
            padding: 0.4rem 0.8rem;
            border: 1px solid var(--border);
            color: var(--gray);
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem;
        }

        .empty-state i {
            font-size: 4rem;
            color: var(--gray);
            opacity: 0.3;
            margin-bottom: 1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .dashboard-wrapper {
                padding: 1rem;
                margin-top: 200px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-box {
                width: 100%;
            }

            .action-buttons {
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>
    <?php include __DIR__ . '/../inc/header.php'; ?>

    <div class="dashboard-wrapper">
        <!-- En-tête -->
        <div class="page-header">
            <div>
                <h1 class="page-title">
                    Gestion des <span>dons</span>
                </h1>
                <p class="text-muted mb-0">
                    <i class="fas fa-circle text-danger me-2" style="font-size: 0.5rem;"></i>
                    Liste complète des dons enregistrés
                </p>
            </div>
            <div class="d-flex gap-3 align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Dons</li>
                    </ol>
                </nav>
                <a href="/dons/ajouter" class="btn-primary">
                    <i class="fas fa-plus"></i>
                    Nouveau don
                </a>
            </div>
        </div>

        <!-- Message de succès -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert-custom">
                <i class="fas fa-check-circle me-2"></i>
                <?= $_SESSION['success'];
                unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <!-- Statistiques -->
        <div class="stats-grid">
            <?php
            $totalNature = count(array_filter($dons, fn($d) => $d->type === 'nature'));
            $totalMateriaux = count(array_filter($dons, fn($d) => $d->type === 'materiaux'));
            $totalArgent = count(array_filter($dons, fn($d) => $d->type === 'argent'));
            ?>
            <div class="stat-card">
                <div class="stat-icon bg-primary-soft">
                    <i class="fas fa-gift"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value"><?= count($dons) ?></div>
                    <div class="stat-label">Total dons</div>
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
                <div class="stat-icon" style="background: rgba(108,117,125,0.1); color: var(--gray);">
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
                    <div class="stat-value"><?= $totalArgent ?></div>
                    <div class="stat-label">Argent</div>
                </div>
            </div>
        </div>

        <!-- Tableau -->
        <div class="table-container">
            <div class="table-header">
                <div class="table-title">
                    <i class="fas fa-list-ul"></i>
                    <h3>Tous les dons</h3>
                </div>
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Rechercher..." id="searchInput">
                </div>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Donateur</th>
                            <th>Type</th>
                            <th>Libellé</th>
                            <th>Valeur</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <?php if (empty($dons)): ?>
                            <tr>
                                <td colspan="7" class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    <h5>Aucun don enregistré</h5>
                                    <p class="text-muted">Commencez par ajouter votre premier don</p>
                                    <a href="/ETU003955/EXAMEN-FINAL/public/dons/ajouter" class="btn-primary">
                                        <i class="fas fa-plus"></i>
                                        Nouveau don
                                    </a>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($dons as $don): ?>
                                <tr class="don-row" data-type="<?= $don->type ?>">
                                    <td>
                                        <span class="badge-id">#<?= str_pad($don->id, 4, '0', STR_PAD_LEFT) ?></span>
                                    </td>
                                    <td>
                                        <div class="donateur-info">
                                            <i class="fas fa-user-circle"></i>
                                            <?= htmlspecialchars($don->donateur ?? 'Anonyme') ?>
                                        </div>
                                    </td>
                                    <td>
                                        <?php
                                        $badgeClass = match ($don->type) {
                                            'nature' => 'badge-nature',
                                            'materiaux' => 'badge-materiaux',
                                            'argent' => 'badge-argent'
                                        };
                                        $typeIcon = match ($don->type) {
                                            'nature' => 'fas fa-seedling',
                                            'materiaux' => 'fas fa-tools',
                                            'argent' => 'fas fa-coins'
                                        };
                                        ?>
                                        <span class="<?= $badgeClass ?>">
                                            <i class="<?= $typeIcon ?>"></i>
                                            <?= ucfirst($don->type) ?>
                                        </span>
                                    </td>
                                    <td class="fw-semibold"><?= htmlspecialchars($don->libelle) ?></td>
                                    <td>
                                        <span class="montant <?= $don->type ?>">
                                            <?php if ($don->type === 'argent'): ?>
                                                <?= number_format($don->montant, 0, ',', ' ') ?> <small>Ar</small>
                                            <?php elseif ($don->type === 'nature'): ?>
                                                <?= number_format($don->quantite) ?> <small>kg</small>
                                            <?php else: ?>
                                                <?= number_format($don->quantite) ?> <small>unités</small>
                                            <?php endif; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="date-info">
                                            <i class="fas fa-calendar-alt me-1 text-muted"></i>
                                            <?= date('d/m/Y', strtotime($don->date_don)) ?>
                                            <small class="d-block">
                                                <?= date('H:i', strtotime($don->date_don)) ?>
                                            </small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="<?= base_url('dons/modifier/' . $don->id) ?>" class="btn-icon" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="<?= base_url('dons/supprimer/' . $don->id) ?>"
                                                class="btn-icon text-danger"
                                                title="Supprimer"
                                                onclick="return confirm('Supprimer ce don ?')">
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

            <?php if (!empty($dons)): ?>
                <div class="table-footer">
                    <div class="text-muted">
                        <i class="fas fa-database me-1"></i> <?= count($dons) ?> don(s)
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

    <?php include __DIR__ . '/../inc/footer.php'; ?>

    <script src="<?= base_url('/assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script>
        // Recherche
        document.getElementById('searchInput')?.addEventListener('keyup', function(e) {
            const search = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('.don-row');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(search) ? '' : 'none';
            });
        });
    </script>
</body>

</html>