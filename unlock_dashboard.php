<?php
require_once __DIR__ . '/../config/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "unauthorized";
    exit;
}

$user_id = $_SESSION['user_id'];
$entered_code = trim($_POST['code'] ?? '');

if ($entered_code === '') {
    echo "empty";
    exit;
}

try {
    $stmt = $conn->prepare("SELECT unlock_codes FROM users WHERE id = :id");
    $stmt->bindParam(':id', $user_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && !empty($row['unlock_codes'])) {
        $codes = array_map('trim', explode(',', $row['unlock_codes']));
        if (in_array($entered_code, $codes)) {
            echo "success";
        } else {
            echo "failed";
        }
    } else {
        echo "nocodes";
    }
} catch (Exception $e) {
    echo "error";
}
?>