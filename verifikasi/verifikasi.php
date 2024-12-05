<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location: ../auth/login.php");
    exit;
}

require_once "../config/conn.php";
require_once "../user/function/functions.php";

$title = "Varifikasi - Sistem Evaluasi";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";
$headerTable = "- Polisi Resort Aceh -"
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
            <h1 class="mt-4">Verifikasi Polres</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active">Verifikasi</li>
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
                                aria-placeholder="triwulan"
                                onchange="updateTriwulan()"
                                style="width: 150px;">
                                <option value="" disabled selected style="color:white">Triwulan</option>
                                <?php
                                for ($i = 1; $i < 5; $i++) {
                                    $selected = (isset($_GET['triwulan']) && $_GET['triwulan'] == $i) ? 'selected' : '';
                                    echo "<option value='$i' $selected>$i</option>";
                                }
                                ?>
                            </select>
                            <!-- Dropdown Program -->
                            <select
                                class="form-select"
                                id="program"
                                name="program"
                                aria-placeholder="Program"
                                onchange="updateProgram()"
                                style="width: 150px;">
                                <option value="" disabled selected style="color:white">Program</option>
                                <?php
                                $data = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                for ($i = 0; $i < strlen($data); $i++) {
                                    $selected = (isset($_GET['program']) && $_GET['program'] == $data[$i]) ? 'selected' : '';
                                    echo "<option value='$data[$i]' $selected>$data[$i]</option>";
                                }
                                ?>
                            </select>
                            
                            <!-- Dropdown Giat -->
                            <select
                            class="form-select"
                            id="giat"
                            name="giat"
                            onchange="updateGiat()"
                            disabled>
                            <option value="" disabled selected style="color:white">Giat</option>
                                <?php
                                for ($i = 1; $i <= 50; $i++) {
                                    $selected = (isset($_GET['giat']) && $_GET['giat'] == $i) ? 'selected' : '';
                                    echo "<option value='$i' $selected>$i</option>";
                                }
                                ?>
                            </select>

                            <!-- Button untuk reset link kembali menjadi /verifikasi.php -->
                            <a href="<?= $main_url ?>verifikasi/verifikasi.php" class="btn btn-sm btn-primary">Reset</a>
                        </div>
                    </div>


                    <!-- <small style="font-size: 10px; color: red; opacity: 0.7; font-style: italic;"> (Max Persentase: 27.44%, Max Sudah Upload: 90)</small> -->
                    <div class="">
                        <!-- fitur filter select -->

                        <?php if (userLogin()['role'] == 1) { ?>
                            <a href="<?= $main_url ?>tambah-data/polres/verifikasi/add-verifikasi.php"
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
                                    <center>Sudah Diupload</center>
                                </th>
                                <th scope="col">
                                    <center>Sudah Diverifikasi</center>
                                </th>
                                <th scope="col">
                                    <center>Belum Diverifikasi</center>
                                </th>
                                <th scope="col">
                                    <center>Ditolak</center>
                                </th>
                                <th scope="col">
                                    <center>Ditolak (akumulasi)</center>
                                </th>
                                <th scope="col">
                                    <center>Persentase</center>
                                </th>
                                <?php if (userLogin()['role'] == 1) { ?>
                                    <th scope="col">
                                        <center>Setting</center>
                                    </th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <style>
                            .size {
                                width: 170px;
                            }
                        </style>
                        <tbody>
                            <?php
                            $MaxPersentase = 27.44;
                            $MaxSudahUpload = 90;

                            $triwulan = isset($_GET['triwulan']) ? $_GET['triwulan'] : '';
                            $program = isset($_GET['program']) ? $_GET['program'] : '';
                            $giat = isset($_GET['giat']) ? $_GET['giat'] : '';


                            $query = "SELECT DISTINCT * FROM verifikasi_polres WHERE 1=1";
                           
                            if (!empty($triwulan)) {
                                $query .= " AND Triwulan = '$triwulan'";
                            }
                            if (!empty($program)) {
                                $query .= " AND program = '$program'";
                            }
                            if (!empty($giat)) {
                                $query .= " AND giat = '$giat'";
                            }


                            $queryPersentase = mysqli_query($koneksi, $query);


                            while ($dataPersentase = mysqli_fetch_array($queryPersentase)) {
                                $Polda              = $dataPersentase["Polda"];
                                $Polres             = $dataPersentase["Polres"];
                                $Sudah_diupload     = $dataPersentase["Sudah_diupload"];
                                $Sudah_diverifikasi = $dataPersentase["Sudah_diverifikasi"];
                                $Belum_diverifikasi = $dataPersentase["Belum_diverifikasi"];
                                $Ditolak            = $dataPersentase["Ditolak"];
                                $Ditolak_akumulasi  = $dataPersentase["Ditolak_akumulasi"];

                                // Hitung Persentase
                                $Persentase = ($MaxPersentase * $Sudah_diverifikasi) / $MaxSudahUpload;
                            ?>
                                <tr>
                                    <td>
                                        <center><?= $Polda ?></center>
                                    </td>
                                    <td>
                                        <center><?= $Polda ?></center>
                                    </td>
                                    <td>
                                        <center><?= $Polres ?></center>
                                    </td>
                                    <td>
                                        <center><?= $Sudah_diupload ?></center>
                                    </td>
                                    <td>
                                        <center><?= $Sudah_diverifikasi ?></center>
                                    </td>
                                    <td>
                                        <center><?= $Belum_diverifikasi ?></center>
                                    </td>
                                    <td>
                                        <center><?= $Ditolak ?></center>
                                    </td>
                                    <td>
                                        <center><?= $Ditolak_akumulasi ?></center>
                                    </td>
                                    <td>
                                        <center><?= number_format($Persentase, 2) ?>%</center>
                                    </td>
                                    <?php if (userLogin()['role'] == 1) { ?>
                                        <td class="size d-flex align-items-center justify-content-center gap-2">
                                            <button type="button" class="btn btn-sm btn-warning editButton" data-id="<?= $dataPersentase['id'] ?>"><i class="fa-solid fa-pen" title="Edit"></i> Edit</button>
                                            <button type="button" class="btn btn-sm btn-danger deleteButton" data-id="<?= $dataPersentase['id'] ?>"><i class="fa-solid fa-trash" title="Delete"></i> Delete</button>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
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

    <!-- script filter -->
    <script>
        
function updateTriwulan() {
    var triwulan = document.getElementById("triwulan").value;
    var giat = document.getElementById("giat");

    // Jika triwulan disetel ke default, hapus semua filter
    if (!triwulan) {
        window.location.href = "?";
        return;
    }

    // Jika triwulan dipilih, perbarui URL
    window.location.href = "?triwulan=" + triwulan;
}

function updateProgram() {
    var program = document.getElementById("program").value;
    var giat = document.getElementById("giat");

    // Jika Program disetel ke default, hapus semua filter
    if (!program) {
        window.location.href = "?";
        return;
    }

    // Jika Program dipilih, perbarui URL
    window.location.href = "?program=" + program;
}

// Fungsi untuk memperbarui URL saat giat dipilih
function updateGiat() {
    var program = document.getElementById("program").value;
    var giat = document.getElementById("giat").value;

    // Jika Giat disetel ke default, hapus semua filter
    if (!giat) {
        window.location.href = "?";
        return;
    }

    // Jika Giat dipilih, pastikan Program juga sudah dipilih
    if (program) {
        window.location.href = "?program=" + program + "&giat=" + giat;
    }
}

// Aktifkan dropdown Giat jika Program sudah dipilih
document.addEventListener("DOMContentLoaded", function () {
    var program = document.getElementById("program").value;
    var giat = document.getElementById("giat");

    // Jika Program dipilih, aktifkan dropdown Giat
    giat.disabled = !program;
});

    </script>


    <?php

    require_once "../template/footer.php";

    ?>