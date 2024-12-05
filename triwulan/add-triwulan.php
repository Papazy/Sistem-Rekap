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

?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Tambah Triwulan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="triwulan.php">Triwulan</a></li>
                        <li class="breadcrumb-item active">Tambah Triwulan</li>
                    </ol>
                    <form action="proses-triwulan.php" method="POST">
                    <div class="card">
                        <div class="card-header">
                            <span class="h5 my-2"><i class="fa-regular fa-square-plus"></i> Tambah Triwulan</span>
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
                                                    <input type="number" name="triwulan" id="triwulan" class="form-control-plaintext border-bottom" placeholder="isi" required>
                                                </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="periode" class="col-sm-2 col-form-label">Periode</label>
                                            <label for="periode" class="col-sm-1 col-form-label">:</label>
                                                <div class="col-sm-9" style="margin-left: -45px;">
                                                    <input type="text" name="periode" id="periode" class="form-control-plaintext border-bottom" placeholder="isi" required>
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