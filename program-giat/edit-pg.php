<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location: ../auth/login.php");
    exit;
}

require_once "../config/conn.php";
require_once "../user/function/functions.php";

$title = "Edit Triwulan - Sistem Evaluasi Polres";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

    // Cek apakah ID giat ada di URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Ambil data triwulan, program, dan giat berdasarkan ID yang dipilih
        $query = mysqli_query($koneksi, "SELECT triwulan.id AS triwulan_id, triwulan.Triwulan, triwulan.Periode, 
                                          program.nama_program, giat.nama_giat, giat.id AS giat_id
                                          FROM triwulan
                                          JOIN program ON program.triwulan_id = triwulan.id
                                          JOIN giat ON giat.program_id = program.id
                                          WHERE giat.id = '$id'");
        $data = mysqli_fetch_array($query);

        if (!$data) {
            echo "Data tidak ditemukan.";
            exit;
        }
    } else {
        echo "ID tidak valid.";
        exit;
    }
    ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Data Program Giat</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="pg.php">Program Giat</a></li>
                <li class="breadcrumb-item active">Edit Program Giat</li>
            </ol>
            <form action="proses-edit-triwulan.php" method="POST">
            <input type="hidden" name="giat_id" value="<?= $data['giat_id'] ?>">
                <div class="card">
                    <div class="card-header">
                        <span class="h5 my-2"><i class="fa-regular fa-square-plus"></i> Edit Triwulan</span>
                        <button type="submit" name="simpan" class="btn btn-primary float-end"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                        <button type="reset" name="reset" class="btn btn-danger float-end me-1"><i class="fa-solid fa-rotate-left"></i> Reset</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-11">
                                <div class="mb-3 row">
                                    <label for="triwulan" class="col-sm-2 col-form-label">Triwulan</label>
                                    <label for="triwulan" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -45px;">
                                        <input type="number" name="triwulan" id="triwulan" value="<?= $data['Triwulan'] ?>" class="form-control-plaintext border-bottom" placeholder="isi" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="program" class="col-sm-2 col-form-label">Program</label>
                                    <label for="program" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -45px;">
                                        <!-- Program menggunakan input text -->
                                        <input type="text" name="program" id="program" value="<?= $data['nama_program'] ?>" class="form-control-plaintext border-bottom" placeholder="isi program" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="giat" class="col-sm-2 col-form-label">Giat</label>
                                    <label for="giat" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -45px;">
                                        <!-- Giat menggunakan input text -->
                                        <input type="text" name="giat" id="giat" value="<?= $data['nama_giat'] ?>" class="form-control-plaintext border-bottom" placeholder="isi giat" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="periode" class="col-sm-2 col-form-label">Periode</label>
                                    <label for="periode" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -45px;">
                                        <!-- Periode menggunakan input date -->
                                        <input type="date" name="periode" id="periode" value="<?= $data['Periode'] ?>" class="form-control-plaintext border-bottom" required>
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