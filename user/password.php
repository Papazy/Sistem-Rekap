<?php 

    session_start();

    if (!isset($_SESSION['ssLogin'])) {
        header("location: ../auth/login.php");
        exit;
    }

    require_once "../config/conn.php";
    require_once "function/functions.php";

    $title = "Ganti Password - Sistem Evaluasi Polres";
    require_once "../template/header.php";
    require_once "../template/navbar.php";
    require_once "../template/sidebar.php";

    if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
    } else {
        $msg = '';
    }

    $alert = "";
    if ($msg == 'updated') {
        $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa-solid fa-circle-check"></i> Password berhasil diganti..
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }

    if ($msg == 'err1') {
        $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="fa-solid fa-circle-xmark"></i> Password gagal diganti, konfirmasi password tidak sama..
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }

    if ($msg == 'err2') {
        $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fa-solid fa-circle-xmark"></i> Password gagal diganti, password lama tidak cocok..
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }

?>

<div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Password</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                        <li class="breadcrumb-item active">Ganti Password</li>
                    </ol>

                    <form action="proses-password.php" method="POST">
                        <?php 
                            if ($msg !== '') {
                                echo $alert;
                            }
                        ?>
                        <div class="card">
                            <div class="card-header">
                                <span class="h5 my-2"><i class="fa-solid fa-pen-to-square"></i> Ganti Password</span>
                                <button type="submit" name="simpan" class="btn btn-primary float-end"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                                <button type="reset" name="reset" class="btn btn-danger float-end me-1"><i class="fa-solid fa-rotate-left"></i> Reset</button>
                            </div>
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <div class="col-7">
                                        <label for="curPass" class="form-label">Password Lama <small style="font-size: 11px; color: red; opacity: 0.7; font-style: italic;">(default: 12345)</small></label>
                                        <input type="password" class="form-control" id="curPass" name="curPass" placeholder="Masukan password lama" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-7">
                                        <label for="newPass" class="form-label">Password Baru</label>
                                        <input type="password" class="form-control" id="newPass" name="newPass" minlength="4" maxlength="20" placeholder="Masukan password baru" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-7">
                                        <label for="confPass" class="form-label">Konfirmasi Password</label>
                                        <input type="password" class="form-control" id="confPass" name="confPass" placeholder="Masukan password baru" required>
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