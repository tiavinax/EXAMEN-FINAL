<?php
namespace app\models;

use app\database\Database;

class LivraisonModel
{
    private $db;

    public function __construct()
    {
        // Assure-toi que Database::getConnection() retourne bien un objet PDO
        $this->db = Database::getConnection();
    }

    /**
     * Crée une nouvelle livraison et son affectation
     */
    public function createLivraison($livraisonData, $affectationData)
    {
        try {
            $this->db->beginTransaction();
            
            // 1. Insérer la livraison
            $sqlLivraison = "INSERT INTO livraison 
                (id_colis, id_zone, id_entrepot, adresse_destination, statut, 
                 prix_client, cout_voiture, cout_chauffeur, date_heure_enlevement)
                VALUES (:id_colis, :id_zone, :id_entrepot, :adresse_destination, :statut,
                        :prix_client, :cout_voiture, :cout_chauffeur, :date_heure_enlevement)";
            
            $stmtLivraison = $this->db->prepare($sqlLivraison);
            $stmtLivraison->execute([
                'id_colis' => $livraisonData['id_colis'],
                'id_zone' => $livraisonData['id_zone'],
                'id_entrepot' => $livraisonData['id_entrepot'] ?? 1, // Défaut 1
                'adresse_destination' => $livraisonData['adresse_destination'],
                'statut' => $livraisonData['statut'] ?? 'en attente',
                'prix_client' => $livraisonData['prix_client'],
                'cout_voiture' => $livraisonData['cout_voiture'],
                'cout_chauffeur' => $livraisonData['cout_chauffeur'],
                'date_heure_enlevement' => $livraisonData['date_heure_enlevement'] ?? date('Y-m-d H:i:s')
            ]);
            
            // Récupérer l'ID de la livraison créée
            $livraisonId = $this->db->lastInsertId();
            
            // 2. Insérer l'affectation
            $sqlAffectation = "INSERT INTO affectation_livraison 
                (id_vehicule, id_livreur, id_livraison)
                VALUES (:id_vehicule, :id_livreur, :id_livraison)";
            
            $stmtAffectation = $this->db->prepare($sqlAffectation);
            $stmtAffectation->execute([
                'id_vehicule' => $affectationData['id_vehicule'],
                'id_livreur' => $affectationData['id_livreur'],
                'id_livraison' => $livraisonId
            ]);
            
            $this->db->commit();
            return $livraisonId;
            
        } catch (\Exception $e) {
            $this->db->rollBack();
            throw new \Exception("Erreur création livraison: " . $e->getMessage());
        }
    }

    /**
     * Récupère toutes les livraisons avec détails
     */
    public function getAll()
    {
        $sql = "SELECT 
                l.id,
                c.reference,
                c.poids_kg,
                z.nom AS zone,
                z.prix_par_kg,
                e.adresse AS entrepot,
                l.adresse_destination,
                l.statut,
                l.prix_client,
                l.cout_voiture,
                l.cout_chauffeur,
                (l.prix_client - (l.cout_voiture + l.cout_chauffeur)) AS benefice,
                CONCAT(v.marque, ' ', v.modele) AS vehicule,
                CONCAT(liv.nom, ' ', liv.prenom) AS livreur,
                l.date_heure_enlevement,
                l.date_heure_livraison,
                l.notes
            FROM livraison l
            JOIN entrepot e ON l.id_entrepot = e.id
            JOIN colis c ON l.id_colis = c.id
            JOIN zone z ON l.id_zone = z.id
            JOIN affectation_livraison a ON l.id = a.id_livraison
            JOIN vehicule v ON a.id_vehicule = v.id
            JOIN livreur liv ON a.id_livreur = liv.id
            ORDER BY l.date_heure_enlevement DESC";
        
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Bénéfices par jour (avec PDO)
     */
    public function getBeneficesParJour()
    {
        $sql = "SELECT 
                DATE(date_heure_enlevement) AS jour,
                COUNT(*) AS nombre_livraisons,
                SUM(prix_client) AS recette_totale,
                SUM(cout_voiture) AS total_cout_voiture,
                SUM(cout_chauffeur) AS total_cout_chauffeur,
                SUM(cout_voiture + cout_chauffeur) AS cout_total,
                SUM(prix_client - (cout_voiture + cout_chauffeur)) AS benefice
            FROM livraison 
            WHERE statut = 'livré'
            GROUP BY DATE(date_heure_enlevement)
            ORDER BY jour DESC";
        
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Bénéfices par mois
     */
    public function getBeneficesParMois()
    {
        $sql = "SELECT 
                DATE_FORMAT(date_heure_enlevement, '%Y-%m') AS mois,
                COUNT(*) AS nombre_livraisons,
                SUM(prix_client) AS recette_totale,
                SUM(cout_voiture + cout_chauffeur) AS cout_total,
                SUM(prix_client - (cout_voiture + cout_chauffeur)) AS benefice
            FROM livraison 
            WHERE statut = 'livré'
            GROUP BY DATE_FORMAT(date_heure_enlevement, '%Y-%m')
            ORDER BY mois DESC";
        
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Met à jour le statut d'une livraison
     */
    public function updateStatut($id, $statut, $dateLivraison = null)
    {
        $sql = "UPDATE livraison SET statut = :statut";
        $params = ['statut' => $statut, 'id' => $id];
        
        if ($dateLivraison) {
            $sql .= ", date_heure_livraison = :date_livraison";
            $params['date_livraison'] = $dateLivraison;
        }
        
        $sql .= " WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * Récupère une livraison par son ID
     */
    public function getLivraisonById($id)
    {
        $sql = "SELECT 
                l.*,
                c.reference,
                c.poids_kg,
                z.nom AS zone_nom,
                z.prix_par_kg,
                e.adresse AS entrepot_adresse,
                v.id AS vehicule_id,
                liv.id AS livreur_id
            FROM livraison l
            JOIN colis c ON l.id_colis = c.id
            JOIN zone z ON l.id_zone = z.id
            JOIN entrepot e ON l.id_entrepot = e.id
            LEFT JOIN affectation_livraison a ON l.id = a.id_livraison
            LEFT JOIN vehicule v ON a.id_vehicule = v.id
            LEFT JOIN livreur liv ON a.id_livreur = liv.id
            WHERE l.id = :id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}