<?php 
// dashboard/ajouter_besoin.php
$title = "Ajouter un besoin - BNGRC";
$page_css = ['ajouter_besoin'];
include __DIR__ . '/../inc/header.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Variables */
       
    </style>
</head>
<body>

    <div class="main-container">
        <div class="content-wrapper">
            <!-- En-tête -->
            <div class="page-header">
                <div class="page-header-left">
                    <h1>
                        Ajouter un <span>besoin</span>
                    </h1>
                    <p>
                        <i class="fas fa-circle"></i>
                        Enregistrez un nouveau besoin d'aide humanitaire
                    </p>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/besoins/liste">Besoins</a></li>
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
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                    <div class="header-title">
                        <h4>Nouveau besoin</h4>
                        <p>Tous les champs marqués d'un * sont obligatoires</p>
                    </div>
                </div>

                <div class="form-card-body">
                    <!-- Info box -->
                    <div class="info-box">
                        <i class="fas fa-info-circle"></i>
                        <p>
                            <strong>Important :</strong> Le prix unitaire est fixe et ne pourra pas être modifié après l'enregistrement.
                        </p>
                    </div>

                    <form action="/besoins/save" method="POST" class="custom-form">
                        <!-- Ville -->
                        <div class="form-group">
                            <label for="ville_id" class="form-label">
                                <i class="fas fa-city"></i>
                                Ville <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" id="ville_id" name="ville_id" required>
                                <option value="" selected disabled>Sélectionner une ville</option>
                                <?php foreach($villes as $ville): ?>
                                    <option value="<?= $ville->id ?>">
                                        <?= htmlspecialchars($ville->nom) ?> (<?= htmlspecialchars($ville->region) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <small class="form-text">Choisissez la ville où le besoin est exprimé</small>
                        </div>

                        <!-- Type de besoin -->
                        <div class="form-group">
                            <label for="type" class="form-label">
                                <i class="fas fa-tag"></i>
                                Type de besoin <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="" selected disabled>Sélectionner un type</option>
                                <option value="nature">🌾 Nature (riz, huile, etc.)</option>
                                <option value="materiaux">🔨 Matériaux (tôle, clou, etc.)</option>
                                <option value="argent">💰 Argent</option>
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
                                   placeholder="Ex: Riz, Tôles, Aide financière..." 
                                   required>
                            <small class="form-text">Décrivez précisément le besoin</small>
                        </div>

                        <!-- Quantité/Montant -->
                        <div class="form-group">
                            <label for="quantite" class="form-label" id="quantiteLabel">
                                <i class="fas fa-calculator"></i>
                                Quantité <span class="text-danger">*</span>
                            </label>
                            <input type="number" 
                                   step="0.01" 
                                   class="form-control" 
                                   id="quantite" 
                                   name="quantite" 
                                   required>
                            <small class="form-text" id="quantiteHelp">
                                Entrez la quantité nécessaire
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
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-check"></i>
                                Enregistrer le besoin
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../inc/footer.php'; ?>

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('type');
            const quantiteLabel = document.getElementById('quantiteLabel');
            const quantiteHelp = document.getElementById('quantiteHelp');
            const quantiteInput = document.getElementById('quantite');

            if(typeSelect) {
                typeSelect.addEventListener('change', function() {
                    const type = this.value;
                    
                    if(type === 'argent') {
                        quantiteLabel.innerHTML = '<i class="fas fa-calculator"></i> Montant <span class="text-danger">*</span>';
                        quantiteHelp.textContent = 'Entrez le montant total nécessaire en Ariary';
                        quantiteInput.placeholder = 'Ex: 5000000';
                    } else if(type === 'nature') {
                        quantiteLabel.innerHTML = '<i class="fas fa-calculator"></i> Quantité <span class="text-danger">*</span>';
                        quantiteHelp.textContent = 'Entrez la quantité nécessaire (en kg, litres, etc.)';
                        quantiteInput.placeholder = 'Ex: 1000';
                    } else if(type === 'materiaux') {
                        quantiteLabel.innerHTML = '<i class="fas fa-calculator"></i> Quantité <span class="text-danger">*</span>';
                        quantiteHelp.textContent = 'Entrez le nombre d\'unités nécessaires';
                        quantiteInput.placeholder = 'Ex: 500';
                    }
                });
            }
        });
    </script>
</body>
</html>