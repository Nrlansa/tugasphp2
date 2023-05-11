<?php

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2 class="mt-4">Tabel user</h2>
        <div class="row">
            <div class="col-md-12 ">
                <div class="float-end">
                    <a href="tambah.php" class="btn btn-primary mb-3">Tambah Data</a>
                </div>
            </div>
        </div>
        <table class="table">
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
                            <a href='edituser.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Edit</a>
                            <a href='lihat.php?id=" . $row['id'] . "' class='btn btn-info btn-sm'>Lihat</a>
                            <a href='?delete=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// Menutup koneksi database
mysqli_close($conn);
?>