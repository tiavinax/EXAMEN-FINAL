<?php

namespace app\models;

use app\utils\Database;
use Flight;
use PDO;

class BesoinModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM besoins ORDER BY date_don DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public function getTotalValeur()
    {
        $stmt = $this->db->query("SELECT SUM(quantite * prix_unitaire) as total FROM besoins");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    public function getByVilleWithDetails($villeId)
    {
        $stmt = $this->db->prepare("
            SELECT b.*, v.nom as ville_nom 
            FROM besoins b
            JOIN villes v ON v.id = b.ville_id
            WHERE b.ville_id = ?
            ORDER BY b.type, b.libelle
        ");
        $stmt->execute([$villeId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Créer un nouveau besoin
     */
    public function create($data)
    {
        $sql = "INSERT INTO besoins (ville_id, type, libelle, quantite, prix_unitaire) 
                VALUES (:ville_id, :type, :libelle, :quantite, :prix_unitaire)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':ville_id' => $data['ville_id'],
            ':type' => $data['type'],
            ':libelle' => $data['libelle'],
            ':quantite' => $data['quantite'],
            ':prix_unitaire' => $data['prix_unitaire']
        ]);
    }

    /**
     * Lister tous les besoins avec le nom de la ville
     */
    public function getAllWithVille()
    {
        $sql = "SELECT b.*, v.nom AS ville_nom, v.region 
                FROM besoins b
                INNER JOIN villes v ON b.ville_id = v.id
                ORDER BY v.nom, b.type, b.libelle";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Récupérer un besoin par ID
     */
    public function getById($id)
    {
        $sql = "SELECT * FROM besoins WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Mettre à jour un besoin
     */
    public function update($id, $data)
    {
        $sql = "UPDATE besoins SET 
                ville_id = :ville_id,
                type = :type,
                libelle = :libelle,
                quantite = :quantite,
                prix_unitaire = :prix_unitaire
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':ville_id' => $data['ville_id'],
            ':type' => $data['type'],
            ':libelle' => $data['libelle'],
            ':quantite' => $data['quantite'],
            ':prix_unitaire' => $data['prix_unitaire']
        ]);
    }

    /**
     * Supprimer un besoin
     */
    public function delete($id)
    {
        $sql = "DELETE FROM besoins WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    /**
     * Récupérer les besoins par ville
     */
    public function getByVille($villeId)
    {
        $sql = "SELECT * FROM besoins WHERE ville_id = ? ORDER BY type, libelle";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$villeId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Récupérer les besoins non satisfaits avec reste > 0
     */
    public function getBesoinsRestants() {
        $sql = "SELECT b.*, v.nom AS ville_nom, v.region,
                   COALESCE(SUM(
                       CASE 
                           WHEN b.type = 'argent' THEN a.montant_attribue
                           ELSE a.quantite_attribuee
                       END
                   ), 0) AS total_attribue,
                   CASE 
                       WHEN b.type = 'argent' THEN b.quantite - COALESCE(SUM(a.montant_attribue), 0)
                       ELSE b.quantite - COALESCE(SUM(a.quantite_attribuee), 0)
                   END AS reste,
                   (b.quantite * b.prix_unitaire) AS total_valeur
            FROM besoins b
            INNER JOIN villes v ON b.ville_id = v.id
            LEFT JOIN attributions a ON b.id = a.besoin_id
            GROUP BY b.id
            HAVING reste > 0
            ORDER BY v.nom, b.type, b.libelle";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
 * Calculer la valeur totale de tous les besoins (quantité × prix_unitaire)
 */
public function getTotalValeurBesoins()
{
    $sql = "SELECT SUM(quantite * prix_unitaire) AS total FROM besoins";
    $stmt = $this->db->query($sql);
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    return $result->total ?? 0;
}

/**
 * Récapitulatif par ville
 */
public function getRecapParVille()
{
    $sql = "SELECT 
                v.id,
                v.nom AS ville_nom,
                v.region,
                SUM(b.quantite * b.prix_unitaire) AS total_besoins,
                COALESCE(SUM(
                    CASE 
                        WHEN b.type = 'argent' THEN a.montant_attribue
                        ELSE a.quantite_attribuee * b.prix_unitaire
                    END
                ), 0) AS total_attribue
            FROM villes v
            LEFT JOIN besoins b ON v.id = b.ville_id
            LEFT JOIN attributions a ON b.id = a.besoin_id
            GROUP BY v.id
            ORDER BY v.nom";
    
    $stmt = $this->db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}
}
