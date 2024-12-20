<?php
session_start();
if (!isset($_SESSION['ssLogin'])) {
    header("location: ../../auth/login.php");
    exit;
}

require_once "../../config/conn.php";

// Fungsi untuk mengganti koma dengan titik pada nilai desimal
function gantiKoma($nilai) {
    return strpos($nilai, ',') !== false ? str_replace(',', '.', $nilai) : $nilai;
}

// Validasi Min dan Max
function validasiMinMax($nilai) {
    // Mengganti koma dengan titik dan memastikan nilai adalah desimal positif
    $nilai = gantiKoma($nilai);
    return filter_var($nilai, FILTER_VALIDATE_FLOAT) && $nilai >= 0 ? $nilai : 0;
}

if (isset($_FILES["filecsv"])) {
    if ($_FILES["filecsv"]["error"] == UPLOAD_ERR_OK) {
        $file_temp = $_FILES["filecsv"]["tmp_name"];
        $handle = fopen($file_temp, "r");
        $data = array();

        $i = 0;
        while (($row = fgetcsv($handle, 2000, ",")) !== FALSE) {
            if (!empty($row[0])) {
                $data[$i] = $row;
            }
            $i++;
        }

        fclose($handle);

        // Hapus header dari data
        $data = array_slice($data, 1);

        if (isset($_POST['simpan'])) {
            $Periode    = $_POST['Periode'];
            $Triwulan   = $_POST['Triwulan'];
            $program    = $_POST['program'];
            $giat       = $_POST['giat'];
            
            // Validasi dan konversi Min dan Max
            $Min        = validasiMinMax($_POST['Min']);
            $Max        = validasiMinMax($_POST['Max']);
            
            $Min_upload = $_POST['Min_upload'];
            $Max_upload = $_POST['Max_upload'];
        }

        try {
            foreach ($data as $row) {
                $Polda              = $row[0]; 
                $Polres             = $row[1]; 
                $Sudah_Upload       = (int)$row[2];
                $Sudah_Diverifikasi = (int)$row[3];
                $Belum_Diverifikasi = (int)$row[4];
                $Ditolak            = (int)$row[5];
                $Ditolak_akumulasi  = (int)$row[6];
                $Persentase         = gantiKoma($row[7]);

                // Query untuk memasukkan data
                $query = "INSERT INTO verifikasi_polres (Polda, Polres, Sudah_diupload, Sudah_diverifikasi, Belum_diverifikasi, Ditolak, Ditolak_akumulasi, Persentase, Periode, Triwulan, program, giat, Min, Max, Min_upload, Max_upload)
                          VALUES ('$Polda', '$Polres', '$Sudah_Upload', '$Sudah_Diverifikasi', '$Belum_Diverifikasi', '$Ditolak', '$Ditolak_akumulasi', '$Persentase', '$Periode', '$Triwulan', '$program', '$giat', '$Min', '$Max', '$Min_upload', '$Max_upload')";
                mysqli_query($koneksi, $query);
            }

            $_SESSION['pesan'] = "Data berhasil diunggah dan disimpan.";
            header("Location: ../../laporan/polres/polres.php");
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        var_dump("Error saat mengunggah file");
    }
} else {
    var_dump("Tidak ada file yang diunggah");
}

exit;
?>
