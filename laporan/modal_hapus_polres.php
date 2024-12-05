<?php
require_once "../config/conn.php";
require_once "../user/function/functions.php";

$id = 0;
if(isset($_POST['id'])){
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
}

$sql = "SELECT * FROM persentase_polres WHERE id = $id";
$result = mysqli_query($koneksi, $sql);

if($result && mysqli_num_rows($result) > 0) {
    $dataPersentase = mysqli_fetch_assoc($result);

$response = '<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalHapus' . $dataPersentase['id'] . 'Label">
                Hapus Data </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
            <div class="modal-body">
                <div class="form-group mb-2">
                    <label style="font-weight:600;" for="exampleFormControlInput1">Polres</label>
                    <input type="text" class="form-control" value="' . $dataPersentase['Polres'] . '" name="Polres" readonly>
                </div>
                <p>Apakah Anda yakin ingin menghapus data ini?</p>
                <input type="hidden" name="id" value="' . $dataPersentase['id'] . '" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="submit" id="submit" class="btn btn-danger">Hapus</button>
            </div>
        
    </div>
</div>';
    echo $response;
}else {
    echo "Data tidak ditemukan";
}

?>