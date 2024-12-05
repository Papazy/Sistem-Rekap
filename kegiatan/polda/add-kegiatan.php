<?php 

    session_start();

    if (!isset($_SESSION['ssLogin'])) {
        header("location: ../../auth/login.php");
        exit;
    }

    require_once "../../config/conn.php";
    require_once "../../user/function/functions.php";

    $title = "Tambah Kegiatan - Sistem Evaluasi Polres";
    require_once "../../template/header.php";
    require_once "../../template/navbar.php";
    require_once "../../template/sidebar.php";

?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Tambah Kegiatan Polda</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="../../index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="kegiatan.php">Kegiatan</a></li>
                        <li class="breadcrumb-item active">Tambah Kegiatan</li>
                    </ol>
                    <form action="proses-kegiatan.php" method="POST">
                    <div class="card">
                        <div class="card-header">
                            <span class="h5 my-2"><i class="fa-regular fa-square-plus"></i> Tambah Kegiatan</span>
                            <button type="submit" name="simpan" class="btn btn-primary float-end"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                            <button type="reset" name="reset" class="btn btn-danger float-end me-1"><i class="fa-solid fa-rotate-left"></i> Reset</button>
                        </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-11">
                                        <div class="mb-3 row">
                                            <label for="pg" class="col-sm-2 col-form-label">Program Giat</label>
                                            <label for="pg" class="col-sm-1 col-form-label">:</label>
                                                <div class="col-sm-9" style="margin-left: -45px;">
                                                    <input type="text" name="pg" id="pg" class="form-control-plaintext border-bottom" placeholder="isi" required>
                                                </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="judul" class="col-sm-2 col-form-label">Kegiatan</label>
                                            <label for="judul" class="col-sm-1 col-form-label">:</label>
                                                <div class="col-sm-9" style="margin-left: -45px;">    
                                                    <textarea name="judul" id="judul" cols="30" rows="3" class="form-control" placeholder="isi" required></textarea>
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

    require_once "../../template/footer.php";

?>