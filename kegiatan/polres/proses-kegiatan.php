<?php 

    session_start();

    if (!isset($_SESSION['ssLogin'])) {
        header("location: ../../auth/login.php");
        exit;
    }

    require_once "../../config/conn.php";
    require_once "../../user/function/functions.php";

    if (isset($_POST['simpan'])) {
        $pg     = $_POST['pg'];
        $judul  = $_POST['judul'];

        mysqli_query($koneksi, "INSERT INTO kegiatan_polres (PG, nama_kegiatan) VALUES('$pg', '$judul')");

        // echo "<script>
        //         alert('Data berhasil disimpan');
        //         document.location.href = 'add-kegiatan.php';
        //      </script>";   
        // return;

    }
    // Setelah kode diatas di proses, pindah ke halaman index.php
    header("Location: kegiatan.php");
    exit;
?>