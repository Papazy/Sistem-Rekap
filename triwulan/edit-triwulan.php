<?php 

    session_start();

    if (!isset($_SESSION['ssLogin'])) {
        header("location: ../auth/login.php");
        exit;
    }

    require_once "../config/conn.php";
    require_once "../user/function/functions.php";

    $title = "Tambah Triwulan - Sistem Evaluasi Polres";
    require_once "../template/header.php";
    require_once "../template/navbar.php";
    require_once "../template/sidebar.php";

    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM triwulan WHERE id = '$id'");
    $data = mysqli_fetch_array($query);


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
                    <form action="proses-edit-triwulan.php" method="POST">
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
                                            <input type="hidden" name="id" value="<?=$id?>">
                                            <label for="triwulan" class="col-sm-2 col-form-label">Triwulan </label>
                                            <label for="triwulan" class="col-sm-1 col-form-label">:</label>
                                                <div class="col-sm-9" style="margin-left: -45px;">
                                                    <input type="number" name="triwulan" id="triwulan" value="<?=$data['Triwulan']?>" class="form-control-plaintext border-bottom" placeholder="isi" required>
                                                </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="periode" class="col-sm-2 col-form-label">Periode</label>
                                            <label for="periode" class="col-sm-1 col-form-label">:</label>
                                                <div class="col-sm-9" style="margin-left: -45px;">    
                                                <input type="text" name="periode" id="periode" value="<?=$data['Periode']?>" class="form-control-plaintext border-bottom" placeholder="isi" required>
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