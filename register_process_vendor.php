<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ✅ Inputs
    $name       = trim($_POST['full_name'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $mobile     = trim($_POST['mobile'] ?? '');
    $whatsapp   = trim($_POST['whatsapp'] ?? '');
    $qualification = trim($_POST['qualification'] ?? '');

    $easypaisa_name   = trim($_POST['easypaisa_name'] ?? '');
    $easypaisa_number = trim($_POST['easypaisa_number'] ?? '');

    $password         = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // ✅ FIX: this is the VENDOR registration file — category must be "vendor",
    // not "reseller" (previous version had this hardcoded wrong).
    $category = "vendor";

    // ✅ Password check
    if ($password !== $confirm_password) {
        die("❌ Passwords do not match");
    }

    // ✅ Hash password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    try {

        // ✅ Check duplicate email
        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->execute([$email]);

        if ($check->rowCount() > 0) {
            die("❌ Email already registered.");
        }

        // ✅ Optional fields
        $city    = $_POST['city_name'] ?? null;
        $address = $_POST['address'] ?? null;

        // ✅ Vendor ke liye null fields (same as reseller — no upliner/product code at signup)
        $upliner_email = null;
        $product_code  = null;

        // ✅ Vendor account is active immediately (free account, no purchase/activation needed)
        $status = "active";

        // ✅ Insert user — moved BEFORE any lastInsertId() call
        // (previous version called lastInsertId() before this ran, which
        // always returned a stale/wrong id).
        $stmt = $conn->prepare("
            INSERT INTO users
            (full_name,email,mobile,whatsapp,qualification,password,category,
            easypaisa_name,easypaisa_number,referred_by_email,city,address,product_code,status)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)
        ");

        $stmt->execute([
            $name,
            $email,
            $mobile,
            $whatsapp,
            $qualification,
            $hashed_password,
            $category,
            $easypaisa_name,
            $easypaisa_number,
            $upliner_email,
            $city,
            $address,
            $product_code,
            $status
        ]);

        // ✅ Get inserted user id — now called AFTER the insert actually runs
        $user_id = $conn->lastInsertId();

        // ✅ FIX: insert into vendor_details (previous version inserted into
        // reseller_details by mistake, and did it twice).
        $conn->prepare("INSERT INTO vendor_details (user_id) VALUES (?)")
             ->execute([$user_id]);

        // ✅ FIX: removed the INSERT INTO `user_tree` block — that table does
        // not exist in this database (the real tree table is `network_tree`,
        // handled by engine/placement_engine.php). A vendor is a root account
        // like reseller — it does not need a network_tree row at signup time;
        // it only gets placed if/when someone refers them, the same way
        // resellers work.

        // ✅ Redirect with success
        header("Location: index.php?page=login&success=Vendor account created successfully");
        exit;

    } catch (PDOException $e) {
        die("❌ Error: " . $e->getMessage());
    }
}
?>