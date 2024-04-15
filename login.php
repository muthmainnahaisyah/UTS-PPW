<?php
include "login-checker.php";
require 'koneksi.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];

    $sql = "SELECT * FROM akun WHERE email = '$email' AND password = '$password' AND user_type = '$user_type'";
    $result = mysqli_query($koneksi, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['sudah_login'] = true;
        $_SESSION['user_type'] = $user_type;
        $_SESSION['id'] = $row['id'];

        if (isset($_POST['ingatSaya'])) {
            setcookie(
                'ingat_saya',
                'true',
                time() + (86400 * 3),
                '/'
            );
        }

        if ($user_type == 'admin') {
            header('Location: admin/admin.php');
        } elseif ($user_type == 'user') {
            header('Location: user/user.php');
        } elseif ($user_type == 'koordinator') {
            header('Location: koordinator/koordinator.php');
        }
        exit;
    } else {
        echo "<script>alert('Email, password, atau tipe pengguna tidak tepat')</script>";
        echo "<script>window.location.href = 'login.php';</script>";
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
    <title>LOGIN</title>
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
                        <div class="card card-body">
                            <h1 class="fs-3 mb-3 text-center">Login</h1>
                            <form action="login.php" method="POST">
                                <div class="form-floating mb-3">
                                    <input type="email" name="email" id="email" class="form-control">
                                    <label for="email">Email</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" name="password" class="form-control">
                                    <label for="password">Password</label>
                                </div>
                                <div class="mb-3">
                                    <select class="form-select" name="user_type">
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                        <option value="koordinator">Koordinator</option>
                                    </select>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="true" name="ingatSaya" id="ingatSaya">
                                    <label class="form-check-label" for="ingatSaya">
                                        Remember me
                                    </label>
                                </div>
                                <button type="submit" name="submit" class="btn-log w-100">Login</button>
                            </form>
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