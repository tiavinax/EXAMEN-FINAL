<?php
// Regrouper les données par ville
// var_dump($data);
?>
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
    </style>
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">BNGRC - Suivi des dons</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="h3 mb-4">Tableau de bord</h1>

        <!-- Cartes statistiques -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Villes</h5>
                        <p class="card-text display-6"><?= $stats->villes ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Besoins</h5>
                        <p class="card-text display-6"><?= $stats->besoins ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Dons</h5>
                        <p class="card-text display-6"><?= $stats->dons ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Attributions</h5>
                        <p class="card-text display-6"><?= $stats->attributions ?></p>
                    </div>
                </div>
            </div>
        </div>


        <table class="table">
            <tr class="bg-green">
                <th>Ville</th>
                <th>Type</th>
                <th>Libellé</th>
                <th>Besoin</th>
                <th>Attribué</th>
                <th>Reste</th>
            </tr>
            <tr>
                <?php foreach ($data as $d) { ?>
            <tr>
                <td><?= $d->ville_nom ?></td>
                <td><?= $d->besoin_type ?></td>
                <td><?= $d->besoin_libelle ?></td>
                <td><?= $d->besoin_quantite ?></td>
                <td><?= $d->total_attribue ?></td>
                <td><?= $d->reste ?></td>
            </tr>
        <?php } ?>
        </tr>
        </table>
    </div>
    </div>
    </div>

    <!-- Modal pour les détails -->
    <div class="modal fade" id="detailModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Détail des attributions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    Chargement...
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script>
        function voirDetails(besoinId) {
            const modalBody = document.getElementById('modalBody');
            modalBody.innerHTML = 'Chargement...';

            fetch('/dashboard/attributions/' + besoinId)
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        modalBody.innerHTML = '<p class="text-muted">Aucune attribution</p>';
                    } else {
                        let html = '<table class="table table-sm">' +
                            '<thead><tr><th>Donateur</th><th>Quantité</th><th>Date</th></tr></thead>' +
                            '<tbody>';
                        data.forEach(a => {
                            html += '<tr>';
                            html += '<td>' + (a.donateur || 'Anonyme') + '</td>';
                            html += '<td>' + (a.quantite_attribuee || a.montant_attribue) + '</td>';
                            html += '<td>' + new Date(a.date_attribution).toLocaleDateString() + '</td>';
                            html += '</tr>';
                        });
                        html += '</tbody></table>';
                        modalBody.innerHTML = html;
                    }
                })
                .catch(error => {
                    modalBody.innerHTML = '<p class="text-danger">Erreur de chargement</p>';
                });

            var modal = new bootstrap.Modal(document.getElementById('detailModal'));
            modal.show();
        }
    </script>
</body>

</html>