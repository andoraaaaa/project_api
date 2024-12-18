<?php
header("Content-Type: application/json");
require_once 'db.php';
require_once 'api_key.php';

// Ambil API key dari parameter
$apiKey = isset($_GET['api_key']) ? $_GET['api_key'] : '';

if (!$apiKey || !validateApiKey($apiKey)) {
    echo json_encode(["error" => "Invalid API key"]);
    exit;
}

// Ambil data film dari database
$stmt = $pdo->query("SELECT * FROM movies");
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Tampilkan data dalam format JSON
echo json_encode($movies);
?>
