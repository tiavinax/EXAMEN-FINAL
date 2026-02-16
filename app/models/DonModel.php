<?php
namespace app\models;
use app\utils\Database;
use Flight;
use PDO;

class DonModel {
    private $db;
    
    public function __construct() {
        $this->db = Database::getConnection();
    }
    
    
    public function getTotalValeur() {
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
}