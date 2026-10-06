<?php
include('../config/db.php');
$token = $_GET['token'] ?? '';

if (empty($token)) {
  die("<p style='color:red;text-align:center;'>❌ Invalid or expired token.</p>");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reset Password</title>
</head>
<body>
  <h2>Reset Your Password</h2>
  <form action="reset_process.php" method="POST">
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
    <input type="password" name="new_password" placeholder="Enter new password" required><br>
    <input type="password" name="confirm_password" placeholder="Confirm password" required><br>
    <button type="submit">Reset Password</button>
  </form>
</body>
</html>