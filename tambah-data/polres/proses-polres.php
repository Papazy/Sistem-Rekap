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


// Periksa apakah ada filecsv
if (isset($_FILES["filecsv"])) {

    // Cek apakah tidak ada error saat upload
    if ($_FILES["filecsv"]["error"] == UPLOAD_ERR_OK) {

        // Mengambil tempat penyimpanan sementara file
        $file_temp = $_FILES["filecsv"]["tmp_name"];

        // Membuka file
        $handle = fopen($file_temp, "r");

        // Membuat array untuk data dari csv
        $data = array();

        $i = 0; // Variabel untuk menghitung baris

        // Baca baris demi baris dari file CSV, lalu memisahkan antar data yang terpisah dengan ";"
        while (($row = fgetcsv($handle, 2000, ";")) !== FALSE) {
            // Tambahkan baris ke dalam array $data, jika baris tersebut memiliki data
            if (!empty($row[0])) {
                $data[$i] = $row;
            }
            $i++; // menambah banyaknya baris
        }

        // Tutup file CSV
        fclose($handle);

        // Menghapus header data
        $data = array_slice($data, 1);

        // Mengupload data ke mysql
        if (isset($_POST['simpan'])) {
            $Periode    = $_POST['Periode'];
            var_dump("Periode");
            var_dump($Periode);
            $PG         = $_POST['PG'];
            $Min        = $_POST['Min'];
            $Max        = $_POST['Max'];
            $Triwulan   = $_POST['Triwulan'];
        }
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
        } catch (Exception $e) { // Handle error
            echo "Error: " . $e->getMessage();
        }
    } else {
        // Tampilkan pesan error jika upload gagal
        var_dump("Error saat mengunggah file");
    }
} else {
    // Tampilkan pesan bila tidak ada file
    var_dump("Tidak ada file yang diunggah");
}

// Setelah kode diatas di proses, pindah ke halaman index.php
header("Location: ../../laporan/polres.php");
exit;

?>
