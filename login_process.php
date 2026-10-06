<?php
session_start();
require_once __DIR__ . '/../config/db.php';

// Input sanitize
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

// Basic validation
if (empty($email) || empty($password)) {
    header("Location: index.php?page=login&error=Please fill all fields");
    exit;
}

try {
    // ✅ Step 1: Get user by email only
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // ❌ If user not found OR password incorrect
    if (!$user || !password_verify($password, $user['password'])) {
        header("Location: index.php?page=login&error=Invalid email or password");
        exit;
    }

    // ❌ Optional: Check user status (if you use it)
    if (isset($user['status']) && $user['status'] !== 'active') {
        header("Location: index.php?page=login&error=Account inactive");
        exit;
    }

    // ✅ SESSION SET
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $user['category'];
    $_SESSION['full_name'] = $user['full_name'];

    // ✅ Role based redirect
    switch ($user['category']) {

        case 'buyer':
            header("Location: index.php?page=dashboard_buyer");
            break;

        case 'reseller':
            header("Location: index.php?page=dashboard_reseller");
            break;

        case 'vendor':
            header("Location: index.php?page=dashboard_vendor");
            break;

        case 'investor':
            header("Location: index.php?page=dashboard_investor");
            break;

        default:
            header("Location: index.php?page=login&error=Invalid role");
            break;
    }

    exit;

} catch (PDOException $e) {
    // Debug ke liye (production me hide karna)
    die("Database Error: " . $e->getMessage());
}
?>