<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BNGRC - Ajouter un don</title>
    
    <!-- Bootstrap CSS (local) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome (local) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
        }

        /* Header BNGRC */
        .bngrc-header {
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 10px 0;
            margin-bottom: 30px;
        }

        .bngrc-top-bar {
            background: #E31B23;
            color: white;
            padding: 5px 0;
            font-size: 13px;
        }

        .bngrc-logo {
            color: #E31B23;
            font-size: 24px;
            font-weight: bold;
        }

        .bngrc-logo small {
            color: #666;
            font-size: 14px;
            display: block;
        }

        /* Navigation */
        .bngrc-nav {
            background: #003399;
        }

        .bngrc-nav a {
            color: white;
            text-decoration: none;
            padding: 15px 20px;
            display: inline-block;
        }

        .bngrc-nav a:hover {
            background: #E31B23;
        }

        /* Formulaire */
        .form-container {
            max-width: 600px;
            margin: 0 auto 50px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .form-header {
            background: #003399;
            color: white;
            padding: 20px;
        }

        .form-header h2 {
            margin: 0;
            font-size: 24px;
        }

        .form-header p {
            margin: 5px 0 0;
            opacity: 0.9;
            font-size: 14px;
        }

        .form-body {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .form-group label i {
            color: #E31B23;
            margin-right: 8px;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-control:focus {
            outline: none;
            border-color: #003399;
            box-shadow: 0 0 5px rgba(0,51,153,0.3);
        }

        select.form-control {
            background: white;
        }

        .radio-group {
            display: flex;
            gap: 20px;
            margin-top: 10px;
        }

        .radio-group label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: normal;
        }

        .btn-submit {
            background: #E31B23;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background 0.3s;
        }

        .btn-submit:hover {
            background: #B00F15;
        }

        .btn-submit i {
            margin-right: 10px;
        }

        .btn-cancel {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #666;
            text-decoration: none;
        }

        .btn-cancel:hover {
            color: #E31B23;
        }

        /* Footer */
        .bngrc-footer {
            background: #003399;
            color: white;
            padding: 20px 0;
            margin-top: 50px;
            text-align: center;
        }

        .bngrc-copyright {
            background: #002266;
            padding: 10px 0;
            color: rgba(255,255,255,0.6);
            font-size: 13px;
            text-align: center;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .breadcrumb {
            background: white;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .breadcrumb a {
            color: #E31B23;
            text-decoration: none;
        }

        .breadcrumb span {
            color: #666;
        }
    </style>
</head>
<body>
    <!-- Top bar -->
    <div class="bngrc-top-bar">
        <div class="container">
            <div style="display: flex; justify-content: space-between;">
                <div>
                    <i class="fas fa-phone"></i> 913
                    <i class="fas fa-envelope ms-3"></i> contact@bngrc.mg
                </div>
                <div>
                    <i class="fab fa-facebook"></i>
                    <i class="fab fa-twitter ms-3"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Header -->
    <div class="bngrc-header">
        <div class="container">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="background: #E31B23; color: white; padding: 15px; border-radius: 5px;">
                    <i class="fas fa-shield-alt fa-2x"></i>
                </div>
                <div>
                    <div class="bngrc-logo">BNGRC</div>
                    <small>Bureau National de Gestion des Risques et Catastrophes</small>
                </div>
                <div style="margin-left: auto;">
                    <i class="fas fa-calendar"></i> Lundi 16 Février 2026
                </div>
            </div>
        </div>
    </div>
    
    <!-- Navigation -->
    <div class="bngrc-nav">
        <div class="container">
            <a href="/dashboard"><i class="fas fa-home"></i> Tableau de bord</a>
            <a href="/villes"><i class="fas fa-city"></i> Villes</a>
            <a href="/besoins"><i class="fas fa-hand-holding-heart"></i> Besoins</a>
            <a href="/dons" style="background: #E31B23;"><i class="fas fa-gift"></i> Dons</a>
            <a href="/attributions"><i class="fas fa-exchange-alt"></i> Attributions</a>
        </div>
    </div>
    
    <!-- Contenu principal -->
    <div class="container">
        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="/dashboard">Accueil</a>
            <span style="margin: 0 10px;">/</span>
            <a href="/dons">Dons</a>
            <span style="margin: 0 10px;">/</span>
            <span>Ajouter un don</span>
        </div>
        
        <!-- Formulaire -->
        <div class="form-container">
            <div class="form-header">
                <h2><i class="fas fa-gift"></i> Ajouter un don</h2>
                <p>Enregistrez un nouveau don dans le système</p>
            </div>
            
            <div class="form-body">
                <!-- Type de don -->
                <div class="form-group">
                    <label><i class="fas fa-tag"></i> Type de don</label>
                    <select class="form-control">
                        <option value="">Sélectionnez un type</option>
                        <option value="nature">En nature (riz, huile, etc.)</option>
                        <option value="materiaux">Matériaux (tôle, clous, etc.)</option>
                        <option value="argent">Argent</option>
                    </select>
                </div>
                
                <!-- Donateur -->
                <div class="form-group">
                    <label><i class="fas fa-user"></i> Donateur</label>
                    <select class="form-control">
                        <option value="">Sélectionnez un donateur</option>
                        <option value="1">Croix Rouge Malagasy</option>
                        <option value="2">UNICEF Madagascar</option>
                        <option value="3">PAM</option>
                        <option value="4">Fondation Telma</option>
                        <option value="5">ANONYME</option>
                    </select>
                </div>
                
                <!-- Libellé -->
                <div class="form-group">
                    <label><i class="fas fa-heading"></i> Libellé du don</label>
                    <input type="text" class="form-control" placeholder="Ex: Riz, Tôles, Argent...">
                </div>
                
                <!-- Description -->
                <div class="form-group">
                    <label><i class="fas fa-align-left"></i> Description (optionnel)</label>
                    <textarea class="form-control" rows="3" placeholder="Description détaillée du don..."></textarea>
                </div>
                
                <!-- Quantité -->
                <div class="form-group">
                    <label><i class="fas fa-cubes"></i> Quantité</label>
                    <input type="number" class="form-control" placeholder="Ex: 100">
                </div>
                
                <!-- Prix unitaire (optionnel) -->
                <div class="form-group">
                    <label><i class="fas fa-coins"></i> Prix unitaire (Ar) - optionnel</label>
                    <input type="number" class="form-control" placeholder="Ex: 5000">
                </div>
                
                <!-- Date du don -->
                <div class="form-group">
                    <label><i class="fas fa-calendar"></i> Date du don</label>
                    <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                </div>
                
                <!-- Boutons -->
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Enregistrer le don
                </button>
                
                <a href="/dons" class="btn-cancel">
                    <i class="fas fa-times"></i> Annuler
                </a>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <div class="bngrc-footer">
        <div class="container">
            <p>Bureau National de Gestion des Risques et Catastrophes</p>
            <p>Antananarivo, Madagascar</p>
        </div>
    </div>
    
    <div class="bngrc-copyright">
        &copy; 2026 BNGRC - Tous droits réservés
    </div>
</body>
</html>
