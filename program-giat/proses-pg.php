<?php
session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location: ../auth/login.php");
    exit;
}

require_once "../config/conn.php";
require_once "../user/function/functions.php";

// Fungsi untuk memeriksa apakah Triwulan sudah ada berdasarkan Triwulan dan Periode
function getTriwulanId($triwulan, $periode) {
    global $koneksi;
    $query = "SELECT id FROM triwulan WHERE Triwulan = '$triwulan' AND Periode = '$periode'";
    $result = mysqli_query($koneksi, $query);
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        return $data['id']; // ID Triwulan yang sudah ada
    }
    return null; // Tidak ada Triwulan dengan kombinasi tersebut
}

// Menangani form submit
if (isset($_POST['simpan'])) {
    $triwulan = $_POST['triwulan'];
    $periode  = $_POST['periode'];
    $program  = $_POST['program'];
    $programId = $_POST['program_id']; // Mengambil ID Program dari hidden field

    // 1. Cek apakah Triwulan sudah ada
    $triwulanId = getTriwulanId($triwulan, $periode);

    // Jika Triwulan belum ada, insert Triwulan baru
    if ($triwulanId === null) {
        $queryTriwulan = "INSERT INTO triwulan (Triwulan, Periode) VALUES('$triwulan', '$periode')";
        if (mysqli_query($koneksi, $queryTriwulan)) {
            $triwulanId = mysqli_insert_id($koneksi); // ID Triwulan yang baru saja dimasukkan
        } else {
            echo "Error inserting Triwulan: " . mysqli_error($koneksi);
            exit;
        }
    }

    // 2. Cek apakah Program sudah ada
    // Jika ID Program kosong (tidak ada yang dipilih), insert Program baru
    if (empty($programId)) {
        $queryProgram = "INSERT INTO program (triwulan_id, nama_program) VALUES ('$triwulanId', '$program')";
        if (mysqli_query($koneksi, $queryProgram)) {
            $programId = mysqli_insert_id($koneksi); // ID Program yang baru saja dimasukkan
        } else {
            echo "Error inserting Program: " . mysqli_error($koneksi);
            exit;
        }
    }

    // 3. Menyimpan data Giat untuk Program yang sesuai
    if (!empty($_POST['giat'])) {
        foreach ($_POST['giat'] as $giat) {
            // Insert Giat yang berhubungan dengan Program ini
            $queryGiat = "INSERT INTO giat (program_id, nama_giat) VALUES ('$programId', '$giat')";
            if (!mysqli_query($koneksi, $queryGiat)) {
                echo "Error inserting Giat: " . mysqli_error($koneksi);
            }
        }
    }

    // Setelah data berhasil disimpan, arahkan kembali ke halaman triwulan.php
    header("Location: pg.php");
    exit;
}
?>
