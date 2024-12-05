<?php


session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location: ../auth/login.php");
    exit;
}

require_once "../../config/conn.php";
require_once "../../user/function/functions.php";

function gantiKoma($nilai)
{
    // Periksa apakah nilai merupakan bilangan desimal dengan tanda koma
    if (strpos($nilai, ',') !== false) {
        // Ganti tanda koma dengan titik
        $nilai = str_replace(',', '.', $nilai);
    }
    return $nilai;
}


// Periksa apakah ada filecsv

if (isset($_POST["simpan"])){
    $id        = $_POST['id'];
    $pg        = $_POST['pg'];
    $nama_kegiatan  = $_POST['nama_kegiatan'];
    

    // mengupdate database
    var_dump($pg);
    var_dump($nama_kegiatan);
    
    //update data
    $sql = "UPDATE kegiatan_polda SET nama_kegiatan = '{$nama_kegiatan}' WHERE id = '$id'";
    mysqli_query($koneksi, $sql);
    $sql = "UPDATE kegiatan_polda SET PG = '{$pg}' WHERE id = '$id'";
    mysqli_query($koneksi, $sql);
   
}

header("Location: kegiatan.php");
exit;


?>
