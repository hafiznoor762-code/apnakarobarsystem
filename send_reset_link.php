<?php
include('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $token = bin2hex(random_bytes(50)); // unique token

    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->execute([$email]);

    if ($check->rowCount() > 0) {
        $stmt = $conn->prepare("UPDATE users SET reset_token=? WHERE email=?");
        $stmt->execute([$token, $email]);

        // ✅ Yahan apni site ka sahi path likho:
        $resetLink = "https://vizmagic.site/karobarsystem/pages/reset_password.php?token=$token";

        $subject = "Password Reset Link";
        $message = "Click this link to reset your password:\n\n$resetLink";
        $headers = "From: noreply@vizmagic.site";

        mail($email, $subject, $message, $headers);

        echo "✅ Reset link sent to your email.";
    } else {
        echo "❌ Email not found.";
    }
}
?>