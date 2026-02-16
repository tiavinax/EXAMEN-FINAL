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

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>