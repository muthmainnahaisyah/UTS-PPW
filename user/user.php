<?php

include "login-checker.php";
require '../koneksi.php';
$title = "Dashboard";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          events: 'date_event.php'
        });
        calendar.render();
      });

    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://kit.fontawesome.com/910e994c98.js" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="../css/user.css">
    <title>USER | <?=$title?></title>
</head>

<body>
    <?php include "partials/navbar.php" ?>

    <section>
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-7 mb-3">
                    <h3 class="mb-2">Dashboard</h3>
                    <div class="card bg-light p-3 shadow">
                        <div id="calendar"></div>
                    </div>
                </div>
                <div class="col-md-5">
                    <h3 class="mb-2">Pesan tempat</h3>
                    <div class="card card-body bg-light shadow">
                        <form action="action.php" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-2">
                                        <input type="date" class="form-control form-control-sm" id="floatingInput" name="tanggal_mulai" placeholder="name@example.com">
                                    <label for="floatingInput">Tanggal Mulai</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-2">
                                        <input type="date" name="tanggal_selesai" class="form-control form-control-sm" id="floatingInput2" placeholder="name@example.com">
                                    <label for="floatingInput2">Tanggal Selesai</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-grid">
                                        <input type="submit" value="Cek ketersediaan" name="cek_ketersediaan" class="btn btn-sm btn-warning my-2">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <footer class="footer mt-5 py-3">
        <div class="container text-center">
            <span class="copy">&copy; 2024 Muthmainnah Aisyah. All rights reserved.</span>
        </div>
    </footer>

    <!-- modals -->
    <div class="modal fade" id="pemesanan-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
            <div class="modal-header bg-prpl">
                <h1 class="modal-title fs-5 text-light" id="staticBackdropLabel">Pemesanan Tempat</h1>
                <a type="button"  onclick="closeModal()" class="btn-close"></a>
            </div>
            <div class="modal-body container">
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    Tanggal tersedia, silahkan lengkapi berkas berikut!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <form action="action.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="tanggal_mulai" value="<?=$_SESSION['tersedia']?>">
                    <input type="hidden" name="tanggal_selesai" value="<?=$_SESSION['tanggal_selesai']?>">
                    <div class="row justify-content-start">
                        <div class="col-md-6 mb-2">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control form-control-sm" id="namaPemesan" placeholder="name@example.com" name="nama" required>
                                <label for="namaPemesan">Nama Pemesan</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control form-control-sm" id="noHP" placeholder="name@example.com" name="hp" required>
                                <label for="noHP">Nomor HP/Whatsapp</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-floating mb-3">
                                <select class="form-select form-select-sm" name="jenis" id="jenis" aria-label="Floating label select example" required>
                                    <?php
                                    $query = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY id DESC");
                                    while($data = mysqli_fetch_array($query)) { ?>
                                        <option value="<?=$data['kategori']?>"><?=$data['kategori']?></option>
                                    <?php } ?>
                                </select>
                                <label for="jenis">Jenis Acara</label>
                            </div>
                        </div>
                        <div class="row mb-3 justify-content-center">
                            <div class="col-12 pe-0">
                                <label for="deskripsi_acara">Deskripsi_acara</label>
                                <textarea name="deskripsi_acara" id="deskripsi_acara" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="gambar">Gambar Acara</label>
                            <input type="file" id="gambar" class="form-control" name="gambar" required>
                        </div>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="submit" name="pesan_tempat" class="btn btn-warning">Konfirmasi</button>
            </div>
            </form>
            </div>
        </div>
    </div>

    <!-- javascript -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <?php
    if(isset($_SESSION['tersedia'])) {
        ?>
            <script>
                $(document).ready(function(){
                    $("#pemesanan-modal").modal("show");
                })
            </script>
        <?php
        unset($_SESSION['tersedia']);
    }
    ?>
    
    <script>
        function closeModal() {
            let answer = confirm("Apakah Anda ingin membatalkan pesanan?")
            if(answer) {
                $("#pemesanan-modal").modal("hide");
            }
        }
        ClassicEditor
            .create( document.querySelector( '#deskripsi_acara' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
</body>
</html>