<?php
$host = 'localhost';
$dbname = 'u910619137_fewaew';
$username = 'u910619137_faizan123alia1';
$password = '1234567890sAmi$';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Database Connected Successfully!";
} catch (PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage());
}
?>