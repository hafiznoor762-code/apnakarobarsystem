<?php
  error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once __DIR__ . '/../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: /karobarsystem/index.php?page=login");
    exit;
}

$user_name = $_SESSION['user_name'] ?? "User";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Select Dashboard</title>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <link rel="stylesheet" href="/karobarsystem/assets/css/structure.css?v=<?php echo time(); ?>">
</head>

<body>

<!-- 🔹 TOPBAR -->
<header class="topbar">
  <div class="topbar-inner">
    <div class="logo-box">
      <img src="../solid/dist/images/logo.svg" alt="Logo">
      <span class="brand-name">
        <span class="blue">Apna</span>Karobar<span class="blue">System</span>
      </span>
    </div>

    <div style="color:#fff;">
        👋 <?php echo htmlspecialchars($user_name); ?>
    </div>
  </div>
</header>

<!-- 🔹 CATEGORY SELECTION -->
<div class="category-wrapper">

    <h2>Select Your Dashboard</h2>

    <div class="category-box">

        <button class="dashboard-btn" data-page="ajax/reseller/dashboard_reseller.php">
            🧑‍💼 Reseller Dashboard
        </button>

        <button class="dashboard-btn" data-page="ajax/buyer/dashboard_buyer.php">
            🛒 Buyer Dashboard
        </button>

        <button class="dashboard-btn" data-page="ajax/vendor/dashboard_vendor.php">
            🏪 Vendor Dashboard
        </button>

        <button class="dashboard-btn" data-page="ajax/investor/dashboard_investor.php">
            💰 Investor Dashboard
        </button>

    </div>

</div>

<!-- 🔹 MAIN CONTENT -->
<div id="main-content"></div>

<script src="/karobarsystem/assets/js/structure.js?v=<?php echo time(); ?>"></script>

</body>
</html>