<?php
namespace app\models;

use app\database\Database;

class VehiculeModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Récupère tous les véhicules
     */
    public function getAll()
    {
        $sql = "SELECT * FROM vehicule ORDER BY immatriculation";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un véhicule par son ID
     */
    public function getById($id)
    {
        $sql = "SELECT * FROM vehicule WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Crée un nouveau véhicule
     */
    public function create($data)
    {
        $sql = "INSERT INTO vehicule (immatriculation, marque, modele, capacite_kg, cout_journalier) 
                VALUES (:immatriculation, :marque, :modele, :capacite_kg, :cout_journalier)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'immatriculation' => $data['immatriculation'],
            'marque' => $data['marque'] ?? null,
            'modele' => $data['modele'] ?? null,
            'capacite_kg' => $data['capacite_kg'] ?? null,
            'cout_journalier' => $data['cout_journalier']
        ]);
    }

    /**
     * Met à jour un véhicule
     */
    public function update($id, $data)
    {
        $sql = "UPDATE vehicule SET 
                immatriculation = :immatriculation,
                marque = :marque,
                modele = :modele,
                capacite_kg = :capacite_kg,
                cout_journalier = :cout_journalier
                WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    /**
     * Supprime un véhicule
     */
    public function delete($id)
    {
        // Vérifier si le véhicule a des livraisons
        $sqlCheck = "SELECT COUNT(*) FROM affectation_livraison WHERE id_vehicule = :id";
        $stmtCheck = $this->db->prepare($sqlCheck);
        $stmtCheck->execute(['id' => $id]);
        
        if ($stmtCheck->fetchColumn() > 0) {
            throw new \Exception("Impossible de supprimer ce véhicule : il a des livraisons associées.");
        }
        
        $sql = "DELETE FROM vehicule WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Compte le nombre total de véhicules
     */
    public function count()
    {
        $sql = "SELECT COUNT(*) as total FROM vehicule";
        $stmt = $this->db->query($sql);
        return $stmt->fetchColumn();
    }
}