<?php
// dashboard/home.php
$title = "Tableau de bord - BNGRC";
$page_css = ['homelia'];
include __DIR__ . '/../inc/header.php';
?>

<style>
    /* Styles pour les filtres actifs */
    .filter-item select {
        cursor: pointer;
    }
    
    .filter-badge {
        background: var(--primary);
        color: white;
        padding: 0.2rem 0.5rem;
        border-radius: 20px;
        font-size: 0.7rem;
        margin-left: 0.3rem;
    }
    
    .reset-filters {
        background: var(--gray-100);
        border: 1px solid var(--gray-300);
        border-radius: 40px;
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
        color: var(--gray-700);
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }
    
    .reset-filters:hover {
        background: var(--gray-200);
        border-color: var(--gray-400);
    }
    
    .reset-filters i {
        font-size: 0.8rem;
    }
    
    .reset-filters.danger {
        background: #dc3545;
        color: white;
        border-color: #dc3545;
    }
    
    .reset-filters.danger:hover {
        background: #b71c1c;
        border-color: #b71c1c;
    }

    /* Badge pour le mode d'affichage */
    .mode-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1.2rem;
        border-radius: 40px;
        font-size: 0.9rem;
        font-weight: 600;
        background: var(--primary);
        color: white;
        box-shadow: var(--shadow-sm);
    }

    .mode-badge i {
        font-size: 1rem;
    }

    .mode-badge.fifo { background: var(--primary); }
    .mode-badge.smallest { background: var(--success); }
    .mode-badge.proportional { background: var(--info); }
</style>

<div class="dashboard-wrapper">
    <!-- En-tête -->
    <div class="dashboard-header">
        <div class="header-left">
            <h1>
                Tableau de <span>bord</span>
            </h1>
            <p>
                <i class="bi bi-circle-fill text-danger" style="font-size: 0.5rem;"></i>
                Liste des attributions effectuées
            </p>
        </div>
        <div class="header-right">
            <div class="date-badge">
                <i class="bi bi-calendar"></i>
                <?= date('d F Y') ?>
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="bi bi-building"></i>
                </div>
                <span class="stat-badge">
                    <i class="bi bi-arrow-up"></i> +2
                </span>
            </div>
            <div class="stat-value"><?= $stats->villes ?></div>
            <div class="stat-label">Villes actives</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
                <span class="stat-badge">
                    <i class="bi bi-arrow-up"></i> +12%
                </span>
            </div>
            <div class="stat-value"><?= $stats->besoins ?></div>
            <div class="stat-label">Besoins en cours</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="bi bi-gift"></i>
                </div>
                <span class="stat-badge" style="color: var(--info);">
                    <i class="bi bi-dash"></i> Stable
                </span>
            </div>
            <div class="stat-value"><?= $stats->dons ?></div>
            <div class="stat-label">Dons reçus</div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="bi bi-check-circle"></i>
                </div>
                <span class="stat-badge">
                    <i class="bi bi-arrow-up"></i> +5%
                </span>
            </div>
            <div class="stat-value"><?= $stats->attributions ?></div>
            <div class="stat-label">Attributions</div>
        </div>
    </div>

    <!-- Filtres (gardés mais peut-être moins utiles ici) -->
    <div class="filters-section">
        <div class="filters-group">
            <div class="filter-item">
                <i class="bi bi-geo-alt"></i>
                <select id="villeFilter">
                    <option value="">Toutes les villes</option>
                    <?php 
                    // Ces filtres peuvent être adaptés pour les attributions si nécessaire
                    ?>
                </select>
            </div>
            <div class="filter-item">
                <i class="bi bi-tag"></i>
                <select id="typeFilter">
                    <option value="">Tous les types</option>
                </select>
            </div>
        </div>
        <div class="actions-group">
            <button class="reset-filters" id="resetFilters">
                <i class="bi bi-x-circle"></i>
                Réinitialiser filtres
            </button>
            <a href="/dashboard/reset" class="reset-filters danger" onclick="return confirm('⚠️ Réinitialiser toutes les attributions ? Cette action est irréversible.')">
                <i class="bi bi-arrow-counterclockwise"></i>
                Réinitialiser tout
            </a>
            <button class="btn-outline" onclick="exportTable()">
                <i class="bi bi-download"></i>
                Exporter
            </button>
        </div>
    </div>

    <!-- Tableau des attributions (déplacé depuis dispatch) -->
    <div class="table-container">
        <div class="table-header">
            <div class="table-title">
                <i class="fas fa-list-ul"></i>
                <h3>Liste des attributions</h3>
            </div>
            <span class="badge-count"><?= count($attributions ?? []) ?> enregistrement(s)</span>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Donateur</th>
                        <th>Don</th>
                        <th>Ville</th>
                        <th>Besoin</th>
                        <th>Quantité attribuée</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($attributions ?? [])): ?>
                        <tr>
                            <td colspan="7" class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <h5>Aucune attribution</h5>
                                <p>Les attributions apparaîtront ici après avoir lancé le dispatch</p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($attributions as $attrib): ?>
                        <tr>
                            <td>
                                <div class="date-info">
                                    <i class="fas fa-calendar-alt"></i>
                                    <?= date('d/m/Y', strtotime($attrib->date_attribution)) ?>
                                    <small><?= date('H:i', strtotime($attrib->date_attribution)) ?></small>
                                </div>
                            </td>
                            <td>
                                <span class="badge-donateur">
                                    <i class="fas fa-user-circle"></i>
                                    <?= htmlspecialchars($attrib->donateur ?? 'Anonyme') ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars($attrib->don_libelle) ?></td>
                            <td>
                                <span class="badge-ville">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <?= htmlspecialchars($attrib->ville_nom) ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars($attrib->besoin_libelle) ?></td>
                            <td class="montant <?= $attrib->don_type ?>">
                                <?php if($attrib->montant_attribue): ?>
                                    <?= number_format($attrib->montant_attribue, 0, ',', ' ') ?> <small>Ar</small>
                                <?php else: ?>
                                    <?= number_format($attrib->quantite_attribuee) ?> 
                                    <small><?= $attrib->don_type === 'nature' ? 'kg' : 'u' ?></small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="badge-type <?= $attrib->don_type ?>">
                                    <i class="fas <?= $attrib->don_type === 'nature' ? 'fa-seedling' : ($attrib->don_type === 'materiaux' ? 'fa-tools' : 'fa-coins') ?>"></i>
                                    <?= ucfirst($attrib->don_type) ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if(!empty($attributions ?? [])): ?>
        <div class="table-footer">
            <div class="text-muted">
                <i class="fas fa-database"></i> <?= count($attributions) ?> attribution(s)
            </div>
            <nav>
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">«</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
            </nav>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Modal Détails (gardé mais peut être moins utilisé) -->
<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-custom">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title">
                    <i class="bi bi-list-ul me-2"></i>
                    Détail des attributions
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body modal-body-custom" id="modalBody">
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Chargement...</span>
                    </div>
                    <p class="mt-3 text-muted">Chargement des données...</p>
                </div>
            </div>
            <div class="modal-footer modal-footer-custom">
                <button type="button" class="btn-outline" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn-primary" onclick="exportModalData()">
                    <i class="bi bi-download me-1"></i> Exporter
                </button>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../inc/footer.php'; ?>

<script src="/assets/js/bootstrap.bundle.min.js"></script>
<script>
// Variables globales
let currentModalData = [];

// Fonction d'export (adaptée pour les attributions)
function exportTable() {
    const rows = [];
    const headers = ['Date', 'Donateur', 'Don', 'Ville', 'Besoin', 'Quantité', 'Type'];
    rows.push(headers.join(','));
    
    document.querySelectorAll('tbody tr').forEach(row => {
        if (row.style.display !== 'none') {
            const rowData = [
                row.querySelector('.date-info').textContent.trim().replace(/\s+/g, ' '),
                row.querySelector('.badge-donateur').textContent.trim(),
                row.querySelector('td:nth-child(3)').textContent.trim(),
                row.querySelector('.badge-ville').textContent.trim(),
                row.querySelector('td:nth-child(5)').textContent.trim(),
                row.querySelector('.montant').textContent.trim(),
                row.querySelector('.badge-type').textContent.trim()
            ];
            rows.push(rowData.join(','));
        }
    });
    
    const csv = rows.join('\n');
    const blob = new Blob([csv], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'attributions.csv';
    a.click();
}

// Réinitialiser les filtres (simplifié)
document.getElementById('resetFilters')?.addEventListener('click', function() {
    document.getElementById('villeFilter').value = '';
    document.getElementById('typeFilter').value = '';
    // Afficher toutes les lignes
    document.querySelectorAll('tbody tr').forEach(row => {
        row.style.display = '';
    });
});

// Animation du menu mobile
document.querySelector('.hamburger')?.addEventListener('click', function() {
    document.querySelector('.nav-menu')?.classList.toggle('active');
});
</script>