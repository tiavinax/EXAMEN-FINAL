<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <style>
        .table-thead-custom { background-color: #87CEEB !important; }
        .dispatch-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../inc/header.php'; ?>

    <div class="container mt-5">
        
        <!-- Messages flash -->
        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Cartes de contrôle -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card dispatch-card">
                    <div class="card-body">
                        <h5 class="card-title">Dispatch automatique</h5>
                        <p class="card-text">
                            Lancer l'attribution automatique des dons aux villes selon :
                            <ul>
                                <li>Ordre de date des dons</li>
                                <li>Besoins non satisfaits</li>
                                <li>Compatibilité type/libellé</li>
                            </ul>
                        </p>
                        <div class="d-flex gap-2">
                            <a href="/dispatch/run" class="btn btn-light" 
                               onclick="return confirm('Lancer le dispatch ?')">
                                🚀 Lancer le dispatch
                            </a>
                            <a href="/dispatch/redistribute" class="btn btn-warning"
                               onclick="return confirm('Réinitialiser et redistribuer tous les dons ?')">
                                🔄 Réinitialiser et redistribuer
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Résumé</h5>
                        <?php
                        $totalAttrib = count($attributions);
                        $totalMontant = 0;
                        $totalQuantite = 0;
                        foreach($attributions as $a) {
                            if($a->montant_attribue) $totalMontant += $a->montant_attribue;
                            if($a->quantite_attribuee) $totalQuantite += $a->quantite_attribuee;
                        }
                        ?>
                        <p class="card-text display-6"><?= $totalAttrib ?> attributions</p>
                        <p class="card-text">
                            Montant total: <?= number_format($totalMontant, 0, ',', ' ') ?> Ar<br>
                            Quantité totale: <?= number_format($totalQuantite) ?> unités
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau des attributions -->
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Liste des attributions</h5>
                <span class="badge bg-light text-dark"><?= count($attributions) ?> enregistrement(s)</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-thead-custom">
                            <tr>
                                <th>Date</th>
                                <th>Donateur</th>
                                <th>Don</th>
                                <th>Ville</th>
                                <th>Besoin</th>
                                <th>Quantité attribuée</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($attributions)): ?>
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <p class="text-muted my-3">
                                            Aucune attribution pour le moment.<br>
                                            Cliquez sur "Lancer le dispatch" pour commencer.
                                        </p>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach($attributions as $attrib): ?>
                                <tr>
                                    <td><?= date('d/m/Y H:i', strtotime($attrib->date_attribution)) ?></td>
                                    <td><?= htmlspecialchars($attrib->donateur ?? 'Anonyme') ?></td>
                                    <td><?= htmlspecialchars($attrib->don_libelle) ?></td>
                                    <td><?= htmlspecialchars($attrib->ville_nom) ?></td>
                                    <td><?= htmlspecialchars($attrib->besoin_libelle) ?></td>
                                    <td class="text-end">
                                        <?php if($attrib->montant_attribue): ?>
                                            <strong><?= number_format($attrib->montant_attribue, 0, ',', ' ') ?> Ar</strong>
                                        <?php else: ?>
                                            <strong><?= number_format($attrib->quantite_attribuee) ?></strong>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $badgeClass = match($attrib->don_type) {
                                            'nature' => 'bg-success',
                                            'materiaux' => 'bg-secondary',
                                            'argent' => 'bg-warning'
                                        };
                                        ?>
                                        <span class="badge <?= $badgeClass ?>">
                                            <?= ucfirst($attrib->don_type) ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../inc/footer.php'; ?>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>