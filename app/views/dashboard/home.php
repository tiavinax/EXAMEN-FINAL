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
    }
    
    .reset-filters:hover {
        background: var(--gray-200);
        border-color: var(--gray-400);
    }
    
    .reset-filters i {
        font-size: 0.8rem;
    }
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
                Suivi en temps réel des besoins et attributions par ville
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

    <!-- Filtres -->
    <div class="filters-section">
        <div class="filters-group">
            <div class="filter-item">
                <i class="bi bi-geo-alt"></i>
                <select id="villeFilter">
                    <option value="">Toutes les villes</option>
                    <?php 
                    $villes = array_unique(array_column($data, 'ville_nom'));
                    sort($villes);
                    foreach($villes as $ville): 
                    ?>
                        <option value="<?= htmlspecialchars($ville) ?>"><?= htmlspecialchars($ville) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="filter-item">
                <i class="bi bi-tag"></i>
                <select id="typeFilter">
                    <option value="">Tous les types</option>
                    <?php 
                    $types = array_unique(array_column($data, 'besoin_type'));
                    sort($types);
                    foreach($types as $type): 
                    ?>
                        <option value="<?= htmlspecialchars($type) ?>"><?= htmlspecialchars($type) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="filter-item">
                <i class="bi bi-clock"></i>
                <select id="statutFilter">
                    <option value="">Tous les statuts</option>
                    <option value="Terminé">Terminé</option>
                    <option value="En cours">En cours</option>
                    <option value="Urgent">Urgent</option>
                </select>
            </div>
        </div>
        <div class="actions-group">
            <button class="reset-filters" id="resetFilters">
                <i class="bi bi-x-circle"></i>
                Réinitialiser
            </button>
            <button class="btn-outline" onclick="exportTable()">
                <i class="bi bi-download"></i>
                Exporter
            </button>
        </div>
    </div>

    <!-- Tableau -->
    <div class="table-container">
        <div class="table-header">
            <div class="table-title">
                <i class="bi bi-list-ul"></i>
                <h3>Détail des besoins et attributions</h3>
            </div>
            <div class="search-box">
                <i class="bi bi-search"></i>
                <input type="text" placeholder="Rechercher..." id="searchInput">
            </div>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Ville</th>
                        <th>Type</th>
                        <th>Libellé</th>
                        <th>Besoin</th>
                        <th>Attribué</th>
                        <th>Reste</th>
                        <th>Progression</th>
                        <th>Statut</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php foreach ($data as $d): 
                        $pourcentage = ($d->besoin_quantite > 0) ? min(100, round(($d->total_attribue / $d->besoin_quantite) * 100)) : 0;
                        $statut = $pourcentage >= 100 ? 'Terminé' : ($pourcentage >= 50 ? 'En cours' : 'Urgent');
                        $statutClass = $pourcentage >= 100 ? 'badge-success' : ($pourcentage >= 50 ? 'badge-warning' : 'badge-danger');
                    ?>
                    <tr class="data-row" 
                        data-ville="<?= htmlspecialchars($d->ville_nom) ?>"
                        data-type="<?= htmlspecialchars($d->besoin_type) ?>"
                        data-statut="<?= $statut ?>">
                        <td>
                            <span class="badge-city">
                                <i class="bi bi-pin-map-fill"></i>
                                <?= $d->ville_nom ?>
                            </span>
                        </td>
                        <td>
                            <span class="badge-type">
                                <?= $d->besoin_type ?>
                            </span>
                        </td>
                        <td class="fw-semibold"><?= $d->besoin_libelle ?></td>
                        <td class="fw-semibold"><?= number_format($d->besoin_quantite) ?></td>
                        <td class="text-success fw-semibold"><?= number_format($d->total_attribue) ?></td>
                        <td class="<?= $d->reste > 0 ? 'text-danger' : 'text-success' ?> fw-semibold">
                            <?= number_format($d->reste) ?>
                        </td>
                        <td>
                            <div class="progress-wrapper">
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: <?= $pourcentage ?>%;"></div>
                                </div>
                                <span class="progress-text"><?= $pourcentage ?>%</span>
                            </div>
                        </td>
                        <td>
                            <span class="<?= $statutClass ?>">
                                <?= $statut ?>
                            </span>
                        </td>
                        <td>
                            <button class="btn-icon" onclick="voirDetails(<?= $d->besoin_id ?>)" title="Voir détails">
                                <i class="bi bi-eye"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="table-footer">
            <div class="text-muted">
                <small><i class="bi bi-database me-1"></i><span id="resultCount"><?= count($data) ?></span> résultats</small>
            </div>
            <nav>
                <ul class="pagination" id="pagination">
                    <!-- La pagination sera générée en JS -->
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Modal Détails -->
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

<script src="/assets/js/bootstrap.bundle.min.js"></script>
<script>
// Variables globales
let currentModalData = [];

// Fonction de filtrage
function filterTable() {
    const villeFilter = document.getElementById('villeFilter').value;
    const typeFilter = document.getElementById('typeFilter').value;
    const statutFilter = document.getElementById('statutFilter').value;
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    
    const rows = document.querySelectorAll('.data-row');
    let visibleCount = 0;
    
    rows.forEach(row => {
        const ville = row.dataset.ville;
        const type = row.dataset.type;
        const statut = row.dataset.statut;
        const text = row.textContent.toLowerCase();
        
        const matchVille = !villeFilter || ville === villeFilter;
        const matchType = !typeFilter || type === typeFilter;
        const matchStatut = !statutFilter || statut === statutFilter;
        const matchSearch = !searchTerm || text.includes(searchTerm);
        
        if (matchVille && matchType && matchStatut && matchSearch) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    
    // Mettre à jour le compteur
    document.getElementById('resultCount').textContent = visibleCount;
    
    // Afficher un message si aucun résultat
    const noResultsRow = document.getElementById('noResultsRow');
    if (visibleCount === 0) {
        if (!noResultsRow) {
            const tbody = document.getElementById('tableBody');
            const tr = document.createElement('tr');
            tr.id = 'noResultsRow';
            tr.innerHTML = '<td colspan="9" class="text-center py-4"><i class="bi bi-inbox fs-1 d-block mb-2"></i>Aucun résultat trouvé</td>';
            tbody.appendChild(tr);
        }
    } else if (noResultsRow) {
        noResultsRow.remove();
    }
}

// Recherche en temps réel
document.getElementById('searchInput').addEventListener('keyup', filterTable);

// Filtres
document.getElementById('villeFilter').addEventListener('change', filterTable);
document.getElementById('typeFilter').addEventListener('change', filterTable);
document.getElementById('statutFilter').addEventListener('change', filterTable);

// Réinitialiser les filtres
document.getElementById('resetFilters').addEventListener('click', function() {
    document.getElementById('villeFilter').value = '';
    document.getElementById('typeFilter').value = '';
    document.getElementById('statutFilter').value = '';
    document.getElementById('searchInput').value = '';
    filterTable();
});

// Fonction d'export
function exportTable() {
    const rows = [];
    const headers = ['Ville', 'Type', 'Libellé', 'Besoin', 'Attribué', 'Reste', 'Progression', 'Statut'];
    rows.push(headers.join(','));
    
    document.querySelectorAll('.data-row:not([style*="display: none"])').forEach(row => {
        const rowData = [
            row.querySelector('.badge-city').textContent.trim(),
            row.querySelector('.badge-type').textContent.trim(),
            row.querySelector('td:nth-child(3)').textContent.trim(),
            row.querySelector('td:nth-child(4)').textContent.trim(),
            row.querySelector('td:nth-child(5)').textContent.trim(),
            row.querySelector('td:nth-child(6)').textContent.trim(),
            row.querySelector('.progress-text').textContent.trim(),
            row.querySelector('td:nth-child(8) span').textContent.trim()
        ];
        rows.push(rowData.join(','));
    });
    
    const csv = rows.join('\n');
    const blob = new Blob([csv], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'dashboard_bngrc.csv';
    a.click();
}

// Voir détails
function voirDetails(besoinId) {
    const modalBody = document.getElementById('modalBody');
    
    modalBody.innerHTML = `
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Chargement...</span>
            </div>
            <p class="mt-3 text-muted">Chargement des attributions...</p>
        </div>
    `;

    fetch('/dashboard/attributions/' + besoinId)
        .then(response => response.json())
        .then(data => {
            currentModalData = data;
            if (data.length === 0) {
                modalBody.innerHTML = `
                    <div class="text-center py-5">
                        <i class="bi bi-inbox" style="font-size: 3rem; color: var(--gray);"></i>
                        <p class="mt-3 text-muted">Aucune attribution trouvée</p>
                    </div>
                `;
            } else {
                let html = `
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead style="background: #FAFAFA;">
                                <tr>
                                    <th>Donateur</th>
                                    <th>Quantité</th>
                                    <th>Date</th>
                                    <th>Référence</th>
                                </tr>
                            </thead>
                            <tbody>
                `;
                
                data.forEach((a, index) => {
                    const date = new Date(a.date_attribution).toLocaleDateString('fr-FR', {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric'
                    });
                    
                    html += `
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person-circle me-2" style="color: var(--primary);"></i>
                                    <strong>${a.donateur || 'Anonyme'}</strong>
                                </div>
                            </td>
                            <td>
                                <span class="badge-success">
                                    ${(a.quantite_attribuee || a.montant_attribue)} unités
                                </span>
                            </td>
                            <td>${date}</td>
                            <td><small class="text-muted">#ATT-${String(index + 1).padStart(4, '0')}</small></td>
                        </tr>
                    `;
                });
                
                html += `
                            </tbody>
                        </table>
                    </div>
                `;
                
                modalBody.innerHTML = html;
            }
        })
        .catch(error => {
            modalBody.innerHTML = `
                <div class="text-center py-5">
                    <i class="bi bi-exclamation-triangle" style="font-size: 3rem; color: var(--danger);"></i>
                    <p class="mt-3 text-danger">Erreur de chargement</p>
                    <button class="btn-outline mt-2" onclick="voirDetails(${besoinId})">
                        <i class="bi bi-arrow-repeat me-1"></i>Réessayer
                    </button>
                </div>
            `;
        });

    var modal = new bootstrap.Modal(document.getElementById('detailModal'));
    modal.show();
}

// Exporter les données du modal
function exportModalData() {
    if (currentModalData.length === 0) return;
    
    const rows = [['Donateur', 'Quantité', 'Date', 'Référence']];
    
    currentModalData.forEach((a, index) => {
        const date = new Date(a.date_attribution).toLocaleDateString('fr-FR');
        rows.push([
            a.donateur || 'Anonyme',
            a.quantite_attribuee || a.montant_attribue,
            date,
            `#ATT-${String(index + 1).padStart(4, '0')}`
        ]);
    });
    
    const csv = rows.map(row => row.join(',')).join('\n');
    const blob = new Blob([csv], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'attributions.csv';
    a.click();
}

// Animation du menu mobile
document.querySelector('.hamburger')?.addEventListener('click', function() {
    document.querySelector('.nav-menu')?.classList.toggle('active');
});
</script>

<?php include __DIR__ . '/../inc/footer.php'; ?>