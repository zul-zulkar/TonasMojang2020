<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location:login.php');
    }
    $email = $_SESSION['user']['email'];
    $pengguna = $_SESSION['user']['nama'];
    $bayar = $_SESSION['user']['pembayaran'];
    $kwitansi = $_SESSION['user']['kwitansi'];
    $tipe = $_SESSION['user']['tipe'];
    $ukuran = $_SESSION['user']['ukuran'];
    $kabkot = $_SESSION['user']['kab_kot'];
    $peran = $_SESSION['user']['peran'];
    $pengguna = $_SESSION['user'];
?>