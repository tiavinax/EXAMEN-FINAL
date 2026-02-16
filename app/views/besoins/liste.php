<?php 
// dashboard/liste_besoins.php
$title = "Liste des besoins - BNGRC";
$page_css = ['liste_besoin'];
include __DIR__ . '/../inc/header.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <style>
        .table-thead-custom { background-color: #87CEEB !important; }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../inc/header.php'; ?>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Liste des besoins</h2>
            <a href="/besoins/ajouter" class="btn btn-primary">
                Ajouter un besoin
            </a>
        </div>

        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="table-thead-custom">
                        <tr>
                            <th>ID</th>
                            <th>Ville</th>
                            <th>Région</th>
                            <th>Type</th>
                            <th>Libellé</th>
                            <th>Quantité</th>
                            <th>Prix unitaire</th>
                            <th>Total (Ar)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($besoins)): ?>
                            <tr>
                                <td colspan="9" class="text-center">Aucun besoin enregistré</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($besoins as $besoin): ?>
                            <tr>
                                <td><?= $besoin->id ?></td>
                                <td><?= htmlspecialchars($besoin->ville_nom) ?></td>
                                <td><?= htmlspecialchars($besoin->region) ?></td>
                                <td>
                                    <?php
                                    $badgeClass = match($besoin->type) {
                                        'nature' => 'bg-success',
                                        'materiaux' => 'bg-secondary',
                                        'argent' => 'bg-warning'
                                    };
                                    ?>
                                    <span class="badge <?= $badgeClass ?>">
                                        <?= ucfirst($besoin->type) ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars($besoin->libelle) ?></td>
                                <td class="text-end">
                                    <?php if($besoin->type === 'argent'): ?>
                                        <?= number_format($besoin->quantite, 0, ',', ' ') ?> Ar
                                    <?php else: ?>
                                        <?= number_format($besoin->quantite) ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end"><?= number_format($besoin->prix_unitaire, 0, ',', ' ') ?> Ar</td>
                                <td class="text-end">
                                    <strong><?= number_format($besoin->quantite * $besoin->prix_unitaire, 0, ',', ' ') ?> Ar</strong>
                                </td>
                                <td>
                                    <a href="/besoins/modifier/<?= $besoin->id ?>" class="btn btn-sm btn-warning">Modifier</a>
                                    <a href="/besoins/supprimer/<?= $besoin->id ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Supprimer ce besoin ?')">
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../inc/footer.php'; ?>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>