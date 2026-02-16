<?php
namespace app\models;

use app\database\Database;

class ColisModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Récupère tous les colis
     */
    public function getAll()
    {
        $sql = "SELECT * FROM colis ORDER BY date_creation DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un colis par son ID
     */
    public function getById($id)
    {
        $sql = "SELECT * FROM colis WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un colis par sa référence
     */
    public function getByReference($reference)
    {
        $sql = "SELECT * FROM colis WHERE reference = :reference";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['reference' => $reference]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Crée un nouveau colis
     */
    public function create($data)
    {
        $sql = "INSERT INTO colis (reference, description, poids_kg, valeur) 
                VALUES (:reference, :description, :poids_kg, :valeur)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'reference' => $data['reference'],
            'description' => $data['description'] ?? null,
            'poids_kg' => $data['poids_kg'],
            'valeur' => $data['valeur'] ?? null
        ]);
    }

    /**
     * Met à jour un colis
     */
    public function update($id, $data)
    {
        $sql = "UPDATE colis SET 
                reference = :reference,
                description = :description,
                poids_kg = :poids_kg,
                valeur = :valeur
                WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    /**
     * Supprime un colis
     */
    public function delete($id)
    {
        $sql = "DELETE FROM colis WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Récupère les colis disponibles (non utilisés dans une livraison active)
     */
    public function getAvailableColis()
    {
        $sql = "SELECT c.* FROM colis c
                LEFT JOIN livraison l ON c.id = l.id_colis 
                    AND l.statut IN ('en attente', 'livré')
                WHERE l.id IS NULL
                ORDER BY c.date_creation DESC";
        
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Compte le nombre total de colis
     */
    public function count()
    {
        $sql = "SELECT COUNT(*) as total FROM colis";
        $stmt = $this->db->query($sql);
        return $stmt->fetchColumn();
    }
}