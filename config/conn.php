<?php 

    $koneksi = mysqli_connect("localhost", "root", "", "evaluasi");

    // url induk
    // $main_url = "http://localhost/Sistem-Evaluasi-Polres-main/";
    $main_url = "http://localhost/SistemPolda1/";
    if (isset($_SESSION['main_title'])) {
        $main_title = $_SESSION['main_title'];
    } else {
        $main_title = "Sistem Evaluasi Polres"; // Nilai default
    }

?>