<?php
require_once "../config/conn.php";

if (isset($_POST['id'])) {
    $triwulan_id = htmlspecialchars(trim($_POST['id']), ENT_QUOTES, 'UTF-8');

    // Validasi ID
    if (!ctype_digit($triwulan_id)) {
        header("location: triwulan.php?message=invalid");
        exit;
    }

    // Periksa apakah ID triwulan valid
    $queryCheckTriwulan = "SELECT id FROM triwulan WHERE id = ?";
    $stmtCheck = $koneksi->prepare($queryCheckTriwulan);
    $stmtCheck->bind_param("i", $triwulan_id);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();

    if ($resultCheck && $resultCheck->num_rows > 0) {
        // Mulai transaksi
        $koneksi->begin_transaction();

        try {
            // Hapus semua giat yang terkait dengan program dalam triwulan
            $deleteGiatQuery = "
                DELETE giat.* 
                FROM giat 
                INNER JOIN program ON giat.program_id = program.id 
                WHERE program.triwulan_id = ?
            ";
            $stmtDeleteGiat = $koneksi->prepare($deleteGiatQuery);
            $stmtDeleteGiat->bind_param("i", $triwulan_id);
            $stmtDeleteGiat->execute();

            // Hapus triwulan (program akan otomatis terhapus karena ON DELETE CASCADE)
            $deleteTriwulanQuery = "DELETE FROM triwulan WHERE id = ?";
            $stmtDeleteTriwulan = $koneksi->prepare($deleteTriwulanQuery);
            $stmtDeleteTriwulan->bind_param("i", $triwulan_id);
            $stmtDeleteTriwulan->execute();

            // Commit transaksi
            $koneksi->commit();
            header("location: triwulan.php?message=success");
            exit;
        } catch (Exception $e) {
            // Rollback jika ada error
            $koneksi->rollback();
            header("location: triwulan.php?message=error");
            exit;
        }
    } else {
        // Jika ID triwulan tidak ditemukan
        header("location: triwulan.php?message=not_found");
        exit;
    }
} else {
    // Jika ID tidak diberikan
    header("location: triwulan.php?message=invalid");
    exit;
}
?>
