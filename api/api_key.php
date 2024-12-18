<?php
require_once 'db.php';

function validateApiKey($key) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM api_keys WHERE key_value = ? AND is_active = 1");
    $stmt->execute([$key]);
    return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
}
?>
