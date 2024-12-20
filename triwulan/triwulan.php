<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location: ../auth/login.php");
    exit;
}

require_once "../config/conn.php";
require_once "../user/function/functions.php";

$title = "Triwulan - Sistem Evaluasi Polres";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

?>

<div id="layoutSidenav_content">
    <main>
        <?php
        if (isset($_GET['hapus'])) {
            $id = $_GET['hapus']; // ID dari triwulan

            // Ambil data triwulan berdasarkan ID
            $query = mysqli_query($koneksi, "SELECT * FROM triwulan WHERE id = '$id'");
            $data = mysqli_fetch_array($query);

            if ($data) {
        ?>
                <form method="POST" action="proses-hapus.php">
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                    <div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modalHapusLabel">Hapus Data Triwulan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group mb-2">
                                        <label style="font-weight:600;" for="triwulan">Triwulan</label>
                                        <input type="text" class="form-control" value="<?= $data['Triwulan'] ?>" name="" readonly>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label style="font-weight:600;" for="periode">Periode</label>
                                        <input type="text" class="form-control" value="<?= $data['Tenggat'] ?>" name="" readonly>
                                    </div>
                                    <div class="alert alert-danger" role="alert" style="font-size: 15px;">
                                        Apakah Anda yakin ingin menghapus Triwulan ini beserta semua data program dan giat yang terkait?
                                    </div>
                                    <input type="hidden" name="triwulan_id" value="<?= $data['id'] ?>" />
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="submit" class="btn btn-danger">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
        <?php
            }
        }
        ?>

        <script>
            $(document).ready(function() {
                $("#modalHapus").modal('show');
            });
        </script>

        <div class="container-fluid px-4">
            <h1 class="mt-4">Triwulan</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active">Triwulan</li>
            </ol>
            <div class="card">
                <div class="card-header">
                    <span class="h5 my-2"><i class="fa-solid fa-list"></i> Data Triwulan</span>
                    <?php if (userLogin()['role'] == 1) { ?>
                        <a href="<?= $main_url ?>triwulan/add-triwulan.php" class="btn btn-sm btn-primary float-end">
                            <i class="fa-solid fa-plus"></i> Tambah
                        </a>
                    <?php } ?>
                </div>
                <div class="card-body">
                    <table class="table table-hover"> <!-- id="example" -->
                        <thead>
                            <tr>
                                <th scope="col">
                                    <center>Triwulan</center>
                                </th>
                                <th scope="col">
                                    <center>Periode</center>
                                </th>
                                <?php if (userLogin()['role'] == 1) { ?>
                                    <th scope="col">
                                        <center>Setting</center>
                                    </th>
                                <?php } ?>
                            </tr>
                        </thead>

                        <style>
                            /* Membatasi lebar kolom program dan giat */
                            td.program,
                            td.giat {
                                font-size: 13px;
                                max-width: 200px;
                                /* Setel lebar kolom sesuai kebutuhan */
                                word-wrap: break-word;
                                /* Memaksa teks untuk dibungkus ke baris baru */
                                white-space: normal;
                                /* Membiarkan teks untuk membungkus jika diperlukan */
                                text-align: justify;
                            }
                        </style>

                        <tbody>
                            <?php
                            // Ambil data triwulan dari database
                            $queryTriwulan = mysqli_query($koneksi, "SELECT id, Triwulan, Tenggat FROM triwulan");

                            // Loop untuk menampilkan data
                            while ($dataTriwulan = mysqli_fetch_array($queryTriwulan)) {
                                // Format nama triwulan (TW I, TW II, dst)
                                $triwulanTexts = ['TW I', 'TW II', 'TW III', 'TW IV', 'TW V', 'TW VI', 'TW VII', 'TW VIII', 'TW IX'];
                                $triwulanIndex = $dataTriwulan['Triwulan'];
                                $triwulanText = ($triwulanIndex >= 1 && $triwulanIndex <= 9) ? $triwulanTexts[$triwulanIndex - 1] : 'Unknown';
                            ?>
                                <tr>
                                    <th>
                                        <center><?= $triwulanText ?></center>
                                    </th>
                                    <td>
                                        <?= $dataTriwulan['Tenggat'] ?>
                                    </td>
                                    <?php if (userLogin()['role'] == 1) { ?>
                                        <td>
                                            <center>
                                                <a href="<?= $main_url ?>triwulan/edit-triwulan.php?id=<?= $dataTriwulan['id'] ?>" class="btn btn-sm btn-warning">
                                                    <i class="fa-solid fa-pen" title="Edit"></i> Edit
                                                </a>
                                                <a href="<?= $main_url ?>triwulan/triwulan.php?hapus=<?= $dataTriwulan['id'] ?>" class="btn btn-sm btn-danger">
                                                    <i class="fa-solid fa-trash" title="Delete"></i> Delete
                                                </a>
                                            </center>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <?php require_once "../template/footer.php"; ?>
</div>