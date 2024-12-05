<?php


session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location: ../../auth/login.php");
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

function periksaPeriodeJikaSudahAda($periode, $PG){
    global $koneksi;
    mysqli_query($koneksi, "SELECT * FROM laporan_polda WHERE Periode = '$periode' AND PG = '$PG'");
    if(mysqli_affected_rows($koneksi) > 0){
        return true;
    }else{
        return false;
    }
}
// Mengupload data ke mysql
if (isset($_POST['submit'])) {
    $Satker     = $_POST['Satker'];
    $Periode    = $_POST['Periode'];
    $Persentase = $_POST['Persentase'];
    $Persentase = gantiKoma($Persentase);
    $PG         = $_POST['PG'];
    $Min        = $_POST['Min'];
    $Max        = $_POST['Max'];
    $Triwulan   = $_POST['Triwulan'];
    try {
        mysqli_query($koneksi, "INSERT INTO persentase_polda (Satker, Periode, Persentase, PG, Triwulan) VALUES ('$Satker', '$Periode', '$Persentase', '$PG', '$Triwulan')");
        if(!periksaPeriodeJikaSudahAda($Periode, $PG)){
            mysqli_query($koneksi, "INSERT INTO laporan_polda (Periode, PG, Min, Max , Triwulan) VALUES ('$Periode', '$PG', '$Min', '$Max', '$Triwulan')");
        }

        echo "<script>
                alert('Data berhasil disimpan');
                document.location.href = 'add-laporan.php';
                </script>";
    } catch (Exception $e) { // Handle error
        echo "Error: " . $e->getMessage();
    }
}


// Setelah kode diatas di proses, pindah ke halaman index.php
header("Location: ../../laporan/polda.php");
exit;

?>