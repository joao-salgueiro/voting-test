<?php
$host = '127.0.0.1';
$db   = 'voting_test';
$user = 'root';
$pass = '1234';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "Conectou no banco $db com sucesso!";
} catch (\PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}