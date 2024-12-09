<?php
session_start();

if (!isset($_SESSION['ssLogin'])) {
  header("Location: ../../auth/login.php");
  exit;
}

require_once "../../config/conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (
    isset($_POST['id'], $_POST['nama'], $_POST['satuan'], $_POST['min'], $_POST['max'], $_POST['min_file'], $_POST['max_file']) &&
    !empty($_POST['id']) && !empty($_POST['nama']) && !empty($_POST['satuan']) &&
    isset($_POST['min']) && isset($_POST['max']) && isset($_POST['min_file']) && isset($_POST['max_file'])
  ) {
    $id = intval($_POST['id']);
    $nama = htmlspecialchars(trim($_POST['nama']));
    $satuan = htmlspecialchars(trim($_POST['satuan']));
    $min = floatval($_POST['min']);
    $max = floatval($_POST['max']);
    $min_file = intval($_POST['min_file']);
    $max_file = intval($_POST['max_file']);

    // Query untuk mengupdate data
    $query = "UPDATE batasan SET nama = ?, satuan = ?, min = ?, max = ?, min_file = ?, max_file = ? WHERE id = ?";
    $stmt = $koneksi->prepare($query);

    if ($stmt) {
      $stmt->bind_param("ssdiidd", $nama, $satuan, $min, $max, $min_file, $max_file, $id);

      if ($stmt->execute()) {
        $_SESSION['success_message'] = "Data berhasil diperbarui.";
      } else {
        $_SESSION['error_message'] = "Gagal memperbarui data. Silakan coba lagi.";
      }

      $stmt->close();
    } else {
      $_SESSION['error_message'] = "Terjadi kesalahan pada sistem.";
    }
  } else {
    $_SESSION['error_message'] = "Data yang dikirim tidak lengkap.";
  }
} else {
  $_SESSION['error_message'] = "Metode pengiriman tidak valid.";
}

header("Location: batasan.php");
exit;
