<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title><?= $title ?></title>
</head>
<body>
    <?php include __DIR__ . '/../inc/header.php'; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">  
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>Ajouter un don</h4>
                    </div>
                    <div class="card-body">
                        
                        <?php if(isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
                        <?php endif; ?>

                        <form action="/dons/save" method="POST">
                            <div class="mb-3">
                                <label for="donateur" class="form-label">Donateur (optionnel)</label>
                                <input type="text" class="form-control" id="donateur" name="donateur" placeholder="Croix Rouge, UNICEF, Anonyme...">
                            </div>

                            <div class="mb-3">
                                <label for="type" class="form-label">Type de don *</label>
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
                                <label for="valeur" class="form-label" id="valeurLabel">Quantité *</label>
                                <input type="number" step="0.01" class="form-control" id="valeur" name="valeur" required>
                                <small class="text-muted" id="valeurHelp">Entrez la quantité (pour nature/matériaux) ou le montant (pour argent)</small>
                            </div>

                            <div class="mb-3">
                                <label for="date_don" class="form-label">Date du don</label>
                                <input type="datetime-local" class="form-control" id="date_don" name="date_don" value="<?= date('Y-m-d\TH:i') ?>">
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="/dons/liste" class="btn btn-secondary">Voir la liste</a>
                                <button type="submit" class="btn btn-primary">Enregistrer le don</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../inc/footer.php'; ?>

    <!-- Bootstrap JS avec nonce -->
    <script src="/assets/js/bootstrap.bundle.min.js" nonce="<?= $nonce ?>"></script>
    
    <!-- Script personnalisé avec nonce -->
    <script nonce="<?= $nonce ?>">
        // Attendre que le DOM soit chargé
        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('type');
            if(typeSelect) {
                typeSelect.addEventListener('change', function() {
                    const valeurLabel = document.getElementById('valeurLabel');
                    const valeurHelp = document.getElementById('valeurHelp');
                    
                    if(this.value === 'argent') {
                        valeurLabel.textContent = 'Montant (Ar) *';
                        valeurHelp.textContent = 'Entrez le montant en Ariary';
                    } else if(this.value === 'nature' || this.value === 'materiaux') {
                        valeurLabel.textContent = 'Quantité *';
                        valeurHelp.textContent = 'Entrez la quantité (kg, L, unités, etc.)';
                    }
                });
            }
        });
    </script>

</body>
</html>