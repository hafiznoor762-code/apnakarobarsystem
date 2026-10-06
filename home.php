 
<?php
if (!isset($from_index)) {
    header("Location: index.php");
    exit;
}

require_once __DIR__ . '/../config/db.php';

$stmt = $conn->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 6");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Apna Karobar System</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="./solid/dist/css/style.css?v=<?php echo time(); ?>">
</head>
<body>

<!-- ================= HEADER ================= -->
<header class="site-header">
  <div class="container site-header-inner">
    <a href="#" class="brand">
      <img src="/karobarsystem/pages/images/logo.png" alt="Apna Karobar System" class="brand-mark">
      <div>
        <div class="brand-name">Apna <span>Karobar</span> System</div>
        <div class="brand-tag">Socho &bull; Samjho &bull; Badho</div>
      </div>
    </a>

    <nav class="nav-links">
      <a href="#features">Account Types</a>
      <a href="#products">Products</a>
      <a href="#pricing">Pricing</a>
      <a href="index.php?page=login">Login</a>
    </nav>

    <div class="header-cta">
      <a href="index.php?page=login" class="btn btn-outline btn-sm">Login</a>
      <a href="index.php?page=register_reseller" class="btn btn-primary btn-sm">Start Free</a>
    </div>
  </div>
</header>

<!-- ================= HERO ================= -->
<section class="hero">
  <div class="container hero-inner">
    <div class="hero-copy">
      <div class="eyebrow">Apna Business, Apne Usool</div>
      <h1 class="hero-title">Apna karobar <em>online</em> shuru karein, sahi tareeqe se</h1>
      <p class="hero-paragraph">
        Buyer ho, vendor, reseller ya investor — Apna Karobar System aapko ek hi platform par
        business grow karne, kamane aur manage karne ki poori suhoolat deta hai, kahin se bhi.
      </p>
      <div class="hero-cta">
        <a href="index.php?page=register_reseller" class="btn btn-primary">Start With Free</a>
        <a href="index.php?page=products" class="btn btn-outline">Buy Product &amp; Earn</a>
      </div>
      <div class="hero-stats">
        <div class="hero-stat"><b>4</b><span>Account Types</span></div>
        <div class="hero-stat"><b>100%</b><span>Online Setup</span></div>
        <div class="hero-stat"><b>24/7</b><span>Dashboard Access</span></div>
      </div>
    </div>

    <div class="hero-figure" aria-hidden="true">
      <div class="bar"></div>
      <div class="bar green"></div>
      <div class="bar"></div>
      <div class="bar green"></div>
      <div class="bar"></div>
      <div class="bar green"></div>
      <div class="bar"></div>
      <svg class="arrow" viewBox="0 0 100 100" fill="none">
        <path d="M10 80 C 30 60, 50 55, 90 20" stroke="#2fa83f" stroke-width="5" stroke-linecap="round"/>
        <path d="M70 18 L92 18 L92 40" stroke="#2fa83f" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>
  </div>
</section>

<!-- ================= FEATURES / ACCOUNT TYPES ================= -->
<section class="section" id="features">
  <div class="container">
    <div class="section-head">
      <div class="eyebrow">Choose Your Role</div>
      <h2 class="section-title">Har account type, apne kaam ke liye</h2>
      <p>Jo bhi aapka business goal ho, uske mutabiq account choose karein aur foran shuru karein.</p>
    </div>

    <div class="features-grid">

      <div class="feature-card">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6"/></svg>
        </div>
        <h4>Reseller Account</h4>
        <p>Apni network banayein, products resell karein aur har sale par commission kamayein.</p>
        <a href="index.php?page=register_reseller" class="feature-link">Register as Reseller &rarr;</a>
      </div>

      <div class="feature-card">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2l1.5 5M18 2l-1.5 5M4 7h16l-1.5 12h-13z"/></svg>
        </div>
        <h4>Buyer Account</h4>
        <p>Trusted vendors se seedha khareedari karein, best price aur fast delivery ke sath.</p>
        <a href="index.php?page=register_buyer" class="feature-link">Register as Buyer &rarr;</a>
      </div>

      <div class="feature-card">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7l9-4 9 4-9 4-9-4zm0 5l9 4 9-4M3 17l9 4 9-4"/></svg>
        </div>
        <h4>Vendor Account</h4>
        <p>Apne products list karein, orders manage karein aur apna storefront online le jayein.</p>
        <a href="index.php?page=register_vendor" class="feature-link">Register as Vendor &rarr;</a>
      </div>

      <div class="feature-card">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 17l6-6 4 4 8-8M21 7v6h-6"/></svg>
        </div>
        <h4>Investor Account</h4>
        <p>Growing businesses mein invest karein aur apni earning ka progress dashboard se track karein.</p>
        <a href="index.php?page=register_investor" class="feature-link">Register as Investor &rarr;</a>
      </div>

      <div class="feature-card">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7H4a1 1 0 00-1 1v11a1 1 0 001 1h16a1 1 0 001-1V8a1 1 0 00-1-1zM16 7V5a4 4 0 00-8 0v2"/></svg>
        </div>
        <h4>Selling Product Account</h4>
        <p>Apne products marketplace par list karke direct customers tak pohanchayein.</p>
        <a href="index.php?page=products" class="feature-link">Start Selling &rarr;</a>
      </div>

      <div class="feature-card">
        <div class="feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 016.5 17H20M4 4.5A2.5 2.5 0 016.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15z"/></svg>
        </div>
        <h4>Buy Course</h4>
        <p>Business skills seekhein — practical courses jo aapka karobar tez tar grow karein.</p>
        <a href="#" class="feature-link">Explore Courses &rarr;</a>
      </div>

    </div>
  </div>
</section>

<!-- ================= PRODUCTS (horizontal scroll rail) ================= -->
<section class="section products-section" id="products">
  <div class="container">
    <div class="products-head">
      <div>
        <div class="eyebrow">Marketplace</div>
        <h2 class="section-title" style="margin-bottom:0;">Our Products</h2>
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

    <div class="products-rail-wrap">
      <div class="products-rail" id="productsRail">

        <!-- PHP note: replace this block with <?php foreach($products as $product): ?> ... <?php endforeach; ?> -->
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

        <div class="product-card">
          <img class="product-card-img" src="../assets/images/sample6.jpg" alt="Product">
          <div class="product-card-body">
            <h4>Office Desk Lamp</h4>
            <span class="product-price">Rs 2,599</span>
          </div>
        </div>

      </div>
    </div>

    <div class="products-footer-cta">
      <a href="index.php?page=products" class="btn btn-outline">View All Products</a>
    </div>
  </div>
</section>

<!-- ================= PRICING ================= -->
<section class="section" id="pricing">
  <div class="container">
    <div class="section-head" style="margin:0 auto 40px;text-align:center;max-width:560px;">
      <div class="eyebrow" style="justify-content:center;">Unlimited For All</div>
      <h2 class="section-title">Simple, seedha pricing</h2>
      <p>Koi chupi hui fees nahi — jo milta hai, saaf saaf.</p>
    </div>

    <div class="pricing-card">
      <div class="price">$49<span>/month</span></div>
      <ul class="pricing-features">
        <li>Full dashboard access — sab account types</li>
        <li>Unlimited product listings</li>
        <li>Referral &amp; commission tracking</li>
        <li>Priority WhatsApp support</li>
      </ul>
      <a href="#" class="btn btn-primary" style="width:100%;">Pre Order Now</a>
    </div>
  </div>
</section>

<!-- ================= CTA BANNER ================= -->
<section class="section">
  <div class="container">
    <div class="cta-banner">
      <h3>Abhi tak convince nahi huay? Chaliye baat karte hain.</h3>
      <a href="#" class="btn btn-primary">Get in Touch</a>
    </div>
  </div>
</section>

<!-- ================= FOOTER ================= -->
<footer class="site-footer">
  <div class="container">
    <div class="footer-top">
      <a href="#" class="brand">
        <img src="images/logo.png" alt="Apna Karobar System" class="brand-mark" style="width:38px;height:38px;">
        <div class="brand-name" style="font-size:16px;">Apna <span>Karobar</span> System</div>
      </a>

      <ul class="footer-links">
        <li><a href="#">Contact</a></li>
        <li><a href="#">About us</a></li>
        <li><a href="#">FAQ's</a></li>
        <li><a href="#">Support</a></li>
      </ul>

      <div class="footer-social">
        <a href="https://wa.me/923275335960" target="_blank" aria-label="WhatsApp">
          <svg viewBox="0 0 32 32" fill="#2fa83f"><path d="M16 2.9c-7.2 0-13 5.8-13 13 0 2.3.6 4.5 1.8 6.4L3 29l6.9-1.8c1.8 1 3.9 1.6 6.1 1.6 7.2 0 13-5.8 13-13S23.2 2.9 16 2.9zm0 23.7c-2 0-4-.5-5.7-1.5l-.4-.2-4.1 1.1 1.1-4-.3-.4c-1.1-1.8-1.7-3.9-1.7-6.1 0-6 4.9-10.9 10.9-10.9S26.9 9 26.9 15 22 26.6 16 26.6z"/></svg>
        </a>
        <a href="https://instagram.com/YOUR_USERNAME" target="_blank" aria-label="Instagram">
          <svg viewBox="0 0 24 24" fill="#10140f"><path d="M7 2C4.2 2 2 4.2 2 7v10c0 2.8 2.2 5 5 5h10c2.8 0 5-2.2 5-5V7c0-2.8-2.2-5-5-5H7zm10 2c1.7 0 3 1.3 3 3v10c0 1.7-1.3 3-3 3H7c-1.7 0-3-1.3-3-3V7c0-1.7 1.3-3 3-3h10zm-5 3c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zm0 2c1.7 0 3 1.3 3 3s-1.3 3-3 3-3-1.3-3-3 1.3-3 3-3z"/></svg>
        </a>
        <a href="#" aria-label="Facebook">
          <svg viewBox="0 0 16 16" fill="#10140f"><path d="M6.023 16L6 9H3V6h3V4c0-2.7 1.672-4 4.08-4 1.153 0 2.144.086 2.433.124v2.821h-1.67c-1.31 0-1.563.623-1.563 1.536V6H13l-1 3H9.28v7H6.023z"/></svg>
        </a>
      </div>
    </div>

    <div class="footer-copyright">&copy; 2026 Apna Karobar System — all rights reserved.</div>
  </div>
</footer>

<script>
  // Horizontal rail arrow-button scroll
  const rail = document.getElementById('productsRail');
  const prev = document.getElementById('railPrev');
  const next = document.getElementById('railNext');
  const scrollAmount = 280;
  if (rail && prev && next) {
    prev.addEventListener('click', () => rail.scrollBy({ left: -scrollAmount, behavior: 'smooth' }));
    next.addEventListener('click', () => rail.scrollBy({ left: scrollAmount, behavior: 'smooth' }));
  }
</script>

</body>
</html>