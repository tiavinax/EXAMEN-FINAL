<?php

namespace app\models;

use app\utils\Database;
use Flight;
use PDO;

class ParametreModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    /**
     * Récupérer la valeur d'un paramètre par son libellé
     */
    public function getValeur($libelle)
    {
        $sql = "SELECT valeur FROM parametre WHERE libelle = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$libelle]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        return $result ? $result->valeur : null;
    }

    /**
     * Mettre à jour la valeur d'un paramètre
     */
    public function setValeur($libelle, $valeur)
    {
        $sql = "UPDATE parametre SET valeur = ? WHERE libelle = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$valeur, $libelle]);
    }

    /**
     * Récupérer tous les paramètres
     */
    public function getAll()
    {
        $sql = "SELECT * FROM parametre ORDER BY libelle";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Récupérer le taux de frais (avec valeur par défaut)
     */
    public function getFraisAchat()
    {
        $frais = $this->getValeur('frais_achat');
        return $frais ? floatval($frais) : 10.0; // 10% par défaut
    }
}
