<?php
namespace app\utils;  // <-- C'est important que ce soit 'utils' et non 'database'

use PDO;
use PDOException;

class Database
{
    private static $instance = null;
    
    public static function getConnection()
    {
        if (self::$instance === null) {
            // Vérifier le chemin du fichier config
            $config = require __DIR__ . '/../config/config.php';
            $dbConfig = $config['database'];
            
            try {
                $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']};charset={$dbConfig['charset']}";
                
                self::$instance = new PDO(
                    $dsn,
                    $dbConfig['user'],
                    $dbConfig['password'],
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false
                    ]
                );
                
            } catch (PDOException $e) {
                die('Erreur de connexion à la base de données : ' . $e->getMessage());
            }
        }
        
        return self::$instance;
    }
}