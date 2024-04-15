<?php

include "login-checker.php";
require '../koneksi.php';
$title = "Pesanan";

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
    <link rel="stylesheet" href="../css/user.css">
    <title>USER | <?=$title?></title>
</head>

<body>
    <?php include "partials/navbar.php" ?>

    <div class="container mt-5">
        <h3 class="mb-2">Daftar pesanan</h3>
        <div class="overflow-x-auto">
            <table class="table table-striped table-hover bg-light shadow">
                <thead>
                    <tr class="text-light">
                        <td>No</td>
                        <td>Jenis</td>
                        <td>Tanggal</td>
                        <td>Status</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <?php
                    $sql = mysqli_query($koneksi, "SELECT * FROM event WHERE id_user='$_SESSION[id]' ORDER BY id DESC");
                    $no = 0;
                    while($data = mysqli_fetch_array($sql)) {
                        $no++
                        ?>
                        <tr>
                            <td><?=$no?></td>
                            <td><?=$data['jenis_acara']?></td>
                            <td><?=$data['tanggal_mulai']?></td>
                            <td>
                                <?=$data['konfirmasi'] == "konfir" ? "<span class='badge text-bg-success'>disetujui</span>" : "<span class='badge text-bg-info'>pending</span>"?>
                            </td>
                            <td>
                                <a href="#" class="badge text-bg-warning text-decoration-none" data-bs-toggle="modal" data-bs-target="#detail-modal-<?=$data['id']?>">detail</a>
                            </td>
                        </tr>

                        <!-- start modal -->
                        <div class="modal fade" id="detail-modal-<?=$data['id']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-fullscreen">
                                        <div class="modal-content">
                                        <div class="modal-header bg-prpl text-light">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Pesanan</h1>
                                            <button type="button" class="btn-close btn-light" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body container">
                                            <div class="row justify-content-center">
                                                <?php
                                                if($data['konfirmasi'] == "konfir") {
                                                    ?>
                                                    <div class="col-md-12 mt-2">
                                                        <div class="alert alert-success" role="alert">
                                                            Pemesanan sudah disetujui, silahkan hubungi <a href="#">081346201350</a> untuk pembayaran dan informasi lebih lanjut!
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
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
                                            <?php
                                            if($data['konfirmasi'] != "konfir") {
                                                ?>
                                                    <a href="action.php?booked=hapus&id=<?=$data['id']?>" onclick="return confirm('Apakah Anda ingin membatalkan pesanan?')" class="btn btn-danger px-3">Batalkan Pesanan</a>
                                                <?php
                                            } else {
                                                echo "";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                </div>
                        <!-- end modal -->
                        <?php
                    }
                ?>
            </table>
        </div>
    </div>

    <!-- footer -->
    <footer class="footer mt-5 py-3 fixed-bottom">
        <div class="container text-center">
            <span class="copy">&copy; 2024 Muthmainnah Aisyah. All rights reserved.</span>
        </div>
    </footer>

    <!-- javascript -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>