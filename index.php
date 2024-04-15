<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>EVENT PLANNER</title>
</head>

<body class="bg-blue">
    <!-- header -->
    <header class="header">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <h3 class="logo">Event Planner</h3>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="registrasi.php">Registrasi</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- main -->
    <main>
        <!-- home section -->
        <section class="home">
            <div class="fullscreen-bg">
                <img src="img/home.png" alt="Background Image">
            </div>
        </section>
        <!-- menu section -->
        <section class="menu py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-5 mb-4">
                        <div class="card text-center shadow ">
                            <div class="card-body">
                                <i class="fas fa-user-plus fa-3x mb-3"></i>
                                <h5 class="card-title">Registrasi</h5>
                                <p class="card-text">Daftar untuk mendapatkan akses penuh.</p>
                                <a href="registrasi.php" class="btn-reg">Registrasi</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-5 mb-4">
                        <div class="card text-center shadow">
                            <div class="card-body">
                                <i class="fas fa-sign-in-alt fa-3x mb-3"></i>
                                <h5 class="card-title">Login</h5>
                                <p class="card-text">Sudah memiliki akun? Masuk sekarang.</p>
                                <a href="login.php" class="btn-log">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- footer -->
    <footer class="footer mt-auto py-3">
        <div class="container text-center">
            <span class="copy">&copy; 2024 Muthmainnah Aisyah. All rights reserved.</span>
        </div>
    </footer>

    <!-- javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>

</html>