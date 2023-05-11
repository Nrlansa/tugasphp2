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

// Mendapatkan data yang dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    // Mendapatkan informasi file foto
    $avatar = $_FILES['avatar'];
    $avatarName = $avatar['name'];
    $avatarTmpName = $avatar['tmp_name'];
    $avatarError = $avatar['error'];

    // Tentukan direktori tujuan untuk menyimpan file foto
    $targetDir = "avatar/";

    // Generate nama unik untuk file foto
    $avatarFileName = uniqid() . '_' . $avatarName;

    // Pindahkan file foto ke direktori tujuan
    if (move_uploaded_file($avatarTmpName, $targetDir . $avatarFileName)) {
        // File foto berhasil diunggah, simpan data pengguna ke dalam database
        $sql = "INSERT INTO users (nama, email, phone, role, address, password, avatar) VALUES ('$nama', '$email', '$phone', '$role', '$address', '$password', '$avatarFileName')";

        if (mysqli_query($conn, $sql)) {
            // Data berhasil ditambahkan
            header("Location: user.php");
            exit;
        } else {
            // Terjadi kesalahan saat menambahkan data
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        // Terjadi kesalahan saat mengunggah file foto
        echo "Error uploading file";
    }
}

// Menutup koneksi database
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Tambah user</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2 class="mt-4">Tambah user</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" ">
                            </div>
                        </div>
                        <div class=" col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" id="role" name="role">
                                <option selected>Pilih Role</option>
                                <option value="admin">Admin</option>
                                <option value="staff">staff</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="address" class="form-label">address</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="avatar" class="mb-2">Foto</label>
                                <input type="file" class="form-control" id="avatar" name="avatar">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-2">tambah</button>
                <a href="user.php" class="btn btn-secondary mt-2">Batal</a>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>