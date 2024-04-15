<header class="header">
    <nav class="navbar navbar-expand-lg shadow navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#"><h3 class="logo">Event Planner</h3></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
                <a class="nav-link <?= $title === "Dashboard" ? "active" : "" ?>" aria-current="page" href="user.php"><i class="fa-solid fa-house"></i> dashboard</a>
                <a class="nav-link <?= $title === "Pesanan" ? "active" : "" ?>" href="pesanan.php"><i class="fa-regular fa-calendar-check"></i> Pesanan</a>
                <a class="nav-link" href="logout.php" onclick="return confirm('Apakah Anda yakin ingin keluar aplikasi sekarang?')"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
            </div>
        </div>
    </div>
    </nav>
</header>