<?php
session_start();

$_SESSION['success_message'] = "Anda berhasil login!";

// Periksa apakah pesan notifikasi tersedia
if (isset($_SESSION['success_message'])) {
    $successMessage = $_SESSION['success_message'];

    // Hapus pesan notifikasi dari sesi
    unset($_SESSION['success_message']);
}

// memastikan pengguna sudah login
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit;
}

$email = $_SESSION["email"];

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

// Menghapus data pengguna dari database
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $query = "DELETE FROM users WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query gagal: " . mysqli_error($conn));
    }
}

// Mengambil data pengguna dari database
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

// Memeriksa apakah query berhasil atau gagal
if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Tabel User</title>
    <!------Link CSS Bootstrap v.5.2.0------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/css/bootstrap.min.css">
    <!-------Link CSS Font Awesome v.5.15.4 -------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>

    <div class="container">
        <?php if (isset($successMessage)) : ?>
            <div class="alert alert-success mt-4" role="alert">
                <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>
        <h2 class="mt-4">Tabel user</h2>
        <div class="row">
            <div class="col-md-12 ">
                <div class="float-end">
                    <form class="container-fluid justify-content-start">
                        <a href="tambah.php" class="btn btn-primary mb-3"><i class="fas fa-plus mx-2"></i>Tambah Data</a>
                        <a href="logout.php" class="btn btn-danger mb-3"><i class="fas fa-sign-out-alt mx-2"></i>Logout</a>
                    </form>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Aksi</th>
                        <th>Nama</th>
                        <th>Avatar</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Mengambil data pengguna dari database
                    $query = "SELECT * FROM users";
                    $result = mysqli_query($conn, $query);

                    // Memeriksa apakah query berhasil atau gagal
                    if (!$result) {
                        die("Query gagal: " . mysqli_error($conn));
                    }
                    // Menampilkan data pengguna ke dalam tabel
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>
                            <a href='edituser.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'><i class='far fa-edit mx-1'></i>Edit</a>
                            <a href='lihat.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'><i class='fas fa-eye mx-1'></i>Lihat</a>
                            <a href='?delete=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'><i class='fas fa-trash-alt mx-1'></i>Hapus</a>
                        </td>";
                        echo "<td>" . $row['nama'] . "</td>";
                        echo "<td><img src='avatar/" . $row['avatar'] . "' alt='Avatar' class='avatar' width='50px' height='50px'></td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['phone'] . "</td>";
                        echo "<td>" . $row['role'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Link JS Bootstrap v.5.2.0-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/js/bootstrap.bundle.min.js"></script>
    <!-- Link Font Awesome v.5.15.4 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <!------- JS agar notif hilang dalam 10s------->
    <script>
        setTimeout(function() {
            document.querySelector('.alert').style.display = 'none';
        }, 10000);
    </script>
</body>

</html>

<?php
// Menutup koneksi database
mysqli_close($conn);
?>