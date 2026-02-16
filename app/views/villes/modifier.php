<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
</head>
<body>
    <?php 
    // include __DIR__ . '/../inc/header.php'; 
    ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-warning">
                        <h4>Modifier la ville</h4>
                    </div>
                    <div class="card-body">
                        
                        <?php if(isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
                        <?php endif; ?>

                        <form action="/villes/update/<?= $ville->id ?>" method="POST">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom de la ville *</label>
                                <input type="text" class="form-control" id="nom" name="nom" 
                                       value="<?= htmlspecialchars($ville->nom) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="region" class="form-label">Région *</label>
                                <input type="text" class="form-control" id="region" name="region" 
                                       value="<?= htmlspecialchars($ville->region) ?>" required>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="/villes/liste" class="btn btn-secondary">Annuler</a>
                                <button type="submit" class="btn btn-warning">Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php 
    // include __DIR__ . '/../inc/footer.php'; 
    ?>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>