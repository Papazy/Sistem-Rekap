<?php 

    session_start();

    if (!isset($_SESSION['ssLogin'])) {
        header("location: ../auth/login.php");
        exit;
    }

    require_once "../config/conn.php";
    require_once "function/functions.php";
    require_once "function/mode-user.php";

    $title = "Edit Pengguna - Sistem Evaluasi Polres";
    require_once "../template/header.php";
    require_once "../template/navbar.php";
    require_once "../template/sidebar.php";

    $id = $_GET['id'];
    $sqlEdit = "SELECT * FROM user WHERE id = '$id'";
    $data    = getData($sqlEdit)[0];
    $jabatan = $data['jabatan'];
    $level   = $data['role'];

    if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
    } else {
        $msg = '';
    }

    $alert = '';
    if ($msg == 'cancel') {
        $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Data user gagal di update, username sudah ada...
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    if ($msg == 'notimage') {
        $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> Data user gagal di update, file yang anda upload bukan gambar...
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Edit User</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="add-user.php">Pengguna</a></li>
                        <li class="breadcrumb-item active">Edit Pengguna</li>
                    </ol>
                    <form action="proses-edit-user.php" method="POST">
                        <div class="card">
                            <div class="card-header">
                                <span class="h5 my-2"><i class="fa-regular fa-square-plus"></i> Edit Data User</span>
                                <button type="submit" name="update" class="btn btn-primary float-end"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="mb-3 row">
                                            <input type="hidden" name="id" value="<?=$id?>">
                                            <label for="username" class="col-sm-2 col-form-label">Username </label>
                                            <label for="username" class="col-sm-1 col-form-label">:</label>
                                                <div class="col-sm-9" style="margin-left: -45px;">
                                                    <input type="text" name="username" id="username" value="<?=$data['username']?>" class="form-control-plaintext border-bottom" placeholder="isi" required>
                                                </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="nama" class="col-sm-2 col-form-label">Nama </label>
                                            <label for="nama" class="col-sm-1 col-form-label">:</label>
                                                <div class="col-sm-9" style="margin-left: -45px;">    
                                                    <input type="text" name="nama" id="nama" value="<?=$data['nama']?>" class="form-control-plaintext border-bottom" placeholder="isi" required>
                                                </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="role" class="col-sm-2 col-form-label">Role</label>
                                            <label for="role" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9" style="margin-left: -45px;">
                                                <select name="role" id="role" class="form-select border-0 border-bottom" required>
                                                    <option value="1" <?= selectUser1($level) ?>>admin</option>
                                                    <option value="2" <?= selectUser2($level) ?>>user</option>
                                                 </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                                            <label for="" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9" style="margin-left: -45px;">
                                                <select name="jabatan" id="jabatan" class="form-select border-0 border-bottom" required>
                                                    <option value="Komandan" <?= selectJabatan1($jabatan) ?>>Komandan</option>
                                                    <option value="Wakil komandan" <?= selectJabatan2($jabatan)?>>Wakil komandan</option>
                                                    <option value="Petugas" <?= selectJabatan3($jabatan)?>>Petugas</option>
                                                    <option value="Operator" <?= selectJabatan4($jabatan)?>>Operator</option>
                                                   </select>
                                             </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                            <label for="" class="col-sm-1 col-form-label">:</label>
                                            <div class="col-sm-9" style="margin-left: -45px;">
                                                <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control" placeholder="isi" required><?=$data['alamat']?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 text-center px-5 mt-4">
                                        <input type="file" name="image" class="form-control form-control-sm mt-2 mb-2">
                                        <small class="text-secondary"> Pastikan Format foto adalah PNG, JPG, dan JPEG, ukuran maksimal 1 MB</small>                                           
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
