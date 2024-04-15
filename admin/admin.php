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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/admin.css">
    <title>ADMIN | <?=$title?></title>
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
                    <h3 class="mb-2">Acara terdekat</h3>
                    <table class="table table-striped table-hover shadow">
                        <tr class="bg-prpl text-light">
                            <td>No</td>
                            <td>Acara</td>
                            <td>Tanggal</td>
                        </tr>
                        <?php
                        $query = mysqli_query($koneksi, "SELECT * FROM event WHERE tanggal_mulai >= CURDATE() ORDER BY tanggal_mulai ASC LIMIT 10");
                        $no = 0;
                        while($data = mysqli_fetch_array($query)) {
                            $no++
                            ?>
                            <tr>
                                <td><?=$no?>.</td>
                                <td><?=$data['jenis_acara']?></td>
                                <td><?=$data['tanggal_mulai']?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
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

    <!-- javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>
</body>

</html>