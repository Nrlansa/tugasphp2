<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "tugas13";
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Koneksi database gagal: " . $e->getMessage();
    exit;
}
function insertProduct($productName, $productPrice, $productdes, $productCategory, $productBy)
{
    global $pdo;
    $stmt = $pdo->prepare("
        INSERT INTO products (name, price, description, category_id, status, created_at, updated_at, created_by)
        VALUES (?, ?, ?, ?, ?, NOW(), NOW(), ?)
    ");
    $status = 'waiting';
    $stmt->execute([$productName, $productPrice, $productdes, $productCategory, $status, $productBy]);
    return "Produk " . $productName . " berhasil ditambahkan";
}

$productName = "citra";
$productPrice = 15000;
$productCategory = 15;
$productdes = "produk kecantikan";
$productBy = 1;

$result = insertProduct($productName, $productPrice, $productdes, $productCategory, $productBy);
echo $result;
