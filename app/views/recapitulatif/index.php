<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <style>
        .table-thead-custom { background-color: #87CEEB !important; }
        .card-recap {
            transition: transform 0.3s;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .card-recap:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }
        .refresh-btn {
            cursor: pointer;
            transition: transform 0.3s;
        }
        .refresh-btn:hover {
            transform: rotate(180deg);
        }
        .progress {
            height: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../inc/header.php'; ?>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Récapitulatif global</h2>
            <div class="d-flex align-items-center">
                <span class="badge bg-info me-3" id="lastUpdate"></span>
                <button class="btn btn-outline-primary" onclick="chargerDonnees()" id="refreshBtn">
                    <i class="fas fa-sync-alt refresh-btn" id="refreshIcon"></i> Actualiser
                </button>
            </div>
        </div>

        <!-- Cartes principales -->
        <div class="row mb-4" id="cartesContainer">
            <div class="col-md-3 mb-3">
                <div class="card card-recap bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Besoins totaux</h5>
                        <h2 class="display-6" id="besoinsTotaux">0 Ar</h2>
                        <small>Valeur totale des besoins</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card card-recap bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Attribué</h5>
                        <h2 class="display-6" id="attributionsTotales">0 Ar</h2>
                        <small>Dons déjà attribués</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card card-recap bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Achats</h5>
                        <h2 class="display-6" id="achatsTotaux">0 Ar</h2>
                        <small>Dont frais inclus</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card card-recap bg-warning text-white">
                    <div class="card-body">
                        <h5 class="card-title">Restants</h5>
                        <h2 class="display-6" id="besoinsRestants">0 Ar</h2>
                        <small>Besoins non satisfaits</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Barre de progression -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Progression globale</h5>
                <div class="progress mb-2" id="progressBar">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 0%;" id="progressFill">0%</div>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Réalisé: <span id="realiseLabel">0 Ar</span></span>
                    <span>Total: <span id="totalLabel">0 Ar</span></span>
                </div>
            </div>
        </div>

        <!-- Tableau par ville -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Détail par ville</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-thead-custom">
                            <tr>
                                <th>Ville</th>
                                <th>Région</th>
                                <th>Besoins totaux</th>
                                <th>Attribué</th>
                                <th>Reste</th>
                                <th>Progression</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <tr>
                                <td colspan="6" class="text-center">Chargement des données...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../inc/footer.php'; ?>

    <script>
        // Fonction pour charger les données via AJAX
        function chargerDonnees() {
            const refreshIcon = document.getElementById('refreshIcon');
            refreshIcon.style.transform = 'rotate(180deg)';
            
            fetch('/recapitulatif/data')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        mettreAJourAffichage(data.data);
                        document.getElementById('lastUpdate').innerHTML = 
                            'Dernière mise à jour: ' + new Date().toLocaleTimeString();
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Erreur lors du chargement des données');
                })
                .finally(() => {
                    setTimeout(() => {
                        refreshIcon.style.transform = 'rotate(0deg)';
                    }, 500);
                });
        }

        // Fonction pour mettre à jour l'affichage
        function mettreAJourAffichage(data) {
            // Formater les nombres
            const formatMoney = (value) => {
                return new Intl.NumberFormat('fr-FR').format(value) + ' Ar';
            };

            // Mettre à jour les cartes
            document.getElementById('besoinsTotaux').textContent = formatMoney(data.besoins_totaux);
            document.getElementById('attributionsTotales').textContent = formatMoney(data.attributions_totales);
            document.getElementById('achatsTotaux').textContent = formatMoney(data.achats_totaux);
            document.getElementById('besoinsRestants').textContent = formatMoney(data.besoins_restants);

            // Mettre à jour la barre de progression
            const total = data.besoins_totaux;
            const realise = data.attributions_totales;
            const pourcentage = total > 0 ? (realise / total * 100) : 0;
            
            document.getElementById('progressFill').style.width = pourcentage + '%';
            document.getElementById('progressFill').textContent = pourcentage.toFixed(1) + '%';
            document.getElementById('realiseLabel').textContent = formatMoney(realise);
            document.getElementById('totalLabel').textContent = formatMoney(total);

            // Mettre à jour le tableau
            let html = '';
            if (data.details_par_ville && data.details_par_ville.length > 0) {
                data.details_par_ville.forEach(ville => {
                    const reste = ville.total_besoins - ville.total_attribue;
                    const progression = ville.total_besoins > 0 ? 
                        (ville.total_attribue / ville.total_besoins * 100) : 0;
                    
                    html += `<tr>
                        <td>${ville.ville_nom || 'Inconnue'}</td>
                        <td>${ville.region || '-'}</td>
                        <td class="text-end">${formatMoney(ville.total_besoins || 0)}</td>
                        <td class="text-end">${formatMoney(ville.total_attribue || 0)}</td>
                        <td class="text-end">
                            <span class="badge ${reste > 0 ? 'bg-warning' : 'bg-success'}">
                                ${formatMoney(reste)}
                            </span>
                        </td>
                        <td style="width: 150px;">
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar bg-success" 
                                     style="width: ${progression}%;">
                                    ${progression.toFixed(1)}%
                                </div>
                            </div>
                        </td>
                    </tr>`;
                });
            } else {
                html = '<tr><td colspan="6" class="text-center">Aucune donnée disponible</td></tr>';
            }
            document.getElementById('tableBody').innerHTML = html;
        }

        // Charger les données au chargement de la page
        document.addEventListener('DOMContentLoaded', function() {
            chargerDonnees();
            
            // Actualisation automatique toutes les 30 secondes
            setInterval(chargerDonnees, 30000);
        });
    </script>

    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>