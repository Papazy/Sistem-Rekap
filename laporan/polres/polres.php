<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location: ../../auth/login.php");
    exit;
}

require_once "../../config/conn.php";
require_once "../../user/function/functions.php";

$title = "Varifikasi - Sistem Evaluasi";
require_once "../../template/header.php";
require_once "../../template/navbar.php";
require_once "../../template/sidebar.php";
$headerTable = "- Polisi Resort Aceh -";

// defaultnya akan mengarahkan ke triwulan saat ini
if(!isset($_GET['triwulan'])){
    $triwulan = ceil(date('n') / 3);
    echo "<script>location.href='polres.php?triwulan=$triwulan';</script>";
}
?>


<div id="layoutSidenav_content">
    <main>
        <!-- Modal Edit-->
        <form method="POST" action="edit_verivikasi.php">
            <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modalEdit">
            </div>
        </form>

        <!-- Modal Delete -->
        <form method="POST" action="hapus_verivikasi.php">
            <div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
            </div>
        </form>

        <div class="container-fluid px-4">
            <h1 class="mt-4">Polres</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../../index.php">Home</a></li>
                <li class="breadcrumb-item active">Polres</li>
            </ol>
            <div class="card">
                <div class="card-header d-inline-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center justify-content-start">
                        <span class="h5 my-2 d-flex align-items-center " style="width: 150px;"><i class="fa-solid fa-list me-2"></i> Data Polres</span>
                        <div class="d-flex align-items-center gap-2">
                            <!-- Dropdown Triwulan -->
                            <select
                                class="form-select"
                                id="triwulan"
                                name="triwulan"
                                aria-placeholder="Triwulan"
                                onchange="updateDropdown('triwulan')"
                                style="width: 110px; cursor:pointer;">
                                <option value="" disabled selected>Triwulan</option>
                                <?php
                                // Triwulan yang tersedia
                                $triwulanTexts = ['TW I', 'TW II', 'TW III', 'TW IV', 'TW V', 'TW VI', 'TW VII', 'TW VIII'];

                                // Menentukan triwulan aktif berdasarkan bulan saat ini
                                $currentTriwulan = ceil(date('n') / 3);

                                // Loop untuk menampilkan semua triwulan
                                foreach ($triwulanTexts as $index => $text) {
                                    $selected = ($index + 1 == $currentTriwulan) ? 'selected' : '';
                                    echo "<option value='" . ($index + 1) . "' $selected>$text</option>";
                                }
                                ?>
                            </select>


                            <!-- Dropdown Periode -->
                            <select
                                class="form-select"
                                id="periode"
                                name="periode"
                                aria-placeholder="Periode"
                                onchange="updateDropdown('periode')"
                                style="width: 140px; cursor:pointer;"
                                disabled>
                                <option value="" disabled selected>Periode</option>
                                <?php
                                if (isset($_GET['triwulan'])) {
                                    $selectedTriwulan = intval($_GET['triwulan']);
                                    $queryPeriode = "SELECT DISTINCT DATE_FORMAT(Periode, '%Y-%m-%d') AS periode 
                                                     FROM verifikasi_polres 
                                                     WHERE Triwulan = $selectedTriwulan 
                                                     ORDER BY Periode DESC";
                                    $resultPeriode = mysqli_query($koneksi, $queryPeriode);

                                    while ($rowPeriode = mysqli_fetch_assoc($resultPeriode)) {
                                        $periode = $rowPeriode['periode'];
                                        $selected = (isset($_GET['periode']) && $_GET['periode'] == $periode) ? 'selected' : '';
                                        echo "<option value='{$periode}' {$selected}>{$periode}</option>";
                                    }
                                }
                                ?>
                            </select>

                            <!-- Dropdown Jam -->
                            <select
                                class="form-select"
                                id="jam"
                                name="jam"
                                aria-placeholder="Jam"
                                onchange="updateDropdown('jam')"
                                style="width: 110px; cursor:pointer;"
                                <?php if (!isset($_GET['periode'])) echo 'disabled'; ?>>
                                <option value="" disabled selected>Jam</option>
                                <?php
                                if (isset($_GET['periode'])) {
                                    $selectedPeriode = $_GET['periode'];
                                    $queryJam = "SELECT DISTINCT DATE_FORMAT(Periode, '%H:%i:%s') AS jam 
                                                FROM verifikasi_polres 
                                                WHERE DATE_FORMAT(Periode, '%Y-%m-%d') = '$selectedPeriode' 
                                                ORDER BY jam";
                                    $resultJam = mysqli_query($koneksi, $queryJam);

                                    while ($rowJam = mysqli_fetch_assoc($resultJam)) {
                                        $jam = $rowJam['jam'];
                                        $selected = (isset($_GET['jam']) && $_GET['jam'] == $jam) ? 'selected' : '';
                                        echo "<option value='{$jam}' {$selected}>{$jam}</option>";
                                    }
                                }
                                ?>
                            </select>


                            <!-- Dropdown Program -->
                            <select
                                class="form-select"
                                id="program"
                                name="program"
                                aria-placeholder="Program"
                                onchange="updateDropdown('program')"
                                style="width: 120px; cursor:pointer;">
                                <option value="" disabled selected>Program</option>
                                <?php
                                if (isset($_GET['periode'])) {
                                    $selectedPeriode = $_GET['periode'];
                                    $queryProgram = "SELECT DISTINCT program.id, program.nama_program
                                                    FROM program
                                                    JOIN verifikasi_polres ON verifikasi_polres.program = program.id
                                                    WHERE DATE_FORMAT(verifikasi_polres.Periode, '%Y-%m-%d') = '$selectedPeriode'
                                                    ORDER BY program.nama_program";
                                    $resultProgram = mysqli_query($koneksi, $queryProgram);

                                    while ($rowProgram = mysqli_fetch_assoc($resultProgram)) {
                                        $programId = $rowProgram['id'];
                                        $programName = $rowProgram['nama_program'];  // Nama program
                                        $selected = (isset($_GET['program']) && $_GET['program'] == $programId) ? 'selected' : '';
                                        echo "<option value='{$programId}' {$selected}>{$programName}</option>";
                                    }
                                }
                                ?>
                            </select>

                            <!-- Dropdown Giat -->
                            <select
                                class="form-select"
                                id="giat" name="giat"
                                aria-placeholder="Giat"
                                onchange="updateDropdown('giat')"
                                style="width: 100px; cursor:pointer;">
                                <?php if (!isset($_GET['program'])) echo 'disabled'; ?>
                                <option value="" disabled selected>Giat</option>
                                <?php
                                if (isset($_GET['program'])) {
                                    $selectedProgram = $_GET['program'];
                                    $queryGiat = "SELECT DISTINCT giat.id, giat.nama_giat
                                                FROM giat 
                                                JOIN verifikasi_polres  ON verifikasi_polres.giat = giat.id
                                                WHERE verifikasi_polres.program = '$selectedProgram'
                                                ORDER BY giat.nama_giat";
                                    $resultGiat = mysqli_query($koneksi, $queryGiat);

                                    while ($rowGiat = mysqli_fetch_assoc($resultGiat)) {
                                        $giatId = $rowGiat['id'];
                                        $giatName = $rowGiat['nama_giat'];  // Nama giat
                                        $selected = (isset($_GET['giat']) && $_GET['giat'] == $giatId) ? 'selected' : '';
                                        echo "<option value='{$giatId}' {$selected}>{$giatName}</option>";
                                    }
                                }
                                ?>
                            </select>



                            <!-- Button untuk reset link kembali menjadi /verifikasi.php -->
                            <a href="<?= $main_url ?>laporan/polres/polres.php" class="btn btn-sm btn-primary">Reset</a>
                        </div>
                    </div>


                    <!-- <small style="font-size: 10px; color: red; opacity: 0.7; font-style: italic;"> (Max Persentase: 27.44%, Max Sudah Upload: 90)</small> -->
                    <div class="">
                        <!-- fitur filter select -->

                        <?php if (userLogin()['role'] == 1) { ?>
                            <!-- fitur filter select -->
                            <a href="<?= $main_url ?>laporan/polres/filter/batasan.php"
                                class="btn btn-sm btn-warning pe-2" style="margin-right: 5px;" data-bs-toggle="tooltip" title="Klik untuk menambah atau mengurangi"><i class="fa-solid fa-plus-minus"></i></a>
                            <a href="<?= $main_url ?>tambah-data/polres/add-polres.php"
                                class="btn btn-sm btn-primary float-end"><i class="fa-solid fa-plus"></i> Tambah</a>
                        <?php } ?>
                    </div>
                </div>
                <div class="card-body">
                    <table class="display" id="exampleNoSetting">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">
                                    <center>Polda</center>
                                </th>
                                <th scope="col">
                                    <center>Polres</center>
                                </th>
                                <th scope="col">
                                    <center>Diupload</center>
                                </th>
                                <th scope="col">
                                    <center>Diverifikasi</center>
                                </th>
                                <th scope="col">
                                    <center>Belum Diverifikasi</center>
                                </th>
                                <th scope="col">
                                    <center>Ditolak</center>
                                </th>
                                <th scope="col">
                                    <center>Persentase</center>
                                </th>
                                <!-- <?php if (userLogin()['role'] == 1) { ?>
                                    <th scope="col">
                                        <center>Setting</center>
                                    </th>
                                <?php } ?> -->
                            </tr>
                        </thead>
                        <style>
                            .size {
                                width: 170px;
                            }
                        </style>

                        <tbody>
                            <?php
                            // Ambil data Max, Min, Max_upload, dan Min_upload dari tabel verifikasi_polres
                            $queryData = "SELECT Min, Max, Min_upload, Max_upload FROM verifikasi_polres";
                            $resultData = $koneksi->query($queryData);

                            if ($resultData->num_rows > 0) {
                                $row = $resultData->fetch_assoc();
                                $MaxPersentase = $row['Max'];
                                $MinPersentase = $row['Min'];
                                $MaxUpload = $row['Max_upload'];
                                $MinUpload = $row['Min_upload'];
                            } else {
                                // Set nilai default jika data tidak ditemukan
                                $MaxPersentase = 0;
                                $MinPersentase = 0;
                                $MaxUpload = 0;
                                $MinUpload = 0;
                            }


                            // Ambil parameter dari URL
                            $triwulan = isset($_GET['triwulan']) ? $_GET['triwulan'] : '';
                            $program = isset($_GET['program']) ? $_GET['program'] : '';
                            $giat = isset($_GET['giat']) ? $_GET['giat'] : '';
                            $periode = isset($_GET['periode']) ? $_GET['periode'] : '';

                            // Query untuk mendapatkan data verifikasi
                            $query = "SELECT Polda, Polres, SUM(Sudah_diupload) AS Total_diupload, SUM(Sudah_diverifikasi) AS Total_diverifikasi, 
    SUM(Belum_diverifikasi) AS Total_belum_diverifikasi, SUM(Ditolak) AS Total_ditolak, 
    SUM(Ditolak_akumulasi) AS Total_ditolak_akumulasi, Persentase
  FROM verifikasi_polres 
  WHERE 1=1";

                            
                            if (!empty($triwulan)) {
                                $query .= " AND Triwulan = '$triwulan'";
                            }
                            if (!empty($program)) {
                                $query .= " AND program = '$program'";
                            }
                            if (!empty($giat)) {
                                $query .= " AND giat = '$giat'";
                            }
                            if (!empty($periode)) {
                                $query .= " AND DATE(Periode) = '$periode'";
                            }

                            $query .= " GROUP BY Polres ORDER BY Polres";

                            // Menjalankan query
                            $queryPersentase = mysqli_query($koneksi, $query);

                              // mencari min max
                              $max = 0;
                              $min = 0;
                              $maxFile = 0;
                              $minFile = 0;
                              if(!empty($giat)){
                                  $max = $MaxPersentase;
                                  $min = $MinPersentase;
                                  $maxFile = $MaxUpload;
                                  $minFile = $MinUpload;
                              }else if(!empty($program)){
                                  // program = 1 maka di convert menjadi A, begitu juga dengan B, C sampai Z
                                  $queryMinMax = "SELECT min, max, min_file, max_file FROM batasan WHERE satuan = 'Polres' AND nama = '$programChar'";
                                  $minMaxRes = mysqli_query($koneksi, $queryMinMax);
                                  $minMax = mysqli_fetch_array($minMaxRes);
                                  $max = $minMax["max"];
                                  $min = $minMax["min"];
                                  $maxFile = $minMax["max_file"];
                                  $minFile = $minMax["min_file"];
                              }else{
                                  // mendapatkan triwulan
                                  $queryMinMax = "SELECT min, max, min_file, max_file FROM batasan WHERE satuan = 'Polres' AND nama = 'Triwulan $triwulan'";
                                  $minMaxRes = mysqli_query($koneksi, $queryMinMax);
                                  $minMax = mysqli_fetch_array($minMaxRes);
                                  // handle error null 
                                  $max = !isset($minMax["max"]) ? 0 : $minMax["max"];
                                  $min = !isset($minMax["min"]) ? 0 : $minMax["min"];
                                  $maxFile = !isset($minMax["max_file"]) ? 0 : $minMax["max_file"];
                                  $minFile = !isset($minMax["min_file"]) ? 0 : $minMax["min_file"];
                              }

                            // Proses data untuk setiap Polres
                            $no = 1;
                            while ($dataPersentase = mysqli_fetch_array($queryPersentase)) {
                                $Polda = $dataPersentase["Polda"];
                                $Polres = $dataPersentase["Polres"];
                                $Total_diupload = $dataPersentase["Total_diupload"];
                                $Total_diverifikasi = $dataPersentase["Total_diverifikasi"];
                                $Total_belum_diverifikasi = $dataPersentase["Total_belum_diverifikasi"];
                                $Total_ditolak = $dataPersentase["Total_ditolak"];
                                $Persentase = $dataPersentase["Persentase"]; // Langsung ambil dari database

                                // // Cek jika persentase sudah ada, jika tidak maka hitung menggunakan rumus
                                // if (empty($dataPersentase["Persentase"])) {
                                // // Hitung Persentase hanya jika MaxSudahUpload tidak nol
                                // if ($MaxUpload != 0) {
                                // $Persentase = ($MaxPersentase * $Total_diverifikasi) / $MaxUpload;
                                // } else {
                                // $Persentase = 0; // Atau bisa diatur ke nilai default lainnya
                                // }
                                // } else {
                                // // Jika sudah ada nilai persentase yang diupload
                                // $Persentase = $dataPersentase["Persentase"];
                                // }
                            ?>
                                <tr>
                                    <td>
                                        <center><?= $no++ ?></center>
                                    </td>
                                    <td>
                                        <center><?= $Polda ?></center>
                                    </td>
                                    <td>
                                        <center><?= $Polres ?></center>
                                    </td>
                                    <td>
                                        <center><?= $Total_diupload ?></center>
                                    </td>
                                    <td>
                                        <center><?= $Total_diverifikasi ?></center>
                                    </td>
                                    <td>
                                        <center><?= $Total_belum_diverifikasi ?></center>
                                    </td>
                                    <td>
                                        <center><?= $Total_ditolak ?></center>
                                    </td>
                                    <td>
                                        <center>
                                            <?php
                                            // Tentukan warna berdasarkan kondisi
                                            if ($Persentase < $min) {
                                                $color = "#e60505"; // Merah (di bawah Min)
                                            } elseif ($Persentase >= $max) {
                                                $color = "green"; // Hijau (sama dengan atau di atas Max)
                                            } else {
                                                $color = "#fcb603"; // Kuning (antara Min dan Max)
                                            }
                                            ?>
                                            <span style="color: <?= $color ?>; font-weight: bold;">
                                                <?= number_format($Persentase, 2) ?>%
                                            </span>
                                        </center>

                                    </td>
                                    <!-- <td>
                                        <center><?= number_format($Persentase, 2) ?>%</center>
                                    </td> -->
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <div style="margin-top: 10px; display: flex; justify-content: right; padding-right: 20px; color: #7d7e80; font-size: 15px; font-weight: 450;">
                        --- Min : <span style="color: #fcb603; margin-left: 5px; font-weight: 600;"><?= number_format($min, 2) ?>% (<?= $minFile ?>)</span>
                        &nbsp;&nbsp;--- Max : <span style="color: green; margin-left: 5px; font-weight: 600;"><?= number_format($max, 2) ?>% (<?= $maxFile ?>)</span>
                    </div>


                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $('.editButton').click(function() {

            var id = $(this).data('id');
            // console.log(userid);
            // AJAX request
            $.ajax({
                url: 'modal_edit_polres.php',
                type: 'post',
                data: {
                    id: id
                },
                success: function(response) {
                    // Add response in Modal body
                    $('#modalEdit').html(response);

                    // Display Modal
                    $('#modalEdit').modal('show');
                }
            });
        });
        $('.deleteButton').click(function() {

            var id = $(this).data('id');
            $.ajax({
                url: 'modal_hapus_polres.php',
                type: 'post',
                data: {
                    id: id
                },
                success: function(response) {
                    // Add response in Modal body
                    $('#modalHapus').html(response);

                    // Display Modal
                    $('#modalHapus').modal('show');
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Mendapatkan elemen dropdown
            const triwulanDropdown = document.getElementById("triwulan");
            const periodeDropdown = document.getElementById("periode");
            const jamDropdown = document.getElementById("jam");
            const programDropdown = document.getElementById("program");
            const giatDropdown = document.getElementById("giat");

            // Helper function untuk mendapatkan parameter dari URL
            function getUrlParam(param) {
                const urlParams = new URLSearchParams(window.location.search);
                return urlParams.get(param);
            }

            // Helper function untuk mengatur nilai dropdown dari URL
            function setDropdownValue(dropdown, value) {
                if (value) {
                    dropdown.value = value;
                }
            }

            // Reset dropdown dan menonaktifkannya
            function resetDropdown(dropdown) {
                dropdown.disabled = true;
                dropdown.innerHTML = '<option value="" disabled selected>-- Pilih --</option>';
            }

            // Fungsi untuk memperbarui URL dengan parameter
            function updateUrl(params) {
                const url = new URL(window.location);
                Object.keys(params).forEach(key => {
                    if (params[key]) {
                        url.searchParams.set(key, params[key]);
                    } else {
                        url.searchParams.delete(key);
                    }
                });
                window.location.href = url.toString();
            }

            // Mendapatkan nilai parameter dari URL
            const selectedTriwulan = getUrlParam("triwulan");
            const selectedPeriode = getUrlParam("periode");
            const selectedJam = getUrlParam("jam");
            const selectedProgram = getUrlParam("program");
            const selectedGiat = getUrlParam("giat");

            // Menetapkan nilai dropdown berdasarkan parameter dari URL
            setDropdownValue(triwulanDropdown, selectedTriwulan);
            if (selectedTriwulan) periodeDropdown.disabled = false;
            setDropdownValue(periodeDropdown, selectedPeriode);
            if (selectedPeriode) jamDropdown.disabled = false;
            setDropdownValue(jamDropdown, selectedJam);
            if (selectedJam) programDropdown.disabled = false;
            setDropdownValue(programDropdown, selectedProgram);
            if (selectedProgram) giatDropdown.disabled = false;
            setDropdownValue(giatDropdown, selectedGiat);

            // Event listener untuk perubahan Triwulan
            triwulanDropdown.addEventListener("change", function() {
                resetDropdown(periodeDropdown);
                resetDropdown(jamDropdown);
                resetDropdown(programDropdown);
                resetDropdown(giatDropdown);

                // Memperbarui URL dengan parameter Triwulan yang dipilih
                updateUrl({
                    triwulan: this.value
                });
            });

            // Event listener untuk perubahan Periode
            periodeDropdown.addEventListener("change", function() {
                resetDropdown(jamDropdown);
                resetDropdown(programDropdown);
                resetDropdown(giatDropdown);

                // Memperbarui URL dengan parameter Triwulan dan Periode yang dipilih
                updateUrl({
                    triwulan: triwulanDropdown.value,
                    periode: this.value
                });
            });

            // Event listener untuk perubahan Jam
            jamDropdown.addEventListener("change", function() {
                resetDropdown(programDropdown);
                resetDropdown(giatDropdown);

                // Perbarui URL hanya jika nilai Jam benar-benar berubah
                updateUrl({
                    triwulan: triwulanDropdown.value,
                    periode: periodeDropdown.value,
                    jam: this.value
                });
            });

            // Event listener untuk perubahan Program
            programDropdown.addEventListener("change", function() {
                resetDropdown(giatDropdown);

                // Memperbarui URL dengan parameter Triwulan, Periode, Jam, dan Program yang dipilih
                updateUrl({
                    triwulan: triwulanDropdown.value,
                    periode: periodeDropdown.value,
                    jam: jamDropdown.value,
                    program: this.value
                });
            });

            // Event listener untuk perubahan Giat
            giatDropdown.addEventListener("change", function() {
                // Memperbarui URL dengan parameter Triwulan, Periode, Jam, Program, dan Giat yang dipilih
                updateUrl({
                    triwulan: triwulanDropdown.value,
                    periode: periodeDropdown.value,
                    jam: jamDropdown.value,
                    program: programDropdown.value,
                    giat: this.value
                });
            });
        });
    </script>
    <script>
        // Aktifkan tooltip Bootstrap
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function(tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>   

    <?php

    require_once "../../template/footer.php";

    ?>
    <!-- <?php if (userLogin()['role'] == 1) { ?>
    <td class="size d-flex align-items-center justify-content-center gap-2">
        <button type="button" class="btn btn-sm btn-warning editButton" data-id="<?= $dataPersentase['id'] ?>"><i class="fa-solid fa-pen" title="Edit"></i> Edit</button>
        <button type="button" class="btn btn-sm btn-danger deleteButton" data-id="<?= $dataPersentase['id'] ?>"><i class="fa-solid fa-trash" title="Delete"></i> Delete</button>
    </td>
<?php } ?> -->