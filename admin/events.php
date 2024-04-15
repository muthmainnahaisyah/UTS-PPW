<?php

include "login-checker.php";
require '../koneksi.php';
$title = "Events";

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
    <link rel="stylesheet" href="../css/admin.css">
    <title>ADMIN | <?=$title?></title>
</head>

<body>
    <?php include "partials/navbar.php" ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <h3 class="mb-2">Daftar Pesanan</h3>
                <div class="overflow-x-auto">
                    <table class="table table-custom table-striped table-hover shadow table-responsive">
                        <thead>
                            <tr class="text-light">
                                <td scope="col" class="px-2">No</td>
                                <td scope="col">Kategori Acara</td>
                                <td scope="col">Tanggal</td>
                                <td scope="col">Status</td>
                                <td scope="col">Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = mysqli_query($koneksi, "SELECT * FROM event ORDER BY id DESC");
                                $no = 0;
                                while($data = mysqli_fetch_array($sql)) {
                                    $no++
                            ?>
                            <tr>
                                <td><?=$no?>.</td>
                                <td><?=$data['jenis_acara']?></td>
                                <td><?=$data['tanggal_mulai']?></td>
                                <td>
                                    <?=$data['konfirmasi'] == "konfir" ? "<span class='badge text-bg-success'>disetujui</span>" : "<span class='badge text-bg-info'>pending</span>"?>
                                </td>
                                <td>
                                    <a href="#" class="badge text-bg-warning text-decoration-none" data-bs-toggle="modal" data-bs-target="#detail-modal-<?=$data['id']?>">detail</a>
                                </td>
                                <!-- start detail booking -->
                                <div class="modal fade" id="detail-modal-<?=$data['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-fullscreen">
                                        <div class="modal-content">
                                        <div class="modal-header bg-prpl text-light">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Pesanan</h1>
                                            <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body container">
                                            <div class="row justify-content-center">
                                                <div class="col-md-4 mt-2">
                                                    <img src="<?=$data['gambar']?>" alt="" class="img-detail-pemesanan shadow-sm">
                                                </div>
                                                <div class="col-md-8 mt-2">
                                                    <div class="row justify-content-center mb-1">
                                                        <div class="col-5">Nama Pemesan</div>
                                                        <div class="col-1">:</div>
                                                        <div class="col-6"><input type="text" class="form-control form-control-sm" disabled value="<?=$data['nama']?>"></div>
                                                    </div>
                                                    <div class="row justify-content-center mb-1">
                                                        <div class="col-5">No HP</div>
                                                        <div class="col-1">:</div>
                                                        <div class="col-6"><input type="text" class="form-control form-control-sm" disabled value="<?=$data['no_hp']?>"></div>
                                                    </div>
                                                    <div class="row justify-content-center mb-1">
                                                        <div class="col-5">Jenis Acara</div>
                                                        <div class="col-1">:</div>
                                                        <div class="col-6"><input type="text" class="form-control form-control-sm" disabled value="<?=$data['jenis_acara']?>"></div>
                                                    </div>
                                                    <div class="row justify-content-center mb-1">
                                                        <div class="col-5">Tanggal Mulai</div>
                                                        <div class="col-1">:</div>
                                                        <div class="col-6"><input type="text" class="form-control form-control-sm" disabled value="<?=$data['tanggal_mulai']?>"></div>
                                                    </div>
                                                    <div class="row justify-content-center mb-1">
                                                        <div class="col-5">Tanggal Selesai</div>
                                                        <div class="col-1">:</div>
                                                        <div class="col-6"><input type="text" class="form-control form-control-sm" disabled value="<?=$data['tanggal_selesai']?>"></div>
                                                    </div>
                                                    <div class="row justify-content-center mb-1">
                                                        <div class="col-5">Durasi</div>
                                                        <div class="col-1">:</div>
                                                        <div class="col-6"><input type="text" class="form-control form-control-sm" disabled value="<?=((strtotime($data['tanggal_selesai']) - strtotime($data['tanggal_mulai'])) / (60 * 60 * 24)) + 1;?> hari"></div>
                                                    </div>
                                                    <div class="row justify-content-center mb-1">
                                                        <div class="col-5">Total Biaya</div>
                                                        <div class="col-1">:</div>
                                                        <div class="col-6"><input type="text" class="form-control form-control-sm" disabled value="Rp. <?=number_format($data['total_biaya'])?>"></div>
                                                    </div>
                                                    <div class="row justify-content-center mb-1">
                                                        <div class="col-5">Status</div>
                                                        <div class="col-1">:</div>
                                                        <div class="col-6">
                                                            <?=$data['konfirmasi'] == "konfir" ? "<span class='badge text-bg-success'>disetujui</span>" : "<span class='badge text-bg-info'>pending</span>"?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <h4>Deskripsi Acara</h4>
                                                    <hr>
                                                    <p><?=$data['deskripsi_acara']?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="action.php?booked=hapus&id=<?=$data['id']?>" class="btn btn-danger px-3">Hapus Pesanan</a>
                                            <?php
                                            if($data['konfirmasi'] == "konfir") {
                                                echo "";
                                            } else {
                                                ?>
                                                    <a href="action.php?konfir=true&id=<?=$data['id']?>" type="button" class="btn btn-success px-3" disabled>Konfirmasi</a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <!-- end detail booking -->
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row justify-content-end mb-2">
                    <div class="col-md-auto">
                        <a class="btn btn-sm btn-success px-4 shadow" data-bs-toggle="modal" data-bs-target="#kategori-modal" title="Tambah kategori"><i class="fa-regular fa-calendar-plus"></i></a>
                    </div>
                </div>
                <table class="table table-striped table-hover shadow">
                    <thead>
                        <tr class="text-light">
                            <td scope="col" class="px-2">No</td>
                            <td scope="col">Kategori Acara</td>
                            <td scope="col">Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = mysqli_query($koneksi, "SELECT * FROM kategori");
                        $no=0;
                        while($data = mysqli_fetch_array($sql)) {
                            $no++;
                        ?>
                        <tr>
                            <td scope="row" class="px-2"><?=$no?>.</td>
                            <td class="px-2"><?=$data['kategori']?></td>
                            <td class="px-2">
                                <a href="#" class="badge rounded-pill text-bg-warning text-decoration-none" data-bs-toggle="modal" data-bs-target="#edit-modal-<?=$data['id']?>">edit</a>
                                <a href="action.php?act=hapus&id=<?=$data['id']?>" class="badge rounded-pill text-bg-danger text-decoration-none" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori dari daftar?')">hapus</a>
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
                                                    <input type="text" class="form-control" id="kategori" name="kategori" placeholder="tidak boleh kosong" value="<?=$data['kategori']?>" required>
                                                    <label for="kategori">Ubah kategori</label>
                                                </div>
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
                <div class="card shadow bg-light">
                    <div class="card-header bg-prpl text-light">Harga perhari (Rp.)</div>
                    <div class="card-body">
                        <?php
                        $sql = mysqli_query($koneksi, "SELECT * FROM tempat_event WHERE id_admin='$_SESSION[id]'");
                        if(mysqli_num_rows($sql) <= 0) {
                            $harga = 0;
                        } else {
                            $data = mysqli_fetch_array($sql);
                            $harga = $data['harga'];
                        }
                        ?>
                        <form action="action.php" method="post">
                            <input type="number" class="form-control form-control-sm mb-3" name="harga_perjam" value="<?=$harga?>" required>
                            <div class="d-grid">
                                <input type="submit" class="btn btn-warning btn-sm" value="Ubah" id="btn-ubah-harga" name="ubah_harga">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer class="footer mt-5 py-3">
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
                            <input type="text" class="form-control" id="kategori" name="kategori" placeholder="pernikahan" required>
                            <label for="kategori">Masukan kategori</label>
                        </div>
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