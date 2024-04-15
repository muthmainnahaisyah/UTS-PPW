<?php

include "login-checker.php";
include "../koneksi.php";

function alert($msg, $location) {
    ?>
    <script>
        alert("<?=$msg?>")
        document.location = "<?=$location?>"
    </script>
    <?php
}

if(isset($_POST['cek_ketersediaan'])) {
    $date = $_POST['tanggal_mulai'];
    $date2 = $_POST['tanggal_selesai'];

    $date = date('Y-m-d', strtotime($date));
    $date2 = date('Y-m-d', strtotime($date2));

    if($date < date('Y-m-d') || $date2 < $date) {
        alert("Masuakan tanggal yang benar!", "user.php");
        exit();
    }

    $query = mysqli_query($koneksi, "SELECT * FROM event WHERE tanggal_mulai >= CURDATE() ORDER BY id DESC");
    while($data = mysqli_fetch_array($query)) {
        $durasi = round((strtotime($data['tanggal_selesai']) - strtotime($data['tanggal_mulai'])) / (60 * 60 * 24));
        for($i = 0;$i < $durasi + 1;$i++) {
            $rentan_waktu = date('Y-m-d', strtotime($data['tanggal_mulai'] . '+' . $i . 'day'));
            if($rentan_waktu == $date || $rentan_waktu == $date2) {
                alert("Maaf tanggal sudah dipesan, silahkan cari tanggal lain", "user.php");
                exit();
            }
        }
    }

    $_SESSION['tersedia'] = $date;
    $_SESSION['tanggal_selesai'] = $date2;
     ?>
         <script>document.location = "user.php"</script>
     <?php
}

if(isset($_POST['pesan_tempat'])) {
    $id = $_SESSION['id'];
    $nama = $_POST['nama'];
    $hp = $_POST['hp'];
    $jenis = $_POST['jenis'];
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_akhir = $_POST['tanggal_selesai'];
    $deskripsi_acara = $_POST['deskripsi_acara'];

    $gambar = $_FILES['gambar'];
    $folder_upload = "../img/acara/";
    $target = $folder_upload . basename($gambar['name']);

    if(!move_uploaded_file($gambar["tmp_name"], $target)) {
        alert("Gambar gagal diupload" , "user.php");
    }

    $sql = mysqli_query($koneksi, "SELECT * FROM tempat_event");
    $data = mysqli_fetch_array($sql);

    $durasi = (strtotime($tanggal_akhir) - strtotime($tanggal_mulai)) / (60 * 60 * 24);
    $total_harga = ($durasi + 1) * $data['harga'];

    $add = mysqli_query($koneksi, "INSERT INTO event (id_user, nama, no_hp, jenis_acara, tanggal_mulai, tanggal_selesai, total_biaya, deskripsi_acara, gambar) VALUES ('$id', '$nama', '$hp', '$jenis', '$tanggal_mulai', '$tanggal_akhir', '$total_harga', '$deskripsi_acara', '$target')");
    
    if($add) {
        alert("Berhasil dipesan, mohon ditunggu!", "user.php");
    } else {
        alert("Gagal dipesan!", "user.php");
    }
}

if(isset($_GET['booked']) && $_GET['booked'] == "hapus") {
    $id = $_GET['id'];
    $delete = mysqli_query($koneksi, "DELETE FROM event WHERE id='$id'");
    if($delete) {
        alert("Pesanan berhasil dibatalkan", "pesanan.php");
    } else {
        alert("Pesanan gagal dibatalkan", "pesanan.php");
    }
}