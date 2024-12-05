<?php

session_start();
if (!isset($_SESSION["ssLogin"])) {
    header("location: ../auth/login.php");
    exit;
}

require_once "../config/conn.php";
require_once "function/functions.php";
require_once "function/mode-user.php";

$title = "Pengguna - Sistem Evaluasi Polres";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
} else {
    $msg = '';
}

$alert = '';
if ($msg == 'cancel') {
    $alert = '<div id="alert-div" class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-triangle-exclamation"></i> Tambah user gagal, username sudah terpakai...
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  <script>
                    setTimeout(function() {
                      var alertDiv = document.getElementById("alert-div");
                      if (alertDiv) {
                        alertDiv.style.display = "none";
                      }
                    window.location.href = "user.php"; 
                    }, 3000);
                  </script>';
}
if ($msg == 'notimage') {
    $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-triangle-exclamation"></i> Tambah user gagal, file yang anda upload bukan gambar...
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  <script>
                    setTimeout(function() {
                      var alertDiv = document.getElementById("alert-div");
                      if (alertDiv) {
                        alertDiv.style.display = "none";
                      }
                    window.location.href = "user.php"; 
                    }, 3000);
                  </script>';
}
if ($msg == 'oversize') {
    $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-triangle-exclamation"></i> Tambah user gagal, maximal ukuran gambar 1 MB...
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  <script>
                    setTimeout(function() {
                      var alertDiv = document.getElementById("alert-div");
                      if (alertDiv) {
                        alertDiv.style.display = "none";
                      }
                    window.location.href = "user.php"; 
                    }, 3000);
                  </script>';
}

if ($msg == 'added') {
    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-circle-check"></i> Tambah user berhasil !
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  <script>
                    setTimeout(function() {
                      var alertDiv = document.getElementById("alert-div");
                      if (alertDiv) {
                        alertDiv.style.display = "none";
                      }
                    window.location.href = "user.php"; 
                    }, 3000);
                  </script>';
}
if ($msg == 'delete') {
    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-circle-check"></i> Data user berhasil di hapus !
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  <script>
                    setTimeout(function() {
                      var alertDiv = document.getElementById("alert-div");
                      if (alertDiv) {
                        alertDiv.style.display = "none";
                      }
                    window.location.href = "user.php"; 
                    }, 3000);
                  </script>';
}
if ($msg == 'update') {
    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-circle-check"></i> Data user berhasil di update !
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  <script>
                    setTimeout(function() {
                      var alertDiv = document.getElementById("alert-div");
                      if (alertDiv) {
                        alertDiv.style.display = "none";
                      }
                    window.location.href = "user.php"; 
                    }, 3000);
                  </script>';
}

// Fetch user data for editing
$editUser = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $users = getData("SELECT * FROM user WHERE id='$id'");
    $editUser = $users[0];
}
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">User</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active">Pengguna</li>
            </ol>
            <form action="add-edit-user.php" method="post" enctype="multipart/form-data">
                <?php
                if ($msg !== '') {
                    echo $alert;
                }
                ?>
                <div class="card">
                    <div class="card-header">
                        <span class="h5 my-2"><i class="fa-solid fa-user-plus fa-sm"></i> <?= isset($editUser) ? 'Edit User' : 'Add User' ?></span>
                        <button type="submit" name="<?= isset($editUser) ? 'update' : 'simpan' ?>" class="btn btn-primary float-end"><i class="fa-solid fa-floppy-disk"></i> <?= isset($editUser) ? 'Update' : 'Simpan' ?></button>
                        <button type="reset" name="reset" class="btn btn-danger float-end me-1"><i class="fa-solid fa-rotate-left"></i> Reset</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="mb-3 row">
                                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -45px;">
                                        <input type="text" pattern="[A-Za-z0-9]{3,}" title="minimal 3 karakter, kombinasi huruf besar, huruf kecil, dan angka." class="form-control border-0 border-bottom" id="username" name="username" maxlength="20" required value="<?= isset($editUser) ? $editUser['username'] : '' ?>">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -45px;">
                                        <input type="text" class="form-control border-0 border-bottom" id="nama" name="nama" maxlength="20" required value="<?= isset($editUser) ? $editUser['nama'] : '' ?>">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="role" class="col-sm-2 col-form-label">Role</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -45px;">
                                        <select name="role" id="role" class="form-select border-0 border-bottom" required>
                                            <option value="" selected> -- Pilih --</option>
                                            <option value="1" <?= isset($editUser) && $editUser['role'] == '1' ? 'selected' : '' ?>> admin</option>
                                            <option value="2" <?= isset($editUser) && $editUser['role'] == '2' ? 'selected' : '' ?>> user</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -45px;">
                                        <select name="jabatan" id="jabatan" class="form-select border-0 border-bottom" required>
                                            <option value="" selected> -- Pilih --</option>
                                            <option value="Komandan" <?= isset($editUser) && $editUser['jabatan'] == 'Komandan' ? 'selected' : '' ?>> Komandan</option>
                                            <option value="Wakil komandan" <?= isset($editUser) && $editUser['jabatan'] == 'Wakil komandan' ? 'selected' : '' ?>> Wakil komandan</option>
                                            <option value="Petugas" <?= isset($editUser) && $editUser['jabatan'] == 'Petugas' ? 'selected' : '' ?>> Petugas</option>
                                            <option value="Operator" <?= isset($editUser) && $editUser['jabatan'] == 'Operator' ? 'selected' : '' ?>> Operator</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <label for="" class="col-sm-1 col-form-label">:</label>
                                    <div class="col-sm-9" style="margin-left: -45px;">
                                        <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control" placeholder="Isi" required><?= isset($editUser) ? $editUser['alamat'] : '' ?></textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?= isset($editUser) ? $editUser['id'] : '' ?>">
                            </div>
                            <div class="col-4 text-center px-5 mt-4">
                                <input type="hidden" name="oldImage" value="<?= isset($editUser['foto']) ? $editUser['foto'] : 'default.png' ?>">
                                <?php if (isset($editUser) && !empty($editUser['foto']) && $editUser['foto'] != 'default.png') : ?>
                                    <img src="../asset/upload_img/<?= $editUser['foto'] ?>" alt="gambar user" class="mb-3" width="40%">
                                <?php else : ?>
                                    <img src="../asset/image/default.png" alt="gambar user" class="mb-3" width="40%">
                                <?php endif; ?>
                                <input type="file" name="image" class="form-control form-control-sm mt-2 mb-2">
                                <small class="text-secondary">Pastikan format foto adalah PNG, JPG, dan JPEG, ukuran maksimal 1 MB</small>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <div class="container-fluid px-4 mt-4 mb-4">
        <div class="card">
            <div class="card-header">
                <span class="h5 my-2"><i class="fa-solid fa-list"></i> Data User</span>
            </div>
            <div class="card-body table-responsive">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col"><center>No.</center></th>
                                    <th scope="col"><center>Foto</center></th>
                                    <th scope="col"><center>Username</center></th>
                                    <th scope="col"><center>Nama</center></th>
                                    <th scope="col"><center>Jabatan</center></th>
                                    <th scope="col"><center>Alamat</center></th>
                                    <th scope="col"><center>Level</center></th>
                                    <th scope="col"><center>Setting</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $users = getData("SELECT * FROM user");
                                foreach ($users as $user) : ?>
                                    <tr>
                                        <td><center><?= $no++; ?></center></td>
                                        <td><center><img src="../asset/upload_img/<?= $user['foto'] ?>" class="rounded-circle" alt="" width="60px"></center></td>
                                        <td><center><?= $user['username'] ?></center></td>
                                        <td><center><?= $user['nama'] ?></center></td>
                                        <td><center><?= $user['jabatan'] ?></center></td>
                                        <td><center><?= $user['alamat'] ?></center></td>
                                        <td>
                                            <center>
                                                <?php
                                                if ($user['role'] == 1) {
                                                    echo "Admin";
                                                } elseif ($user['role'] == 2) {
                                                    echo "User";
                                                }
                                                ?>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <a href="<?= $_SERVER['PHP_SELF'] ?>?edit=<?= $user['id'] ?>" class="btn btn-sm btn-warning"><i class="fa-solid fa-pen" title="Edit"></i> Edit</a>
                                                <a href="<?= $_SERVER['PHP_SELF'] ?>?hapus=<?= $user['id'] ?>" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash" title="Delete"></i> Delete</a>
                                            </center>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_GET['hapus'])) {
        $id = $_GET['hapus'];
        $query = mysqli_query($koneksi, "SELECT * FROM user WHERE id = '$id'");
        $row = mysqli_fetch_array($query);
    ?>
        <form method="POST" action="del-user.php">
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
                                <label style="font-weight:600;" for="exampleFormControlInput1">Pengguna</label>
                                <input type="text" class="form-control" value="<?= $row['username'] ?>" name="username" readonly>
                            </div>
                            <p>Apakah Anda yakin ingin menghapus data ini?</p>
                            <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="delete" id="delete" class="btn btn-primary">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php } ?>

    <script>
        $(document).ready(function() {
            $("#modalHapus").modal('show');
        });
    </script>

    <?php

    require_once "../template/footer.php";

    ?>