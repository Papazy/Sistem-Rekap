<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location: ../../auth/login.php");
    exit;
}

require_once "../../config/conn.php";
require_once "../../user/function/functions.php";

$title = "Tambah Polres - Sistem Evaluasi Polres";
require_once "../../template/header.php";
require_once "../../template/navbar.php";
require_once "../../template/sidebar.php";

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tambah Polres</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../../../index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= $main_url ?>laporan/polres/polres.php">Polres</a></li>
                <li class="breadcrumb-item active">Tambah Polres</li>
            </ol>
            <form action="proses-polres.php" method="POST" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        <span class="h5 my-2"><i class="fa-regular fa-square-plus"></i> Form Verifikasi Polres</span>
                        <button type="submit" name="simpan" class="btn btn-primary float-end"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                        <button type="reset" name="reset" class="btn btn-danger float-end me-1"><i class="fa-solid fa-rotate-left"></i> Reset</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-11">
                                <div class="mb-3 row">
                                    <label for="Tw" class="col-sm-2 col-form-label">Triwulan</label>
                                    <label for="Tw" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -45px;">
                                        <select name="Triwulan" id="Triwulan" class="form-select border-0 border-bottom">
                                            <option value="" selected>-- Pilih --</option>
                                            <?php
                                            // Query data triwulan dari database
                                            $queryTriwulan = "SELECT id FROM triwulan ORDER BY id";
                                            $resultTriwulan = mysqli_query($koneksi, $queryTriwulan);

                                            // Fungsi untuk mengubah angka menjadi format TW I, TW II, dll.
                                            function convertToRoman($number)
                                            {
                                                $map = [
                                                    1 => 'I',
                                                    2 => 'II',
                                                    3 => 'III',
                                                    4 => 'IV',
                                                    5 => 'V',
                                                    6 => 'VI',
                                                    7 => 'VII',
                                                    8 => 'VIII',
                                                    9 => 'IX',
                                                    10 => 'X'
                                                ];
                                                return $map[$number] ?? $number;
                                            }

                                            // Loop untuk mengisi dropdown
                                            if ($resultTriwulan && mysqli_num_rows($resultTriwulan) > 0) {
                                                while ($rowTriwulan = mysqli_fetch_assoc($resultTriwulan)) {
                                                    $romanNumber = convertToRoman($rowTriwulan['id']); // Konversi angka ke format Romawi
                                                    echo "<option value='{$rowTriwulan['id']}'>TW {$romanNumber}</option>";
                                                }
                                            } else {
                                                echo "<option value=''>Tidak ada data</option>";
                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="Tw" class="col-sm-2 col-form-label">Program</label>
                                    <label for="Tw" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -45px;">
                                        <select name="program" id="program" class="form-select border-0 border-bottom">
                                            <option value="" selected>-- Pilih --</option>
                                            <?php
                                            if (isset($_GET['triwulan']) && $_GET['triwulan'] != '') {
                                                $selectedTriwulan = $_GET['triwulan'];
                                                $queryProgram = "SELECT id, nama_program FROM program WHERE triwulan_id = '$selectedTriwulan' ORDER BY nama_program";
                                                $resultProgram = mysqli_query($koneksi, $queryProgram);

                                                while ($rowProgram = mysqli_fetch_assoc($resultProgram)) {
                                                    $selected = (isset($_GET['program']) && $_GET['program'] == $rowProgram['id']) ? 'selected' : '';
                                                    echo "<option value='{$rowProgram['id']}' $selected>{$rowProgram['nama_program']}</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="Tw" class="col-sm-2 col-form-label">Giat</label>
                                    <label for="Tw" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -45px;">
                                        <select name="giat" id="giat" class="form-select border-0 border-bottom">
                                            <option value="" selected>-- Pilih --</option>
                                            <?php
                                            if (isset($_GET['program']) && $_GET['program'] != '') {
                                                $selectedProgram = $_GET['program'];
                                                $queryGiat = "SELECT id, nama_giat FROM giat WHERE program_id = '$selectedProgram' ORDER BY nama_giat";
                                                $resultGiat = mysqli_query($koneksi, $queryGiat);

                                                while ($rowGiat = mysqli_fetch_assoc($resultGiat)) {
                                                    $selected = (isset($_GET['giat']) && $_GET['giat'] == $rowGiat['id']) ? 'selected' : '';
                                                    echo "<option value='{$rowGiat['id']}' $selected>{$rowGiat['nama_giat']}</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="Periode" class="col-sm-2 col-form-label">Periode</label>
                                    <label for="Periode" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -45px;">
                                        <input type="datetime-local" name="Periode" class="form-control-plaintext border-bottom" id="Periode" required>
                                    </div>
                                </div>
                                <div class=" mt-1 mb-3 row">
                                    <label for="Periode" class="col-sm-2 col-form-label">Data Verifikasi</label>
                                    <label for="Periode" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="file" name="filecsv" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-6">
                                        <label for="Min" class="col-form-label">Min Persentase</label>
                                        <input type="number" name="Min" id="Min" class="form-control-plaintext border-bottom" style="margin-left: 20px;" placeholder="isi" step="any" required>
                                    </div>
                                    <div class="col-sm-5">
                                        <label for="Min_upload" class="col-form-label">Min Upload File</label>
                                        <input type="number" name="Min_upload" id="Min_upload" class="form-control-plaintext border-bottom" style="margin-left: 20px;" placeholder="isi" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-sm-6">
                                        <label for="Max" class="col-form-label">Max Persentase</label>
                                        <input type="number" name="Max" id="Max" class="form-control-plaintext border-bottom" style="margin-left: 20px;" placeholder="isi" step="any" required>
                                    </div>
                                    <div class="col-sm-5">
                                        <label for="Max_upload" class="col-form-label">Max Upload File</label>
                                        <input type="number" name="Max_upload" id="Max_upload" class="form-control-plaintext border-bottom" style="margin-left: 20px;" placeholder="isi" required>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </main>

    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            document.querySelectorAll('input[type="number"]').forEach(function(input) {
                // Ganti koma dengan titik
                input.value = input.value.replace(',', '.');
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const triwulanDropdown = document.getElementById("Triwulan");
            const programDropdown = document.getElementById("program");
            const giatDropdown = document.getElementById("giat");

            // Set dropdown Program disabled secara default
            programDropdown.disabled = true;
            giatDropdown.disabled = true;

            // Menentukan apakah sudah ada parameter triwulan dan program di URL
            const urlParams = new URLSearchParams(window.location.search);
            const triwulanId = urlParams.get('triwulan');
            const programId = urlParams.get('program');

            // Menjaga agar triwulan dan program yang dipilih tetap ada
            if (triwulanId) {
                triwulanDropdown.value = triwulanId; // Menetapkan nilai yang terpilih
                programDropdown.disabled = false; // Mengaktifkan dropdown Program
            }
            if (programId) {
                programDropdown.value = programId; // Menetapkan nilai yang terpilih
                giatDropdown.disabled = false; // Mengaktifkan dropdown Giat
            }

            // Event listener untuk memilih Triwulan
            triwulanDropdown.addEventListener("change", function() {
                const triwulanId = this.value;
                if (triwulanId) {
                    // Reload halaman dengan parameter triwulan
                    window.location.href = `?triwulan=${triwulanId}`;
                } else {
                    // Reset program dan giat jika Triwulan tidak dipilih
                    programDropdown.disabled = true;
                    giatDropdown.disabled = true;
                    programDropdown.innerHTML = '<option value="">-- Pilih Program --</option>';
                    giatDropdown.innerHTML = '<option value="">-- Pilih Giat --</option>';
                }
            });

            // Event listener untuk memilih Program
            programDropdown.addEventListener("change", function() {
                const programId = this.value;
                if (programId) {
                    // Reload halaman dengan parameter triwulan dan program
                    window.location.href = `?triwulan=${triwulanDropdown.value}&program=${programId}`;
                } else {
                    // Reset giat jika Program tidak dipilih
                    giatDropdown.disabled = true;
                    giatDropdown.innerHTML = '<option value="">-- Pilih Giat --</option>';
                }
            });
        });
    </script>

    <?php

    require_once "../../template/footer.php";

    ?>