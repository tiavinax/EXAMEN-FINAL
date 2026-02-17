<?php

namespace app\models;

use Flight;
use app\utils\Database as UtilsDatabase;
use PDO;

class AttributionModel
{
    private $db;

    public function __construct()
    {
        $this->db = UtilsDatabase::getConnection();
    }

    /**
     * Récupère toutes les données pour le tableau de bord
     */
    public function getDashboardData()
    {
        $sql = "SELECT 
            v.id AS ville_id,
            v.nom AS ville_nom,
            v.region,
            b.id AS besoin_id,
            b.libelle AS besoin_libelle,
            b.type AS besoin_type,
            b.quantite AS besoin_quantite,
            b.prix_unitaire,
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
            COUNT(a.id) AS nb_attributions
            FROM besoins b
            INNER JOIN villes v ON b.ville_id = v.id
            LEFT JOIN attributions a ON b.id = a.besoin_id
            GROUP BY b.id, v.id
            ORDER BY v.nom, b.type, b.libelle";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Récupère les détails d'attribution pour un besoin
     */
    public function getAttributionsByBesoin($besoinId)
    {
        $sql = "SELECT 
            a.id,
            a.quantite_attribuee,
            a.montant_attribue,
            a.date_attribution,
            d.donateur,
            d.libelle AS don_libelle,
            d.date_don
            FROM attributions a
            INNER JOIN dons d ON a.don_id = d.id
            WHERE a.besoin_id = ?
            ORDER BY a.date_attribution DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$besoinId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Récupère les statistiques globales
     */
    public function getStats()
    {
        $stats = [];

        // Nombre de villes
        $sql = "SELECT COUNT(*) AS total FROM villes";
        $stmt = $this->db->query($sql);
        $stats['villes'] = $stmt->fetch(PDO::FETCH_OBJ)->total;

        // Nombre de besoins
        $sql = "SELECT COUNT(*) AS total FROM besoins";
        $stmt = $this->db->query($sql);
        $stats['besoins'] = $stmt->fetch(PDO::FETCH_OBJ)->total;

        // Nombre de dons
        $sql = "SELECT COUNT(*) AS total FROM dons";
        $stmt = $this->db->query($sql);
        $stats['dons'] = $stmt->fetch(PDO::FETCH_OBJ)->total;

        // Nombre d'attributions
        $sql = "SELECT COUNT(*) AS total FROM attributions";
        $stmt = $this->db->query($sql);
        $stats['attributions'] = $stmt->fetch(PDO::FETCH_OBJ)->total;

        return (object) $stats;
    }

    /**
     * Créer une attribution
     */
    public function create($data)
    {
        $sql = "INSERT INTO attributions (don_id, besoin_id, ville_id, quantite_attribuee, montant_attribue, date_attribution) 
                VALUES (:don_id, :besoin_id, :ville_id, :quantite_attribuee, :montant_attribue, NOW())";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':don_id' => $data['don_id'],
            ':besoin_id' => $data['besoin_id'],
            ':ville_id' => $data['ville_id'],
            ':quantite_attribuee' => $data['quantite_attribuee'] ?? null,
            ':montant_attribue' => $data['montant_attribue'] ?? null
        ]);
    }

    /**
     * Récupérer toutes les attributions avec détails
     */
    public function getAllWithDetails()
    {
        $sql = "SELECT a.*, 
                       d.donateur, d.type AS don_type, d.libelle AS don_libelle,
                       v.nom AS ville_nom, v.region,
                       b.libelle AS besoin_libelle, b.type AS besoin_type
                FROM attributions a
                INNER JOIN dons d ON a.don_id = d.id
                INNER JOIN villes v ON a.ville_id = v.id
                INNER JOIN besoins b ON a.besoin_id = b.id
                ORDER BY a.date_attribution DESC";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Récupérer les attributions par ville
     */
    public function getByVille($villeId)
    {
        $sql = "SELECT a.*, d.donateur, d.libelle AS don_libelle
                FROM attributions a
                INNER JOIN dons d ON a.don_id = d.id
                WHERE a.ville_id = ?
                ORDER BY a.date_attribution DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$villeId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Supprimer toutes les attributions (pour réinitialiser)
     */
    public function resetAll()
    {
        $sql = "DELETE FROM attributions";
        return $this->db->exec($sql);
    }

    /**
     * Calculer la valeur totale de toutes les attributions
     */
    public function getTotalValeurAttributions()
    {
        $sql = "SELECT 
                SUM(
                    CASE 
                        WHEN b.type = 'argent' THEN a.montant_attribue
                        ELSE a.quantite_attribuee * b.prix_unitaire
                    END
                ) AS total
            FROM attributions a
            INNER JOIN besoins b ON a.besoin_id = b.id";

        $stmt = $this->db->query($sql);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result->total ?? 0;
    }
    /**
     * Récupérer le total attribué pour un besoin
     */
    public function getTotalByBesoin($besoinId)
    {
        $sql = "SELECT 
                COALESCE(SUM(
                    CASE 
                        WHEN b.type = 'argent' THEN a.montant_attribue
                        ELSE a.quantite_attribuee
                    END
                ), 0) AS total
            FROM attributions a
            INNER JOIN besoins b ON a.besoin_id = b.id
            WHERE a.besoin_id = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$besoinId]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result->total ?? 0;
    }
}
