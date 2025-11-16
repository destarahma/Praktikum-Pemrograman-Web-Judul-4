<?php
session_start();

// Redirect ke login jika belum login
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: login.php");
    exit();
}

// Cek apakah ID kontak diberikan
if (!isset($_GET['id']) || !isset($_SESSION['contacts'][$_GET['id']])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// Hapus kontak
unset($_SESSION['contacts'][$id]);

header("Location: index.php");
exit();
?>