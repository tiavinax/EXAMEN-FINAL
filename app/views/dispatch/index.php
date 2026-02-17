<?php 
// dispatch/index.php
$title = "Dispatch automatique - BNGRC";
// $page_css = ['dispatch'];
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
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

        /* ===== NOTIFICATIONS ===== */
        .notifications {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }

        .alert-custom {
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 0.95rem;
            border-left-width: 4px;
            border-left-style: solid;
            box-shadow: var(--shadow-lg);
            animation: slideIn 0.3s ease;
            min-width: 300px;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
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
            color: var(--secondary);
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
            color: var(--gray-500);
            font-size: 0.95rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .page-header-left p i {
            color: var(--secondary);
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

        /* ===== CONTROL GRID ===== */
        .control-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        /* Carte Dispatch */
        .dispatch-card {
            background: linear-gradient(135deg, var(--primary) 0%, #1a4a7a 100%);
            border-radius: 24px;
            padding: 2rem;
            color: var(--white);
            box-shadow: var(--shadow-lg);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .dispatch-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-xl);
        }

        .dispatch-card h5 {
            font-size: 1.35rem;
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .dispatch-card h5 i {
            font-size: 1.5rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .dispatch-card p {
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }

        .dispatch-card ul {
            margin: 1rem 0 1.5rem 1.5rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .dispatch-card li {
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }

        .btn-dispatch, .btn-redistribute {
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 40px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
        }

        .btn-dispatch {
            background: var(--white);
            color: var(--primary);
            box-shadow: var(--shadow-md);
        }

        .btn-dispatch:hover:not(:disabled) {
            background: var(--gray-100);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            color: var(--primary-dark);
        }

        .btn-redistribute {
            background: var(--warning);
            color: var(--white);
            box-shadow: 0 4px 12px rgba(237, 108, 2, 0.3);
        }

        .btn-redistribute:hover:not(:disabled) {
            background: #e65100;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(237, 108, 2, 0.4);
        }

        .btn-dispatch:disabled, .btn-redistribute:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Styles pour le mode de dispatch */
        .dispatch-mode {
            margin: 1.5rem 0;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .mode-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--white);
        }

        .mode-label i {
            margin-right: 0.5rem;
            color: var(--white);
        }

        .mode-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            background: var(--white);
            color: var(--gray-900);
            font-size: 0.95rem;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
        }

        .mode-select:hover {
            border-color: var(--white);
        }

        .mode-select:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.2);
        }

        .mode-help {
            display: block;
            margin-top: 0.5rem;
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .mode-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-left: 0.5rem;
        }

        .mode-badge.fifo {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .mode-badge.smallest {
            background: var(--success);
            color: white;
        }

        .mode-badge.proportional {
            background: var(--info);
            color: white;
        }

        /* Carte Stats */
        .stats-card {
            background: var(--white);
            border-radius: 24px;
            padding: 2rem;
            border: 1px solid var(--gray-200);
            box-shadow: var(--shadow-md);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .stats-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-light);
        }

        .stats-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stats-header i {
            font-size: 2rem;
            color: var(--primary);
            background: var(--primary-light);
            padding: 1rem;
            border-radius: 16px;
        }

        .stats-header h5 {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--gray-900);
            margin: 0;
        }

        .stats-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--gray-900);
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        .stats-detail {
            color: var(--gray-600);
            font-size: 0.95rem;
            padding-top: 1rem;
            border-top: 1px solid var(--gray-200);
        }

        .stats-detail p {
            margin: 0.5rem 0;
            display: flex;
            justify-content: space-between;
        }

        .stats-detail span {
            color: var(--gray-900);
            font-weight: 600;
        }

        /* ===== TABLE CONTAINER ===== */
        .table-container {
            background: var(--white);
            border-radius: 24px;
            border: 1px solid var(--gray-200);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            margin-top: 2rem;
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
            color: var(--secondary);
            font-size: 1.2rem;
        }

        .table-title h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--gray-900);
            margin: 0;
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
        }

        .search-box input {
            width: 100%;
            padding: 0.7rem 1rem 0.7rem 2.8rem;
            border: 1px solid var(--gray-200);
            border-radius: 40px;
            font-size: 0.9rem;
            background: var(--gray-50);
            transition: all 0.2s;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 3px rgba(0,51,102,0.1);
        }

        .badge-count {
            background: var(--primary);
            color: var(--white);
            padding: 0.3rem 0.8rem;
            border-radius: 40px;
            font-size: 0.8rem;
            font-weight: 600;
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
        .badge-city {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 0.4rem 1.2rem;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
        }

        .badge-city i {
            font-size: 0.8rem;
        }

        .badge-type {
            background: var(--gray-100);
            color: var(--gray-700);
            padding: 0.3rem 1rem;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-block;
        }

        .badge-success {
            background: rgba(46,125,50,0.1);
            color: var(--success);
            padding: 0.3rem 1rem;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-block;
        }

        .badge-warning {
            background: rgba(237,108,2,0.1);
            color: var(--warning);
            padding: 0.3rem 1rem;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-block;
        }

        .badge-danger {
            background: rgba(211,47,47,0.1);
            color: var(--danger);
            padding: 0.3rem 1rem;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-block;
        }

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
            display: inline-block;
        }

        /* ===== PROGRESS ===== */
        .progress-wrapper {
            min-width: 140px;
        }

        .progress-bar {
            height: 6px;
            background: var(--gray-200);
            border-radius: 3px;
            overflow: hidden;
            margin-bottom: 0.35rem;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 3px;
            transition: width 0.3s ease;
        }

        .progress-text {
            font-size: 0.8rem;
            color: var(--gray-500);
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
        }

        /* ===== MONTANTS ===== */
        .montant {
            font-weight: 600;
        }

        .montant.nature { color: var(--success); }
        .montant.materiaux { color: var(--gray-700); }
        .montant.argent { color: var(--warning); }

        .montant small {
            font-size: 0.75rem;
            color: var(--gray-500);
            font-weight: 400;
        }

        /* ===== BUTTONS ===== */
        .btn-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid var(--gray-200);
            background: white;
            color: var(--gray-500);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-icon:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
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

        /* ===== MODE INFO ===== */
        .mode-info {
            margin-top: 1rem;
            padding: 0.75rem 1rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            border-left: 4px solid var(--white);
            font-size: 0.9rem;
            color: var(--white);
        }

        .mode-info i {
            color: var(--white);
            margin-right: 0.5rem;
        }

        /* ===== LOADER ===== */
        .table-loading {
            text-align: center;
            padding: 3rem;
        }

        .table-loading i {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .control-grid {
                grid-template-columns: 1fr;
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

            .action-buttons {
                flex-direction: column;
            }

            .btn-dispatch, .btn-redistribute {
                width: 100%;
                justify-content: center;
            }

            .table-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .search-box {
                width: 100%;
            }

            .table-footer {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .stats-header {
                flex-direction: column;
                text-align: center;
            }

            .notifications {
                left: 20px;
                right: 20px;
            }

            .alert-custom {
                min-width: auto;
            }
        }

        @media (max-width: 480px) {
            .dispatch-card, .stats-card {
                padding: 1.5rem;
            }

            .stats-value {
                font-size: 2rem;
            }

            .badge-donateur, .badge-ville, .badge-type {
                font-size: 0.75rem;
                padding: 0.2rem 0.6rem;
            }
        }
    </style>
</head>
<body>

    <!-- Notifications -->
    <div class="notifications" id="notifications"></div>

    <div class="main-container">
        <div class="content-wrapper">
            <!-- En-tête -->
            <div class="page-header">
                <div class="page-header-left">
                    <h1>
                        Dispatch <span>automatique</span>
                    </h1>
                    <p>
                        <i class="fas fa-circle"></i>
                        Détail des besoins et attributions par ville
                    </p>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Dispatch</li>
                    </ol>
                </nav>
            </div>

            <!-- Messages flash -->
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

            <!-- Cartes de contrôle -->
            <div class="control-grid">
                <!-- Carte Dispatch -->
                <div class="dispatch-card">
                    <h5>
                        <i class="fas fa-rocket"></i>
                        Dispatch automatique
                    </h5>
                    <p>Lancer l'attribution automatique des dons aux villes selon :</p>
                    <ul>
                        <li><i class="fas fa-check-circle"></i> Ordre de date des dons</li>
                        <li><i class="fas fa-check-circle"></i> Besoins non satisfaits</li>
                        <li><i class="fas fa-check-circle"></i> Compatibilité type/libellé</li>
                    </ul>
                    
                    <!-- Mode de distribution -->
                    <div class="dispatch-mode">
                        <label for="modeDispatch" class="mode-label">
                            <i class="fas fa-sliders-h"></i>
                            Mode de distribution :
                        </label>
                        <select id="modeDispatch" class="mode-select">
                            <option value="fifo" <?= ($currentMode ?? 'fifo') == 'fifo' ? 'selected' : '' ?>>📅 Premier demandé, premier servi (FIFO)</option>
                            <option value="smallest" <?= ($currentMode ?? '') == 'smallest' ? 'selected' : '' ?>>🔍 Plus petite demande d'abord</option>
                            <option value="proportional" <?= ($currentMode ?? '') == 'proportional' ? 'selected' : '' ?>>⚖️ Répartition proportionnelle</option>
                        </select>
                        <small class="mode-help">Les restes non distribués restent disponibles</small>
                    </div>

                    <div class="action-buttons">
                        <button class="btn-dispatch" id="btnLancer">
                            <i class="fas fa-play"></i>
                            Lancer le dispatch
                        </button>
                        <button class="btn-redistribute" id="btnReinitialiser">
                            <i class="fas fa-sync-alt"></i>
                            Réinitialiser
                        </button>
                    </div>
                    
                    <!-- Info sur le mode actuel -->
                    <div class="mode-info" id="modeInfo">
                        <i class="fas fa-info-circle"></i>
                        <span id="modeInfoText">
                            <?php if(($currentMode ?? 'fifo') == 'fifo'): ?>
                                Mode FIFO actif : Les besoins les plus anciens sont servis en premier.
                            <?php elseif(($currentMode ?? '') == 'smallest'): ?>
                                Mode Plus petite demande actif : Les besoins avec la plus petite quantité restante sont servis en premier.
                            <?php elseif(($currentMode ?? '') == 'proportional'): ?>
                                Mode Proportionnel actif : Les dons sont répartis proportionnellement à la taille des besoins.
                            <?php endif; ?>
                        </span>
                    </div>
                </div>

                <!-- Carte Résumé -->
                <div class="stats-card">
                    <div class="stats-header">
                        <i class="fas fa-chart-pie"></i>
                        <h5>Résumé des besoins</h5>
                    </div>
                    <?php
                    $totalBesoins = count($besoinsData ?? []);
                    $totalMontant = 0;
                    $totalQuantite = 0;
                    $urgents = 0;
                    
                    foreach($besoinsData ?? [] as $b) {
                        // CORRECTION: utiliser 'type' au lieu de 'besoin_type'
                        if($b->type === 'argent') {
                            $totalMontant += ($b->reste ?? 0) * ($b->prix_unitaire ?? 1);
                        } else {
                            $totalQuantite += $b->reste ?? 0;
                        }
                        
                        // Compter les urgents (reste > 0 et pourcentage < 30)
                        $pourcentage = ($b->quantite > 0) ? ($b->total_attribue / $b->quantite) * 100 : 0;
                        if(($b->reste ?? 0) > 0 && $pourcentage < 30) {
                            $urgents++;
                        }
                    }
                    ?>
                    <div class="stats-value" id="statsTotal"><?= $totalBesoins ?></div>
                    <div class="stats-detail" id="statsDetail">
                        <p>Besoins urgents <span id="statsUrgents"><?= $urgents ?></span></p>
                        <p>Valeur restante <span><?= number_format($totalMontant, 0, ',', ' ') ?> Ar</span></p>
                        <p>Quantité restante <span><?= number_format($totalQuantite) ?> u</span></p>
                    </div>
                </div>
            </div>

            <!-- Tableau des besoins et attributions -->
            <div class="table-container" id="besoinsContainer">
                <div class="table-header">
                    <div class="table-title">
                        <i class="bi bi-list-ul"></i>
                        <h3>Détail des besoins et attributions</h3>
                    </div>
                    <div class="search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" placeholder="Rechercher..." id="searchInput">
                    </div>
                </div>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Ville</th>
                                <th>Type</th>
                                <th>Libellé</th>
                                <th>Besoin</th>
                                <th>Attribué</th>
                                <th>Reste</th>
                                <th>Progression</th>
                                <th>Statut</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php if(empty($besoinsData ?? [])): ?>
                                <tr>
                                    <td colspan="9" class="empty-state">
                                        <i class="bi bi-inbox"></i>
                                        <h5>Aucun besoin enregistré</h5>
                                        <p>Ajoutez des besoins pour commencer</p>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($besoinsData as $d): 
                                    // CORRECTION: utiliser les bonnes propriétés
                                    $quantite = $d->quantite ?? 0;
                                    $totalAttribue = $d->total_attribue ?? 0;
                                    $reste = $d->reste ?? 0;
                                    
                                    $pourcentage = ($quantite > 0) ? min(100, round(($totalAttribue / $quantite) * 100)) : 0;
                                    $statut = $pourcentage >= 100 ? 'Terminé' : ($pourcentage >= 50 ? 'En cours' : 'Urgent');
                                    $statutClass = $pourcentage >= 100 ? 'badge-success' : ($pourcentage >= 50 ? 'badge-warning' : 'badge-danger');
                                ?>
                                <tr class="besoin-row" 
                                    data-ville="<?= htmlspecialchars($d->ville_nom ?? '') ?>"
                                    data-type="<?= htmlspecialchars($d->type ?? '') ?>"
                                    data-statut="<?= $statut ?>">
                                    <td>
                                        <span class="badge-city">
                                            <i class="bi bi-pin-map-fill"></i>
                                            <?= htmlspecialchars($d->ville_nom ?? 'Inconnue') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge-type">
                                            <?= htmlspecialchars($d->type ?? '') ?>
                                        </span>
                                    </td>
                                    <td class="fw-semibold"><?= htmlspecialchars($d->libelle ?? '') ?></td>
                                    <td class="fw-semibold"><?= number_format($quantite) ?></td>
                                    <td class="text-success fw-semibold"><?= number_format($totalAttribue) ?></td>
                                    <td class="<?= $reste > 0 ? 'text-danger' : 'text-success' ?> fw-semibold">
                                        <?= number_format($reste) ?>
                                    </td>
                                    <td>
                                        <div class="progress-wrapper">
                                            <div class="progress-bar">
                                                <div class="progress-fill" style="width: <?= $pourcentage ?>%;"></div>
                                            </div>
                                            <span class="progress-text"><?= $pourcentage ?>%</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="<?= $statutClass ?>">
                                            <?= $statut ?>
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn-icon" onclick="voirDetailsBesoin(<?= $d->id ?>)" title="Voir détails">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="table-footer">
                    <div class="text-muted">
                        <small><i class="bi bi-database me-1"></i><span id="besoinsCount"><?= count($besoinsData ?? []) ?></span> résultats</small>
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
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../inc/footer.php'; ?>
    
    <script src="<?php base_url("/assets/js/bootstrap.bundle.min.js");?>"></script>

    <script>
        // Variables globales
        let modeActuel = document.getElementById('modeDispatch')?.value || 'fifo';

        // Fonction pour afficher une notification
        function afficherNotification(type, message) {
            const notifications = document.getElementById('notifications');
            const notification = document.createElement('div');
            notification.className = `alert-custom ${type}`;
            notification.innerHTML = `
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle'}"></i>
                ${message}
            `;
            
            notifications.appendChild(notification);
            
            setTimeout(() => {
                notification.style.transition = 'opacity 0.5s';
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 500);
            }, 3000);
        }

        // Fonction pour mettre à jour le mode
        function mettreAJourMode() {
            const select = document.getElementById('modeDispatch');
            if (!select) return;
            modeActuel = select.value;
            
            const url = new URL(window.location.href);
            url.searchParams.set('mode', modeActuel);
            window.history.replaceState({}, '', url);
            
            const infoText = document.getElementById('modeInfoText');
            if (infoText) {
                if (modeActuel === 'fifo') {
                    infoText.textContent = 'Mode FIFO actif : Les besoins les plus anciens sont servis en premier.';
                } else if (modeActuel === 'smallest') {
                    infoText.textContent = 'Mode Plus petite demande actif : Les besoins avec la plus petite quantité restante sont servis en premier.';
                } else if (modeActuel === 'proportional') {
                    infoText.textContent = 'Mode Proportionnel actif : Les dons sont répartis proportionnellement à la taille des besoins.';
                }
            }
        }

        // Fonction pour lancer le dispatch en AJAX
        async function lancerDispatch() {
            const btn = document.getElementById('btnLancer');
            if (!btn) return;
            
            const originalHtml = btn.innerHTML;
            
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Traitement...';
            
            try {
                const response = await fetch(`/ETU003955/EXAMEN-FINAL/public/dispatch/run-ajax?mode=${modeActuel}`);
                const data = await response.json();
                
                if (data.success) {
                    afficherNotification('success', data.message);
                    setTimeout(() => location.reload(), 1000);
                } else {
                    afficherNotification('error', data.message || 'Erreur lors du dispatch');
                }
            } catch (error) {
                console.error('Erreur:', error);
                afficherNotification('error', 'Erreur de connexion au serveur');
            } finally {
                btn.disabled = false;
                btn.innerHTML = originalHtml;
            }
        }

        // Fonction pour réinitialiser en AJAX
        async function reinitialiserDispatch() {
            if (!confirm('⚠️ Réinitialiser et redistribuer tous les dons ? Cette action est irréversible.')) {
                return;
            }
            
            const btn = document.getElementById('btnReinitialiser');
            if (!btn) return;
            
            const originalHtml = btn.innerHTML;
            
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Réinitialisation...';
            
            try {
                const response = await fetch(`/ETU003955/EXAMEN-FINAL/public/dispatch/redistribute-ajax?mode=${modeActuel}`);
                const data = await response.json();
                
                if (data.success) {
                    afficherNotification('success', data.message);
                    setTimeout(() => location.reload(), 1000);
                } else {
                    afficherNotification('error', data.message || 'Erreur lors de la réinitialisation');
                }
            } catch (error) {
                console.error('Erreur:', error);
                afficherNotification('error', 'Erreur de connexion au serveur');
            } finally {
                btn.disabled = false;
                btn.innerHTML = originalHtml;
            }
        }

        // Recherche dans le tableau
        document.getElementById('searchInput')?.addEventListener('keyup', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('.besoin-row');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
            
            const visibleCount = Array.from(rows).filter(r => r.style.display !== 'none').length;
            document.getElementById('besoinsCount').textContent = visibleCount;
        });

        // Initialisation
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const modeUrl = urlParams.get('mode');
            if (modeUrl) {
                const select = document.getElementById('modeDispatch');
                if (select) {
                    select.value = modeUrl;
                    modeActuel = modeUrl;
                }
            }
            
            mettreAJourMode();
            
            document.getElementById('modeDispatch')?.addEventListener('change', mettreAJourMode);
            document.getElementById('btnLancer')?.addEventListener('click', lancerDispatch);
            document.getElementById('btnReinitialiser')?.addEventListener('click', reinitialiserDispatch);
        });

        // Fonction pour voir les détails (à adapter)
        function voirDetailsBesoin(besoinId) {
            alert('Détails du besoin ' + besoinId + ' - À implémenter');
        }
    </script>
</body>
</html>