<?php
// inc/header.php
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BNGRC - Bureau National de Gestion des Risques et des Catastrophes Madagascar">
    <meta name="keywords" content="BNGRC, Madagascar, Gestion des risques, Catastrophes, Alertes">
    <meta name="author" content="BNGRC Madagascar">

    <title><?= $title ?? 'BNGRC' ?></title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap Local -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/header.css">
    <?php if (isset($page_css)): ?>
        <?php foreach ($page_css as $css): ?>
            <link rel="stylesheet" href="/assets/css/<?= $css ?>.css">
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/bngrc.png">
    <link rel="icon" type="image/png" sizes="64x64" href="/assets/images/bngrc.png">
    <link rel="icon" type="image/png" sizes="48x48" href="/assets/images/bngrc.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/bngrc.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/bngrc.png">

    <style>
        /* Variables globales */
        :root {
            --primary: #003366;
            --secondary: #D32F2F;
            --accent: #FFA000;
            --success: #2E7D32;
            --info: #0288D1;
            --warning: #ED6C02;
            --danger: #D32F2F;
            --dark: #1A1A1A;
            --light: #F5F5F5;
            --gray: #757575;
            --border: #E0E0E0;
            --header-bg: linear-gradient(135deg, #003366 0%, #002147 100%);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            padding-top: 180px;
            /* Espace pour le header fixe */
            margin: 0;
        }

        /* Header fixe */
        .site-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            background: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <header class="site-header">
        <div class="header-top">
            <div class="container logos-row">
                <img src="/assets/images/interieure.png" alt="Ministère de l'Intérieur" class="logo-left">
                <img src="/assets/images/republique.png" alt="République de Madagascar" class="logo-center">
                <img src="/assets/images/bngrc.png" alt="BNGRC" class="logo-right">
            </div>
            <div class="main-title">
                BUREAU NATIONAL DE GESTION DES RISQUES ET DES CATASTROPHES
            </div>
        </div>

        <nav class="navbar">
            <div class="container navbar-container">
                <ul class="nav-menu">
                    <li><a href="/" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">ACCUEIL</a></li>
                    <li><a href="/#bngrc" class="nav-link">BNGRC <i class="fas fa-chevron-down caret"></i></a></li>
                    <li><a href="/#news" class="nav-link">ACTUALITÉS <i class="fas fa-chevron-down caret"></i></a></li>
                    <li><a href="/#alerts" class="nav-link">URGENCES EN COURS</a></li>
                    <li><a href="/#sensibilisations" class="nav-link">SENSIBILISATIONS</a></li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">DONS</a>
                        <ul class="dropdown-menu">
                            <li><a href="/dons/ajouter" class="dropdown-item">Ajouter un don</a></li>
                            <li><a href="/dons/liste" class="dropdown-item">Liste des dons</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">GESTION</a>
                        <ul class="dropdown-menu">
                            <li><a href="/villes/liste" class="dropdown-item">🏙️ Villes</a></li>
                            <li><a href="/besoins/liste" class="dropdown-item">📋 Besoins</a></li>
                            <li><a href="/dons/liste" class="dropdown-item">🎁 Dons</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a href="/dashboard" class="dropdown-item">📊 Tableau de bord</a></li>
                        </ul>
                    </li>
                    <li><a href="/#contact" class="nav-link">CONTACT</a></li>
                </ul>
            </div>
        </nav>
    </header>