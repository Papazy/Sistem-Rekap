<?php
session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location: ../auth/login.php");
    exit;
}

require_once "../config/conn.php";
require_once "function/functions.php";

if (isset($_POST["delete"])) {
    $id = $_POST['id'];

    // Ambil semua nama file gambar dari database
    $sql = "SELECT foto FROM user WHERE id = '$id'";
    $result = mysqli_query($koneksi, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $foto = $row['foto'];

        // Hapus semua file gambar terkait dari direktori
        $deletePath = '../asset/upload_img/';

        // Hapus file gambar dari direktori
        $sqlFoto = "SELECT foto FROM user WHERE id = '$id'";
        $resultFoto = mysqli_query($koneksi, $sqlFoto);
        if ($resultFoto) {
            $rowFoto = mysqli_fetch_assoc($resultFoto);
            $foto = $rowFoto['foto'];

            // Hapus file gambar dari direktori jika bukan default.png
            if ($foto != 'default.png') {
                $path = '../asset/upload_img/' . $foto;
                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }

        // Hapus user dari database
        $deleteSql = "DELETE FROM user WHERE id = '$id'";
        $deleteQuery = mysqli_query($koneksi, $deleteSql);

        if ($deleteQuery) {
            header("location:user.php?msg=delete");
            exit;
        } else {
            header("location:user.php?msg=error");
            exit;
        }
    } else {
        header("location:user.php?msg=error");
        exit;
    }
} else {
    header("location:user.php");
    exit;
}
?>
