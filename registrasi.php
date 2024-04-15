<?php

require 'koneksi.php';

$pesan_error = '';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $pesan_error = "Format email tidak valid";
    } else {
        $sql = "INSERT INTO akun (name, email, password, user_type) VALUES ('$name', '$email', '$password', '$user_type')";
        if (mysqli_query($koneksi, $sql)) {
            header('Location: login.php');
            exit;
        } else {
            $pesan_error = "Registrasi Gagal!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>REGISTRASI</title>
</head>

<body class="bg-blue">
    <!-- header -->
    <header class="header">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <h3 class="logo">Event Planner</h3>
            </div>
        </nav>
    </header>

    <!-- main -->
    <main>
        <section>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-10 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="fs-3 mb-3 text-center">Registrasi</h1>
                                <?php if ($pesan_error != '') : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo $pesan_error; ?>
                                    </div>
                                <?php endif; ?>
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="name" id="name" class="form-control" required>
                                        <label for="name" class="form-label">Name</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="email" name="email" id="email" class="form-control" required>
                                        <label for="email" class="form-label">Email</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" name="password" id="password" class="form-control" required>
                                        <label for="password" class="form-label">Password</label>
                                    </div>
                                    <input type="hidden" name="user_type" value="user">
                                    <button type="submit" name="submit" class="btn-reg w-100">Registrasi</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- footer -->
    <footer class="footer mt-5 py-3 fixed-bottom">
        <div class="container text-center">
            <span class="copy">&copy; 2024 Muthmainnah Aisyah. All rights reserved.</span>
        </div>
    </footer>

    <!-- javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>

</html>