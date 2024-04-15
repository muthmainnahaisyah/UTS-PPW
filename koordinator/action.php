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

$pesan_error = '';

if(isset($_POST['tambah'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $pesan_error = "Format email tidak valid";
    } else {
        $sql = "INSERT INTO akun (name, email, password, user_type) VALUES ('$name', '$email', '$password', '$user_type')";
        if (mysqli_query($koneksi, $sql)) {
            alert("Berhasil menambahkan akun admin", "adminevent.php");
        } else {
            alert("Gagal menambahkan akun admin", "adminevent.php");
        }
    }
}

if(isset($_POST['edit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $pesan_error = "Format email tidak valid";
    } else {
        $sql = "UPDATE akun SET name='$name', email='$email', password='$password', user_type='$user_type' WHERE id='$id'";
        if (mysqli_query($koneksi, $sql)) {
            alert("Berhasil merubah akun admin", "adminevent.php");
        } else {
            alert("Gagal merubah akun admin", "adminevent.php");
        }
    }
}

if(isset($_GET['act'])) {
    $id = $_GET['id'];

    $delData = mysqli_query($koneksi, "DELETE FROM akun WHERE id='$id'");
    if($delData) {
        alert("Berhasil menghapus akun admin", "adminevent.php");
    } else {
        alert("Gagal menghapus akun admin", "adminevent.php");
    }
}
?>