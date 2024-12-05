<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location: ../auth/login.php");
    exit;
}

require_once "../config/conn.php";
require_once "../user/function/functions.php";

$title = "Polres - Sistem Evaluasi Polres";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

$nama_kota = "";
if (isset($_GET['p'])) {
    // Ambil nilai dari parameter p
    $nama_kota = $_GET['p'];
}
$DAERAH = "Polres";
if (isset($_GET['j'])) {
    $DAERAH = $_GET['j'];
}

$KATEGORI = "Hijau";
if (isset($_GET["q"])) {
    $KATEGORI = $_GET["q"];
}
$kategori_title = "";
if ($KATEGORI == "Hijau") {
    $kategori_title = "Lulus";

} elseif ($KATEGORI == "Kuning") {
    $kategori_title = "Cukup";
} else {
    $kategori_title = "Tidak Lulus";
}

$jenis = strtolower($DAERAH) == "polda" ? "polda" : "polres";
$satker = strtolower($DAERAH) == "polda" ? "Satker" : "Polres";


$PERIODE = array();
$PERSENTASE = array();

$TRIWULAN_SELECTED = isset($_GET['triwulan']) ? $_GET['triwulan'] : 1;

$query = mysqli_query($koneksi, "SELECT DISTINCT Periode FROM persentase_" . $jenis . " WHERE " . $satker . " = '$nama_kota'");
while ($data = mysqli_fetch_array($query)) {
    // var_dump($data["Periode"]);
    $PERIODE[] = $data["Periode"];
}


$periode_select = isset($_GET['periode']) ? $_GET['periode'] : $PERIODE[0];



$total = 0;
$count = 0;
$query = mysqli_query($koneksi, "SELECT Persentase FROM persentase_" . $jenis . " WHERE " . $satker . " = '$nama_kota' AND Periode = '$periode_select'");
while ($data = mysqli_fetch_array($query)) {
    // var_dump($data["Persentase"]);
    // var_dump($data["Persentase"]);
    $total = $total + (float) $data["Persentase"];
    $count++;
}
if($count > 0){
    $PERSENTASE[] = ($total / $count);
}else{
    $PERSENTASE[] = 0;
}




// var_dump($PERIODE);
$title_jenis = $jenis == "polres" ? "Polres" : "Polda";
if($periode_select != "None"){
    $headerTable = "".$title_jenis." ".$nama_kota." - Periode : ".$periode_select."";
}else{
    $headerTable = "".$title_jenis." ".$nama_kota." - Triwulan : ".$TRIWULAN_SELECTED."";
}

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">
                <?php echo $DAERAH == "Polda" ? "Satuan Kerja" : "Polres"; ?>
                <?= $nama_kota; ?>
            </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="../index.php">Triwulan
                        <?= $TRIWULAN_SELECTED ?>
                    </a></li>
                <li class="breadcrumb-item "><a href="../table/data.php?q=<?= $nama_kota ?>">
                        <?= $nama_kota; ?>
                    </a></li>
                <li class="breadcrumb-item active"><a
                        href="../table/data-periode.php?q=<?= $nama_kota ?>&periode=<?= $periode_select; ?>">
                        <?= $periode_select; ?>
                    </a>
                </li>
            </ol>

            <div class="card w-75">
                <div class="card-header d-flex align-items-center justify-content-between">Data
                    <?= $DAERAH ?></span>
                    <div class="d-flex align-items-center">
                        <style>
                            select {
                                -webkit-appearance: none;
                                -moz-appearance: none;
                                text-indent: 1px;
                                text-overflow: '';
                            }
                        </style>
                        <label class="mx-2 ">Periode</label>
                        <select class="form-select" style="width: 150px;" onchange="location = this.value;">
                            <?php
                            echo "<option value='?periode={$periode_select}' selected>{$periode_select}</option>";
                            ?>
                        </select>
                    </div>
                </div>
                <div class="card-body ">
                    <table class="table table-hover w-75" id="example">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">
                                    <center><?=$satker?></center>
                                </th>
                                <th scope="col">
                                    <center>PG</center>
                                </th>
                                <th scope="col" style="width:20%; height:100%">
                                    <center>Persentase</center>
                                </th>
                                <th scope="col">
                                    <center>Min</center>
                                </th>
                                <th scope="col">
                                    <center>Max</center>
                                </th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php

                            $no = 1;
                            $queryPersentase = mysqli_query($koneksi, "SELECT * FROM persentase_" . $jenis . " WHERE Periode = '{$periode_select}' AND " . $satker . " = '{$nama_kota}'");
                            // print_r($periode_select);
                            while ($dataPersentase = mysqli_fetch_array($queryPersentase)) {

                                $queryLaporan = mysqli_query($koneksi, "SELECT Min, Max FROM laporan_" . $jenis . " WHERE Periode = '{$periode_select}' AND PG = '{$dataPersentase['PG']}'");
                                $data = mysqli_fetch_array($queryLaporan);
                                $dataMin = $data["Min"];
                                $dataMax = $data["Max"];
                                $class = null;
                                if ((float) $dataPersentase['Persentase'] >= (float) $data["Max"]) {
                                    $class = 'bg-success';
                                } elseif ((float) $dataPersentase['Persentase'] > (float) $data["Min"]) {
                                    $class = 'bg-warning';
                                } else {
                                    $class = 'bg-danger';

                                }


                                if ($KATEGORI == "Hijau" && !($dataPersentase['Persentase'] >= (float) $data["Max"])) {
                                    continue;
                                } elseif ($KATEGORI == "Kuning" && !($dataPersentase['Persentase'] < (float) $data["Max"] && $dataPersentase['Persentase'] > (float) $data["Min"])) {
                                    continue;
                                } elseif ($KATEGORI == "Merah" && !($dataPersentase['Persentase'] <= (float) $data["Min"])) {
                                    continue;
                                }


                                ?>
                                <tr>
                                    <th class="dt-type-numeric">
                                    </th>
                                    <td>
                                        <center>
                                            <?= $dataPersentase[$satker] ?>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <?= $dataPersentase['PG'] ?>
                                        </center>
                                    </td>
                                    <td class="<?= $class ?>">
                                        <center>
                                            <?= $dataPersentase['Persentase'] . "%" ?>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <?= $dataMin . "%" ?>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <?= $dataMax . "%" ?>
                                        </center>
                                    </td>
                                </tr>


                                <?php
                            } ?>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </main>




    <?php

    require_once "../template/footer.php";

    ?>