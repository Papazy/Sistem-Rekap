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
    $id = $_POST['id'];

    $sql = "DELETE FROM triwulan WHERE id = '$id'";
    $query = mysqli_query($koneksi, $sql);

}
header("Location: triwulan.php");
exit;

?>
