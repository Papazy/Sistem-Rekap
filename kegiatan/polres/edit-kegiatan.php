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

    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM kegiatan_polres WHERE id = '$id'");
    $data = mysqli_fetch_array($query);


?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Edit Kegiatan Polres</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="../../index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="kegiatan.php">Kegiatan</a></li>
                        <li class="breadcrumb-item active">Edit Kegiatan</li>
                    </ol>
                    <form action="proses-edit-kegiatan.php" method="POST">
                    <div class="card">
                        <div class="card-header">
                            <span class="h5 my-2"><i class="fa-regular fa-square-plus"></i> Edit Kegiatan</span>
                            <button type="submit" name="simpan" class="btn btn-primary float-end"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                            <button type="reset" name="reset" class="btn btn-danger float-end me-1"><i class="fa-solid fa-rotate-left"></i> Reset</button>
                        </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-11">
                                        <div class="mb-3 row">
                                            <input type="hidden" name="id" value="<?=$id?>">
                                            <label for="pg" class="col-sm-2 col-form-label">Program Giat</label>
                                            <label for="pg" class="col-sm-1 col-form-label">:</label>
                                                <div class="col-sm-9" style="margin-left: -45px;">
                                                    <input type="text" name="pg" id="pg" value="<?=$data['PG']?>" class="form-control-plaintext border-bottom" placeholder="isi" required>
                                                </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="judul" class="col-sm-2 col-form-label">Kegiatan</label>
                                            <label for="judul" class="col-sm-1 col-form-label">:</label>
                                                <div class="col-sm-9" style="margin-left: -45px;">    
                                                    <textarea name="nama_kegiatan" id="judul" cols="30" rows="3" class="form-control" required><?=$data['nama_kegiatan']?></textarea>
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