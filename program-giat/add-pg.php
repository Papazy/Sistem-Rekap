<?php
session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location: ../auth/login.php");
    exit;
}

require_once "../config/conn.php";
require_once "../user/function/functions.php";

$title = "Tambah Triwulan - Sistem Evaluasi Polres";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tambah Program Giat</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="pg.php">Program Giat</a></li>
                <li class="breadcrumb-item active">Tambah Program Giat</li>
            </ol>
            <form action="proses-pg.php" method="POST">
                <div class="card">
                    <div class="card-header">
                        <span class="h5 my-2"><i class="fa-regular fa-square-plus"></i> Program Giat</span>
                        <button type="submit" name="simpan" class="btn btn-primary float-end"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                        <button type="reset" name="reset" id="resetButton" class="btn btn-danger float-end me-2"><i class="fa-solid fa-rotate-left"></i> Reset</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-11">
                                <!-- Input Triwulan -->
                                <div class="mb-3 row">
                                    <label for="triwulan" class="col-sm-2 col-form-label">Triwulan</label>
                                    <label for="triwulan" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -45px;">
                                        <input type="number" name="triwulan" id="triwulan" class="form-control-plaintext border-bottom" placeholder="isi" required>
                                    </div>
                                </div>

                                <!-- Input Program -->
                                <div class="mb-3 row">
                                    <!-- Menyimpan ID Program dalam hidden field -->
                                    <input type="hidden" name="program_id" id="program_id" value="">
                                    <label for="program" class="col-sm-2 col-form-label">Program</label>
                                    <label for="program" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -45px;">
                                        <input type="text" name="program" id="program" class="form-control-plaintext border-bottom" placeholder="isi" >
                                    </div>
                                    <div class="col-sm-1">
                                        <button type="button" class="btn btn-sm position-absolute" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; transform: translateY(-140%); margin-left: 930px;"><i class="fa-solid fa-arrow-down"></i></button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <?php
                                            // Ambil semua data Program yang sudah ada
                                            $resultProgram = mysqli_query($koneksi, "SELECT * FROM program");

                                            // Array untuk menyimpan data yang sudah difilter
                                            $programsByLetter = [];

                                            // Proses untuk mengelompokkan data berdasarkan huruf pertama
                                            while ($programRow = mysqli_fetch_assoc($resultProgram)) {
                                                // Ambil huruf pertama dari nama_program
                                                $firstLetter = strtoupper(substr($programRow['nama_program'], 0, 1));

                                                // Cek apakah huruf pertama sudah ada dalam array
                                                if (!isset($programsByLetter[$firstLetter])) {
                                                    // Jika belum ada, tambahkan program ini ke dalam array berdasarkan huruf pertama
                                                    $programsByLetter[$firstLetter] = $programRow;
                                                }
                                            }

                                            // Tampilkan data yang sudah difilter
                                            foreach ($programsByLetter as $programRow) {
                                                echo "<li><a class='dropdown-item' href='#' onclick='setProgram(\"" . $programRow['nama_program'] . "\", \"" . $programRow['id'] . "\")'>" . $programRow['nama_program'] . "</a></li>";
                                            }
                                            ?>

                                        </ul>
                                    </div>
                                </div>

                                <!-- Input Giat (Multiple) -->
                                <div class="mb-2 row">
                                    <label for="giat" class="col-sm-2 col-form-label">Giat</label>
                                    <label for="giat" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9 position-relative" style="margin-left: -45px;">
                                        <div id="giatInputs">
                                            <div class="giat-group">
                                                <input type="text" name="giat[]" class="form-control-plaintext border-bottom mb-2" placeholder="isi" >
                                            </div>
                                        </div>
                                        <button type="button" id="addGiat" class="btn btn-sm position-fixed" style="transform: translateY(-150%); margin-left: 724px; color: black;"><i class="fa-solid fa-plus"></i></button>
                                    </div>
                                </div>

                                <!-- Input Periode -->
                                <div class="mb-3 row">
                                    <label for="periode" class="col-sm-2 col-form-label">Periode</label>
                                    <label for="periode" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -45px;">
                                        <input type="date" name="periode" id="periode" class="form-control-plaintext border-bottom" placeholder="isi" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </main>

    <?php
    require_once "../template/footer.php";
    ?>

    <script>
        // Function to add new Giat input
        document.getElementById("addGiat").addEventListener("click", function() {
            var giatGroup = document.createElement("div");
            giatGroup.classList.add("giat-group");
            giatGroup.innerHTML = '<input type="text" name="giat[]" class="form-control-plaintext border-bottom mb-2" placeholder="isi" required>';
            document.getElementById("giatInputs").appendChild(giatGroup);
        });

        document.getElementById("resetButton").addEventListener("click", function() {
            // Menghapus semua input Giat kecuali yang pertama
            const giatInputs = document.querySelectorAll("#giatInputs .giat-group");

            // Mulai dari input kedua, karena yang pertama tidak dihapus
            for (let i = 1; i < giatInputs.length; i++) {
                giatInputs[i].remove();
            }
        });
        // Fungsi untuk mengisi input program dan menyimpan ID Program
        function setProgram(programName, programId) {
            document.getElementById('program').value = programName;
            document.getElementById('program_id').value = programId; // Menyimpan ID Program
        }
    </script>