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

if (isset($_POST["submit"])){
    $id         = $_POST['id'];
    $Satker     = $_POST['Satker'];
    $Persentase = $_POST['Persentase'];
    $Periode    = $_POST['Periode'];
    $PG         = $_POST['PG'];
    $Triwulan   = $_POST['Triwulan'];
    
    $Periode_old   = $_POST['Periode_old'];
    $PG_old   = $_POST['PG_old'];
    

    // mengupdate database
    var_dump($id);
    var_dump($Satker);
    var_dump($Persentase);
    var_dump($Periode);
    var_dump($PG);
   
    var_dump($Triwulan);
    $Persentase = gantiKoma($Persentase);
    //update data
    $sql = "UPDATE persentase_polda SET Satker = '$Satker', Persentase = '$Persentase', Periode = '$Periode', PG = '$PG', Triwulan = '$Triwulan' WHERE id = '$id'";
    $query = mysqli_query($koneksi, $sql);

    // Periksa apakah masih ada
    $sql = "SELECT * FROM persentase_polda WHERE Periode = '$Periode_old' AND PG = '$PG_old'";
    $data = mysqli_query($koneksi, $sql);
    if(mysqli_num_rows($data) == 0){
        print_r("Menghapus ".$Periode." dan ".$PG);
        print_r("<br>");
        $sql = "DELETE FROM laporan_polda WHERE Periode = '$Periode_old' AND PG = '$PG_old'";
        mysqli_query($koneksi, $sql);
    }

    $periksaPeriode = mysqli_query($koneksi, "SELECT * FROM laporan_polda WHERE Periode = '$Periode' AND PG = '$PG'");
    if(mysqli_num_rows($periksaPeriode) == 0){
        mysqli_query($koneksi,"INSERT INTO laporan_polda (Periode, PG, Min, Max , Triwulan) VALUES ('$Periode', '$PG', '$Min', '$Max', '$Triwulan')");
    }
}

header("Location: polda.php");
exit;


?>
