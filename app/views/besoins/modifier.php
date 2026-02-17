<?php 
// besoins/modifier.php
$title = "Modifier un besoin - BNGRC";
$page_css = ['modifier_besoin'];
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
            color: var(--warning);
            position: relative;
        }

        .page-header-left h1 span::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--warning), transparent);
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
            color: var(--warning);
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
            background: linear-gradient(135deg, var(--warning), #b85e00);
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

        /* ===== INFO BOX ===== */
        .info-box {
            background: var(--warning-light);
            border: 1px solid rgba(237, 108, 2, 0.2);
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .info-box i {
            color: var(--warning);
            font-size: 1.5rem;
        }

        .info-box p {
            margin: 0;
            color: var(--gray-700);
            font-size: 0.95rem;
        }

        .info-box strong {
            color: var(--warning);
            font-weight: 600;
        }

        /* ===== CURRENT VALUES ===== */
        .current-values {
            background: var(--gray-50);
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            border: 1px dashed var(--gray-300);
        }

        .current-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .current-item i {
            color: var(--primary);
            font-size: 1rem;
            width: 20px;
        }

        .current-item span {
            color: var(--gray-600);
            font-size: 0.95rem;
        }

        .current-item strong {
            color: var(--primary);
            font-weight: 600;
            margin-left: 0.25rem;
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
            color: var(--warning);
            font-size: 1rem;
            width: 20px;
        }

        .form-label .text-danger {
            color: var(--danger);
            margin-left: 0.25rem;
        }

        .form-control, .form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1.5px solid var(--gray-200);
            border-radius: 12px;
            font-size: 0.95rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s;
            background: var(--white);
        }

        .form-control:hover, .form-select:hover {
            border-color: var(--gray-300);
        }

        .form-control:focus, .form-select:focus {
            outline: none;
            border-color: var(--warning);
            box-shadow: 0 0 0 4px rgba(237, 108, 2, 0.1);
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

        /* ===== INPUT GROUP ===== */
        .input-group {
            display: flex;
            align-items: center;
        }

        .input-group .form-control {
            flex: 1;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            border-right: none;
        }

        .input-group-text {
            background: var(--gray-100);
            border: 1.5px solid var(--gray-200);
            border-left: none;
            border-radius: 0 12px 12px 0;
            padding: 0.75rem 1.2rem;
            color: var(--gray-600);
            font-size: 0.95rem;
            font-weight: 500;
            white-space: nowrap;
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

        .btn-warning-custom {
            background: var(--warning);
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
            box-shadow: 0 4px 12px rgba(237, 108, 2, 0.2);
        }

        .btn-warning-custom:hover {
            background: #b85e00;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(237, 108, 2, 0.3);
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

            .btn-outline, .btn-warning-custom {
                width: 100%;
                justify-content: center;
            }

            .info-box {
                flex-direction: column;
                text-align: center;
            }

            .current-values {
                flex-direction: column;
                gap: 1rem;
            }

            .input-group {
                flex-direction: column;
            }

            .input-group .form-control {
                border-radius: 12px;
                border-right: 1.5px solid var(--gray-200);
            }

            .input-group-text {
                border-radius: 12px;
                border-left: 1.5px solid var(--gray-200);
                width: 100%;
                justify-content: center;
                margin-top: -1px;
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
                        Modifier un <span>besoin</span>
                    </h1>
                    <p>
                        <i class="fas fa-circle"></i>
                        Modifiez les informations du besoin
                    </p>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/besoins/liste">Besoins</a></li>
                        <li class="breadcrumb-item active">Modifier</li>
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
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                    <div class="header-title">
                        <h4>Modification du besoin</h4>
                        <p>Modifiez les informations ci-dessous</p>
                    </div>
                </div>

                <div class="form-card-body">
                    <!-- Info box -->
                    <div class="info-box">
                        <i class="fas fa-info-circle"></i>
                        <p>
                            <strong>Attention :</strong> La modification peut affecter les attributions existantes.
                        </p>
                    </div>

                    <!-- Valeurs actuelles -->
                    <div class="current-values">
                        <div class="current-item">
                            <i class="fas fa-city"></i>
                            <span>Ville : <strong><?= htmlspecialchars($besoin->ville_nom) ?></strong></span>
                        </div>
                        <div class="current-item">
                            <i class="fas fa-tag"></i>
                            <span>Type : <strong><?= ucfirst($besoin->type) ?></strong></span>
                        </div>
                        <div class="current-item">
                            <i class="fas fa-calculator"></i>
                            <span>Quantité actuelle : <strong><?= number_format($besoin->quantite) ?> <?= $besoin->type === 'argent' ? 'Ar' : ($besoin->type === 'nature' ? 'kg' : 'u') ?></strong></span>
                        </div>
                    </div>

                    <form action="/ETU003955/EXAMEN-FINAL/public/besoins/update/<?= $besoin->id ?>" method="POST" class="custom-form">
                        <!-- Ville -->
                        <div class="form-group">
                            <label for="ville_id" class="form-label">
                                <i class="fas fa-city"></i>
                                Ville <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" id="ville_id" name="ville_id" required>
                                <option value="" disabled>Sélectionner une ville</option>
                                <?php foreach($villes as $ville): ?>
                                    <option value="<?= $ville->id ?>" <?= $ville->id == $besoin->ville_id ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($ville->nom) ?> (<?= htmlspecialchars($ville->region) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <small class="form-text">Choisissez la ville concernée par le besoin</small>
                        </div>

                        <!-- Type de besoin -->
                        <div class="form-group">
                            <label for="type" class="form-label">
                                <i class="fas fa-tag"></i>
                                Type de besoin <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="" disabled>Sélectionner un type</option>
                                <option value="nature" <?= $besoin->type == 'nature' ? 'selected' : '' ?>>🌾 Nature (riz, huile, etc.)</option>
                                <option value="materiaux" <?= $besoin->type == 'materiaux' ? 'selected' : '' ?>>🔨 Matériaux (tôle, clou, etc.)</option>
                                <option value="argent" <?= $besoin->type == 'argent' ? 'selected' : '' ?>>💰 Argent</option>
                            </select>
                            <small class="form-text">Le type détermine l'unité de mesure</small>
                        </div>

                        <!-- Libellé -->
                        <div class="form-group">
                            <label for="libelle" class="form-label">
                                <i class="fas fa-font"></i>
                                Libellé <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="libelle" 
                                   name="libelle" 
                                   value="<?= htmlspecialchars($besoin->libelle) ?>" 
                                   placeholder="Ex: Riz, Tôles, Aide financière..." 
                                   required>
                            <small class="form-text">Décrivez précisément le besoin</small>
                        </div>

                        <!-- Quantité/Montant -->
                        <div class="form-group">
                            <label for="quantite" class="form-label" id="quantiteLabel">
                                <i class="fas fa-calculator"></i>
                                <?= $besoin->type === 'argent' ? 'Montant' : 'Quantité' ?> <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="number" 
                                       step="0.01" 
                                       class="form-control" 
                                       id="quantite" 
                                       name="quantite" 
                                       value="<?= $besoin->quantite ?>" 
                                       required>
                                <span class="input-group-text" id="quantiteUnite">
                                    <?= $besoin->type === 'argent' ? 'Ar' : ($besoin->type === 'nature' ? 'kg' : 'u') ?>
                                </span>
                            </div>
                            <small class="form-text" id="quantiteHelp">
                                <?= $besoin->type === 'argent' ? 'Entrez le montant total nécessaire en Ariary' : 'Entrez la quantité nécessaire' ?>
                            </small>
                        </div>

                        <!-- Prix unitaire -->
                        <div class="form-group">
                            <label for="prix_unitaire" class="form-label">
                                <i class="fas fa-coins"></i>
                                Prix unitaire (Ar) <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="number" 
                                       step="0.01" 
                                       class="form-control" 
                                       id="prix_unitaire" 
                                       name="prix_unitaire" 
                                       value="<?= $besoin->prix_unitaire ?>" 
                                       required>
                                <span class="input-group-text">Ar</span>
                            </div>
                            <small class="form-text">Le prix unitaire en Ariary (ex: 2500 pour 1 kg de riz)</small>
                        </div>

                        <!-- Boutons -->
                        <div class="form-actions">
                            <a href="/besoins/liste" class="btn-outline">
                                <i class="fas fa-times"></i>
                                Annuler
                            </a>
                            <button type="submit" class="btn-warning-custom">
                                <i class="fas fa-save"></i>
                                Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../inc/footer.php'; ?>
    <script src="<?= asset_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('type');
            const quantiteLabel = document.getElementById('quantiteLabel');
            const quantiteHelp = document.getElementById('quantiteHelp');
            const quantiteUnite = document.getElementById('quantiteUnite');
            const quantiteInput = document.getElementById('quantite');

            if(typeSelect) {
                typeSelect.addEventListener('change', function() {
                    const type = this.value;
                    
                    if(type === 'argent') {
                        quantiteLabel.innerHTML = '<i class="fas fa-calculator"></i> Montant <span class="text-danger">*</span>';
                        quantiteHelp.textContent = 'Entrez le montant total nécessaire en Ariary';
                        quantiteUnite.textContent = 'Ar';
                        quantiteInput.placeholder = 'Ex: 5000000';
                    } else if(type === 'nature') {
                        quantiteLabel.innerHTML = '<i class="fas fa-calculator"></i> Quantité <span class="text-danger">*</span>';
                        quantiteHelp.textContent = 'Entrez la quantité nécessaire (en kg, litres, etc.)';
                        quantiteUnite.textContent = 'kg';
                        quantiteInput.placeholder = 'Ex: 1000';
                    } else if(type === 'materiaux') {
                        quantiteLabel.innerHTML = '<i class="fas fa-calculator"></i> Quantité <span class="text-danger">*</span>';
                        quantiteHelp.textContent = 'Entrez le nombre d\'unités nécessaires';
                        quantiteUnite.textContent = 'u';
                        quantiteInput.placeholder = 'Ex: 500';
                    }
                });
            }
        });
    </script>
</body>
</html>