<?php

session_start();
session_destroy();

setcookie(
    'ingat_saya',
    null,
    time() - 3600,
    '/'
  );

header("Location: ../index.php");
exit;