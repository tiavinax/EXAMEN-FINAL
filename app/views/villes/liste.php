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
    <?php 
    // include __DIR__ . '/../inc/header.php'; 
    ?>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Liste des villes</h2>
            <a href="/villes/ajouter" class="btn btn-primary">
                Ajouter une ville
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
                            <th>Nom</th>
                            <th>Région</th>
                            <th>Date création</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($villes)): ?>
                            <tr>
                                <td colspan="5" class="text-center">Aucune ville enregistrée</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($villes as $ville): ?>
                            <tr>
                                <td><?= $ville->id ?></td>
                                <td><?= htmlspecialchars($ville->nom) ?></td>
                                <td><?= htmlspecialchars($ville->region) ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($ville->created_at)) ?></td>
                                <td>
                                    <a href="/villes/modifier/<?= $ville->id ?>" class="btn btn-sm btn-warning">Modifier</a>
                                    <a href="/villes/supprimer/<?= $ville->id ?>" 
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Supprimer cette ville ? Tous les besoins associés seront également supprimés.')">
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

    <?php 
    // include __DIR__ . '/../inc/footer.php'; 
    ?>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>