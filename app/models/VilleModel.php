<?php
namespace app\models;
use Flight;
use app\utils\Database;
use PDO;

class VilleModel {
    private $db;
    
    public function __construct() {
        $this->db = Database::getConnection();
    }
    
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM villes ORDER BY nom");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function nombreVille($id) {
        $sql = "SELECT count(*) FROM villes";
        $stmt = $this->db->query($sql);
        return $stmt;
    }

    
}