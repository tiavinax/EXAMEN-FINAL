<?php 
// villes/ajouter.php
$title = "Ajouter une ville - BNGRC";
$page_css = ['ajouter_ville'];
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
            max-width: 800px;
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
            color: var(--success);
            position: relative;
        }

        .page-header-left h1 span::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--success), transparent);
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
            color: var(--success);
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

        /* ===== ALERT ===== */
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
            background: var(--secondary-light);
            border-left-color: var(--danger);
            color: var(--danger);
            border: 1px solid rgba(211, 47, 47, 0.2);
            box-shadow: var(--shadow-sm);
        }

        .alert-custom i {
            font-size: 1.25rem;
        }

        /* ===== FORM CARD ===== */
        .form-card {
            background: var(--white);
            border-radius: 24px;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--gray-200);
            overflow: hidden;
        }

        .form-card-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid var(--gray-200);
            background: var(--gray-50);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, var(--success), #1E5A22);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header-icon i {
            font-size: 1.75rem;
            color: var(--white);
        }

        .header-title h4 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--gray-900);
            margin: 0 0 0.25rem 0;
        }

        .header-title p {
            color: var(--gray-500);
            font-size: 0.9rem;
            margin: 0;
        }

        .form-card-body {
            padding: 2.5rem;
        }

        /* ===== FORM ===== */
        .custom-form {
            max-width: 600px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 1.75rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
        }

        .form-label i {
            color: var(--success);
            font-size: 1rem;
            width: 20px;
        }

        .form-label .text-danger {
            color: var(--danger);
            margin-left: 0.25rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1.5px solid var(--gray-200);
            border-radius: 12px;
            font-size: 0.95rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s;
            background: var(--white);
        }

        .form-control:hover {
            border-color: var(--gray-300);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--success);
            box-shadow: 0 0 0 4px rgba(46, 125, 50, 0.1);
        }

        .form-control::placeholder {
            color: var(--gray-400);
        }

        .form-text {
            font-size: 0.85rem;
            color: var(--gray-500);
            margin-top: 0.35rem;
            display: block;
        }

        /* ===== INFO BOX ===== */
        .info-box {
            background: var(--primary-light);
            border: 1px solid rgba(0, 51, 102, 0.2);
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .info-box i {
            color: var(--primary);
            font-size: 1.5rem;
        }

        .info-box p {
            margin: 0;
            color: var(--gray-700);
            font-size: 0.95rem;
        }

        .info-box strong {
            color: var(--primary);
            font-weight: 600;
        }

        /* ===== BUTTONS ===== */
        .btn-outline {
            background: var(--white);
            border: 1.5px solid var(--gray-200);
            color: var(--gray-700);
            padding: 0.75rem 1.5rem;
            border-radius: 40px;
            font-size: 0.95rem;
            font-weight: 600;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            cursor: pointer;
            box-shadow: var(--shadow-sm);
        }

        .btn-outline:hover {
            background: var(--gray-100);
            border-color: var(--gray-300);
            color: var(--gray-900);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            text-decoration: none;
        }

        .btn-primary {
            background: var(--success);
            border: none;
            color: var(--white);
            padding: 0.75rem 2rem;
            border-radius: 40px;
            font-size: 0.95rem;
            font-weight: 600;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(46, 125, 50, 0.2);
        }

        .btn-primary:hover {
            background: #1E5A22;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(46, 125, 50, 0.3);
            color: var(--white);
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-top: 2.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--gray-200);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .content-wrapper {
                padding: 0 1rem 2rem 1rem;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .form-card-body {
                padding: 1.5rem;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-outline, .btn-primary {
                width: 100%;
                justify-content: center;
            }

            .info-box {
                flex-direction: column;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .page-header-left h1 {
                font-size: 1.5rem;
            }

            .breadcrumb {
                font-size: 0.85rem;
                padding: 0.5rem 1rem;
            }

            .header-icon {
                width: 48px;
                height: 48px;
            }

            .header-icon i {
                font-size: 1.5rem;
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
                        Ajouter une <span>ville</span>
                    </h1>
                    <p>
                        <i class="fas fa-circle"></i>
                        Enregistrez une nouvelle ville dans le système
                    </p>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/villes/liste">Villes</a></li>
                        <li class="breadcrumb-item active">Ajouter</li>
                    </ol>
                </nav>
            </div>

            <!-- Message d'erreur -->
            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert-custom">
                    <i class="fas fa-exclamation-triangle"></i>
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <!-- Formulaire -->
            <div class="form-card">
                <div class="form-card-header">
                    <div class="header-icon">
                        <i class="fas fa-city"></i>
                    </div>
                    <div class="header-title">
                        <h4>Nouvelle ville</h4>
                        <p>Tous les champs marqués d'un * sont obligatoires</p>
                    </div>
                </div>

                <div class="form-card-body">
                    <!-- Info box -->
                    <div class="info-box">
                        <i class="fas fa-info-circle"></i>
                        <p>
                            <strong>Information :</strong> Les villes sont associées aux besoins et aux dons.
                        </p>
                    </div>

                    <form action="/villes/save" method="POST" class="custom-form">
                        <!-- Nom de la ville -->
                        <div class="form-group">
                            <label for="nom" class="form-label">
                                <i class="fas fa-building"></i>
                                Nom de la ville <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="nom" 
                                   name="nom" 
                                   placeholder="Ex: Antananarivo, Toamasina, Mahajanga..." 
                                   required>
                            <small class="form-text">Entrez le nom officiel de la ville</small>
                        </div>

                        <!-- Région -->
                        <div class="form-group">
                            <label for="region" class="form-label">
                                <i class="fas fa-map-marker-alt"></i>
                                Région <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="region" 
                                   name="region" 
                                   placeholder="Ex: Analamanga, Atsinanana, Boeny..." 
                                   required>
                            <small class="form-text">Entrez le nom de la région</small>
                        </div>

                        <!-- Boutons -->
                        <div class="form-actions">
                            <a href="/villes/liste" class="btn-outline">
                                <i class="fas fa-arrow-left"></i>
                                Retour à la liste
                            </a>
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-save"></i>
                                Enregistrer la ville
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../inc/footer.php'; ?>

     <script src="<?= asset_url('js/bootstrap.bundle.min.js') ?>"></script>

</body>
</html>