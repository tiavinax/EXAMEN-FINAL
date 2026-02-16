<?php 
// villes/modifier.php
$title = "Modifier une ville - BNGRC";
$page_css = ['modifier_ville'];
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

    </style>
</head>
<body>

    <div class="main-container">
        <div class="content-wrapper">
            <!-- En-tête -->
            <div class="page-header">
                <div class="page-header-left">
                    <h1>
                        Modifier une <span>ville</span>
                    </h1>
                    <p>
                        <i class="fas fa-circle"></i>
                        Modifiez les informations de la ville
                    </p>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/villes/liste">Villes</a></li>
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
                        <i class="fas fa-edit"></i>
                    </div>
                    <div class="header-title">
                        <h4>Modification de la ville</h4>
                        <p>Modifiez les informations ci-dessous</p>
                    </div>
                </div>

                <div class="form-card-body">
                    <!-- Info box -->
                    <div class="info-box">
                        <i class="fas fa-info-circle"></i>
                        <p>
                            <strong>Attention :</strong> La modification du nom ou de la région peut affecter les besoins associés.
                        </p>
                    </div>

                    <!-- Valeurs actuelles -->
                    <div class="current-values">
                        <div class="current-item">
                            <i class="fas fa-building"></i>
                            <span>Ville actuelle : <strong><?= htmlspecialchars($ville->nom) ?></strong></span>
                        </div>
                        <div class="current-item">
                            <i class="fas fa-map-marked-alt"></i>
                            <span>Région actuelle : <strong><?= htmlspecialchars($ville->region) ?></strong></span>
                        </div>
                    </div>

                    <form action="/villes/update/<?= $ville->id ?>" method="POST" class="custom-form">
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
                                   value="<?= htmlspecialchars($ville->nom) ?>" 
                                   placeholder="Ex: Antananarivo" 
                                   required>
                            <small class="form-text">Modifiez le nom de la ville si nécessaire</small>
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
                                   value="<?= htmlspecialchars($ville->region) ?>" 
                                   placeholder="Ex: Analamanga" 
                                   required>
                            <small class="form-text">Modifiez la région si nécessaire</small>
                        </div>

                        <!-- Boutons -->
                        <div class="form-actions">
                            <a href="/villes/liste" class="btn-outline">
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

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script>
        // Confirmation avant modification
        document.querySelector('form')?.addEventListener('submit', function(e) {
            const nom = document.getElementById('nom').value;
            const region = document.getElementById('region').value;
            
            if(confirm('Voulez-vous vraiment modifier cette ville ?')) {
                return true;
            }
            e.preventDefault();
            return false;
        });
    </script>
</body>
</html>