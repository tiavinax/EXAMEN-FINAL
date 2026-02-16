<?php
class DashboardController {
    
    public function index() {
        // Statistiques globales
        $stats = $this->getGlobalStats();
        
        // Liste des villes avec leurs besoins
        $villes = $this->getVillesWithBesoins();
        
        Flight::render('dashboard/index', [
            'title' => 'Tableau de bord - BNGRC',
            'stats' => $stats,
            'villes' => $villes
        ]);
    }
    
    public function detailVille($ville_id) {
        $ville = $this->getVilleDetail($ville_id);
        $attributions = $this->getAttributionsByVille($ville_id);
        
        Flight::render('dashboard/ville_detail', [
            'title' => 'Détail - ' . $ville['nom'],
            'ville' => $ville,
            'attributions' => $attributions
        ]);
    }
    
    private function getGlobalStats() {
        $db = Flight::db();
        
        // Total des dons
        $totalDons = $db->fetchOne("SELECT SUM(montant_total) as total FROM dons WHERE type_don = 'argent'");
        
        // Total des besoins
        $totalBesoins = $db->fetchOne("SELECT SUM(quantite_initiale * prix_unitaire) as total FROM besoins");
        
        // Villes touchées
        $villesSinistrees = $db->fetchOne("SELECT COUNT(DISTINCT ville_id) as total FROM besoins");
        
        return [
            'total_dons' => $totalDons['total'] ?? 0,
            'total_besoins' => $totalBesoins['total'] ?? 0,
            'villes_sinistrees' => $villesSinistrees['total'] ?? 0,
            'pourcentage_couvert' => ($totalDons['total'] ?? 0) > 0 ? 
                round(($totalDons['total'] / ($totalBesoins['total'] ?? 1)) * 100, 2) : 0
        ];
    }
    
    private function getVillesWithBesoins() {
        $db = Flight::db();
        
        return $db->fetchAll("
            SELECT 
                v.id,
                v.nom as ville_nom,
                r.nom as region_nom,
                COUNT(DISTINCT b.id) as nb_besoins,
                SUM(b.quantite_initiale * b.prix_unitaire) as montant_besoins,
                SUM(b.quantite_restante * b.prix_unitaire) as montant_reste,
                (
                    SELECT SUM(a.montant_attribue) 
                    FROM attributions a 
                    JOIN besoins b2 ON a.besoin_id = b2.id 
                    WHERE b2.ville_id = v.id
                ) as total_attribue
            FROM villes v
            JOIN regions r ON v.region_id = r.id
            LEFT JOIN besoins b ON v.id = b.ville_id
            GROUP BY v.id, v.nom, r.nom
            ORDER BY r.nom, v.nom
        ");
    }
    
    private function getVilleDetail($ville_id) {
        $db = Flight::db();
        
        return $db->fetchOne("
            SELECT 
                v.*,
                r.nom as region_nom,
                GROUP_CONCAT(DISTINCT b.libelle) as types_besoins
            FROM villes v
            JOIN regions r ON v.region_id = r.id
            LEFT JOIN besoins b ON v.id = b.ville_id
            WHERE v.id = ?
            GROUP BY v.id
        ", [$ville_id]);
    }
    
    private function getAttributionsByVille($ville_id) {
        $db = Flight::db();
        
        return $db->fetchAll("
            SELECT 
                a.*,
                b.libelle as besoin_libelle,
                b.prix_unitaire as besoin_prix,
                d.libelle as don_libelle,
                d.type_don,
                don.nom as donateur_nom,
                a.date_attribution
            FROM attributions a
            JOIN besoins b ON a.besoin_id = b.id
            JOIN dons d ON a.don_id = d.id
            JOIN donateurs don ON d.donateur_id = don.id
            WHERE b.ville_id = ?
            ORDER BY a.date_attribution DESC
        ", [$ville_id]);
    }
}
