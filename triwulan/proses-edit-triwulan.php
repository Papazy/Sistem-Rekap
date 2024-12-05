<?php


session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location: ../auth/login.php");
    exit;
}

require_once "../config/conn.php";
require_once "../user/function/functions.php";

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
    $triwulan  = $_POST['triwulan'];
    $periode   = $_POST['periode'];
    

    // mengupdate database
    var_dump($pg);
    var_dump($nama_kegiatan);
    
    //update data
    $sql = "UPDATE triwulan SET Periode = '{$periode}' WHERE id = '$id'";
    mysqli_query($koneksi, $sql);
    $sql = "UPDATE triwulan SET Triwulan = '{$triwulan}' WHERE id = '$id'";
    mysqli_query($koneksi, $sql);
   
}

header("Location: triwulan.php");
exit;


?>
