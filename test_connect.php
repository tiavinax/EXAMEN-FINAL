<?php
// Utiliser 127.0.0.1 au lieu de localhost pour forcer TCP/IP
$host = '127.0.0.1';
$port = '8889';
$dbname = 'bngrc_db';
$user = 'root';
$pass = 'root';

echo "<h1>Test de connexion MAMP MySQL 8.0</h1>";
echo "<p>Tentative de connexion à $host:$port avec user '$user'</p>";

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<p style='color:green'>✅ Connexion réussie à MySQL 8.0 (MAMP) !</p>";
    
    // Vérifier les données
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM villes");
    $row = $stmt->fetch();
    echo "<p>Nombre de villes: <strong>" . $row['total'] . "</strong></p>";
    
} catch (PDOException $e) {
    echo "<p style='color:red'>❌ Erreur: " . $e->getMessage() . "</p>";
}