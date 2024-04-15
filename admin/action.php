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

if(isset($_POST['tambah'])) {
    $kategori = $_POST['kategori'];

    $addData = mysqli_query($koneksi, "INSERT INTO kategori (kategori) VALUES ('$kategori')");
    if($addData) {
        alert("Berhasil menambahkan kategori", "events.php");
    } else {
        alert("Gagal menambahkan kategori", "events.php");
    }
}

if(isset($_POST['edit'])) {
    $id = $_POST['id'];
    $kategori = $_POST['kategori'];

    $update = mysqli_query($koneksi, "UPDATE kategori SET kategori='$kategori' WHERE id='$id'");
    if($update) {
        alert("Berhasil merubah kategori", "events.php");
    } else {
        alert("Gagal merubah kategori", "events.php");
    }
}

if(isset($_GET['act'])) {
    $id = $_GET['id'];

    $delData = mysqli_query($koneksi, "DELETE FROM kategori WHERE id='$id'");
    if($delData) {
        alert("Berhasil menghapus kategori", "events.php");
    } else {
        alert("Gagal menghapus kategori", "events.php");
    }
}

if(isset($_POST['ubah_harga'])) {
    $id = $_SESSION['id'];
    $harga = $_POST['harga_perjam'];

    $sql = mysqli_query($koneksi, "SELECT * FROM tempat_event WHERE id_admin='$id'");
    if(mysqli_num_rows($sql) > 0) {
        $edit = mysqli_query($koneksi, "UPDATE tempat_event SET harga='$harga' WHERE id='$id'");
        if($edit) {
            alert("Berhasil mengubah harga", "events.php");
        } else {
            alert("Gagal mengubah harga", "events.php");
        }
    } else {
        $add = mysqli_query($koneksi, "INSERT INTO tempat_event (id_admin, harga) VALUES ('$id','$harga')");
        if($add) {
            alert("Berhasil menambahkan harga", "events.php");
        } else {
            alert("Gagal menambahkan harga", "events.php");
        }
    }
}

if(isset($_GET['konfir']) && $_GET['konfir'] == "true") {
    $id = $_GET['id'];
    $update = mysqli_query($koneksi, "UPDATE event SET konfirmasi='konfir' WHERE id='$id'");
    if($update) {
        alert("Pesanan telah dikonfirmasi", "events.php");
    } else {
        alert("Pesanan gagal dikonfirmasi", "events.php");
    }
}

if(isset($_GET['booked']) && $_GET['booked'] == "hapus") {
    $id = $_GET['id'];
    $delete = mysqli_query($koneksi, "DELETE FROM event WHERE id='$id'");
    if($delete) {
        alert("Pesanan berhasil dihapus", "events.php");
    } else {
        alert("Pesanan gagal dihapus", "events.php");
    }
}

?>