<?php

    session_start();

    if (!isset($_SESSION["ssLogin"])) {
        header("location: ../../auth/login.php");
        exit;
    }

    require_once "../../config/conn.php";
    require_once "../../user/function/functions.php";

    $title = "Edit Judul - Sistem Evaluasi Polres";
    require_once "../header.php";
    require_once "../navbar.php";
    require_once "../sidebar.php";

    // Ambil data riwayat judul
    $sql = "SELECT id, judul, tanggal FROM judul_riwayat ORDER BY tanggal DESC";
    $result = $koneksi->query($sql);

    $riwayatJudul = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $riwayatJudul[] = $row;
        }
    }

    $koneksi->close();
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Judul Halaman</h1>
            <ol class="breadcrumb mb-3">
                <li class="breadcrumb-item"><a href="../../index.php">Home</a></li>
                <li class="breadcrumb-item active">Edit Judul</li>
            </ol>
            
            <!-- Tabel Riwayat Judul Sebelumnya -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="text-bg-light"">
                        <tr>
                            <th><center>No.</center></th>
                            <th><center>Judul Sebelumnya</center></th>
                            <th><center>Tanggal Perubahan</center></th>
                        </tr>
                    </thead>
                    <style>
                        .table td {
                            opacity: 0.9; /* Atur tingkat opasitas di sini */
                        }
                        .form-group label {
                            text-align: center; /* Memusatkan teks label */
                            display: block; /* Menjadikan label sebagai blok */
                        }
                        .form-group input {
                            opacity: 0.9; /* Atur tingkat opasitas di sini */
                        }
                    </style>
                    <tbody>
                        <?php
                        if (!empty($riwayatJudul)) {
                            foreach ($riwayatJudul as $index => $riwayat) {
                                echo "<tr>";
                                echo "<td><center>" . ($index + 1) . "</center></td>";
                                echo "<td>" . htmlspecialchars($riwayat['judul']) . "</td>";
                                echo "<td><center>" . htmlspecialchars($riwayat['tanggal']) . "</center></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3' class='text-center'>Tidak ada data riwayat judul.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            
            <form action="proses-edit.php" method="post">
                <div class="form-group mb-2">
                    <label for="judul" class="col-form-label baru"><h5>Masukan Judul Baru</h5></label>
                    <input type="text" class="form-control" id="judul" name="judul" placeholder="<?php echo htmlspecialchars($main_title); ?>" required>
                </div>
                <button type="submit" name="edit-judul" class="btn btn-primary btn-block rounded mt-2 w-100"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
            </form>
        </div>
    </main>

<?php

require_once "../footer.php";

?>
