<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Activate Account — Apna Karobar System</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/karobarsystem/assets/css/register.css?v=<?php echo time(); ?>">
</head>
<body>

<!-- ================= TOPBAR ================= -->
<header class="topbar">
  <div class="container topbar-inner">
    <a href="index.php" class="logo-box">
      <img class="header-logo-image" src="/karobarsystem/pages/images/logo.png" alt="Apna Karobar System Logo">
      <span class="brand-name">Apna <span>Karobar</span> System</span>
    </a>
    <nav class="topbar-links">
      <a href="index.php">Home</a>
      <a href="index.php?page=login">Login</a>
    </nav>
  </div>
</header>

<!-- ================= ACTIVATE SECTION ================= -->
<section class="auth-wrap">
  <div class="container auth-grid">

    <!-- LEFT: FORM -->
    <div class="form-panel">
      <div class="eyebrow">Buyer Activation</div>
      <h2>Activate Your Account</h2>
      <p class="form-sub">Apna registered email, activation code aur referral email fill karein — account activate ho jayega.</p>

      <?php if (isset($_GET['error'])): ?>
        <div id="formMsg" class="form-msg form-msg-error show">
          ⚠️ <?php echo htmlspecialchars($_GET['error']); ?>
        </div>
      <?php endif; ?>

      <?php if (isset($_GET['success'])): ?>
        <div id="formMsg" class="form-msg show">
          ✅ <?php echo htmlspecialchars($_GET['success']); ?>
        </div>
      <?php endif; ?>

      <form id="activateForm" action="index.php?page=activate_buyer_process" method="post">

        <div class="level-box">
          <div class="level-title">🔓 Account Activation</div>

          <input type="email" name="user_email" placeholder="Enter Your Email" required>
          <input type="text" name="activation_code" placeholder="Enter Activation Code" required>
          <input type="email" name="referral_email" placeholder="Referral Email" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Activate Account</button>
      </form>

      <p class="login-text">Already have an account? <a href="index.php?page=login">Login</a></p>
    </div>

  </div>
</section>

<footer class="mini-footer">&copy; 2026 Apna Karobar System — all rights reserved.</footer>

<script>
// Submit button ko dobara-click se bachane ke liye disable kar dete hain —
// backend mein transaction-based fix pehle se hai, ye sirf UX ke liye extra hai.
document.getElementById('activateForm').addEventListener('submit', function () {
  const btn = this.querySelector('button[type="submit"]');
  btn.disabled = true;
  btn.textContent = 'Activating...';
});
</script>

</body>
</html>