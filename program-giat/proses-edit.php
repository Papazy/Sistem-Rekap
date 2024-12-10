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
    $giatId = isset($_POST['giat_id']) ? sanitizeInput($_POST['giat_id']) : null; // ID Giat
    $triwulan = sanitizeInput($_POST['triwulan']); // Data Triwulan
    $periode = sanitizeInput($_POST['periode']);   // Data Periode
    $program = sanitizeInput($_POST['program']);   // Data Program
    $giat = sanitizeInput($_POST['giat']);         // Nama Giat Baru

    if ($giatId) {
        // Cari data triwulan dan program terkait giat yang dipilih
        $queryData = "
            SELECT 
                program.id AS program_id, 
                triwulan.id AS triwulan_id 
            FROM giat
            INNER JOIN program ON giat.program_id = program.id
            INNER JOIN triwulan ON program.triwulan_id = triwulan.id
            WHERE giat.id = '$giatId'
        ";
        $resultData = mysqli_query($koneksi, $queryData);

        if ($resultData && mysqli_num_rows($resultData) > 0) {
            $data = mysqli_fetch_assoc($resultData);
            $currentProgramId = $data['program_id'];
            $currentTriwulanId = $data['triwulan_id'];

            // *** STEP 1: Periksa Triwulan ***
            $queryTriwulan = "
                SELECT id 
                FROM triwulan 
                WHERE Triwulan = '$triwulan' AND Periode = '$periode'
            ";
            $resultTriwulan = mysqli_query($koneksi, $queryTriwulan);

            if ($resultTriwulan && mysqli_num_rows($resultTriwulan) > 0) {
                // Jika triwulan sudah ada
                $newTriwulanId = mysqli_fetch_assoc($resultTriwulan)['id'];
            } else {
                // Tambahkan triwulan baru jika tidak ada
                $queryInsertTriwulan = "
                    INSERT INTO triwulan (Triwulan, Periode) 
                    VALUES ('$triwulan', '$periode')
                ";
                mysqli_query($koneksi, $queryInsertTriwulan);
                $newTriwulanId = mysqli_insert_id($koneksi);
            }

            // *** STEP 2: Periksa Program ***
            $queryProgram = "
                SELECT id 
                FROM program 
                WHERE triwulan_id = '$newTriwulanId' AND nama_program = '$program'
            ";
            $resultProgram = mysqli_query($koneksi, $queryProgram);

            if ($resultProgram && mysqli_num_rows($resultProgram) > 0) {
                // Jika program sudah ada
                $newProgramId = mysqli_fetch_assoc($resultProgram)['id'];
            } else {
                // Tambahkan program baru jika tidak ada
                $queryInsertProgram = "
                    INSERT INTO program (triwulan_id, nama_program) 
                    VALUES ('$newTriwulanId', '$program')
                ";
                mysqli_query($koneksi, $queryInsertProgram);
                $newProgramId = mysqli_insert_id($koneksi);
            }

            // *** STEP 3: Update Giat ***
            // Periksa apakah hanya giat yang diubah, atau seluruh data (triwulan/program) yang diubah
            if ($currentProgramId != $newProgramId || $currentTriwulanId != $newTriwulanId) {
                // Jika Program atau Triwulan berubah, update ID Giat juga
                $queryUpdateGiat = "
                    UPDATE giat 
                    SET nama_giat = '$giat', program_id = '$newProgramId' 
                    WHERE id = '$giatId'
                ";
                mysqli_query($koneksi, $queryUpdateGiat);
            } else {
                // Jika hanya nama Giat yang diubah, cukup update nama Giat
                $queryUpdateGiat = "
                    UPDATE giat 
                    SET nama_giat = '$giat' 
                    WHERE id = '$giatId'
                ";
                mysqli_query($koneksi, $queryUpdateGiat);
            }

            // Debugging logs
            error_log("Updated Giat: $giatId, New Program ID: $newProgramId, New Triwulan ID: $newTriwulanId");
        } else {
            error_log("Error: Giat ID $giatId tidak ditemukan!");
        }
    } else {
        error_log("Error: Tidak ada ID giat yang diberikan!");
    }

    // Redirect setelah berhasil
    header("Location: pg.php");
    exit;
}
?>
