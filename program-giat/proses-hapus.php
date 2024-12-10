<?php
require_once "../config/conn.php";

if (isset($_POST['giat_id'])) {
    $giat_id = $_POST['giat_id'];

    // Ambil data terkait giat, program, dan triwulan
    $queryData = "
        SELECT 
            triwulan.id AS triwulan_id, 
            triwulan.Triwulan, 
            triwulan.Periode, 
            program.nama_program, 
            giat.nama_giat, 
            giat.id AS giat_id 
        FROM triwulan
        JOIN program ON program.triwulan_id = triwulan.id
        JOIN giat ON giat.program_id = program.id
        WHERE giat.id = '$giat_id'
    ";
    $resultData = mysqli_query($koneksi, $queryData);

    if ($resultData && mysqli_num_rows($resultData) > 0) {
        $data = mysqli_fetch_assoc($resultData);
        $programId = $data['program_id'];
        $triwulanId = $data['triwulan_id'];

        // Hapus data di tabel Giat
        $deleteGiatQuery = mysqli_query($koneksi, "DELETE FROM giat WHERE id = '$giat_id'");

        if ($deleteGiatQuery) {
            // *** Cek dan Hapus Program jika tidak ada lagi giat yang menggunakan program tersebut ***
            $queryProgramUsage = "SELECT COUNT(*) AS count FROM giat WHERE program_id = '$programId'";
            $resultProgramUsage = mysqli_query($koneksi, $queryProgramUsage);
            $programUsageCount = mysqli_fetch_assoc($resultProgramUsage)['count'];

            if ($programUsageCount == 0) {
                // Jika tidak ada giat lain yang menggunakan program, hapus program
                $deleteProgramQuery = mysqli_query($koneksi, "DELETE FROM program WHERE id = '$programId'");
            }

            // *** Cek dan Hapus Triwulan jika tidak ada program yang menggunakan triwulan tersebut ***
            $queryTriwulanUsage = "SELECT COUNT(*) AS count FROM program WHERE triwulan_id = '$triwulanId'";
            $resultTriwulanUsage = mysqli_query($koneksi, $queryTriwulanUsage);
            $triwulanUsageCount = mysqli_fetch_assoc($resultTriwulanUsage)['count'];

            if ($triwulanUsageCount == 0) {
                // Jika tidak ada program yang menggunakan triwulan, hapus triwulan
                $deleteTriwulanQuery = mysqli_query($koneksi, "DELETE FROM triwulan WHERE id = '$triwulanId'");
            }

            // Redirect dengan pesan sukses
            header("location: pg.php?message=success");
        } else {
            // Jika gagal menghapus giat
            header("location: pg.php?message=error");
        }
    } else {
        // Jika giat_id tidak ditemukan
        header("location: pg.php?message=invalid");
    }
} else {
    // Jika giat_id tidak diberikan
    header("location: pg.php?message=invalid");
}
?>
