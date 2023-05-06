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
function insertCategories($categoryName)
{
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO categories (name, created_at, updated_at) VALUES (?, NOW(), NOW())");
    $stmt->execute([$categoryName]);
    return "Kategori " . $categoryName . " berhasil ditambahkan";
}


$categoryName = insertCategories("Kecantikan");


echo $categoryName;
