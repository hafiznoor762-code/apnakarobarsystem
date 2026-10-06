<?php
include('../config/db.php');

$token = $_POST['token'] ?? '';
$new_password = $_POST['new_password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

if (empty($token) || empty($new_password) || empty($confirm_password)) {
    die("<p style='color:red;text-align:center;'>⚠️ Please fill all fields.</p>");
}

if ($new_password !== $confirm_password) {
    die("<p style='color:red;text-align:center;'>❌ Passwords do not match.</p>");
}

$stmt = $conn->prepare("SELECT id FROM users WHERE reset_token = ?");
$stmt->execute([$token]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("<p style='color:red;text-align:center;'>❌ Invalid or expired token.</p>");
}

$hashed = password_hash($new_password, PASSWORD_BCRYPT);
$update = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL WHERE id = ?");
$update->execute([$hashed, $user['id']]);

echo "<p style='color:green;text-align:center;'>✅ Password updated successfully!</p>";
echo "<script>setTimeout(()=>{window.location.href='login.php';},2000);</script>";
?>