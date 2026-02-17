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
            <h2>Historique des achats</h2>
            <a href="/achats/besoins-restants" class="btn btn-success">
                Nouvel achat
            </a>
        </div>

        <?php if(empty($achats)): ?>
            <div class="alert alert-info">
                Aucun achat enregistré pour le moment.
            </div>
        <?php else: ?>
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="table-thead-custom">
                            <tr>
                                <th>Date</th>
                                <th>Donateur</th>
                                <th>Don</th>
                                <th>Ville</th>
                                <th>Besoin</th>
                                <th>Quantité</th>
                                <th>Montant achat</th>
                                <th>Frais</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($achats as $achat): ?>
                            <tr>
                                <td><?= date('d/m/Y H:i', strtotime($achat->date_achat)) ?></td>
                                <td><?= htmlspecialchars($achat->donateur ?? 'Anonyme') ?></td>
                                <td><?= htmlspecialchars($achat->don_libelle) ?></td>
                                <td><?= htmlspecialchars($achat->ville_nom) ?></td>
                                <td><?= htmlspecialchars($achat->besoin_libelle) ?></td>
                                <td class="text-end"><?= number_format($achat->quantite) ?></td>
                                <td class="text-end"><?= number_format($achat->montant_achat, 0, ',', ' ') ?> Ar</td>
                                <td class="text-end"><?= number_format($achat->montant_frais, 0, ',', ' ') ?> Ar</td>
                                <td class="text-end"><strong><?= number_format($achat->montant_total, 0, ',', ' ') ?> Ar</strong></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="table-secondary">
                            <?php
                            $totalAchats = array_sum(array_column($achats, 'montant_achat'));
                            $totalFrais = array_sum(array_column($achats, 'montant_frais'));
                            $totalGeneral = array_sum(array_column($achats, 'montant_total'));
                            ?>
                            <tr>
                                <th colspan="6" class="text-end">TOTAUX:</th>
                                <th class="text-end"><?= number_format($totalAchats, 0, ',', ' ') ?> Ar</th>
                                <th class="text-end"><?= number_format($totalFrais, 0, ',', ' ') ?> Ar</th>
                                <th class="text-end"><?= number_format($totalGeneral, 0, ',', ' ') ?> Ar</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php include __DIR__ . '/../inc/footer.php'; ?>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>