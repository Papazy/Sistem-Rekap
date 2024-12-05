<?php 

    session_start();

    if (!isset($_SESSION['ssLogin'])) {
        header("location: ../auth/login.php");
        exit;
    }

    require_once "../config/conn.php";
    require_once "../user/function/functions.php";

    if (isset($_POST['simpan'])) {
        $triwulan = $_POST['triwulan'];
        $periode  = $_POST['periode'];

        mysqli_query($koneksi, "INSERT INTO triwulan (Triwulan, Periode) VALUES('$triwulan', '$periode')");

        // echo "<script>
        //         alert('Data berhasil disimpan');
        //         document.location.href = 'add-kegiatan.php';
        //      </script>";   
        // return;

    }
    // Setelah kode diatas di proses, pindah ke halaman index.php
    header("Location: triwulan.php");
    exit;
?>