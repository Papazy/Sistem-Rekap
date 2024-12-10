<?php
session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location: ../auth/login.php");
    exit;
}

require_once "../config/conn.php";

// Fungsi sanitasi input
function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

// Periksa apakah tombol simpan telah diklik
if (isset($_POST["simpan"])) {
    // Ambil ID triwulan dari form
    $id = isset($_POST['id']) ? sanitizeInput($_POST['id']) : null;
    $triwulan = sanitizeInput($_POST['triwulan']); // Data Triwulan
    $tenggat = sanitizeInput($_POST['tenggat']);   // Data Tenggat

    // Validasi ID triwulan
    if ($id && is_numeric($id)) {
        // Update data triwulan dan tenggat
        $queryUpdate = "
            UPDATE triwulan 
            SET Triwulan = '$triwulan', Tenggat = '$tenggat' 
            WHERE id = '$id'
        ";
        $resultUpdate = mysqli_query($koneksi, $queryUpdate);

        if ($resultUpdate) {
            // Jika berhasil, redirect ke halaman triwulan
            $_SESSION['success'] = "Data berhasil diperbarui!";
            header("Location: triwulan.php");
            exit;
        } else {
            // Jika gagal, tampilkan pesan error
            $_SESSION['error'] = "Terjadi kesalahan saat memperbarui data.";
        }
    } else {
        $_SESSION['error'] = "ID tidak valid!";
    }
}

// Redirect jika tidak ada aksi
header("Location: triwulan.php");
exit;
?>
