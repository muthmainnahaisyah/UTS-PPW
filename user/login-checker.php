<?php
session_start();
if(isset($_COOKIE['ingat_saya']) && $_COOKIE['ingat_saya'] === 'true') {
    $_SESSION['sudah_login'] = true;
}

if(!isset($_SESSION['sudah_login'])) {
    ?>
        <script>
            alert("Silahkan login terlebih dahulu")
            document.location = "../login.php"
        </script>
    <?php
}