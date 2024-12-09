<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
  header("location: ../../auth/login.php");
  exit;
}

require_once "../../config/conn.php";
require_once "../../user/function/functions.php";

$title = "Varifikasi - Sistem Evaluasi";
require_once "../../template/header.php";
require_once "../../template/navbar.php";
require_once "../../template/sidebar.php";
$headerTable = "- Polisi Resort Aceh -"
?>


<?php
// Modal Edit
?>
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditLabel">Edit Data Batasan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formEdit" method="POST" action="edit_batasan.php">
        <div class="modal-body">
          <input type="hidden" name="id" id="editId">

          <div class="mb-3">
            <label for="editNama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="editNama" name="nama" required>
          </div>

          <div class="mb-3">
            <label for="editSatuan" class="form-label">Satuan</label>
            <input type="text" class="form-control" id="editSatuan" name="satuan" required>
          </div>

          <div class="mb-3">
            <label for="editMin" class="form-label">Min</label>
            <input type="number" step="0.01" class="form-control" id="editMin" name="min" required>
          </div>

          <div class="mb-3">
            <label for="editMax" class="form-label">Max</label>
            <input type="number" step="0.01" class="form-control" id="editMax" name="max" required>
          </div>
          <div class="mb-3">
            <label for="editMinFile" class="form-label">Min File</label>
            <input type="number"  class="form-control" id="editMinFile" name="min_file" required>
          </div>

          <div class="mb-3">
            <label for="editMaxFile" class="form-label">Max File</label>
            <input type="number"  class="form-control" id="editMaxFile" name="max_file" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
// Modal Delete
?>
<div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalHapusLabel">Hapus Data Batasan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formHapus" method="POST" action="hapus_batasan.php">
        <div class="modal-body">
          <input type="hidden" name="id" id="hapusId">
          <p>Apakah Anda yakin ingin menghapus data ini?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  // Fill Edit Modal with Data
  function openEditModal(id, nama, satuan, min, max, min_file, max_file) {
    document.getElementById('editId').value = id;
    document.getElementById('editNama').value = nama;
    document.getElementById('editSatuan').value = satuan;
    document.getElementById('editMin').value = min;
    document.getElementById('editMax').value = max;
    document.getElementById('editMinFile').value = min_file;
    document.getElementById('editMaxFile').value = max_file;

    var editModal = new bootstrap.Modal(document.getElementById('modalEdit'));
    editModal.show();
  }

  // Fill Delete Modal with ID
  function openDeleteModal(id) {
    document.getElementById('hapusId').value = id;

    var deleteModal = new bootstrap.Modal(document.getElementById('modalHapus'));
    deleteModal.show();
  }
</script>


<div id="layoutSidenav_content">
  <main>
    <!-- Modal Edit-->
    <form method="POST" action="edit_verivikasi.php">
      <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modalEdit">
      </div>
    </form>

    <!-- Modal Delete -->
    <form method="POST" action="hapus_verivikasi.php">
      <div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
      </div>
    </form>

    <div class="container-fluid px-4">
      <h1 class="mt-4">Batasan Indikator Polres</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="../../index.php">Home</a></li>
        <li class="breadcrumb-item active">Verifikasi</li>
      </ol>
      <div class="card">
        <div class="card-header d-inline-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center justify-content-start">
            <span class="h5 my-2 d-flex align-items-center " style="width: 150px;"><i class="fa-solid fa-list me-2"></i> Polres</span>
            <div class="d-flex align-items-center gap-2">
              <!-- Dropdown Triwulan -->
              <select
                class="form-select"
                id="triwulan"
                name="triwulan"
                aria-placeholder="triwulan"
                onchange="updateTriwulan()"
                style="width: 150px;">
                <option value="" disabled selected>Pilih Jenis</option>
                <option value="triwulan" <?php if (isset($_GET['jenis']) && $_GET['jenis'] == 'triwulan') {
                                            echo "selected";
                                          } ?>>Triwulan</option>
                <option value="program" <?php if (isset($_GET['jenis']) && $_GET['jenis'] == 'program') {
                                          echo "selected";
                                        } ?>>Program</option>


              </select>
              <!-- Dropdown Program -->
              <!-- <select
                                class="form-select"
                                id="program"
                                name="program"
                                aria-placeholder="Program"
                                onchange="updateProgram()"
                                style="width: 150px;">
                                <option value="" disabled selected style="color:white">Program</option>
                                <?php
                                $data = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                for ($i = 0; $i < strlen($data); $i++) {
                                  $selected = (isset($_GET['program']) && $_GET['program'] == $data[$i]) ? 'selected' : '';
                                  echo "<option value='$data[$i]' $selected>$data[$i]</option>";
                                }
                                ?>
                            </select> -->

              <!-- Dropdown Giat -->
              <!-- <select
                                class="form-select"
                                id="giat"
                                name="giat"
                                onchange="updateGiat()"
                                disabled>
                                <option value="" disabled selected style="color:white">Giat</option>
                                <?php
                                for ($i = 1; $i <= 50; $i++) {
                                  $selected = (isset($_GET['giat']) && $_GET['giat'] == $i) ? 'selected' : '';
                                  echo "<option value='$i' $selected>$i</option>";
                                }
                                ?>
                            </select> -->

              <!-- Button untuk reset link kembali menjadi /verifikasi.php -->
              <!-- <a href="<?= $main_url ?>verifikasi/verifikasi.php" class="btn btn-sm btn-primary">Reset</a> -->
            </div>
          </div>


          <!-- <small style="font-size: 10px; color: red; opacity: 0.7; font-style: italic;"> (Max Persentase: 27.44%, Max Sudah Upload: 90)</small> -->
          <div class="">
            <!-- fitur filter select -->

            <?php if (userLogin()['role'] == 1) { ?>
              <a href="<?= $main_url ?>verifikasi/polres/add_batasan.php"
                class="btn btn-sm btn-primary float-end"><i class="fa-solid fa-plus"></i> Tambah</a>
            <?php } ?>
          </div>
        </div>
        <div class="card-body">
          <table class="display" id="exampleNoSetting">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">
                  <center>Nama</center>
                </th>
                <th scope="col">
                  <center>Satuan</center>
                </th>
                <th scope="col">
                  <center>Min</center>
                </th>
                <th scope="col">
                  <center>Min File</center>
                </th>
                <th scope="col">
                  <center>Max</center>
                </th>
                <th scope="col">
                  <center>Max File</center>
                </th>
                <th scope="col">
                  <center>Action</center>
                </th>
              </tr>
            </thead>
            <style>
              .size {
                width: 170px;
              }
            </style>
            <tbody>
              <?php
              $queryBatasan = "SELECT * FROM batasan ORDER BY id ASC";
              $resultBatasan = mysqli_query($koneksi, $queryBatasan);

              $no = 1;
              while ($dataBatasan = mysqli_fetch_array($resultBatasan)) {
                $nama = $dataBatasan["nama"];
                $satuan = $dataBatasan["satuan"];
                $min = $dataBatasan["min"];
                $max = $dataBatasan["max"];
                $min_file = $dataBatasan["min_file"];
                $max_file = $dataBatasan["max_file"];
              ?>
                <tr>
                  <td>
                    <center><?= $no++ ?></center>
                  </td>
                  <td>
                    <center><?= htmlspecialchars($nama) ?></center>
                  </td>
                  <td>
                    <center><?= htmlspecialchars($satuan) ?></center>
                  </td>
                  <td>
                    <center><?= number_format($min, 2) ?></center>
                  </td>
                  <td>
                    <center><?= $min_file ?></center>
                  </td>
                  <td>
                    <center><?= number_format($max, 2) ?></center>
                  </td>
                  <td>
                    <center><?= $max_file  ?></center>
                  </td>
                  <td>
                    <button class="btn btn-sm btn-warning" onclick="openEditModal('<?= $dataBatasan['id'] ?>', '<?= htmlspecialchars($dataBatasan['nama']) ?>', '<?= htmlspecialchars($dataBatasan['satuan']) ?>', <?= $dataBatasan['min'] ?>, <?= $dataBatasan['max'] ?>,<?= $dataBatasan['min_file'] ?>, <?= $dataBatasan['max_file'] ?>)">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="openDeleteModal('<?= $dataBatasan['id'] ?>')">Hapus</button>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

  <?php

  require_once "../../template/footer.php";

  ?>