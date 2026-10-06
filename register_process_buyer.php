<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 🔹 BASIC INFO
    $name          = trim($_POST['full_name']);
    $email         = trim($_POST['email']);
    $password      = $_POST['password'];
    $confirm       = $_POST['confirm_password'];
    $mobile        = trim($_POST['mobile']);
    $whatsapp      = trim($_POST['whatsapp']);
    $city          = trim($_POST['city']);
    $address       = trim($_POST['address']);
    $qualification = trim($_POST['qualification'] ?? '');

    // 🔹 PRODUCT
    $product_pin       = trim($_POST['product_pin']);
    $purchase_name     = trim($_POST['purchase_name'] ?? '');
    $purchase_contact  = trim($_POST['purchase_contact'] ?? '');
    $purchase_address  = trim($_POST['purchase_address'] ?? '');
    $product_qty       = (int) ($_POST['product_qty'] ?? 1);

    $category = "buyer";

    // ✅ PASSWORD CHECK
    if ($password !== $confirm) {
        die("❌ Passwords do not match");
    }
    $password = password_hash($password, PASSWORD_BCRYPT);

    try {
        // ✅ EMAIL CHECK
        $check = $conn->prepare("SELECT id FROM users WHERE email=?");
        $check->execute([$email]);
        if ($check->rowCount() > 0) {
            die("❌ Email already exists");
        }

        // ✅ PRODUCT PIN CHECK
        $product = $conn->prepare("SELECT * FROM products WHERE pin=?");
        $product->execute([$product_pin]);
        if ($product->rowCount() == 0) {
            die("❌ Invalid Product PIN");
        }

        // ✅ INSERT USER (NO REFERRAL, NO ACTIVATION)
        $stmt = $conn->prepare("
        INSERT INTO users
        (full_name,email,password,mobile,whatsapp,city,address,qualification,category,product_code,status)
        VALUES (?,?,?,?,?,?,?,?,?,?,?)
        ");
        if (!$stmt->execute([
            $name, $email, $password, $mobile, $whatsapp, $city, $address, $qualification,
            $category, $product_pin, 'pending'
        ])) {
            print_r($stmt->errorInfo());
            exit;
        }

        $user_id = $conn->lastInsertId();

        // ✅ BUYER TABLE — ab purchaser ki detail aur product PIN bhi save hogi
        $buyerStmt = $conn->prepare("
            INSERT INTO buyer_details
            (user_id, product_pin, purchase_name, purchase_contact, purchase_address, product_qty)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $buyerStmt->execute([$user_id, $product_pin, $purchase_name, $purchase_contact, $purchase_address, $product_qty]);

        // ✅ SUCCESS
        header("Location: index.php?page=activate_buyer");
        exit;

    } catch (PDOException $e) {
        echo "❌ SQL Error: <br>";
        print_r($e->errorInfo);
        exit;
    }
}
