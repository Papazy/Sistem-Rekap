<?php
session_start();

if (!isset($_SESSION['ssLogin'])) {
  header("location: ../../../auth/login.php");
  exit;
}

require_once "../../../config/conn.php";
require_once "../../../user/function/functions.php";

$title = "Tambah Batasan - Sistem Evaluasi Polres";
require_once "../../../template/header.php";
require_once "../../../template/navbar.php";
require_once "../../../template/sidebar.php";
?>

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Tambah Indikator</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../../index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="<?= $main_url ?>laporan/polres/filter/batasan.php">Indikator</a></li>
        <li class="breadcrumb-item active">Tambah Indikator</li>
      </ol>
      <form action="proses_tambah_batasan.php" method="POST">
        <div class="card">
          <div class="card-header">
            <span class="h5 my-2"><i class="fa-regular fa-square-plus"></i> Form Tambah Indikator</span>
            <button type="submit" name="simpan" class="btn btn-primary float-end">
              <i class="fa-solid fa-floppy-disk"></i> Simpan
            </button>
            <button type="reset" class="btn btn-danger float-end me-1">
              <i class="fa-solid fa-rotate-left"></i> Reset
            </button>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-11">
                <!-- Input Nama -->
                <div class="mb-3 row">
                  <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                  <label class="col-sm-1 col-form-label">:</label>
                  <div class="col-sm-9" style="margin-left: -45px;">
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="A">
                  </div>
                </div>

                <!-- Input Satuan -->
                <div class="mb-3 row">
                  <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
                  <label class="col-sm-1 col-form-label">:</label>
                  <div class="col-sm-9" style="margin-left: -45px;">
                    <select name="satuan" id="satuan" class="form-select border-0 border-bottom" required>
                      <option value="" selected>-- Pilih Satuan --</option>
                      <option value="Polda">Polda</option>
                      <option value="Polres">Polres</option>
                    </select>
                  </div>
                </div>
                <!-- Input Nilai Minimum -->
                <div class="mb-3 row">
                  <label for="min" class="col-sm-2 col-form-label">Nilai Minimum</label>
                  <label class="col-sm-1 col-form-label">:</label>
                  <div class="col-sm-9" style="margin-left: -45px;">
                    <input type="number" step="0.01" name="min" id="min" class="form-control" required>
                  </div>
                </div>
                <!-- Input Nilai Maksimum -->
                <div class="mb-3 row">
                  <label for="max" class="col-sm-2 col-form-label">Nilai Maksimum</label>
                  <label class="col-sm-1 col-form-label">:</label>
                  <div class="col-sm-9" style="margin-left: -45px;">
                    <input type="number" step="0.01" name="max" id="max" class="form-control" required>
                  </div>
                </div>
              </div>
                <!-- Input Nilai Minimum File -->
                <div class="mb-3 row">
                  <label for="min_file" class="col-sm-2 col-form-label">Minimum File</label>
                  <label class="col-sm-1 col-form-label">:</label>
                  <div class="col-sm-9" style="margin-left: -45px;">
                    <input type="number"  name="min_file" id="min_file" class="form-control" required>
                  </div>
                </div>
                <!-- Input Nilai Maksimum File-->
                <div class="mb-3 row">
                  <label for="max_file" class="col-sm-2 col-form-label">Maksimum File</label>
                  <label class="col-sm-1 col-form-label">:</label>
                  <div class="col-sm-9" style="margin-left: -45px;">
                    <input type="number"  name="max_file" id="max_file" class="form-control" required>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </form>
    </div>
  </main>
  <?php require_once "../../../template/footer.php"; ?>
</div>