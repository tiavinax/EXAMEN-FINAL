<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title><?= $title ?> - BNGRC</title>
    
    <!-- Les CSS sont déjà dans header.php -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    
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
        .dashboard-wrapper {
            padding: 2rem 1.5rem;
            max-width: 1200px;
            margin: 0 auto;
            margin-top: 180px; /* Espace pour le header */
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
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

        .page-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: var(--gray-900);
            margin: 0 0 0.5rem 0;
            letter-spacing: -0.02em;
        }

        .page-title span {
            color: var(--secondary);
            position: relative;
        }

        .page-title span::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--secondary), transparent);
            border-radius: 2px;
        }

        .page-header p {
            color: var(--gray-500);
            font-size: 0.95rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
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
        }

        .header-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header-icon i {
            font-size: 1.75rem;
            color: var(--white);
        }

        .form-card-header h5 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--gray-900);
            margin: 0;
        }

        .form-card-header p {
            color: var(--gray-500);
            font-size: 0.9rem;
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
            color: var(--secondary);
            font-size: 1rem;
            width: 20px;
        }

        .form-label .text-danger {
            color: var(--danger);
            margin-left: 0.25rem;
        }

        .form-label .text-muted {
            color: var(--gray-400);
            font-weight: 400;
            font-size: 0.85rem;
        }

        .form-control, .form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1.5px solid var(--gray-200);
            border-radius: 12px;
            font-size: 0.95rem;
            font-family: inherit;
            transition: all 0.2s;
            background: var(--white);
            color: var(--gray-900);
        }

        .form-control:hover, .form-select:hover {
            border-color: var(--gray-300);
        }

        .form-control:focus, .form-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(0, 51, 102, 0.1);
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

        /* Input group */
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
        }

        .alert-custom i {
            font-size: 1.25rem;
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
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
            text-decoration: none;
        }

        .btn-primary {
            background: var(--primary);
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
            box-shadow: 0 4px 12px rgba(0, 51, 102, 0.2);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 51, 102, 0.3);
            color: var(--white);
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 2.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--gray-200);
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

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .dashboard-wrapper {
                padding: 1rem;
                margin-top: 200px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                padding: 1.25rem;
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

            .form-card-header {
                padding: 1.25rem;
            }

            .header-icon {
                width: 48px;
                height: 48px;
            }

            .header-icon i {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .page-title {
                font-size: 1.5rem;
            }

            .breadcrumb {
                font-size: 0.85rem;
                padding: 0.5rem 1rem;
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
    </style>
</head>
<body>
    <?php include __DIR__ . '/../inc/header.php'; ?>

    <div class="dashboard-wrapper">
        <div class="container">
            <!-- En-tête de page -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">
                        Ajouter un <span>don</span>
                    </h1>
                    <p>
                        <i class="bi bi-circle-fill" style="color: var(--secondary); font-size: 0.5rem;"></i>
                        Enregistrez un nouveau don dans le système
                    </p>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Tableau de bord</a></li>
                        <li class="breadcrumb-item"><a href="/dons/liste">Dons</a></li>
                        <li class="breadcrumb-item active">Ajouter</li>
                    </ol>
                </nav>
            </div>

            <!-- Formulaire -->
            <div class="form-card">
                <div class="form-card-header">
                    <div class="d-flex align-items-center gap-3">
                        <div class="header-icon">
                            <i class="bi bi-gift"></i>
                        </div>
                        <div>
                            <h5>Nouveau don</h5>
                            <p>Tous les champs marqués d'un * sont obligatoires</p>
                        </div>
                    </div>
                </div>

                <div class="form-card-body">
                    <!-- Info box -->
                    <div class="info-box">
                        <i class="bi bi-info-circle"></i>
                        <p>Les dons seront automatiquement dispatchés aux villes selon les besoins.</p>
                    </div>

                    <?php if(isset($_SESSION['error'])): ?>
                        <div class="alert-custom">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                        </div>
                    <?php endif; ?>

                    <form action="/dons/save" method="POST" class="custom-form">
                        <!-- Donateur (optionnel) -->
                        <div class="form-group">
                            <label for="donateur" class="form-label">
                                <i class="bi bi-person"></i>
                                Donateur <span class="text-muted">(optionnel)</span>
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="donateur" 
                                   name="donateur" 
                                   placeholder="Croix Rouge, UNICEF, Anonyme..."
                                   autocomplete="off">
                            <small class="form-text">Laissez vide si anonyme</small>
                        </div>

                        <!-- Type de don -->
                        <div class="form-group">
                            <label for="type" class="form-label">
                                <i class="bi bi-tag"></i>
                                Type de don <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="" disabled selected>Sélectionner un type</option>
                                <option value="nature">🌾 Nature (riz, huile, etc.)</option>
                                <option value="materiaux">🔨 Matériaux (tôle, clou, etc.)</option>
                                <option value="argent">💰 Argent</option>
                            </select>
                        </div>

                        <!-- Libellé -->
                        <div class="form-group">
                            <label for="libelle" class="form-label">
                                <i class="bi bi-card-text"></i>
                                Libellé <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="libelle" 
                                   name="libelle" 
                                   placeholder="Ex: Riz, Tôle, Aide financière..." 
                                   required
                                   autocomplete="off">
                            <small class="form-text">Décrivez brièvement le don</small>
                        </div>

                        <!-- Valeur/Quantité -->
                        <div class="form-group">
                            <label for="valeur" class="form-label" id="valeurLabel">
                                <i class="bi bi-calculator"></i>
                                Quantité <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="number" 
                                       step="0.01" 
                                       class="form-control" 
                                       id="valeur" 
                                       name="valeur" 
                                       required>
                                <span class="input-group-text" id="valeurUnite">kg</span>
                            </div>
                            <small class="form-text" id="valeurHelp">
                                Entrez la quantité (pour nature/matériaux) ou le montant (pour argent)
                            </small>
                        </div>

                        <!-- Date du don -->
                        <div class="form-group">
                            <label for="date_don" class="form-label">
                                <i class="bi bi-calendar"></i>
                                Date du don
                            </label>
                            <input type="datetime-local" 
                                   class="form-control" 
                                   id="date_don" 
                                   name="date_don" 
                                   value="<?= date('Y-m-d\TH:i') ?>">
                        </div>

                        <!-- Boutons d'action -->
                        <div class="form-actions">
                            <a href="/dons/liste" class="btn-outline">
                                <i class="bi bi-x-lg"></i>
                                Annuler
                            </a>
                            <button type="submit" class="btn-primary">
                                <i class="bi bi-check-lg"></i>
                                Enregistrer le don
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../inc/footer.php'; ?>

    <!-- Scripts -->
    <script src="/assets/js/bootstrap.bundle.min.js" nonce="<?= $nonce ?>"></script>
    <script nonce="<?= $nonce ?>">
        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('type');
            const valeurInput = document.getElementById('valeur');
            const valeurLabel = document.getElementById('valeurLabel');
            const valeurHelp = document.getElementById('valeurHelp');
            const valeurUnite = document.getElementById('valeurUnite');
            
            if(typeSelect) {
                typeSelect.addEventListener('change', function() {
                    const type = this.value;
                    
                    if(type === 'argent') {
                        valeurLabel.innerHTML = '<i class="bi bi-calculator"></i> Montant <span class="text-danger">*</span>';
                        valeurHelp.textContent = 'Entrez le montant en Ariary (Ar)';
                        valeurUnite.textContent = 'Ar';
                        valeurInput.placeholder = 'Ex: 500000';
                    } else if(type === 'nature') {
                        valeurLabel.innerHTML = '<i class="bi bi-calculator"></i> Quantité <span class="text-danger">*</span>';
                        valeurHelp.textContent = 'Entrez la quantité (kg, L, unités)';
                        valeurUnite.textContent = 'kg';
                        valeurInput.placeholder = 'Ex: 100';
                    } else if(type === 'materiaux') {
                        valeurLabel.innerHTML = '<i class="bi bi-calculator"></i> Quantité <span class="text-danger">*</span>';
                        valeurHelp.textContent = 'Entrez le nombre d\'unités';
                        valeurUnite.textContent = 'unités';
                        valeurInput.placeholder = 'Ex: 50';
                    }
                });

                if(typeSelect.value) {
                    typeSelect.dispatchEvent(new Event('change'));
                }
            }
        });
    </script>
</body>
</html>