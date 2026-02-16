<?php

namespace app\models;

use Flight;
use app\utils\Database;
use PDO;

class VilleModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    //     CREATE TABLE villes (
    //     id INT PRIMARY KEY AUTO_INCREMENT,
    //     nom VARCHAR(100) NOT NULL,
    //     region VARCHAR(100) NOT NULL,
    //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    // );

    /**
     * Créer une nouvelle ville
     */
    public function create($data)
    {
        $sql = "INSERT INTO villes (nom, region) VALUES (:nom, :region)";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':nom' => $data['nom'],
            ':region' => $data['region']
        ]);
    }

    /**
     * Lister toutes les villes
     */
    public function getAll()
    {
        $sql = "SELECT * FROM villes ORDER BY created_at DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Récupérer une ville par ID
     */
    public function getById($id)
    {
        $sql = "SELECT * FROM villes WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Mettre à jour une ville
     */
    public function update($id, $data)
    {
        $sql = "UPDATE villes SET nom = :nom, region = :region WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':nom' => $data['nom'],
            ':region' => $data['region']
        ]);
    }

    /**
     * Supprimer une ville
     */
    public function delete($id)
    {
        $sql = "DELETE FROM villes WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    /**
     * Vérifier si une ville a des besoins
     */
    public function hasBesoins($id)
    {
        $sql = "SELECT COUNT(*) as count FROM besoins WHERE ville_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result->count > 0;
    }
}
