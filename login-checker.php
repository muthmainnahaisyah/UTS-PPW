<?php
session_start();
if(isset($_COOKIE['ingat_saya']) && $_COOKIE['ingat_saya'] === 'true') {
    $_SESSION['sudah_login'] = true;
}

if(isset($_SESSION['sudah_login'])) {
    if($_SESSION['user_type'] == "admin") {
        ?>
            <script>
                document.location = "admin/admin.php";
            </script>
        <?php
    } elseif($_SESSION['user_type'] == "koordinator") {
        ?>
            <script>
                document.location = "koordinator/koordinator.php";
            </script>
        <?php
    } else {
        ?>
            <script>
                document.location = "user/user.php";
            </script>
        <?php
    }
}