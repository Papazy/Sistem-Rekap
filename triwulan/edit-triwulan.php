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

    // Ambil data triwulan berdasarkan ID yang dipilih
    $query = mysqli_query($koneksi, "SELECT id, Triwulan, Tenggat FROM triwulan WHERE id = '$id'");
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
            <h1 class="mt-4">Edit Data Triwulan</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="triwulan.php">Triwulan</a></li>
                <li class="breadcrumb-item active">Edit Triwulan</li>
            </ol>
            <form action="proses-edit.php" method="POST">
                <input type="hidden" name="id" value="<?= $data['id'] ?>"> <!-- ID untuk proses edit -->
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
                                        <input type="number" name="triwulan" id="triwulan" 
                                               value="<?= $data['Triwulan'] ?>"
                                               class="form-control-plaintext border-bottom"
                                               placeholder="isi triwulan"
                                               required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="tenggat" class="col-sm-2 col-form-label">Tenggat</label>
                                    <label for="tenggat" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -45px;">
                                        <input type="text" name="tenggat" id="tenggat" 
                                               value="<?= $data['Tenggat'] ?>"
                                               class="form-control-plaintext border-bottom"
                                               placeholder="isi tenggat"
                                               required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <script>
        // Fungsi untuk mengambil parameter ID dari URL
        function getIdFromUrl() {
            const params = new URLSearchParams(window.location.search); // Mendapatkan parameter dari URL
            return params.get('id'); // Mengambil nilai ID
        }

        // Mengatur input secara dinamis (jika ID diperlukan)
        document.addEventListener("DOMContentLoaded", () => {
            const id = getIdFromUrl(); // Ambil ID dari URL
            if (id) {
                console.log("ID dari URL:", id); // Untuk debugging, bisa dihapus nanti
                // Jika ingin menampilkan ID di input tertentu, bisa menggunakan:
                document.querySelector("input[name='id']").value = id;
            }
        });
    </script>

<?php
require_once "../template/footer.php";
?>
