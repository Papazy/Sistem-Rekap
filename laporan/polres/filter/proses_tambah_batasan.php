<?php
session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location: ../../../auth/login.php");
    exit;
}

require_once "../../../config/conn.php";

if (isset($_POST['simpan'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $satuan = mysqli_real_escape_string($koneksi, $_POST['satuan']);
    $min = (float) $_POST['min'];
    $max = (float) $_POST['max'];
    $min_file = (float) $_POST['min_file'];
    $max_file = (float) $_POST['max_file'];

    // Validasi input
    if ($min > $max) {
        $_SESSION['error'] = "Nilai minimum tidak boleh lebih besar dari nilai maksimum!";
        header("Location: tambah_batasan.php");
        exit;
    }

    // Insert data ke database
    $query = "INSERT INTO batasan (nama, satuan, min, max, min_file, max_file) VALUES ('$nama', '$satuan', '$min', '$max', '$min_file', '$max_file')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $_SESSION['success'] = "Data batasan berhasil ditambahkan!";
        header("Location: batasan.php");
    } else {
        $_SESSION['error'] = "Terjadi kesalahan saat menambahkan data!";
        header("Location: tambah_batasan.php");
    }
    exit;
}
?>
