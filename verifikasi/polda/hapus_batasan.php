<?php
session_start();

if (!isset($_SESSION['ssLogin'])) {
  header("Location: ../../auth/login.php");
  exit;
}

require_once "../../config/conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = intval($_POST['id']);

    // Query untuk menghapus data berdasarkan ID
    $query = "DELETE FROM batasan WHERE id = ?";
    $stmt = $koneksi->prepare($query);

    if ($stmt) {
      $stmt->bind_param("i", $id);
      
      if ($stmt->execute()) {
        $_SESSION['success_message'] = "Data berhasil dihapus.";
      } else {
        $_SESSION['error_message'] = "Gagal menghapus data. Silakan coba lagi.";
      }

      $stmt->close();
    } else {
      $_SESSION['error_message'] = "Terjadi kesalahan pada sistem.";
    }
  } else {
    $_SESSION['error_message'] = "ID data tidak ditemukan.";
  }
} else {
  $_SESSION['error_message'] = "Metode pengiriman tidak valid.";
}

header("Location: batasan.php");
exit;