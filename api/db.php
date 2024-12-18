<?php
$host = 'localhost';
$dbname = 'movie_api';
$username = 'root'; // Sesuaikan dengan konfigurasi MySQL Anda
$password = 'red2002';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
