<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <style>
        .table-thead-custom {
            background-color: #87CEEB !important;
        }

        .btn-acheter {
            background-color: #28a745;
            color: white;
        }

        .btn-acheter:hover {
            background-color: #218838;
            color: white;
        }
    </style>
</head>

<body>
    <?php include __DIR__ . '/../inc/header.php'; ?>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Besoins restants à satisfaire</h2>
            <a href="/dashboard" class="btn btn-info">Tableau de bord</a>
        </div>

        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i>
            Sélectionnez un besoin pour acheter avec des dons en argent (frais de 10% appliqués)
        </div>

        <?php if (empty($besoins)): ?>
            <div class="alert alert-success">
                <h4 class="alert-heading">Félicitations !</h4>
                <p>Tous les besoins sont satisfaits. Aucun besoin restant.</p>
            </div>
        <?php else: ?>
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="table-thead-custom">
                            <tr>
                                <th>Ville</th>
                                <th>Région</th>
                                <th>Type</th>
                                <th>Libellé</th>
                                <th>Quantité restante</th>
                                <th>Prix unitaire</th>
                                <th>Valeur totale (Ar)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($besoins as $besoin): ?>
                                <tr>
                                    <td><?= htmlspecialchars($besoin->ville_nom) ?></td>
                                    <td><?= htmlspecialchars($besoin->region) ?></td>
                                    <td>
                                        <?php
                                        $badgeClass = match ($besoin->type) {
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
                                    <td class="text-end"><?= number_format($besoin->reste) ?></td>
                                    <td class="text-end"><?= number_format($besoin->prix_unitaire, 0, ',', ' ') ?> Ar</td>
                                    <td class="text-end">
                                        <strong><?= number_format($besoin->reste * $besoin->prix_unitaire, 0, ',', ' ') ?> Ar</strong>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-acheter"
                                            data-besoin-id="<?= $besoin->id ?>"
                                            data-besoin-libelle="<?= htmlspecialchars($besoin->libelle) ?>"
                                            data-besoin-type="<?= $besoin->type ?>"
                                            data-besoin-reste="<?= $besoin->reste ?>"
                                            data-prix-unitaire="<?= $besoin->prix_unitaire ?>"
                                            data-ville-nom="<?= htmlspecialchars($besoin->ville_nom) ?>"
                                            onclick="ouvrirModalAchat(this)">
                                            Acheter
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Modal d'achat -->
    <div class="modal fade" id="modalAchat" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Acheter avec dons en argent</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modalAchatBody">
                    <div class="text-center py-4">
                        <div class="spinner-border text-success" role="status">
                            <span class="visually-hidden">Chargement...</span>
                        </div>
                        <p class="mt-2">Chargement des données...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../inc/footer.php'; ?>

    <script>
        let besoinActuel = null;
        let donsDisponibles = [];
        let fraisActuel = 0;

        function ouvrirModalAchat(button) {
            const besoinId = button.dataset.besoinId;

            // Afficher le modal avec loader
            var modal = new bootstrap.Modal(document.getElementById('modalAchat'));
            modal.show();

            // Charger les données via AJAX
            fetch(`/achats/modal-data?besoin_id=${besoinId}`)
                .then(response => response.json())
                .then(data => {
                    besoinActuel = data.besoin;
                    donsDisponibles = data.dons;
                    fraisActuel = data.frais;

                    afficherFormulaireAchat();
                })
                .catch(error => {
                    document.getElementById('modalAchatBody').innerHTML = `
                <div class="alert alert-danger">
                    Erreur lors du chargement des données
                </div>
                <div class="text-center">
                    <button class="btn btn-secondary" onclick="ouvrirModalAchat(${besoinId})">
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
        <div class="alert alert-info">
            <strong>${besoinActuel.ville_nom}</strong> - ${besoinActuel.libelle} (${besoinActuel.type})<br>
            <div class="row mt-2">
                <div class="col-md-6">
                    <small>Reste: ${parseInt(besoinActuel.reste).toLocaleString()} unités</small>
                </div>
                <div class="col-md-6">
                    <small>Prix unitaire: ${parseInt(besoinActuel.prix_unitaire).toLocaleString()} Ar</small>
                </div>
            </div>
        </div>
        
        <form id="formAchat">
            <input type="hidden" id="besoin_id" value="${besoinActuel.id}">
            
            <div class="mb-3">
                <label for="don_id" class="form-label">Sélectionner un don *</label>
                <select class="form-control" id="don_id" required>
                    ${optionsDons}
                </select>
            </div>
            
            <div class="mb-3">
                <label for="quantite" class="form-label">Quantité à acheter *</label>
                <input type="number" class="form-control" id="quantite" 
                       min="1" max="${besoinActuel.reste}" step="1" required>
                <small class="text-muted">Max: ${parseInt(besoinActuel.reste).toLocaleString()}</small>
            </div>
            
            <div class="card mt-3" id="resultatSimulation" style="display: none;">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0">Résultat de la simulation</h6>
                </div>
                <div class="card-body" id="simulationDetails">
                    <!-- Rempli par JavaScript -->
                </div>
            </div>
            
            <div class="alert alert-danger mt-3" id="erreurSimulation" style="display: none;"></div>
        </form>
    `;

            document.getElementById('modalAchatBody').innerHTML = html;

            // Ajouter les événements
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

            // Appel AJAX pour simuler
            fetch('/achats/simuler', {
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
                <table class="table table-sm">
                    <tr>
                        <td>Montant du besoin:</td>
                        <td class="text-end">${calc.montant_besoin.toLocaleString()} Ar</td>
                    </tr>
                    <tr>
                        <td>Frais (${calc.frais_pourcentage}%):</td>
                        <td class="text-end">${calc.montant_frais.toLocaleString()} Ar</td>
                    </tr>
                    <tr class="fw-bold">
                        <td>Total à déduire:</td>
                        <td class="text-end">${calc.total_a_deduire.toLocaleString()} Ar</td>
                    </tr>
                    <tr>
                        <td>Solde du don:</td>
                        <td class="text-end">${calc.solde_don.toLocaleString()} Ar</td>
                    </tr>
                    <tr class="${peutAcheter ? 'text-success' : 'text-danger'}">
                        <td>Reste après achat:</td>
                        <td class="text-end">${calc.reste_apres_achat.toLocaleString()} Ar</td>
                    </tr>
                </table>
            `;

                        if (!peutAcheter) {
                            html += '<div class="alert alert-danger">Solde insuffisant pour cet achat</div>';
                        } else {
                            html += `
                    <div class="d-grid gap-2">
                        <button class="btn btn-success" onclick="validerAchat()">
                            Valider l'achat
                        </button>
                    </div>
                `;
                        }

                        document.getElementById('simulationDetails').innerHTML = html;
                        document.getElementById('resultatSimulation').style.display = 'block';
                        document.getElementById('erreurSimulation').style.display = 'none';
                    }
                })
                .catch(error => {
                    document.getElementById('erreurSimulation').innerHTML = 'Erreur lors de la simulation';
                    document.getElementById('erreurSimulation').style.display = 'block';
                    document.getElementById('resultatSimulation').style.display = 'none';
                });
        }

        function validerAchat() {
            const donId = document.getElementById('don_id').value;
            const quantite = document.getElementById('quantite').value;
            const besoinId = document.getElementById('besoin_id').value;

            // Validation côté client
            const erreurs = [];
            if (!donId) erreurs.push("Veuillez sélectionner un don");
            if (!quantite || quantite < 1) erreurs.push("Quantité invalide");
            

            if (erreurs.length > 0) {
                alert('Erreurs:\n- ' + erreurs.join('\n- '));
                return;
            }

            // Confirmation avec détails
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

            // Désactiver le bouton
            const btn = event.target;
            const originalHtml = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Traitement...';

            // Créer et soumettre le formulaire
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/achats/valider';
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

            // Restaurer le bouton au cas où (ne s'exécute généralement pas)
            setTimeout(() => {
                btn.disabled = false;
                btn.innerHTML = originalHtml;
            }, 5000);
        }
    </script>

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>