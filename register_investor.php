<?php
$ref_email = isset($_GET['ref']) ? htmlspecialchars($_GET['ref']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Create Investor Account — Apna Karobar System</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/karobarsystem/assets/css/register.css?v=<?php echo time(); ?>">
</head>
<body>

<!-- ================= TOPBAR ================= -->
<header class="topbar">
  <div class="container topbar-inner">
    <a href="index.php" class="logo-box">
      <img class="header-logo-image" src="/karobarsystem/assets/images/logo.png" alt="Apna Karobar System Logo">
      <span class="brand-name">Apna <span>Karobar</span> System</span>
    </a>
    <nav class="topbar-links">
      <a href="index.php">Home</a>
      <a href="index.php?page=login">Login</a>
    </nav>
  </div>
</header>

<!-- ================= AUTH SECTION ================= -->
<section class="auth-wrap">
  <div class="container auth-grid">

    <!-- LEFT: FORM -->
    <div class="form-panel">
      <div class="eyebrow">Investor Registration</div>
      <h2>Create Investor Account</h2>
      <p class="form-sub">Growing businesses mein invest karein aur apni earning ka progress dashboard se track karein.</p>

      <div id="formMsg" class="form-msg">✅ Aapki registration submit ho gayi hai. Form clear kar diya gaya hai.</div>

      <form id="investorForm" action="index.php?page=register_process_investor" method="post">

        <input type="hidden" name="ref_email" value="<?php echo $ref_email; ?>">

        <div class="level-box">
          <div class="level-title">🔹 Basic Information</div>

          <input type="text" name="full_name" placeholder="Full Name" required>
          <input type="email" name="email" placeholder="Email Address" required>

          <div class="password-box">
            <input type="password" id="password" name="password" placeholder="Password" required>
            <span onclick="togglePassword('password')">👁️</span>
          </div>
          <div class="password-box">
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
            <span onclick="togglePassword('confirm_password')">👁️</span>
          </div>

          <input type="text" name="mobile" placeholder="Mobile Number" required>
          <input type="text" name="whatsapp" placeholder="WhatsApp Number" required>

          <div class="row">
            <input type="text" name="easypaisa_name" placeholder="Easypaisa Name" required>
            <input type="text" name="easypaisa_number" placeholder="Easypaisa Number" required>
          </div>

          <input type="text" name="qualification" placeholder="Qualification" required>
          <input type="text" name="city_name" placeholder="City" required>
          <input type="text" name="address" placeholder="Address" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Register Investor</button>
      </form>

      <div class="switch-account">
        <p>Want another account?</p>
        <div class="chip-links">
          <a href="index.php?page=register_reseller">Reseller</a>
          <a href="index.php?page=register_buyer">Buyer</a>
          <a href="index.php?page=register_vendor">Vendor</a>
        </div>
      </div>

      <p class="login-text">Already have an account? <a href="index.php?page=login">Login</a></p>
    </div>

    <!-- RIGHT: GROWTH PANEL -->
    <aside class="growth-panel">
      <div class="eyebrow">Investor Growth</div>
      <h3>Apni investment ko barhte dekhein</h3>
      <p>Active reseller network mein invest karein aur apni earning ka progress dashboard se track karein.</p>

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

      <div class="growth-stats">
        <div class="growth-stat"><span>Active Reseller Network</span><b>2,400+</b></div>
        <div class="growth-stat"><span>Avg. Payout Cycle</span><b>Weekly</b></div>
        <div class="growth-stat"><span>Platform Transparency</span><b>Full</b></div>
      </div>
    </aside>

  </div>
</section>

<!-- ================= PRODUCTS ================= -->
<section class="products-section">
  <div class="container">
    <div class="products-head">
      <div>
        <div class="eyebrow">Marketplace</div>
        <h2 style="margin-bottom:0;">Jin Products Mein Growth Ho Rahi Hai</h2>
      </div>
      <div class="rail-nav">
        <button class="rail-btn" id="railPrev" aria-label="Scroll left">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
        </button>
        <button class="rail-btn" id="railNext" aria-label="Scroll right">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
        </button>
      </div>
    </div>

    <div class="products-rail" id="productsRail">
      <!-- PHP note: replace this static block with your products foreach loop (see home.php for the pattern) -->
      <div class="product-card">
        <img class="product-card-img" src="../assets/images/sample1.jpg" alt="Product">
        <div class="product-card-body">
          <h4>Wireless Earbuds Pro</h4>
          <span class="product-price">Rs 3,499</span>
        </div>
      </div>
      <div class="product-card">
        <img class="product-card-img" src="../assets/images/sample2.jpg" alt="Product">
        <div class="product-card-body">
          <h4>Smart Fitness Band</h4>
          <span class="product-price">Rs 2,199</span>
        </div>
      </div>
      <div class="product-card">
        <img class="product-card-img" src="../assets/images/sample3.jpg" alt="Product">
        <div class="product-card-body">
          <h4>Portable Speaker</h4>
          <span class="product-price">Rs 4,999</span>
        </div>
      </div>
      <div class="product-card">
        <img class="product-card-img" src="../assets/images/sample4.jpg" alt="Product">
        <div class="product-card-body">
          <h4>Leather Wallet</h4>
          <span class="product-price">Rs 1,299</span>
        </div>
      </div>
      <div class="product-card">
        <img class="product-card-img" src="../assets/images/sample5.jpg" alt="Product">
        <div class="product-card-body">
          <h4>Kitchen Organizer Set</h4>
          <span class="product-price">Rs 1,899</span>
        </div>
      </div>
    </div>
  </div>
</section>

<footer class="mini-footer">&copy; 2026 Apna Karobar System — all rights reserved.</footer>

<script>
function togglePassword(id){
  let input = document.getElementById(id);
  input.type = input.type === "password" ? "text" : "password";
}

const rail = document.getElementById('productsRail');
const prev = document.getElementById('railPrev');
const next = document.getElementById('railNext');
if (rail && prev && next) {
  prev.addEventListener('click', () => rail.scrollBy({ left: -260, behavior: 'smooth' }));
  next.addEventListener('click', () => rail.scrollBy({ left: 260, behavior: 'smooth' }));
}

document.getElementById('investorForm').addEventListener('submit', function (e) {
  e.preventDefault();
  const form = e.target;
  const msg = document.getElementById('formMsg');

  fetch(form.action, { method: 'POST', body: new FormData(form) })
    .then(res => res.text())
    .then(() => {
      form.reset();
      msg.classList.add('show');
      setTimeout(() => msg.classList.remove('show'), 4000);
    })
    .catch(() => {
      alert('Registration mein masla aaya, dobara try karein.');
    });
});
</script>

</body>
</html>
