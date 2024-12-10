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
            $id = $_GET['hapus']; // Ini adalah ID dari giat, bukan triwulan

            // Ambil data giat berdasarkan ID giat
            $query = mysqli_query($koneksi, "SELECT * FROM giat WHERE id = '$id'");
            $giat_data = mysqli_fetch_array($query);

            if ($giat_data) {
        ?>
                <form method="POST" action="proses-hapus.php">
                    <div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modalHapusLabel">Hapus Data Giat</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group mb-2">
                                        <label style="font-weight:600;" for="giat">Giat</label>
                                        <input type="text" class="form-control" value="<?= $giat_data['nama_giat'] ?>" name="giat" readonly>
                                    </div>
                                    <p>Apakah Anda yakin ingin menghapus Giat ini?</p>
                                    <input type="hidden" name="giat_id" value="<?= $giat_data['id'] ?>" />
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="submit" class="btn btn-primary">Hapus</button>
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
            <h1 class="mt-4">Program Giat</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active">Program Giat</li>
            </ol>
            <div class="card">
                <div class="card-header">
                    <span class="h5 my-2"><i class="fa-solid fa-list"></i> Data Program Giat</span>
                    <?php if (userLogin()['role'] == 1) { ?>
                        <a href="<?= $main_url ?>program-giat/add-pg.php" class="btn btn-sm btn-primary float-end">
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
                                    <center>Program</center>
                                </th>
                                <th scope="col">
                                    <center>Giat</center>
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
                            // Array untuk teks triwulan
                            $triwulanTexts = [
                                'TW I',
                                'TW II',
                                'TW III',
                                'TW IV',
                                'TW V',
                                'TW VI',
                                'TW VII',
                                'TW VIII',
                                'TW IX'
                            ];

                            // Ambil data triwulan dari database dengan query yang sudah dimodifikasi
                            $queryTriwulan = mysqli_query($koneksi, "SELECT triwulan.id AS triwulan_id, triwulan.Triwulan, triwulan.Periode, program.nama_program, giat.nama_giat, giat.id AS giat_id
                                                                    FROM triwulan
                                                                    JOIN program ON program.triwulan_id = triwulan.id
                                                                    JOIN giat ON giat.program_id = program.id");

                            while ($dataTriwulan = mysqli_fetch_array($queryTriwulan)) {
                                $triwulanIndex = $dataTriwulan['Triwulan'];  // Misalnya 1, 2, 3, dst
                                if ($triwulanIndex >= 1 && $triwulanIndex <= 9) {
                                    $triwulanText = $triwulanTexts[$triwulanIndex - 1];  // Mengonversi angka ke teks (TW I, TW II, dst)
                                } else {
                                    $triwulanText = 'Unknown';
                                }
                            ?>
                                <tr>
                                    <th>
                                        <center><?= $triwulanText ?></center>
                                    </th>
                                    <td class="program">
                                        <center>
                                            <?= $dataTriwulan['nama_program'] ?>
                                        </center>
                                    </td>
                                    <td class="giat">
                                        <center>
                                            <?= $dataTriwulan['nama_giat'] ?>
                                        </center>
                                    </td>
                                    <td>
                                        <center><?= $dataTriwulan['Periode'] ?></center>
                                    </td>
                                    <?php if (userLogin()['role'] == 1) { ?>
                                        <td>
                                            <center>
                                                <a href="<?= $main_url ?>program-giat/edit-pg.php?id=<?= $dataTriwulan['giat_id'] ?>"
                                                    class="btn btn-sm btn-warning"><i class="fa-solid fa-pen" title="Edit"></i> Edit</a>
                                                <a href="<?= $main_url ?>program-giat/pg.php?hapus=<?= $dataTriwulan['giat_id'] ?>"
                                                    class="btn btn-sm btn-danger"><i class="fa-solid fa-trash" title="Delete"></i> Delete</a>
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