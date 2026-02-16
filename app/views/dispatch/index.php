<?php 
// dispatch/index.php
$title = "Dispatch automatique - BNGRC";
$page_css = ['dispatch'];
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

    </style>
</head>
<body>

    <div class="main-container">
        <div class="content-wrapper">
            <!-- En-tête -->
            <div class="page-header">
                <div class="page-header-left">
                    <h1>
                        Dispatch <span>automatique</span>
                    </h1>
                    <p>
                        <i class="fas fa-circle"></i>
                        Attribution intelligente des dons aux besoins
                    </p>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Dispatch</li>
                    </ol>
                </nav>
            </div>

            <!-- Messages flash -->
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

            <!-- Cartes de contrôle -->
            <div class="control-grid">
                <!-- Carte Dispatch -->
                <div class="dispatch-card">
                    <h5>
                        <i class="fas fa-rocket"></i>
                        Dispatch automatique
                    </h5>
                    <p>Lancer l'attribution automatique des dons aux villes selon :</p>
                    <ul>
                        <li> Ordre de date des dons</li>
                        <li>Besoins non satisfaits</li>
                        <li> Compatibilité type/libellé</li>
                    </ul>
                    <div class="action-buttons">
                        <a href="/dispatch/run" class="btn-dispatch" 
                           onclick="return confirm('🚀 Lancer le dispatch automatique ?')">
                            <i class="fas fa-play"></i>
                            Lancer le dispatch
                        </a>
                        <a href="/dispatch/redistribute" class="btn-redistribute"
                           onclick="return confirm('⚠️ Réinitialiser et redistribuer tous les dons ? Cette action est irréversible.')">
                            <i class="fas fa-sync-alt"></i>
                            Réinitialiser
                        </a>
                    </div>
                </div>

                <!-- Carte Résumé -->
                <div class="stats-card">
                    <div class="stats-header">
                        <i class="fas fa-chart-pie"></i>
                        <h5>Résumé des attributions</h5>
                    </div>
                    <?php
                    $totalAttrib = count($attributions);
                    $totalMontant = 0;
                    $totalQuantite = 0;
                    $typeCount = ['nature' => 0, 'materiaux' => 0, 'argent' => 0];
                    
                    foreach($attributions as $a) {
                        if($a->montant_attribue) {
                            $totalMontant += $a->montant_attribue;
                            $typeCount['argent']++;
                        }
                        if($a->quantite_attribuee) {
                            $totalQuantite += $a->quantite_attribuee;
                            if($a->don_type === 'nature') $typeCount['nature']++;
                            if($a->don_type === 'materiaux') $typeCount['materiaux']++;
                        }
                    }
                    ?>
                    <div class="stats-value"><?= $totalAttrib ?></div>
                    <div class="stats-detail">
                        <p>Montant total <span><?= number_format($totalMontant, 0, ',', ' ') ?> Ar</span></p>
                        <p>Quantité totale <span><?= number_format($totalQuantite) ?> u</span></p>
                        <p>Nature <span><?= $typeCount['nature'] ?></span></p>
                        <p>Matériaux <span><?= $typeCount['materiaux'] ?></span></p>
                        <p>Argent <span><?= $typeCount['argent'] ?></span></p>
                    </div>
                </div>
            </div>

            <!-- Tableau des attributions -->
            <div class="table-container">
                <div class="table-header">
                    <div class="table-title">
                        <i class="fas fa-list-ul"></i>
                        <h3>Liste des attributions</h3>
                    </div>
                    <span class="badge-count"><?= count($attributions) ?> enregistrement(s)</span>
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
                            <?php if(empty($attributions)): ?>
                                <tr>
                                    <td colspan="7" class="empty-state">
                                        <i class="fas fa-inbox"></i>
                                        <h5>Aucune attribution</h5>
                                        <p>Cliquez sur "Lancer le dispatch" pour commencer l'attribution automatique</p>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach($attributions as $attrib): ?>
                                <tr>
                                    <td>
                                        <div class="date-info">
                                            <i class="fas fa-calendar-alt"></i>
                                            <?= date('d/m/Y', strtotime($attrib->date_attribution)) ?>
                                            <small class="text-muted"><?= date('H:i', strtotime($attrib->date_attribution)) ?></small>
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

                <?php if(!empty($attributions)): ?>
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
    </div>

    <?php include __DIR__ . '/../inc/footer.php'; ?>
    
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('.alert-custom').forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>