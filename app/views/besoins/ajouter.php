<?php 
// var_dump($villes);
?>

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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>Ajouter un besoin</h4>
                    </div>
                    <div class="card-body">
                        
                        <?php if(isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
                        <?php endif; ?>

                        <form action="/besoins/save" method="POST">
                            <div class="mb-3">
                                <label for="ville_id" class="form-label">Ville *</label>
                                <select class="form-control" id="ville_id" name="ville_id" required>
                                    <option value="">Sélectionner une ville</option>
                                    <?php foreach($villes as $ville): ?>
                                        <option value="<?= $ville->id ?>"><?= htmlspecialchars($ville->nom) ?> (<?= htmlspecialchars($ville->region) ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="type" class="form-label">Type de besoin *</label>
                                <select class="form-control" id="type" name="type" required>
                                    <option value="">Sélectionner un type</option>
                                    <option value="nature">Nature (riz, huile, etc.)</option>
                                    <option value="materiaux">Matériaux (tôle, clou, etc.)</option>
                                    <option value="argent">Argent</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="libelle" class="form-label">Libellé *</label>
                                <input type="text" class="form-control" id="libelle" name="libelle" placeholder="Riz, Tôle, Aide financière..." required>
                            </div>

                            <div class="mb-3">
                                <label for="quantite" class="form-label" id="quantiteLabel">Quantité *</label>
                                <input type="number" step="0.01" class="form-control" id="quantite" name="quantite" required>
                                <small class="text-muted" id="quantiteHelp">Entrez la quantité nécessaire</small>
                            </div>

                            <div class="mb-3">
                                <label for="prix_unitaire" class="form-label">Prix unitaire (Ar) *</label>
                                <input type="number" step="0.01" class="form-control" id="prix_unitaire" name="prix_unitaire" required>
                                <small class="text-muted">Le prix unitaire ne changera pas</small>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="/besoins/liste" class="btn btn-secondary">Voir la liste</a>
                                <button type="submit" class="btn btn-primary">Enregistrer le besoin</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../inc/footer.php'; ?>

    <script>
        // Adapter le label selon le type
        document.getElementById('type').addEventListener('change', function() {
            const quantiteLabel = document.getElementById('quantiteLabel');
            const quantiteHelp = document.getElementById('quantiteHelp');
            
            if(this.value === 'argent') {
                quantiteLabel.textContent = 'Montant (Ar) *';
                quantiteHelp.textContent = 'Entrez le montant total nécessaire en Ariary';
            } else {
                quantiteLabel.textContent = 'Quantité *';
                quantiteHelp.textContent = 'Entrez la quantité nécessaire';
            }
        });
    </script>

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>