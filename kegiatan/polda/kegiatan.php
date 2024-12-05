<?php 

    session_start();

    if (!isset($_SESSION['ssLogin'])) {
        header("location: ../../auth/login.php");
        exit;
    }

    require_once "../../config/conn.php";
    require_once "../../user/function/functions.php";

    $title = "Kegiatan - Sistem Evaluasi Polres";
    require_once "../../template/header.php";
    require_once "../../template/navbar.php";
    require_once "../../template/sidebar.php";

?>

        <div id="layoutSidenav_content">
            <main>
            <?php
        if (isset($_GET['hapus'])) {
            $id = $_GET['hapus'];
            $query = mysqli_query($koneksi, "SELECT * FROM kegiatan_polda WHERE id = '$id'");
            $row = mysqli_fetch_array($query);
            ?>
            <form method="POST" action="proses-hapus-kegiatan.php">
                <div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalHapusLabel">
                                    Hapus Data </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div class="form-group mb-2">
                                    <label style="font-weight:600;" for="exampleFormControlInput1">Program</label>
                                    <input type="text" class="form-control" value="<?= $row['PG'] ?>" name="PG" readonly>
                                </div>
                                <p>Apakah Anda yakin ingin menghapus data ini?</p>
                                <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="submit" id="submit" class="btn btn-primary">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <?php
        }
        ?>

        <script>
            $(document).ready(function () {
                $("#modalHapus").modal('show');
            });
        </script>

                <div class="container-fluid px-4">
                    <h1 class="mt-4">PG Polda</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="../../index.php">Home</a></li>
                        <li class="breadcrumb-item active">Kegiatan</li>
                    </ol>
                    <div class="card">
                        <div class="card-header">
                            <span class="h5 my-2"><i class="fa-solid fa-list"></i> Data Kegiatan</span>
                            <?php if(userLogin()['role'] == 1) { ?>
                                <a href="<?= $main_url ?>kegiatan/polda/add-kegiatan.php" class="btn btn-sm btn-primary float-end"><i class="fa-solid fa-plus"></i> Tambah</a>
                            <?php } ?>
                        </div>
                        <div class="card-body">
                        <table class="table table-hover" id="example">
                            <thead>
                                <tr>
                                    <th scope="col"><center>No.</center></th>
                                    <th scope="col"><center>PG</center></th>
                                    <th scope="col"><center>Judul Kegiatan</center></th>
                                    <?php if(userLogin()['role'] == 1) { ?>
                                        <th scope="col"><center>Setting</center></th>
                                    <?php } ?>
                               </tr>
                            </thead>
                            <style>
                                .text-wrap {
                                    word-wrap: break-word; /* For wrapping long words */
                                    white-space: normal;   /* Allows text to wrap onto multiple lines */
                                    max-width: 50px;
                                    text-align: justify;
                                }

                                .size {
                                    width: 170px;
                                }
                                
                            </style>
                            <tbody>
                                <?php 
                                
                                    $no = 1;
                                    $queryKegiatan = mysqli_query($koneksi, "SELECT * FROM kegiatan_polda");
                                    while ($data = mysqli_fetch_array($queryKegiatan)) { ?>

                                    <tr>
                                        <th scope="row">
                                            <center>
                                                <?= $no++ ?>
                                            </center></th>
                                        <td>
                                            <center>
                                                <?= $data['PG'] ?>
                                            </center></td>
                                        <td class="text-wrap">
                                            <?= $data['nama_kegiatan'] ?>
                                        </td>
                                        <?php if(userLogin()['role'] == 1) { ?>
                                            <td class="size">                                         
                                                <a href="<?=$main_url?>kegiatan/polda/edit-kegiatan.php?id=<?=$data['id']?>" class="btn btn-sm btn-warning"><i class="fa-solid fa-pen" title="Edit"></i> Edit</a>
                                                <a href="<?=$main_url?>kegiatan/polda/kegiatan.php?hapus=<?=$data['id']?>" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash" title="Delete"></i> Delete</a>
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
            



<?php 

    require_once "../../template/footer.php";

?>