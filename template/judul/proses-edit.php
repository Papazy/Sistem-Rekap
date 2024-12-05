<?php 

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location: auth/login.php");
    exit;
}

require_once "../../config/conn.php";
require_once "../../user/function/functions.php";

// jika tombol simpan ditekan
if (isset($_POST['judul'])) {
    $main_title = $_POST['judul'];
    
    // Simpan judul baru ke dalam sesi
    $_SESSION['main_title'] = $main_title;

    // Simpan judul baru ke dalam tabel judul_riwayat
    $conn = $koneksi;

    // Cek koneksi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert judul baru ke dalam tabel judul_riwayat
    $sql_insert = "INSERT INTO judul_riwayat (judul) VALUES (?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("s", $main_title);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}

header("Location:edit-judul.php");
exit;


?>
