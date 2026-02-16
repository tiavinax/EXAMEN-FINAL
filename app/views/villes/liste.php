<?php 
// villes/liste.php
$title = "Liste des villes - BNGRC";
$page_css = ['liste_villes'];
include __DIR__ . '/../inc/header.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Variables */
 
    </style>
</head>
<body>

    <div class="main-container">
        <div class="content-wrapper">
            <!-- En-tête -->
            <div class="page-header">
                <div class="page-header-left">
                    <h1>
                        Liste des <span>villes</span>
                    </h1>
                    <p>
                        <i class="fas fa-circle"></i>
                        Gérez les villes et leurs informations
                    </p>
                </div>
                <div class="d-flex gap-3 align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Villes</li>
                        </ol>
                    </nav>
                    <a href="/villes/ajouter" class="btn-primary">
                        <i class="fas fa-plus"></i>
                        Nouvelle ville
                    </a>
                </div>
            </div>

            <!-- Messages -->
            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert-custom success">
                    <i class="fas fa-check-circle"></i>
                    <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert-custom error">
                    <i class="fas fa-exclamation-triangle"></i>
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <!-- Statistiques -->
            <?php if(!empty($villes)): 
                $totalVilles = count($villes);
                $totalRegions = count(array_unique(array_column($villes, 'region')));
                $dateRecent = max(array_column($villes, 'created_at'));
            ?>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon bg-primary-soft">
                        <i class="fas fa-city"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value"><?= $totalVilles ?></div>
                        <div class="stat-label">Total villes</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bg-success-soft">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value"><?= $totalRegions ?></div>
                        <div class="stat-label">Régions</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bg-info-soft">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value"><?= date('d/m/Y', strtotime($dateRecent)) ?></div>
                        <div class="stat-label">Dernière mise à jour</div>
                    </div>
                </div>
            </div>

            <!-- Filtres -->
            <div class="filters-section">
                <div class="d-flex gap-3 align-items-center">
                    <span class="text-muted"><i class="fas fa-filter me-1"></i>Filtrer :</span>
                    <select class="form-select" style="width: auto;" id="regionFilter">
                        <option value="">Toutes les régions</option>
                        <?php 
                        $regions = array_unique(array_column($villes, 'region'));
                        sort($regions);
                        foreach($regions as $region): 
                        ?>
                            <option value="<?= htmlspecialchars($region) ?>"><?= htmlspecialchars($region) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Rechercher une ville..." id="searchInput">
                </div>
            </div>
            <?php endif; ?>

            <!-- Tableau -->
            <div class="table-container">
                <div class="table-header">
                    <div class="table-title">
                        <i class="fas fa-list-ul"></i>
                        <h3>Liste des villes</h3>
                    </div>
                </div>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ville</th>
                                <th>Région</th>
                                <th>Date création</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php if(empty($villes)): ?>
                                <tr>
                                    <td colspan="5" class="empty-state">
                                        <i class="fas fa-city"></i>
                                        <h5>Aucune ville enregistrée</h5>
                                        <p>Commencez par ajouter votre première ville</p>
                                        <a href="/villes/ajouter" class="btn-primary">
                                            <i class="fas fa-plus"></i> Ajouter une ville
                                        </a>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach($villes as $ville): ?>
                                <tr class="ville-row" data-region="<?= htmlspecialchars($ville->region) ?>">
                                    <td>
                                        <span class="badge-id">#<?= str_pad($ville->id, 3, '0', STR_PAD_LEFT) ?></span>
                                    </td>
                                    <td>
                                        <span class="badge-ville">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <?= htmlspecialchars($ville->nom) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge-region">
                                            <i class="fas fa-map-signs me-1"></i>
                                            <?= htmlspecialchars($ville->region) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="date-info">
                                            <i class="fas fa-calendar-alt"></i>
                                            <?= date('d/m/Y', strtotime($ville->created_at)) ?>
                                            <small class="text-muted"><?= date('H:i', strtotime($ville->created_at)) ?></small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="/villes/modifier/<?= $ville->id ?>" class="btn-icon warning" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="/villes/supprimer/<?= $ville->id ?>" 
                                               class="btn-icon danger" 
                                               title="Supprimer"
                                               onclick="return confirm('Supprimer cette ville ? Tous les besoins associés seront également supprimés.')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if(!empty($villes)): ?>
                <div class="table-footer">
                    <div class="text-muted">
                        <i class="fas fa-database"></i> <?= count($villes) ?> ville(s) · <?= $totalRegions ?> région(s)
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
    </div>

    <?php include __DIR__ . '/../inc/footer.php'; ?>
    
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script>
        // Recherche en temps réel
        const searchInput = document.getElementById('searchInput');
        if(searchInput) {
            searchInput.addEventListener('keyup', function() {
                const search = this.value.toLowerCase();
                const rows = document.querySelectorAll('.ville-row');
                
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(search) ? '' : 'none';
                });
            });
        }

        // Filtre par région
        const regionFilter = document.getElementById('regionFilter');
        if(regionFilter) {
            regionFilter.addEventListener('change', function() {
                const region = this.value;
                const rows = document.querySelectorAll('.ville-row');
                
                rows.forEach(row => {
                    const match = !region || row.dataset.region === region;
                    row.style.display = match ? '' : 'none';
                });
            });
        }
    </script>
</body>
</html>