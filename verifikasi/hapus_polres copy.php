<?php


session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location: ../auth/login.php");
    exit;
}

require_once "../config/conn.php";
require_once "../user/function/functions.php";

// Periksa apakah ada filecsv

if (isset($_POST["submit"])){
    $id         = $_POST['id'];
    

    $sql = "SELECT * FROM persentase_polres WHERE id = '$id'";
    $data = mysqli_query($koneksi, $sql);

    $row = mysqli_fetch_assoc($data);
    // var_dump($row["Periode"]);

    $Periode = $row["Periode"];
    $PG = $row["PG"];

    
    print_r($row);
    print_r("<br>");
    // menghapus data
    $sql = "DELETE FROM persentase_polres WHERE id = '$id'";
    $query = mysqli_query($koneksi, $sql);
    
    // Periksa apakah masih ada Persentase di periode tersebut
    $sql = "SELECT * FROM persentase_polres WHERE Periode = '$Periode' AND PG = '$PG'";
    $data = mysqli_query($koneksi, $sql);
    if(mysqli_num_rows($data) == 0){
        print_r("Menghapus ".$Periode." dan ".$PG);
        print_r("<br>");
        $sql = "DELETE FROM laporan_polres WHERE Periode = '$Periode' AND PG = '$PG'";
        mysqli_query($koneksi, $sql);
    }





}
header("Location: polres.php");
exit;

?>
