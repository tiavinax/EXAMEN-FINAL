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
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    
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

        .btn-success {
            background: var(--success);
            color: var(--white);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 40px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(46, 125, 50, 0.2);
        }

        .btn-success:hover {
            background: #1E5A22;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(46, 125, 50, 0.3);
            color: var(--white);
        }

        .btn-success i {
            font-size: 0.9rem;
        }

        /* ===== ALERT ===== */
        .alert-custom {
            border-radius: 12px;
            padding: 1.5rem 2rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 1rem;
            border-left-width: 4px;
            border-left-style: solid;
            box-shadow: var(--shadow-sm);
            background: var(--info-light);
            border-left-color: var(--info);
            color: var(--info);
            border: 1px solid rgba(2, 136, 209, 0.2);
        }

        .alert-custom i {
            font-size: 1.5rem;
        }

        /* ===== TABLE CARD ===== */
        .table-card {
            background: var(--white);
            border-radius: 24px;
            border: 1px solid var(--gray-200);
            overflow: hidden;
            box-shadow: var(--shadow-md);
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

        /* ===== TABLE FOOTER ===== */
        tfoot tr {
            background: var(--gray-100);
            font-weight: 600;
        }

        tfoot th, tfoot td {
            padding: 1rem 1.5rem;
            border-top: 2px solid var(--gray-300);
            color: var(--gray-800);
        }

        tfoot th {
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.4px;
        }

        tfoot td {
            font-weight: 700;
        }

        /* ===== BADGES ===== */
        .badge-donateur {
            background: var(--primary-light);
            padding: 0.3rem 1rem;
            border-radius: 40px;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            color: var(--primary);
            font-weight: 500;
        }

        .badge-ville {
            background: var(--gray-100);
            color: var(--gray-700);
            padding: 0.3rem 1rem;
            border-radius: 40px;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .badge-ville i {
            color: var(--primary);
        }

        /* ===== MONTANTS ===== */
        .montant {
            font-weight: 600;
            text-align: right;
        }

        .montant-achat {
            color: var(--primary);
        }

        .montant-frais {
            color: var(--warning);
        }

        .montant-total {
            color: var(--success);
            font-weight: 700;
        }

        .montant small {
            font-size: 0.75rem;
            color: var(--gray-500);
            font-weight: 400;
            margin-left: 2px;
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

        .empty-state h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: var(--gray-500);
            font-size: 1rem;
            margin-bottom: 2rem;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .table-card-body {
                padding: 1rem;
            }
            
            th, td {
                padding: 0.75rem 1rem;
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

            .table-responsive {
                margin: 0 -1rem;
            }
            
            th, td {
                white-space: nowrap;
            }
        }

        @media (max-width: 480px) {
            .page-header-left h1 {
                font-size: 1.5rem;
            }

            .btn-success {
                width: 100%;
                justify-content: center;
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
                        Historique des <span>achats</span>
                    </h1>
                    <p>
                        <i class="fas fa-circle"></i>
                        Consultez tous les achats effectués avec les dons en argent
                    </p>
                </div>
                <div class="d-flex gap-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="/achats/besoins-restants">Achats</a></li>
                            <li class="breadcrumb-item active">Historique</li>
                        </ol>
                    </nav>
                    <a href="/achats/besoins-restants" class="btn-success">
                        <i class="fas fa-plus"></i>
                        Nouvel achat
                    </a>
                </div>
            </div>

            <?php if(empty($achats)): ?>
                <div class="empty-state">
                    <i class="fas fa-shopping-cart"></i>
                    <h3>Aucun achat</h3>
                    <p>Vous n'avez pas encore effectué d'achat avec les dons en argent.</p>
                    <a href="/achats/besoins-restants" class="btn-success">
                        <i class="fas fa-shopping-cart"></i>
                        Commencer un achat
                    </a>
                </div>
            <?php else: ?>
                <div class="table-card">
                    <div class="table-card-body">
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Donateur</th>
                                        <th>Don</th>
                                        <th>Ville</th>
                                        <th>Besoin</th>
                                        <th class="text-end">Quantité</th>
                                        <th class="text-end">Montant achat</th>
                                        <th class="text-end">Frais</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($achats as $achat): ?>
                                    <tr>
                                        <td>
                                            <div class="date-info">
                                                <i class="fas fa-calendar-alt"></i>
                                                <?= date('d/m/Y', strtotime($achat->date_achat)) ?>
                                                <small><?= date('H:i', strtotime($achat->date_achat)) ?></small>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge-donateur">
                                                <i class="fas fa-user-circle"></i>
                                                <?= htmlspecialchars($achat->donateur ?? 'Anonyme') ?>
                                            </span>
                                        </td>
                                        <td><?= htmlspecialchars($achat->don_libelle) ?></td>
                                        <td>
                                            <span class="badge-ville">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <?= htmlspecialchars($achat->ville_nom) ?>
                                            </span>
                                        </td>
                                        <td><?= htmlspecialchars($achat->besoin_libelle) ?></td>
                                        <td class="montant"><?= number_format($achat->quantite) ?></td>
                                        <td class="montant montant-achat">
                                            <?= number_format($achat->montant_achat, 0, ',', ' ') ?> <small>Ar</small>
                                        </td>
                                        <td class="montant montant-frais">
                                            <?= number_format($achat->montant_frais, 0, ',', ' ') ?> <small>Ar</small>
                                        </td>
                                        <td class="montant montant-total">
                                            <?= number_format($achat->montant_total, 0, ',', ' ') ?> <small>Ar</small>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <?php
                                    $totalAchats = array_sum(array_column($achats, 'montant_achat'));
                                    $totalFrais = array_sum(array_column($achats, 'montant_frais'));
                                    $totalGeneral = array_sum(array_column($achats, 'montant_total'));
                                    ?>
                                    <tr>
                                        <th colspan="6" class="text-end">TOTAUX GÉNÉRAUX :</th>
                                        <th class="text-end montant-achat">
                                            <?= number_format($totalAchats, 0, ',', ' ') ?> <small>Ar</small>
                                        </th>
                                        <th class="text-end montant-frais">
                                            <?= number_format($totalFrais, 0, ',', ' ') ?> <small>Ar</small>
                                        </th>
                                        <th class="text-end montant-total">
                                            <?= number_format($totalGeneral, 0, ',', ' ') ?> <small>Ar</small>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Résumé des achats -->
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-icon" style="background: var(--primary-light); color: var(--primary);">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-value"><?= count($achats) ?></div>
                                <div class="stat-label">Nombre d'achats</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-icon" style="background: var(--success-light); color: var(--success);">
                                <i class="fas fa-coins"></i>
                            </div>
                            <div class="stat-content">
                                <div class="stat-value"><?= number_format($totalAchats, 0, ',', ' ') ?> Ar</div>
                                <div class="stat-label">Montant total</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-icon" style="background: var(--warning-light); color: var(--warning);">
                                <i class="fas fa-percent"></i>
                            </div>
                            <div class="stat-content">
                                <?php $pourcentageFrais = ($totalAchats > 0) ? round(($totalFrais / $totalAchats) * 100, 1) : 0; ?>
                                <div class="stat-value"><?= $pourcentageFrais ?>%</div>
                                <div class="stat-label">Frais moyens</div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include __DIR__ . '/../inc/footer.php'; ?>

    <style>
        /* Styles supplémentaires pour les cartes statistiques */
        .stat-card {
            background: var(--white);
            border-radius: 16px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            border: 1px solid var(--gray-200);
            transition: all 0.2s;
            box-shadow: var(--shadow-sm);
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-light);
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

        .stat-content {
            flex: 1;
        }

        .stat-value {
            font-size: 1.4rem;
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

        @media (max-width: 768px) {
            .row {
                flex-direction: column;
            }
            
            .col-md-4 {
                margin-bottom: 1rem;
            }
        }
    </style>

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>