<?php

include "login-checker.php";
include "../koneksi.php";

function randomColor() {
    $red = mt_rand(0, 255);
    $green = mt_rand(0, 255);
    $blue = mt_rand(0, 255);

    $hex = sprintf("#%02x%02x%02x", $red, $green, $blue);

    return $hex;
}

$query = "SELECT * FROM event ORDER BY id DESC";
$result = mysqli_query($koneksi, $query);

$events = array();
while ($row = mysqli_fetch_assoc($result)) {
    $tanggal_selesai = date('Y-m-d', strtotime($row['tanggal_selesai'] . '+1 day'));
    $events[] = array(
        'title' => $row['jenis_acara'],
        'start' => $row['tanggal_mulai'],
        'end' => $tanggal_selesai,
        'color' => randomColor(),
    );
}

echo json_encode($events);
?>