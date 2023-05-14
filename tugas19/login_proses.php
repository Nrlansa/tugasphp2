<?php
// Konfigurasi koneksi database
$host = "localhost";
$username = "root";
$password = "";
$database = "arkatama_store";

// Membuat koneksi ke database
$conn = mysqli_connect($host, $username, $password, $database);

// Memeriksa apakah koneksi berhasil atau gagal
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Cek apakah ada data yang dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil dari input email dan password
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Query untuk memeriksa keberadaan pengguna dengan email dan password yang sesuai
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    // Memeriksa apakah query berhasil atau gagal
    if ($result) {
        // Memeriksa apakah ada pengguna dengan email dan password yang sesuai
        if (mysqli_num_rows($result) == 1) {
            // Mulai sesi
            session_start();

            // Simpan informasi pengguna dalam sesi
            $_SESSION["email"] = $email;

            // Redirect ke halaman user.php
            header("Location: user.php");
            exit;
        } else {
            // Jika login gagal, tampilkan pesan error atau redirect kembali ke halaman login.php
            $error_message = "Email atau password anda salah. Silakan coba lagi.";
            header("Location: login.php?error=" . urlencode($error_message));
            exit;
        }
    } else {
        // Jika query gagal, tampilkan pesan error atau redirect kembali ke halaman login.php
        $error_message = "Terjadi kesalahan saat melakukan query. Silakan coba lagi.";
        header("Location: login.php?error=" . urlencode($error_message));
        exit;
    }
} else {
    // Jika tidak ada data yang dikirimkan melalui metode POST, redirect kembali ke halaman login.php
    header("Location: login.php");
    exit;
}

// Menutup koneksi database
mysqli_close($conn);
