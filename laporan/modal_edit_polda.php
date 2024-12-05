<?php
require_once "../config/conn.php";
require_once "../user/function/functions.php";

$id = 0;
if(isset($_POST['id'])){
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
}

$sql = "SELECT * FROM persentase_polda WHERE id = $id";
$result = mysqli_query($koneksi, $sql);

if($result && mysqli_num_rows($result) > 0) {
    $dataPersentase = mysqli_fetch_assoc($result);
    $Min = 0;
    $Max = 0;
    $sqlMinMax = "SELECT * FROM laporan_polda WHERE periode = '".$dataPersentase['Periode']."' AND PG = '".$dataPersentase['PG']."'";
    $resultMinMax = mysqli_query($koneksi, $sqlMinMax);
    if($resultMinMax && mysqli_num_rows($resultMinMax) > 0){
        $dataMinMax = mysqli_fetch_assoc($resultMinMax);
        $Min = $dataMinMax['Min'];
        $Max = $dataMinMax['Max'];
    }
    $response = '<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalEdit' . $dataPersentase['id'] . 'Label">
                Edit Data </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body ">
            
                <input type="hidden" name="id" value="' . $dataPersentase['id'] . '" />
                <input type="hidden" name="Min" value="' . $Min . '" />
                <input type="hidden" name="Max" value="' . $Max . '" />
                <input type="hidden" name="Periode_old" value="' . $dataPersentase['Periode'] . '" />
                <input type="hidden" name="PG_old" value="' . $dataPersentase['PG'] . '" />

                <div class="form-group mb-2">
                    <label for="Satker" style="font-weight:600;">Satuan Kerja</label>
                    <select name="Satker" class="form-control" id="Satker">';
                        // Query untuk mendapatkan daftar Program Giat
                        $query_jenis = mysqli_query($koneksi, "SELECT DISTINCT Satker FROM persentase_polda");
                        
                        // Penanganan error jika query gagal
                        if (!$query_jenis) {
                            die("Error query: " . mysqli_error($koneksi)); 
                        }

                        while ($jenis = mysqli_fetch_array($query_jenis)) {
                            $selected = ($dataPersentase["Satker"] == $jenis['Satker']) ? "selected" : "";
                            $response .= '<option value="' . $jenis['Satker'] . '" ' . $selected . '>' . ucwords($jenis['Satker']) . '</option>';
                        }

                        $response .= '
                    </select>
                </div>

                <div class="form-group mb-2">
                    <label style="font-weight:600;" for="exampleFormControlInput1">Persentase</label>
                    <input name="Persentase" type="text" class="form-control" value="' . $dataPersentase['Persentase'] . '">
                </div>

                <div class="form-group mb-2">
                    <label for="PG" style="font-weight:600;">Program Giat</label>
                    <select name="PG" class="form-control" id="PG">';
                        // Query untuk mendapatkan daftar Program Giat
                        $query_jenis = mysqli_query($koneksi, "SELECT * FROM kegiatan_polda");
                        
                        // Penanganan error jika query gagal
                        if (!$query_jenis) {
                            die("Error query: " . mysqli_error($koneksi)); 
                        }

                        while ($jenis = mysqli_fetch_array($query_jenis)) {
                            $selected = ($dataPersentase["PG"] == $jenis['PG']) ? "selected" : "";
                            $response .= '<option value="' . $jenis['PG'] . '" ' . $selected . '>' . ucwords($jenis['PG']) . '</option>';
                        }

                        $response .= '
                    </select>
                </div>

                <div class="form-group mb-2">
                    <label style="font-weight:600;" for="exampleFormControlInput1">Periode</label>
                    <input type="date" name="Periode" class="form-control-plaintext border-bottom" id="Periode" value="' . $dataPersentase["Periode"] . '" />
                </div>

                <div class="form-group mb-2">
                    <label for="Triwulan" style="font-weight:600;">Triwulan</label>
                    <select name="Triwulan" class="form-control" id="Triwulan">';
                        // Query untuk mendapatkan daftar Program Giat
                        $query_jenis = mysqli_query($koneksi, "SELECT * FROM triwulan");
                        
                        // Penanganan error jika query gagal
                        if (!$query_jenis) {
                            die("Error query: " . mysqli_error($koneksi)); 
                        }

                        while ($jenis = mysqli_fetch_array($query_jenis)) {
                            $selected = ($dataPersentase["Triwulan"] == $jenis['Triwulan']) ? "selected" : "";
                            $response .= '<option value="' . $jenis['Triwulan'] . '" ' . $selected . '>' . ucwords($jenis['Triwulan']) . '</option>';
                        }

                        $response .= '
                    </select>
                </div>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Simpan</button>
        </div>
        
    </div>
</div>';

    echo $response;
} else {
    // Jika tidak ada data ditemukan, tampilkan pesan error atau tindakan lain yang sesuai
    echo "Data tidak ditemukan";
}
?>

