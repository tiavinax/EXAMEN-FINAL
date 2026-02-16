<?php

namespace app\models;

use app\utils\Database;
use Flight;
use PDO;

class DonModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Lister tous les dons
     */
    public function getAll()
    {
        $sql = "SELECT * FROM dons ORDER BY date_don DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getTotalValeur()
    {
        $stmt = $this->db->query("
            SELECT SUM(
                CASE 
                    WHEN type = 'argent' THEN montant
                    ELSE quantite * (SELECT prix_unitaire FROM besoins WHERE libelle = dons.libelle LIMIT 1)
                END
            ) as total FROM dons
        ");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    /**
     * Créer un nouveau don
     */
    public function create($data)
    {
        $sql = "INSERT INTO dons (donateur, type, libelle, quantite, montant, date_don) 
                VALUES (:donateur, :type, :libelle, :quantite, :montant, :date_don)";

        $stmt = $this->db->prepare($sql);

        // Gérer selon le type
        $quantite = null;
        $montant = null;

        if ($data['type'] === 'argent') {
            $montant = $data['valeur'];
        } else {
            $quantite = $data['valeur'];
        }

        return $stmt->execute([
            ':donateur' => $data['donateur'] ?? null,
            ':type' => $data['type'],
            ':libelle' => $data['libelle'],
            ':quantite' => $quantite,
            ':montant' => $montant,
            ':date_don' => $data['date_don'] ?? date('Y-m-d H:i:s')
        ]);
    }

    

    /**
     * Récupérer un don par ID
     */
    public function getById($id)
    {
        $sql = "SELECT * FROM dons WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Mettre à jour un don
     */
    public function update($id, $data)
    {
        $sql = "UPDATE dons SET 
                donateur = :donateur,
                type = :type,
                libelle = :libelle,
                quantite = :quantite,
                montant = :montant,
                date_don = :date_don
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        $quantite = null;
        $montant = null;

        if ($data['type'] === 'argent') {
            $montant = $data['valeur'];
        } else {
            $quantite = $data['valeur'];
        }

        return $stmt->execute([
            ':id' => $id,
            ':donateur' => $data['donateur'] ?? null,
            ':type' => $data['type'],
            ':libelle' => $data['libelle'],
            ':quantite' => $quantite,
            ':montant' => $montant,
            ':date_don' => $data['date_don']
        ]);
    }

    /**
     * Supprimer un don
     */
    public function delete($id)
    {
        $sql = "DELETE FROM dons WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
}
