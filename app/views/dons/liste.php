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
            <h2>Liste des dons</h2>
            <a href="/dons/ajouter" class="btn btn-primary">
                <i class="fas fa-plus"></i> Ajouter un don
            </a>
        </div>

        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="table-thead-custom">
                        <tr>
                            <th>ID</th>
                            <th>Donateur</th>
                            <th>Type</th>
                            <th>Libellé</th>
                            <th>Valeur</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($dons)): ?>
                            <tr>
                                <td colspan="7" class="text-center">Aucun don enregistré</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($dons as $don): ?>
                            <tr>
                                <td><?= $don->id ?></td>
                                <td><?= htmlspecialchars($don->donateur ?? 'Anonyme') ?></td>
                                <td>
                                    <?php
                                    $badgeClass = match($don->type) {
                                        'nature' => 'bg-success',
                                        'materiaux' => 'bg-secondary',
                                        'argent' => 'bg-warning'
                                    };
                                    ?>
                                    <span class="badge <?= $badgeClass ?>">
                                        <?= ucfirst($don->type) ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars($don->libelle) ?></td>
                                <td>
                                    <?php if($don->type === 'argent'): ?>
                                        <?= number_format($don->montant, 0, ',', ' ') ?> Ar
                                    <?php else: ?>
                                        <?= number_format($don->quantite) ?>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d/m/Y H:i', strtotime($don->date_don)) ?></td>
                                <td>
                                    <a href="/dons/supprimer/<?= $don->id ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Supprimer ce don ?')">
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