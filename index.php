<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$page = $_GET['page'] ?? 'home';
switch ($page) {
    case 'home':
        $from_index = true;
        include 'pages/home.php';
        break;
    case 'register_reseller':
        $from_index = true;
        include 'pages/register_reseller.php';
        break;
    case 'register_buyer':
        $from_index = true;
        include 'pages/register_buyer.php';
        break;
    case 'register_vendor':
        $from_index = true;
        include 'pages/register_vendor.php';
        break;
    case 'register_investor':
        $from_index = true;
        include 'pages/register_investor.php';
        break;
    case 'register_process_reseller':
        $from_index = true;
        include 'pages/register_process_reseller.php';
        break;
    case 'register_process_buyer':
        $from_index = true;
        include 'pages/register_process_buyer.php';
        break;
    case 'register_process':
        $from_index = true;
        include 'pages/register_process_vendor.php';
        break;
    case 'activate_buyer':
        $from_index = true;
        include 'pages/activate_buyer.php';
        break;
    case 'activate_buyer_process':
        $from_index = true;
        include 'pages/activate_buyer_process.php';
        break;
    case 'register_process_investor':
        // NOTE: pehle iski value bhi 'register_process' thi (duplicate case),
        // is liye ye kabhi chalta hi nahi tha — hamesha upar wala
        // 'register_process' (vendor) hi match ho jata tha. Ab alag
        // value di hai; register_investor.php ke form ka action bhi
        // isi value se match hona chahiye: index.php?page=register_process_investor
        $from_index = true;
        include 'pages/register_process_investor.php';
        break;
    case 'login':
        $from_index = true;
        include 'pages/login.php';
        break;
    case 'dashboards':
        $from_index = true;
        include 'pages/dashboard.php';
        break;
    case 'structure':   // ✅ yeh add karna zaruri hai
        $from_index = true;
        include 'pages/structure.php';
        break;
    case 'logout':
        $from_index = true;
        include 'pages/logout.php';
        break;
    case 'login_process':
        $from_index = true;
        include 'pages/login_process.php';
        break;
    case 'dashboard':   // ✅ default dashboard (ajax wala)
        $from_index = true;
        include 'pages/ajax/dashboard.php';
        break;
    case 'dashboard_vendor':
        $from_index = true;
        include 'pages/ajax/dashboard_vendor.php';
        break;
    case 'dashboard_reseller':
        $from_index = true;
        include 'pages/ajax/reseller/dashboard_reseller.php';
        break;
    case 'dashboard_investor':
        $from_index = true;
        include 'pages/ajax/investor/dashboard_investor.php';
        break;
    case 'dashboard_buyer':
        $from_index = true;
        include 'pages/ajax/buyer/dashboard_buyer.php';
        break;

    case 'products':
        $from_index = true;
        include 'pages/ajax/products/products.php';
        break;
    default:
        echo "<h1 style='color: red; text-align: center;'>❌ 404 - Page Not Found</h1>";
        break;
}