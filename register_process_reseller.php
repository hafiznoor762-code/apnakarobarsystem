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
    $city       = trim($_POST['city'] ?? '');
    $address    = trim($_POST['address'] ?? '');
    $password         = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    // ✅ Fixed category
    $category = "reseller";

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
        $city = $_POST['city_name'] ?? null;
        $address = $_POST['address'] ?? null;

        // ✅ Reseller ke liye null fields
        $upliner_email = null;
        $product_code  = null;

        // ✅ IMPORTANT: status = active (free account)
        $status = "active";

        // ✅ Insert user
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

        // ✅ Get inserted user id
        $user_id = $conn->lastInsertId();

        // ✅ Insert into reseller_details
        $conn->prepare("INSERT INTO reseller_details (user_id) VALUES (?)")
             ->execute([$user_id]);

        // ✅ 

        // ✅ Redirect with success
        header("Location: index.php?page=login&success=Account created successfully");
        exit;

    } catch (PDOException $e) {
        die("❌ Error: " . $e->getMessage());
    }
}
?>