<?php

include "login-checker.php";
require '../koneksi.php';
$title = "AdminEvent";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://kit.fontawesome.com/910e994c98.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/koordinator.css">
    <title>KOORDINATOR | <?=$title?></title>
</head>

<body>
    <?php include "partials/navbar.php" ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h3 class="mb-2">Daftar Akun Admin</h3>
                <div class="overflow-x-auto">
                    <div class="row justify-content-end mb-2">
                        <div class="col-md-auto">
                            <a class="btn btn-sm btn-success px-4 shadow" data-bs-toggle="modal" data-bs-target="#kategori-modal" title="Tambah kategori"><i class="fa-solid fa-user-plus"></i></a>
                        </div>
                    </div>
                    <table class="table table-custom table-striped table-hover shadow table-responsive">
                        <thead>
                            <tr class="text-light">
                                <td scope="col" class="px-2">No</td>
                                <td scope="col">Nama</td>
                                <td scope="col">Email</td>
                                <td scope="col">Password</td>
                                <td class="col">Tipe User</td>
                                <td class="col">Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = mysqli_query($koneksi, "SELECT * FROM akun WHERE user_type = 'admin' ORDER BY id DESC");
                                $no = 0;
                                while($data = mysqli_fetch_array($sql)) {
                                    $no++
                            ?>
                            <tr>
                                <td><?=$no?>.</td>
                                <td><?=$data['name']?></td>
                                <td><?=$data['email']?></td>
                                <td><?=$data['password']?></td>
                                <td><?=$data['user_type']?></td>
                                <td class="px-2">
                                    <a href="#" class="badge rounded-pill text-bg-warning text-decoration-none" data-bs-toggle="modal" data-bs-target="#edit-modal-<?=$data['id']?>">edit</a>
                                    <a href="action.php?act=hapus&id=<?=$data['id']?>" class="badge rounded-pill text-bg-danger text-decoration-none" onclick="return confirm('Apakah Anda yakin ingin menghapus akun admin tersebut?')">hapus</a>
                                </td class="px-2">
                            </tr>
                            <!-- start edit -->
                            <div class="modal fade" id="edit-modal-<?=$data['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-prpl">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="action.php" method="POST">
                                                <div class="form-floating mb-3">
                                                    <input type="hidden" value="<?=$data['id']?>" name="id" required>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama" value="<?=$data['name']?>" required>
                                                    <label for="name">Nama</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?=$data['email']?>" required>
                                                    <label for="email">Email</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="password" name="password" placeholder="Password" value="<?=$data['password']?>" required>
                                                    <label for="password">Password</label>
                                                </div>
                                                <input type="hidden" name="user_type" value="admin">
                                                <div class="row justify-content-end">
                                                    <div class="col-auto">
                                                        <input type="submit" value="Simpan" name="edit" class="btn btn-warning">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end edit -->
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer class="footer mt-5 py-3 fixed-bottom">
        <div class="container text-center">
            <span class="copy">&copy; 2024 Muthmainnah Aisyah. All rights reserved.</span>
        </div>
    </footer>

    <!-- start tambah -->
    <div class="modal fade" id="kategori-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-prpl">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="action.php" method="POST">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name" name="name" placeholder="akun_admin" required>
                            <label for="kategori">Masukan nama</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="" name="email" placeholder="email" required>
                            <label for="kategori">Masukan email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="password" name="password" placeholder="akun_admin" required>
                            <label for="kategori">Masukan password</label>
                        </div>
                        <input type="hidden" name="user_type" value="admin">
                        <div class="row justify-content-end">
                            <div class="col-auto">
                                <input type="submit" value="Tambahkan" name="tambah" class="btn btn-warning">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end tambah -->

    <!-- javascript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>
</body>

</html>