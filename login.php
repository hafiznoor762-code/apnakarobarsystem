<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login — Apna Karobar System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/karobarsystem/assets/css/login.css?v=<?php echo time(); ?>">
</head>
<body>

<!-- ================= TOPBAR ================= -->
<header class="topbar">
  <div class="container topbar-inner">
    <a href="index.php" class="logo-box">
      <img class="header-logo-image" src="/karobarsystem/assets/images/logo.png" alt="Apna Karobar System Logo">
      <span class="brand-name">Apna <span class="blue">Karobar</span> System</span>
    </a>
  </div>
</header>

<!-- ================= LOGIN SECTION ================= -->
<div class="wrapper">
  <div class="container login-grid">

    <!-- LEFT: LOGIN FORM -->
    <div class="form-box">
      <div class="eyebrow">Welcome Back</div>
      <h2>Login</h2>
      <p class="form-sub">Apne account mein dashboard access karne ke liye login karein.</p>

      <?php if (isset($_GET['error'])): ?>
        <p class="form-msg error"><?php echo htmlspecialchars($_GET['error']); ?></p>
      <?php endif; ?>

      <?php if (isset($_GET['success'])): ?>
        <p class="form-msg success"><?php echo htmlspecialchars($_GET['success']); ?></p>
      <?php endif; ?>

      <form action="index.php?page=login_process" method="post">
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
      </form>

      <div class="forgot">
        <a href="index.php?page=forgot_password">Forgot Password?</a>
      </div>
      <p class="signup-text">
        Naya account chahiye? <a href="index.php?page=register_reseller">Register here</a>
      </p>
    </div>

    <!-- RIGHT: PLATFORM HIGHLIGHTS -->
    <aside class="highlight-panel">
      <div class="eyebrow">Apna Karobar System</div>
      <h3>Socho, Samjho, Badho</h3>
      <p>Har roz nayi resellers, buyers aur vendors is platform se judh rahe hain — apna karobar bhi shamil karein.</p>

      <div class="growth-chart" aria-hidden="true">
        <div class="gbar"></div>
        <div class="gbar"></div>
        <div class="gbar"></div>
        <div class="gbar"></div>
        <div class="gbar"></div>
        <div class="gbar"></div>
        <div class="gbar"></div>
      </div>
      <div class="growth-labels">
        <span>M1</span><span>M2</span><span>M3</span><span>M4</span><span>M5</span><span>M6</span><span>M7</span>
      </div>

      <div class="highlight-stats">
        <div class="highlight-stat"><b>2,400+</b><span>Active Resellers</span></div>
        <div class="highlight-stat"><b>500+</b><span>Verified Vendors</span></div>
        <div class="highlight-stat"><b>12%</b><span>Avg. Commission</span></div>
        <div class="highlight-stat"><b>24/7</b><span>Dashboard Access</span></div>
      </div>
    </aside>

  </div>
</div>

<script src="/karobarsystem/assets/js/login.js"></script>
</body>
</html>