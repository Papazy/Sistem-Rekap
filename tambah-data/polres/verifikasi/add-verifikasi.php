<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location: ../../../auth/login.php");
    exit;
}

require_once "../../../config/conn.php";
require_once "../../../user/function/functions.php";

$title = "Tambah Polres - Sistem Evaluasi Polres";
require_once "../../../template/header.php";
require_once "../../../template/navbar.php";
require_once "../../../template/sidebar.php";

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tambah Polres</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../../../index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= $main_url ?>verifikasi/verifikasi.php">Verifikasi Polres</a></li>
                <li class="breadcrumb-item active">Tambah Verifikasi Polres</li>
            </ol>
            <form action="proses-verifikasi.php" method="POST" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        <span class="h5 my-2"><i class="fa-regular fa-square-plus"></i> Form Verifikasi Polres</span>
                        <button type="submit" name="simpan" class="btn btn-primary float-end"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                        <button type="reset" name="reset" class="btn btn-danger float-end me-1"><i class="fa-solid fa-rotate-left"></i> Reset</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-11">
                                <div class=" mt-1 mb-3 row">
                                    <label for="Periode" class="col-sm-2 col-form-label">Data Verifikasi</label>
                                    <label for="Periode" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -50px;">
                                        <input type="file" name="filecsv" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="Periode" class="col-sm-2 col-form-label">Periode</label>
                                    <label for="Periode" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -45px;">
                                        <input type="date" name="Periode" class="form-control-plaintext border-bottom" id="Periode" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="Tw" class="col-sm-2 col-form-label">Program</label>
                                    <label for="Tw" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -45px;">
                                        <select name="program" id="program" class="form-select border-0 border-bottom">
                                            <option value="" selected>-- Pilih --</option>
                                            <!-- looping php dari a-z -->
                                            <?php
                                            $data = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                            for ($i = 0; $i < strlen($data); $i++) {
                                                echo "<option value='$data[$i]'>$data[$i]</option>";
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
                                            <!-- Looping dari 1-50 -->
                                            <?php
                                            for ($i = 1; $i <= 50; $i++) {
                                                echo "<option value='$i'>$i</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="Tw" class="col-sm-2 col-form-label">Triwulan</label>
                                    <label for="Tw" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -45px;">
                                        <select name="Triwulan" id="Triwulan" class="form-select border-0 border-bottom">
                                            <option value="" selected>-- Pilih --</option>
                                            <?php
                                            include "../config.php";
                                            $query_jenis = mysqli_query($koneksi, "SELECT * FROM triwulan");
                                            while ($jenis = mysqli_fetch_array($query_jenis)) { ?>
                                                <option value="<?= $jenis['Triwulan'] ?>"><?= ucwords($jenis['Triwulan']) ?></option>
                                            <?php
                                            };
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </main>




    <?php

    require_once "../../../template/footer.php";

    ?>