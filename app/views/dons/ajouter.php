<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title><?= $title ?> - BNGRC</title>
    
    <!-- Les CSS sont déjà dans header.php -->
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
                    <p class="text-muted mb-0">
                        <i class="bi bi-circle-fill text-danger" style="font-size: 0.5rem;"></i>
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
                            <h5 class="mb-1">Nouveau don</h5>
                            <p class="text-muted mb-0 small">Tous les champs marqués d'un * sont obligatoires</p>
                        </div>
                    </div>
                </div>

                <div class="form-card-body">
                    <?php if(isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-custom">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
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
                            <small class="form-text text-muted">Laissez vide si anonyme</small>
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
                            <small class="form-text text-muted">Décrivez brièvement le don</small>
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
                            <small class="form-text text-muted" id="valeurHelp">
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
                    
                    // Mise à jour du label et de l'aide
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

                // Déclencher le changement initial
                if(typeSelect.value) {
                    typeSelect.dispatchEvent(new Event('change'));
                }
            }
        });
    </script>

    <style>
        /* Styles supplémentaires si nécessaire */
      
    </style>
</body>
</html>