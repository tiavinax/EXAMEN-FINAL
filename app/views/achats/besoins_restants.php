<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - BNGRC</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    
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

        .btn-info {
            background: var(--info);
            color: var(--white);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 40px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(2, 136, 209, 0.2);
        }

        .btn-info:hover {
            background: #026AA2;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(2, 136, 209, 0.3);
            color: var(--white);
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
            box-shadow: var(--shadow-sm);
        }

        .alert-custom.info {
            background: var(--info-light);
            border-left-color: var(--info);
            color: var(--info);
            border: 1px solid rgba(2, 136, 209, 0.2);
        }

        .alert-custom.success {
            background: var(--success-light);
            border-left-color: var(--success);
            color: var(--success);
            border: 1px solid rgba(46, 125, 50, 0.2);
        }

        .alert-custom i {
            font-size: 1.25rem;
        }

        /* ===== TABLE CARD ===== */
        .table-card {
            background: var(--white);
            border-radius: 24px;
            border: 1px solid var(--gray-200);
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }

        .table-card-body {
            padding: 1.5rem;
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
        .badge {
            padding: 0.4rem 0.8rem;
            border-radius: 40px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .badge.bg-success {
            background: var(--success-light) !important;
            color: var(--success) !important;
        }

        .badge.bg-secondary {
            background: var(--gray-200) !important;
            color: var(--gray-700) !important;
        }

        .badge.bg-warning {
            background: var(--warning-light) !important;
            color: var(--warning) !important;
        }

        /* ===== MONTANTS ===== */
        .montant {
            font-weight: 600;
            text-align: right;
        }

        .montant.total {
            color: var(--primary);
            font-weight: 700;
        }

        .montant small {
            font-size: 0.75rem;
            color: var(--gray-500);
            font-weight: 400;
        }

        /* ===== BOUTON ACHETER ===== */
        .btn-acheter {
            background: var(--success);
            color: var(--white);
            border: none;
            padding: 0.5rem 1.2rem;
            border-radius: 40px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 2px 8px rgba(46, 125, 50, 0.2);
        }

        .btn-acheter:hover {
            background: #1E5A22;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(46, 125, 50, 0.3);
            color: var(--white);
        }

        .btn-acheter i {
            font-size: 0.9rem;
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state i {
            font-size: 4rem;
            color: var(--success);
            margin-bottom: 1rem;
        }

        .empty-state h4 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: var(--gray-500);
            font-size: 1rem;
        }

        /* ===== MODAL ===== */
        .modal-content {
            border: none;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow-xl);
        }

        .modal-header {
            background: linear-gradient(135deg, var(--success), #1E5A22);
            color: var(--white);
            border: none;
            padding: 1.5rem;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
            opacity: 0.8;
            transition: opacity 0.2s;
        }

        .modal-header .btn-close:hover {
            opacity: 1;
        }

        .modal-body {
            padding: 2rem;
        }

        /* ===== FORM ===== */
        .form-label {
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control, .form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1.5px solid var(--gray-200);
            border-radius: 12px;
            font-size: 0.95rem;
            font-family: inherit;
            transition: all 0.2s;
        }

        .form-control:focus, .form-select:focus {
            outline: none;
            border-color: var(--success);
            box-shadow: 0 0 0 4px rgba(46, 125, 50, 0.1);
        }

        .form-text {
            font-size: 0.85rem;
            color: var(--gray-500);
            margin-top: 0.35rem;
            display: block;
        }

        /* ===== SIMULATION CARD ===== */
        .simulation-card {
            border: 1px solid var(--gray-200);
            border-radius: 16px;
            overflow: hidden;
            margin-top: 1rem;
        }

        .simulation-header {
            background: var(--info);
            color: var(--white);
            padding: 0.75rem 1rem;
            font-weight: 600;
        }

        .simulation-body {
            padding: 1rem;
            background: var(--gray-50);
        }

        .simulation-table {
            width: 100%;
            font-size: 0.95rem;
        }

        .simulation-table td {
            padding: 0.5rem 0;
            border: none;
        }

        .simulation-table td:last-child {
            text-align: right;
            font-weight: 600;
        }

        .simulation-total {
            background: var(--success-light);
            color: var(--success);
            padding: 0.5rem;
            border-radius: 8px;
            margin-top: 0.5rem;
            font-weight: 700;
            text-align: center;
        }

        .simulation-insufficient {
            background: var(--secondary-light);
            color: var(--danger);
            padding: 0.5rem;
            border-radius: 8px;
            margin-top: 0.5rem;
            font-weight: 600;
            text-align: center;
        }

        .btn-valider {
            background: var(--success);
            color: var(--white);
            border: none;
            padding: 0.75rem;
            border-radius: 40px;
            font-weight: 600;
            width: 100%;
            margin-top: 1rem;
            transition: all 0.2s;
        }

        .btn-valider:hover {
            background: #1E5A22;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(46, 125, 50, 0.3);
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

            .table-card-body {
                padding: 1rem;
            }

            th, td {
                padding: 0.75rem 1rem;
            }

            .btn-acheter {
                padding: 0.4rem 1rem;
                font-size: 0.8rem;
            }
        }

        @media (max-width: 480px) {
            .page-header-left h1 {
                font-size: 1.5rem;
            }

            .modal-body {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../inc/header.php'; ?>

    <div class="main-container">
        <div class="content-wrapper">
            <!-- En-tête -->
            <div class="page-header">
                <div class="page-header-left">
                    <h1>
                        Besoins <span>restants</span>
                    </h1>
                    <p>
                        <i class="fas fa-circle"></i>
                        Achetez avec des dons en argent pour satisfaire les besoins
                    </p>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/achats/historique">Achats</a></li>
                        <li class="breadcrumb-item active">Besoins restants</li>
                    </ol>
                </nav>
            </div>

            <!-- Info alerte -->
            <div class="alert-custom info">
                <i class="fas fa-info-circle"></i>
                Sélectionnez un besoin pour acheter avec des dons en argent 
                <strong>(frais de 10% appliqués)</strong>
            </div>

            <?php if (empty($besoins)): ?>
                <div class="alert-custom success">
                    <i class="fas fa-check-circle"></i>
                    <div>
                        <strong>Félicitations !</strong>
                        <p class="mb-0">Tous les besoins sont satisfaits. Aucun besoin restant.</p>
                    </div>
                </div>
            <?php else: ?>
                <div class="table-card">
                    <div class="table-card-body">
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Ville / Région</th>
                                        <th>Type</th>
                                        <th>Libellé</th>
                                        <th>Quantité restante</th>
                                        <th>Prix unitaire</th>
                                        <th>Valeur totale</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($besoins as $besoin): ?>
                                        <tr>
                                            <td>
                                                <span class="badge" style="background: var(--primary-light); color: var(--primary);">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    <?= htmlspecialchars($besoin->ville_nom) ?>
                                                    <small>(<?= htmlspecialchars($besoin->region) ?>)</small>
                                                </span>
                                            </td>
                                            <td>
                                                <?php
                                                $badgeClass = match ($besoin->type) {
                                                    'nature' => 'bg-success',
                                                    'materiaux' => 'bg-secondary',
                                                    'argent' => 'bg-warning'
                                                };
                                                $icon = match ($besoin->type) {
                                                    'nature' => 'fa-seedling',
                                                    'materiaux' => 'fa-tools',
                                                    'argent' => 'fa-coins'
                                                };
                                                ?>
                                                <span class="badge <?= $badgeClass ?>">
                                                    <i class="fas <?= $icon ?>"></i>
                                                    <?= ucfirst($besoin->type) ?>
                                                </span>
                                            </td>
                                            <td><?= htmlspecialchars($besoin->libelle) ?></td>
                                            <td class="montant"><?= number_format($besoin->reste) ?></td>
                                            <td class="montant"><?= number_format($besoin->prix_unitaire, 0, ',', ' ') ?> <small>Ar</small></td>
                                            <td class="montant total">
                                                <?= number_format($besoin->reste * $besoin->prix_unitaire, 0, ',', ' ') ?> <small>Ar</small>
                                            </td>
                                            <td>
                                                <button class="btn-acheter"
                                                    data-besoin-id="<?= $besoin->id ?>"
                                                    data-besoin-libelle="<?= htmlspecialchars($besoin->libelle) ?>"
                                                    data-besoin-type="<?= $besoin->type ?>"
                                                    data-besoin-reste="<?= $besoin->reste ?>"
                                                    data-prix-unitaire="<?= $besoin->prix_unitaire ?>"
                                                    data-ville-nom="<?= htmlspecialchars($besoin->ville_nom) ?>"
                                                    onclick="ouvrirModalAchat(this)">
                                                    <i class="fas fa-shopping-cart"></i>
                                                    Acheter
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal d'achat -->
    <div class="modal fade" id="modalAchat" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-shopping-cart me-2"></i>
                        Acheter avec dons en argent
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modalAchatBody">
                    <div class="text-center py-4">
                        <div class="spinner-border text-success" role="status">
                            <span class="visually-hidden">Chargement...</span>
                        </div>
                        <p class="mt-2 text-muted">Chargement des données...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../inc/footer.php'; ?>

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script>
        let besoinActuel = null;
        let donsDisponibles = [];
        let fraisActuel = 0;

 function ouvrirModalAchat(button) {
    const besoinId = button.dataset.besoinId;

    var modal = new bootstrap.Modal(document.getElementById('modalAchat'));
    modal.show();

    fetch(`http://172.16.7.131/ETU003955/EXAMEN-FINAL/public/achats/modal-data?besoin_id=${besoinId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                throw new Error(data.error);
            }
            if (!data.success) {
                throw new Error('Erreur inconnue');
            }
            besoinActuel = data.besoin;
            donsDisponibles = data.dons;
            fraisActuel = data.frais;
            afficherFormulaireAchat();
        })
        .catch(error => {
            console.error('Erreur:', error);
            document.getElementById('modalAchatBody').innerHTML = `
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Erreur lors du chargement des données</strong><br>
                    ${error.message}
                </div>
                <div class="text-center mt-3">
                    <button class="btn btn-secondary" onclick="ouvrirModalAchat(${besoinId})">
                        <i class="fas fa-redo me-2"></i>
                        Réessayer
                    </button>
                </div>
            `;
        });
}

        function afficherFormulaireAchat() {
            if (!besoinActuel) return;

            let optionsDons = '<option value="">Sélectionner un don</option>';
            donsDisponibles.forEach(don => {
                optionsDons += `<option value="${don.id}" data-solde="${don.solde}">
                    ${don.donateur || 'Anonyme'} - ${new Date(don.date_don).toLocaleDateString()} - 
                    ${parseInt(don.solde).toLocaleString()} Ar disponible
                </option>`;
            });

            const html = `
                <div class="alert alert-info mb-4">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-info-circle fa-2x"></i>
                        <div>
                            <strong>${besoinActuel.ville_nom}</strong> - ${besoinActuel.libelle} (${besoinActuel.type})<br>
                            <small>Reste: ${parseInt(besoinActuel.reste).toLocaleString()} unités</small> |
                            <small>Prix unitaire: ${parseInt(besoinActuel.prix_unitaire).toLocaleString()} Ar</small>
                        </div>
                    </div>
                </div>
                
                <form id="formAchat">
                    <input type="hidden" id="besoin_id" value="${besoinActuel.id}">
                    
                    <div class="mb-3">
                        <label for="don_id" class="form-label">Sélectionner un don <span class="text-danger">*</span></label>
                        <select class="form-select" id="don_id" required>
                            ${optionsDons}
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="quantite" class="form-label">Quantité à acheter <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="quantite" 
                               min="1" max="${besoinActuel.reste}" step="1" required>
                        <small class="form-text">Maximum: ${parseInt(besoinActuel.reste).toLocaleString()} unités</small>
                    </div>
                    
                    <div id="resultatSimulation" style="display: none;"></div>
                    
                    <div class="alert alert-danger mt-3" id="erreurSimulation" style="display: none;"></div>
                </form>
            `;

            document.getElementById('modalAchatBody').innerHTML = html;

            document.getElementById('don_id').addEventListener('change', simulerAchat);
            document.getElementById('quantite').addEventListener('input', simulerAchat);
        }

        function simulerAchat() {
            const donId = document.getElementById('don_id').value;
            const quantite = document.getElementById('quantite').value;
            const besoinId = document.getElementById('besoin_id').value;

            if (!donId || !quantite || quantite < 1) {
                document.getElementById('resultatSimulation').style.display = 'none';
                document.getElementById('erreurSimulation').style.display = 'none';
                return;
            }

            fetch('http://172.16.7.131/ETU003955/EXAMEN-FINAL/public/achats/simuler', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `don_id=${donId}&besoin_id=${besoinId}&quantite=${quantite}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const calc = data.calculs;
                        const peutAcheter = calc.peut_acheter;

                        let html = `
                            <div class="simulation-card">
                                <div class="simulation-header">
                                    <i class="fas fa-calculator me-2"></i>
                                    Résultat de la simulation
                                </div>
                                <div class="simulation-body">
                                    <table class="simulation-table">
                                        <tr>
                                            <td>Montant du besoin:</td>
                                            <td>${calc.montant_besoin.toLocaleString()} Ar</td>
                                        </tr>
                                        <tr>
                                            <td>Frais (${calc.frais_pourcentage}%):</td>
                                            <td>${calc.montant_frais.toLocaleString()} Ar</td>
                                        </tr>
                                        <tr style="border-top: 1px solid var(--gray-300);">
                                            <td><strong>Total à déduire:</strong></td>
                                            <td><strong>${calc.total_a_deduire.toLocaleString()} Ar</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Solde du don:</td>
                                            <td>${calc.solde_don.toLocaleString()} Ar</td>
                                        </tr>
                                    </table>
                        `;

                        if (!peutAcheter) {
                            html += `
                                    <div class="simulation-insufficient">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        Solde insuffisant pour cet achat
                                    </div>
                                </div>
                            </div>
                            `;
                        } else {
                            html += `
                                    <div class="simulation-total">
                                        <i class="fas fa-check-circle me-2"></i>
                                        Reste après achat: ${calc.reste_apres_achat.toLocaleString()} Ar
                                    </div>
                                </div>
                            </div>
                            <button class="btn-valider" onclick="validerAchat()">
                                <i class="fas fa-check-circle me-2"></i>
                                Valider l'achat
                            </button>
                            `;
                        }

                        document.getElementById('resultatSimulation').innerHTML = html;
                        document.getElementById('resultatSimulation').style.display = 'block';
                        document.getElementById('erreurSimulation').style.display = 'none';
                    }
                })
                .catch(error => {
                    document.getElementById('erreurSimulation').innerHTML = `
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Erreur lors de la simulation
                    `;
                    document.getElementById('erreurSimulation').style.display = 'block';
                    document.getElementById('resultatSimulation').style.display = 'none';
                });
        }

        function validerAchat() {
            const donId = document.getElementById('don_id').value;
            const quantite = document.getElementById('quantite').value;
            const besoinId = document.getElementById('besoin_id').value;

            const erreurs = [];
            if (!donId) erreurs.push("Veuillez sélectionner un don");
            if (!quantite || quantite < 1) erreurs.push("Quantité invalide");

            if (erreurs.length > 0) {
                alert('Erreurs:\n- ' + erreurs.join('\n- '));
                return;
            }

            const message = `Confirmer l'achat ?
            
Détails:
• Besoin: ${besoinActuel.libelle} (${besoinActuel.ville_nom})
• Quantité: ${parseInt(quantite).toLocaleString()} unités
• Montant: ${(quantite * besoinActuel.prix_unitaire).toLocaleString()} Ar
• Frais (${fraisActuel}%): ${(quantite * besoinActuel.prix_unitaire * fraisActuel/100).toLocaleString()} Ar
• Total: ${(quantite * besoinActuel.prix_unitaire * (1 + fraisActuel/100)).toLocaleString()} Ar

Cette action est irréversible.`;

            if (!confirm(message)) {
                return;
            }

            const btn = event.target;
            const originalHtml = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Traitement...';

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'http://172.16.7.131/ETU003955/EXAMEN-FINAL/public/achats/valider';
            form.style.display = 'none';

            const fields = {
                don_id: donId,
                besoin_id: besoinId,
                quantite: quantite
            };

            for (const [name, value] of Object.entries(fields)) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = name;
                input.value = value;
                form.appendChild(input);
            }

            document.body.appendChild(form);
            form.submit();

            setTimeout(() => {
                btn.disabled = false;
                btn.innerHTML = originalHtml;
            }, 5000);
        }
    </script>
</body>
</html>