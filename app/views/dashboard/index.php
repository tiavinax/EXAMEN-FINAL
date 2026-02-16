<div class="bngrc-breadcrumb">
    <a href="/dashboard"><i class="fas fa-home"></i> Accueil</a>
    <span class="separator">/</span>
    <span>Tableau de bord</span>
</div>

<!-- En-tête -->
<div class="bngrc-card">
    <div class="bngrc-card-header">
        <i class="fas fa-chart-line"></i> Tableau de bord - Suivi des dons et besoins
    </div>
    <div class="bngrc-card-body">
        <div class="row">
            <div class="col-md-8">
                <h5>Bienvenue sur le système de suivi</h5>
                <p>Visualisez l'état des besoins et des dons par ville sinistrée.</p>
            </div>
            <div class="col-md-4 text-end">
                <span class="badge badge-urgence">
                    <i class="fas fa-exclamation-triangle me-1"></i> Mise à jour en temps réel
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Cartes statistiques -->
<div class="row">
    <div class="col-md-3">
        <div class="stat-card position-relative">
            <div class="stat-icon">
                <i class="fas fa-city"></i>
            </div>
            <div class="stat-title">Villes sinistrées</div>
            <div class="stat-value">8</div>
            <div class="text-muted small">4 régions touchées</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card position-relative">
            <div class="stat-icon">
                <i class="fas fa-hand-holding-heart"></i>
            </div>
            <div class="stat-title">Besoins</div>
            <div class="stat-value">15</div>
            <div class="text-muted small">+3 cette semaine</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card position-relative">
            <div class="stat-icon">
                <i class="fas fa-gift"></i>
            </div>
            <div class="stat-title">Dons reçus</div>
            <div class="stat-value">12</div>
            <div class="text-muted small">5 donateurs</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card position-relative">
            <div class="stat-icon">
                <i class="fas fa-percent"></i>
            </div>
            <div class="stat-title">Taux couverture</div>
            <div class="stat-value">68%</div>
            <div class="progress-bngrc mt-2">
                <div class="progress-bar" style="width: 68%"></div>
            </div>
        </div>
    </div>
</div>

<!-- Tableau des villes -->
<div class="bngrc-card mt-4">
    <div class="bngrc-card-header">
        <i class="fas fa-table"></i> Situation par ville
    </div>
    <div class="bngrc-card-body">
        <div class="table-responsive">
            <table class="bngrc-table">
                <thead>
                    <tr>
                        <th>Région</th>
                        <th>Ville</th>
                        <th class="text-center">Besoins</th>
                        <th class="text-end">Montant besoins (Ar)</th>
                        <th class="text-end">Attribué (Ar)</th>
                        <th class="text-end">Reste (Ar)</th>
                        <th class="text-center">Progression</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Analamanga</td>
                        <td>
                            <strong>Antananarivo</strong><br>
                            <small class="text-muted">Population: 1.5M</small>
                        </td>
                        <td class="text-center"><span class="badge-besoin">4</span></td>
                        <td class="text-end">150 000 000</td>
                        <td class="text-end text-success">85 000 000</td>
                        <td class="text-end text-danger">65 000 000</td>
                        <td class="text-center" style="min-width: 120px;">
                            <div class="progress-bngrc">
                                <div class="progress-bar" style="width: 57%"></div>
                            </div>
                            <small>57%</small>
                        </td>
                        <td class="text-center">
                            <a href="/dashboard/ville/1" class="btn btn-bngrc-outline btn-sm">
                                <i class="fas fa-eye"></i> Détail
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Diana</td>
                        <td>
                            <strong>Antsiranana</strong><br>
                            <small class="text-muted">Population: 150k</small>
                        </td>
                        <td class="text-center"><span class="badge-besoin">3</span></td>
                        <td class="text-end">45 000 000</td>
                        <td class="text-end text-success">30 000 000</td>
                        <td class="text-end text-danger">15 000 000</td>
                        <td class="text-center">
                            <div class="progress-bngrc">
                                <div class="progress-bar" style="width: 67%"></div>
                            </div>
                            <small>67%</small>
                        </td>
                        <td class="text-center">
                            <a href="/dashboard/ville/2" class="btn btn-bngrc-outline btn-sm">
                                <i class="fas fa-eye"></i> Détail
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Sava</td>
                        <td>
                            <strong>Sambava</strong><br>
                            <small class="text-muted">Population: 120k</small>
                        </td>
                        <td class="text-center"><span class="badge-besoin">2</span></td>
                        <td class="text-end">25 000 000</td>
                        <td class="text-end text-success">10 000 000</td>
                        <td class="text-end text-danger">15 000 000</td>
                        <td class="text-center">
                            <div class="progress-bngrc">
                                <div class="progress-bar" style="width: 40%"></div>
                            </div>
                            <small>40%</small>
                        </td>
                        <td class="text-center">
                            <a href="/dashboard/ville/3" class="btn btn-bngrc-outline btn-sm">
                                <i class="fas fa-eye"></i> Détail
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Itasy</td>
                        <td>
                            <strong>Miarinarivo</strong><br>
                            <small class="text-muted">Population: 90k</small>
                        </td>
                        <td class="text-center"><span class="badge-besoin">1</span></td>
                        <td class="text-end">10 000 000</td>
                        <td class="text-end text-success">10 000 000</td>
                        <td class="text-end text-success">0</td>
                        <td class="text-center">
                            <div class="progress-bngrc">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="badge-don">100%</span>
                        </td>
                        <td class="text-center">
                            <a href="/dashboard/ville/4" class="btn btn-bngrc-outline btn-sm">
                                <i class="fas fa-eye"></i> Détail
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Dernières attributions -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="bngrc-card">
            <div class="bngrc-card-header">
                <i class="fas fa-clock"></i> Dernières attributions
            </div>
            <div class="bngrc-card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <span class="badge-don me-2">Don</span>
                            <strong>Riz 500kg</strong>
                        </div>
                        <small class="text-muted">Il y a 2h</small>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <span class="badge-don me-2">Don</span>
                            <strong>Tôles 100 pcs</strong>
                        </div>
                        <small class="text-muted">Il y a 5h</small>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <span class="badge-don me-2">Don</span>
                            <strong>Cash 10M Ar</strong>
                        </div>
                        <small class="text-muted">Hier</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="bngrc-card">
            <div class="bngrc-card-header">
                <i class="fas fa-exclamation-triangle"></i> Alertes besoins urgents
            </div>
            <div class="bngrc-card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <span class="badge-urgence me-2">Urgent</span>
                            <strong>Antananarivo - Eau potable</strong>
                        </div>
                        <small class="text-danger">Reste: 45%</small>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <span class="badge-urgence me-2">Urgent</span>
                            <strong>Sambava - Médicaments</strong>
                        </div>
                        <small class="text-danger">Reste: 60%</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Actions rapides -->
<div class="row mt-4">
    <div class="col-12">
        <div class="bngrc-card">
            <div class="bngrc-card-header">
                <i class="fas fa-bolt"></i> Actions rapides
            </div>
            <div class="bngrc-card-body">
                <div class="d-flex gap-2 flex-wrap">
                    <a href="/besoins/" class="btn btn-bngrc">
                        <i class="fas fa-plus"></i> Nouveau besoin
                    </a>
                    <a href="don_ajouter" class="btn btn-bngrc">
                        <i class="fas fa-gift"></i> Enregistrer un don
                    </a>
                    <a href="/attributions/simuler" class="btn btn-bngrc-outline">
                        <i class="fas fa-calculator"></i> Simuler attribution
                    </a>
                    <a href="/rapports" class="btn btn-bngrc-outline">
                        <i class="fas fa-file-pdf"></i> Générer rapport
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
