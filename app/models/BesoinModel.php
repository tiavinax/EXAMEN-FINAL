<?php
namespace app\models;

use app\utils\Database;
use Flight;
use PDO;

class BesoinModel {
    private $db;
    
    public function __construct() {
        $this->db = Database::getConnection();
    }
    
    
    public function getTotalValeur() {
        $stmt = $this->db->query("SELECT SUM(quantite * prix_unitaire) as total FROM besoins");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }
    
    public function getByVilleWithDetails($villeId) {
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
}