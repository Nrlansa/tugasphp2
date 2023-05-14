<?php
session_start();

// Buat token CSRF agar browser menganggap halaman login atau form dari sumber yang sah
if (!isset($_SESSION['csrf_token'])) {
    $csrfToken = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $csrfToken;
} else {
    $csrfToken = $_SESSION['csrf_token'];
}

// Periksa apakah ada parameter error pada URL
$error = isset($_GET['error']) ? $_GET['error'] : '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Link CSS Bootstrap v.5.2.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/css/bootstrap.min.css">
    <!-------link CSS Font Awesome v.5.15.4 -------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title text-center ">Login</h1>
                        <!-- Tampilkan notifikasi error jika ada -->
                        <?php if ($error) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                        <form action="login_proses.php" method="POST">
                            <!--  input untuk token CSRF -->
                            <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">

                            <div class="input-group pt-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="Email" aria-label="email" aria-describedby="basic-addon1" required>
                            </div>

                            <div class="input-group pt-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="password" aria-label="Username" aria-describedby="basic-addon1" required>
                            </div>
                            <div class="float-end mt-3">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in-alt mx-2"></i>Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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