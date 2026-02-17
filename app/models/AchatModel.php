<?php

namespace app\models;

use app\utils\Database;
use PDO;
use Flight;
use Exception;

class AchatModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Créer un nouvel achat
     */
    public function create($data)
    {
        $sql = "INSERT INTO achats (don_id, besoin_id, quantite, montant_achat, frais_pourcentage, montant_frais, montant_total) 
                VALUES (:don_id, :besoin_id, :quantite, :montant_achat, :frais_pourcentage, :montant_frais, :montant_total)";

        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':don_id' => $data['don_id'],
            ':besoin_id' => $data['besoin_id'],
            ':quantite' => $data['quantite'],
            ':montant_achat' => $data['montant_achat'],
            ':frais_pourcentage' => $data['frais_pourcentage'],
            ':montant_frais' => $data['montant_frais'],
            ':montant_total' => $data['montant_total']
        ]);
    }

    /**
     * Exécuter un achat complet (avec transaction)
     */
    public function executeAchat($data)
    {
        // Démarrer la transaction
        $this->db->beginTransaction();
        
        try {
            // 1. Créer l'attribution
            $sqlAttribution = "INSERT INTO attributions (don_id, besoin_id, ville_id, quantite_attribuee, montant_attribue, date_attribution) 
                               VALUES (:don_id, :besoin_id, :ville_id, :quantite_attribuee, :montant_attribue, NOW())";
            
            $stmt = $this->db->prepare($sqlAttribution);
            $result1 = $stmt->execute([
                ':don_id' => $data['don_id'],
                ':besoin_id' => $data['besoin_id'],
                ':ville_id' => $data['ville_id'],
                ':quantite_attribuee' => $data['quantite'],
                ':montant_attribue' => null
            ]);

            if (!$result1) {
                throw new Exception("Erreur lors de la création de l'attribution");
            }
            
            // 2. Créer l'achat
            $sqlAchat = "INSERT INTO achats (don_id, besoin_id, quantite, montant_achat, frais_pourcentage, montant_frais, montant_total) 
                         VALUES (:don_id, :besoin_id, :quantite, :montant_achat, :frais_pourcentage, :montant_frais, :montant_total)";
            
            $stmt = $this->db->prepare($sqlAchat);
            $result2 = $stmt->execute([
                ':don_id' => $data['don_id'],
                ':besoin_id' => $data['besoin_id'],
                ':quantite' => $data['quantite'],
                ':montant_achat' => $data['montant_besoin'],
                ':frais_pourcentage' => $data['frais_pourcentage'],
                ':montant_frais' => $data['montant_frais'],
                ':montant_total' => $data['montant_total']
            ]);

            if (!$result2) {
                throw new Exception("Erreur lors de la création de l'achat");
            }
            
            // Valider la transaction
            $this->db->commit();
            
            return [
                'success' => true,
                'message' => sprintf(
                    "Achat réussi : %s unités de %s pour %s Ar (dont %s Ar de frais)",
                    number_format($data['quantite']),
                    "besoin", // On pourrait passer le libellé
                    number_format($data['montant_total'], 0, ',', ' '),
                    number_format($data['montant_frais'], 0, ',', ' ')
                )
            ];
            
        } catch (Exception $e) {
            // Annuler la transaction en cas d'erreur
            $this->db->rollBack();
            
            // Log l'erreur pour déboguer
            error_log("Erreur executeAchat: " . $e->getMessage());
            
            return [
                'success' => false,
                'message' => "Erreur lors de l'achat : " . $e->getMessage()
            ];
        }
    }

    /**
     * Récupérer tous les achats avec détails
     */
    public function getAllWithDetails()
    {
        $sql = "SELECT a.*, 
                       d.donateur, d.libelle AS don_libelle,
                       b.libelle AS besoin_libelle, b.type AS besoin_type,
                       v.nom AS ville_nom, v.region
                FROM achats a
                INNER JOIN dons d ON a.don_id = d.id
                INNER JOIN besoins b ON a.besoin_id = b.id
                INNER JOIN villes v ON b.ville_id = v.id
                ORDER BY a.date_achat DESC";
        
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Récupérer les achats par don
     */
    public function getByDon($donId)
    {
        $sql = "SELECT * FROM achats WHERE don_id = ? ORDER BY date_achat DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$donId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Calculer la valeur totale des achats (avec frais)
     */
    public function getTotalValeurAchats()
    {
        $sql = "SELECT SUM(montant_total) AS total FROM achats";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result->total ?? 0;
    }

    /**
     * Récupérer le total des frais
     */
    public function getTotalFrais()
    {
        $sql = "SELECT SUM(montant_frais) AS total FROM achats";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result->total ?? 0;
    }
}