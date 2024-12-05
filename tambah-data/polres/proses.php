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


// Proses form jika ada file yang diunggah
if (isset($_FILES["filecsv"])) {
    if ($_FILES["filecsv"]["error"] == UPLOAD_ERR_OK) {
        $file_temp = $_FILES["filecsv"]["tmp_name"];
        $handle = fopen($file_temp, "r");
        $data = array();
        $i = 0;

        while (($row = fgetcsv($handle, 2000, ";")) !== FALSE) {
            if (!empty($row[0])) {
                $data[$i] = $row;
            }
            $i++;
        }

        fclose($handle);
        $data = array_slice($data, 1);

        if (isset($_POST['simpan'])) {
            $Periode    = $_POST['Periode'];
            $PG         = $_POST['PG'];
            $Min        = $_POST['Min'];
            $Max        = $_POST['Max'];
            $Triwulan   = $_POST['Triwulan'];

            try {
                $Polres = "";
                foreach ($data as $row) {
                    $Polres = $row[0];
                    $Persentase = $row[1];
                    $Persentase = gantiKoma($Persentase);
                    mysqli_query($koneksi, "INSERT INTO persentase_polres (Polres, Periode, Persentase, PG, Triwulan) VALUES ('$Polres', '$Periode', '$Persentase', '$PG', '$Triwulan')");
                }
                mysqli_query($koneksi, "INSERT INTO laporan_polres (Periode, PG, Min, Max , Triwulan) VALUES ('$Periode', '$PG', '$Min', '$Max', '$Triwulan')");

                echo "<script>
                    alert('Data berhasil disimpan');
                    document.location.href = 'add-laporan.php';
                </script>";
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    } else {
        echo "Error saat mengunggah file";
    }
} elseif (isset($_POST['simpan'])) {
    // Proses form jika tidak ada file yang diunggah
    $Periode    = $_POST['Periode'];
    $PG         = $_POST['PG'];
    $Min        = $_POST['Min'];
    $Max        = $_POST['Max'];
    $Triwulan   = $_POST['Triwulan'];
    
    // Ambil nilai Polres dari form manual
    $Polres     = $_POST['Polda'];

    try {
        // Simpan data ke database
        mysqli_query($koneksi, "INSERT INTO persentase_polres (Polres, Periode, Persentase, PG, Triwulan) VALUES ('$Polres', '$Periode', '0', '$PG', '$Triwulan')");
        mysqli_query($koneksi, "INSERT INTO laporan_polres (Periode, PG, Min, Max , Triwulan) VALUES ('$Periode', '$PG', '$Min', '$Max', '$Triwulan')");

        echo "<script>
            alert('Data berhasil disimpan');
            document.location.href = 'add-laporan.php';
        </script>";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Setelah kode diatas di proses, pindah ke halaman index.php
header("Location: ../../laporan/polres.php");
exit;

?>
