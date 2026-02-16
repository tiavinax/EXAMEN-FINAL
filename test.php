<?php
echo '<h1>Test Simple</h1>';

// Charger la config
$config = require 'app/config/config.php';
$dbConfig = $config['database'];

echo '<h2>Configuration DB:</h2>';
echo 'Host: ' . $dbConfig['host'] . '<br>';
echo 'Database: ' . $dbConfig['dbname'] . '<br>';
echo 'User: ' . $dbConfig['user'] . '<br>';

try {
    $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']}";
    $pdo = new PDO($dsn, $dbConfig['user'], $dbConfig['password']);

    echo '<h2 style="color: green;">✓ Connexion réussie!</h2>';
} catch (Exception $e) {
    echo '<h2 style="color: red;">✗ Erreur: ' . $e->getMessage() . '</h2>';
}
