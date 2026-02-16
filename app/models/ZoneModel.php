<?php
namespace app\models;

use app\database\Database;

class ZoneModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Récupère toutes les zones
     */
    public function getAll()
    {
        $sql = "SELECT * FROM zone ORDER BY nom";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Récupère une zone par son ID
     */
    public function getById($id)
    {
        $sql = "SELECT * FROM zone WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Récupère le prix au kg d'une zone
     */
    public function getPrixParKg($zoneId)
    {
        $sql = "SELECT prix_par_kg FROM zone WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $zoneId]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result ? $result['prix_par_kg'] : 0;
    }

    /**
     * Crée une nouvelle zone
     */
    public function create($data)
    {
        $sql = "INSERT INTO zone (nom, prix_par_kg) 
                VALUES (:nom, :prix_par_kg)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'nom' => $data['nom'],
            'prix_par_kg' => $data['prix_par_kg']
        ]);
    }

    /**
     * Met à jour une zone
     */
    public function update($id, $data)
    {
        $sql = "UPDATE zone SET 
                nom = :nom,
                prix_par_kg = :prix_par_kg
                WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    /**
     * Supprime une zone
     */
    public function delete($id)
    {
        // Vérifier si la zone a des livraisons
        $sqlCheck = "SELECT COUNT(*) FROM livraison WHERE id_zone = :id";
        $stmtCheck = $this->db->prepare($sqlCheck);
        $stmtCheck->execute(['id' => $id]);
        
        if ($stmtCheck->fetchColumn() > 0) {
            throw new \Exception("Impossible de supprimer cette zone : elle a des livraisons associées.");
        }
        
        $sql = "DELETE FROM zone WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Récupère les statistiques d'une zone
     */
    public function getStats($zoneId)
    {
        $sql = "SELECT 
                COUNT(*) as total_livraisons,
                SUM(prix_client) as total_chiffre_affaires,
                AVG(prix_client) as moyenne_par_livraison,
                MIN(prix_client) as prix_minimum,
                MAX(prix_client) as prix_maximum
                FROM livraison
                WHERE id_zone = :zone_id
                AND statut = 'livré'";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['zone_id' => $zoneId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Récupère le prix moyen au kg de toutes les zones
     */
    public function getPrixMoyenParKg()
    {
        $sql = "SELECT AVG(prix_par_kg) as prix_moyen FROM zone";
        $stmt = $this->db->query($sql);
        return $stmt->fetchColumn();
    }

    /**
     * Compte le nombre total de zones
     */
    public function count()
    {
        $sql = "SELECT COUNT(*) as total FROM zone";
        $stmt = $this->db->query($sql);
        return $stmt->fetchColumn();
    }
}