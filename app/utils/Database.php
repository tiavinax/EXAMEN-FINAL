<?php
namespace app\utils;  

use PDO;
use PDOException;

class Database
{
    private static $instance = null;
    
public static function getConnection()
{
    if (self::$instance === null) {
        require_once __DIR__ . '/../config/config.php';
        
        try {
            // Détection automatique de l'environnement
            if (file_exists('/Applications/MAMP/tmp/mysql/mysql.sock')) {
                // Environnement MAMP
                $dsn = "mysql:unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock;dbname=" . DB_NAME . ";charset=utf8mb4";
            } elseif (file_exists('/tmp/mysql.sock')) {
                // Environnement Homebrew/standard
                $dsn = "mysql:unix_socket=/tmp/mysql.sock;dbname=" . DB_NAME . ";charset=utf8mb4";
            } else {
                // Fallback à TCP/IP
                $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            }
            
            self::$instance = new PDO(
                $dsn,
                DB_USER,
                DB_PASS,
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