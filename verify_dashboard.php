<?php
// /karobarsystem/pages/verify_dashboard.php
session_start();
header('Content-Type: application/json');

// include PDO DB (your file)
require_once(__DIR__ . "/../config/db.php");

// make sure user logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status"=>"error","message"=>"Not logged in"]);
    exit;
}

$user_id = (int) $_SESSION['user_id'];
$code = $_POST['code'] ?? '';
$dashboard = $_POST['dashboard'] ?? '';

$dashboard = trim($dashboard);
$code = trim($code);

// validate input
if ($code === '' || $dashboard === '') {
    echo json_encode(["status"=>"error","message"=>"Missing code or dashboard"]);
    exit;
}

// valid dashboard slugs (for safety)
$valid = ['buyer','vendor','investor','reseller'];
if (!in_array($dashboard, $valid, true)) {
    echo json_encode(["status"=>"error","message"=>"Invalid dashboard"]);
    exit;
}

try {
    // PDO prepared statement
    $stmt = $conn->prepare("SELECT unlock_code FROM users WHERE id = :id LIMIT 1");
    $stmt->execute([':id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo json_encode(["status"=>"error","message"=>"User not found"]);
        exit;
    }

    // Compare unlock code (exact match). If you want case-insensitive: use strcasecmp
    if ($user['unlock_code'] !== null && $user['unlock_code'] === $code) {
        // Optionally update users.dashboard_access to the unlocked dashboard
        $u = $conn->prepare("UPDATE users SET dashboard_access = :dash WHERE id = :id");
        $u->execute([':dash' => $dashboard, ':id' => $user_id]);

        // store unlocked info in session (optional)
        $_SESSION['dashboard_access'] = $dashboard;

        // Build redirect URL — consistent with your folder layout:
        $redirect = "/karobarsystem/pages/ajax/{$dashboard}/dashboard_{$dashboard}.php";

        echo json_encode([
            "status" => "success",
            "message" => ucfirst($dashboard)." unlocked",
            "redirect" => $redirect
        ]);
        exit;
    } else {
        echo json_encode(["status"=>"error","message"=>"Incorrect code"]);
        exit;
    }

} catch (Exception $e) {
    echo json_encode(["status"=>"error","message"=>"Server error"]);
    // For debugging (remove on production): echo json_encode(["status"=>"error","message"=>$e->getMessage()]);
    exit;
}