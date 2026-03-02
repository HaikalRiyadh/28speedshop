<?php
require 'function.php';

if (isset($_SESSION["login"]) && $_SESSION["login"] === true) {
    header("Location: index.php");
    exit;
}

if (isset($_POST["login"])) {
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : '';
    $password = isset($_POST["password"]) ? $_POST["password"] : '';
    $errorMessage = "";

    if ($email === '') {
        $errorMessage = "Harus diisi emailnya.";
    } else {
        $safe_email = mysqli_real_escape_string($conn, $email);
        $result = mysqli_query($conn, "SELECT * FROM login WHERE email = '$safe_email'");

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($password == $row["password"]) {
                $_SESSION["login"] = true;
                $_SESSION["email"] = $row["email"];
                header("Location: index.php");
                exit;
            } else {
                $errorMessage = "Password salah.";
            }
        } else {
            $errorMessage = "Email tidak terdaftar.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Login - 28SpeedShop</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/custom.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="login-body">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-lg-5 col-md-7 col-sm-10">
                <div class="text-center mb-4">
                    <div class="login-logo">
                        <i class="fas fa-motorcycle fa-3x text-white"></i>
                    </div>
                    <h2 class="text-white fw-bold mt-3">28SpeedShop</h2>
                    
                </div>
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-4 p-md-5">
                        <h4 class="text-center fw-bold mb-1">Selamat Datang</h4>
                        <p class="text-center text-muted mb-4">Silakan login untuk melanjutkan</p>

                        <?php if (!empty($errorMessage)) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i><?php echo $errorMessage; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form method="post">
                            <div class="mb-3">
                                <label for="inputEmail" class="form-label fw-semibold">
                                    <i class="fas fa-envelope me-1 text-muted"></i>Email
                                </label>
                                <input class="form-control form-control-lg" name="email" id="inputEmail" type="email" placeholder="nama@email.com" required
                                    value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" />
                            </div>
                            <div class="mb-4">
                                <label for="inputPassword" class="form-label fw-semibold">
                                    <i class="fas fa-lock me-1 text-muted"></i>Password
                                </label>
                                <input class="form-control form-control-lg" name="password" id="inputPassword" type="password" placeholder="Masukkan password" required />
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary btn-lg fw-bold" type="submit" name="login">
                                    <i class="fas fa-sign-in-alt me-2"></i>Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <small class="text-white-50">28SpeedShop</small>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
