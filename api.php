<?php
$apiKey = '1234567890abcdef'; // Ganti dengan API key Anda
$apiUrl = "http://localhost/project_api/api/index.php?api_key=$apiKey";

$response = file_get_contents($apiUrl);
$movies = json_decode($response, true);