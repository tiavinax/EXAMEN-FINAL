<?php
namespace app\models;

use app\database\Database;

class LivreurModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Récupère tous les livreurs
     */
    public function getAll()
    {
        $sql = "SELECT * FROM livreur ORDER BY nom, prenom";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un livreur par son ID
     */
    public function getById($id)
    {
        $sql = "SELECT * FROM livreur WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Récupère le tarif d'un livreur
     */
    public function getTarif($livreurId)
    {
        $sql = "SELECT tarif_par_livraison FROM livreur WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $livreurId]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result ? $result['tarif_par_livraison'] : 0;
    }

    /**
     * Crée un nouveau livreur
     */
    public function create($data)
    {
        $sql = "INSERT INTO livreur (nom, prenom, tarif_par_livraison, contact) 
                VALUES (:nom, :prenom, :tarif_par_livraison, :contact)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'] ?? null,
            'tarif_par_livraison' => $data['tarif_par_livraison'],
            'contact' => $data['contact'] ?? null
        ]);
    }

    /**
     * Met à jour un livreur
     */
    public function update($id, $data)
    {
        $sql = "UPDATE livreur SET 
                nom = :nom,
                prenom = :prenom,
                tarif_par_livraison = :tarif_par_livraison,
                contact = :contact
                WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    /**
     * Supprime un livreur
     */
    public function delete($id)
    {
        // Vérifier si le livreur a des livraisons
        $sqlCheck = "SELECT COUNT(*) FROM affectation_livraison WHERE id_livreur = :id";
        $stmtCheck = $this->db->prepare($sqlCheck);
        $stmtCheck->execute(['id' => $id]);
        
        if ($stmtCheck->fetchColumn() > 0) {
            throw new \Exception("Impossible de supprimer ce livreur : il a des livraisons associées.");
        }
        
        $sql = "DELETE FROM livreur WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Récupère les statistiques d'un livreur
     */
    public function getStats($livreurId)
    {
        $sql = "SELECT 
                COUNT(l.id) as total_livraisons,
                SUM(l.prix_client) as total_chiffre_affaires,
                SUM(l.cout_chauffeur) as total_salaire,
                AVG(l.cout_chauffeur) as moyenne_salaire_par_livraison
                FROM livraison l
                JOIN affectation_livraison a ON l.id = a.id_livraison
                WHERE a.id_livreur = :livreur_id
                AND l.statut = 'livré'";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['livreur_id' => $livreurId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Compte le nombre total de livreurs
     */
    public function count()
    {
        $sql = "SELECT COUNT(*) as total FROM livreur";
        $stmt = $this->db->query($sql);
        return $stmt->fetchColumn();
    }
}