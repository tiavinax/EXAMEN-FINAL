<?php
// Les variables sont automatiquement disponibles via Flight::render()
// $stats, $donneesVilles, $dernieresAttributions
?>
<div class="container-fluid py-4 px-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="display-6 fw-bold" style="color: #1a1f36;">
                Tableau de bord
            </h1>
            <p class="text-muted">
                <i class="bi bi-info-circle me-1"></i>
                Suivi des collectes et distributions de dons pour les sinistrés
            </p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="stat-card d-flex align-items-center">
                <div class="stat-icon blue me-3">
                    <i class="bi bi-building"></i>
                </div>
                <div>
                    <div class="stat-value"><?= $stats['total_villes'] ?></div>
                    <div class="stat-label">Villes</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stat-card d-flex align-items-center">
                <div class="stat-icon green me-3">
                    <i class="bi bi-list-check"></i>
                </div>
                <div>
                    <div class="stat-value"><?= number_format($stats['total_besoins'], 0, ',', ' ') ?></div>
                    <div class="stat-label">Besoins totaux (Ar)</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stat-card d-flex align-items-center">
                <div class="stat-icon orange me-3">
                    <i class="bi bi-gift"></i>
                </div>
                <div>
                    <div class="stat-value"><?= number_format($stats['total_dons'], 0, ',', ' ') ?></div>
                    <div class="stat-label">Dons reçus (Ar)</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stat-card d-flex align-items-center">
                <div class="stat-icon red me-3">
                    <i class="bi bi-truck"></i>
                </div>
                <div>
                    <div class="stat-value"><?= number_format($stats['total_distribue'], 0, ',', ' ') ?></div>
                    <div class="stat-label">Distribué (Ar)</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Table -->
    <div class="row">
        <div class="col-12">
            <div class="table-container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="table-title mb-0">
                        <i class="bi bi-map me-2"></i>
                        Situation par ville
                    </h5>
                    <button class="btn-export" onclick="exporterTableau()">
                        <i class="bi bi-download me-2"></i>
                        Exporter
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table" id="tableVilles">
                        <thead>
                            <tr>
                                <th>Ville / Région</th>
                                <th class="text-end">Besoins (Ar)</th>
                                <th class="text-end">Attribué (Ar)</th>
                                <th class="text-end">Reste (Ar)</th>
                                <th class="text-center">Progression</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($donneesVilles as $data): ?>
                            <tr>
                                <td>
                                    <div class="ville-name"><?= htmlspecialchars($data['ville']['nom']) ?></div>
                                    <div class="region-name"><?= htmlspecialchars($data['ville']['region']) ?></div>
                                </td>
                                <td class="text-end">
                                    <span class="badge-custom badge-besoin">
                                        <?= number_format($data['total_besoins'], 0, ',', ' ') ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <span class="badge-custom badge-attribue">
                                        <?= number_format($data['total_attribue'], 0, ',', ' ') ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <span class="badge-custom badge-reste">
                                        <?= number_format($data['reste'], 0, ',', ' ') ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="progress mx-auto">
                                        <div class="progress-bar" style="width: <?= $data['pourcentage'] ?>%"></div>
                                    </div>
                                    <div class="progress-text"><?= $data['pourcentage'] ?>%</div>
                                </td>
                                <td class="text-center">
                                    <button class="btn-details" onclick="voirDetails(<?= $data['ville']['id'] ?>)">
                                        <i class="bi bi-eye me-1"></i>
                                        Détails
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Distributions -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="table-container">
                <h5 class="table-title mb-4">
                    <i class="bi bi-clock-history me-2"></i>
                    Dernières distributions
                </h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Ville</th>
                                <th>Type de don</th>
                                <th>Quantité</th>
                                <th class="text-end">Valeur (Ar)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dernieresAttributions as $attribution): ?>
                            <tr>
                                <td><?= date('d/m/Y H:i', strtotime($attribution['date_attribution'])) ?></td>
                                <td class="ville-name"><?= htmlspecialchars($attribution['ville_nom']) ?></td>
                                <td>
                                    <span class="badge-custom" style="background:#e5e7eb;">
                                        <?= htmlspecialchars($attribution['don_libelle'] ?? $attribution['besoin_libelle']) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if (!empty($attribution['quantite_attribuee'])): ?>
                                        <?= $attribution['quantite_attribuee'] ?> unités
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td class="text-end fw-bold">
                                    <?= number_format($attribution['valeur'] ?? 0, 0, ',', ' ') ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour les détails -->
<div class="modal fade" id="detailsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Détails des besoins</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Contenu chargé dynamiquement -->
            </div>
        </div>
    </div>
</div>

<script>
function voirDetails(villeId) {
    fetch('/dashboard/detailVille/' + villeId)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let html = `
                    <h6 class="mb-3">Ville: ${data.ville.nom} (${data.ville.region})</h6>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Besoin</th>
                                <th>Type</th>
                                <th>Quantité</th>
                                <th>Prix unit.</th>
                                <th>Total</th>
                                <th>Attribué</th>
                                <th>Reste</th>
                            </tr>
                        </thead>
                        <tbody>
                `;
                
                data.besoins.forEach(besoin => {
                    html += `
                        <tr>
                            <td>${besoin.libelle}</td>
                            <td>${besoin.type}</td>
                            <td>${besoin.quantite}</td>
                            <td>${Number(besoin.prix_unitaire).toLocaleString()} Ar</td>
                            <td>${Number(besoin.total_besoin).toLocaleString()} Ar</td>
                            <td>${besoin.total_attribue_quantite} (${Number(besoin.total_attribue_valeur).toLocaleString()} Ar)</td>
                            <td>${besoin.reste_quantite} (${Number(besoin.reste_valeur).toLocaleString()} Ar)</td>
                        </tr>
                    `;
                });
                
                html += '</tbody></table>';
                document.getElementById('modalBody').innerHTML = html;
                new bootstrap.Modal(document.getElementById('detailsModal')).show();
            }
        });
}

function exporterTableau() {
    alert('Export en cours de développement');
}
</script>