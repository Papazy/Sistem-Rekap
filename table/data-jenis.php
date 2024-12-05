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

    $jenis = "polres";
    if(isset($_GET['j'])){
        $jenis = $_GET['j'];
    }
    $title_jenis = $jenis == "polres" ? "Polres" : "Polda";
    $satuan = $jenis == "polres" ? "Polres" : "Satker";


    $nama_kota = $_GET["p"];
    $class = $_GET["q"];

    $queryData = mysqli_query($koneksi, "SELECT * FROM persentase_".$jenis." WHERE ".$satuan." = '{$nama_kota}'");
    $queryPeriodeData = mysqli_query($koneksi, "SELECT DISTINCT Periode FROM persentase_".$jenis." WHERE ".$satuan." = '{$nama_kota}'");
    $dataPersentase = array();

    $countDataPeriode = array();
    $PERIODE_ALL = array();
    while($periode = mysqli_fetch_array($queryPeriodeData)){
        $Min = 0;
        $Max = 0;
        $queryMinMax = mysqli_query($koneksi, "SELECT Min, Max FROM laporan_".$jenis." WHERE Periode = '{$periode['Periode']}'");
        while($data = mysqli_fetch_array($queryMinMax)){
            $Min = $data['Min'];
            $Max = $data['Max'];
            break;
        }
        $periode_select = $periode['Periode'];
        $queryData = mysqli_query($koneksi, "SELECT * FROM persentase_".$jenis." WHERE ".$satuan." = '{$nama_kota}' AND Periode = '$periode_select'");
        $count = 0;
        while($data = mysqli_fetch_array($queryData)){
            $nilai = $data['Persentase'];
            if ($class == "danger"){
                if ($nilai <  $Min){
                    $count++;
                }
            } else if ($class == "warning"){
                if ($nilai >= $Min && $nilai <= $Max){
                    $count++;
                }
            } else if ($class == "success"){
                if ($nilai > $Max){
                    $count++;
                }
            }
        }
        $PERIODE_ALL[] = $periode['Periode'];
        $countDataPeriode[] = $count;
    }

    $Breadcumb = ($class == "danger") ? "Tidak Lulus" : (($class == "warning") ? "Cukup" : "Lulus");



?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?=$title_jenis?> <?= $nama_kota; ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a style="text-decoration: none;" href="../index.php">Home</a></li>
                <li class="breadcrumb-item active"><a style="text-decoration: none;" href="../index.php"><?=$title_jenis?> </a></li>
                <li class="breadcrumb-item"><a style="text-decoration: none;"
                        href="../table/<?= $class ?>.php?j=<?=$jenis?>"><?= $Breadcumb ?></a></li>
                <li class="breadcrumb-item active"><a style="text-decoration: none;"
                        href="../table/data-jenis.php?j=<?=$jenis?>&q=<?= $class ?>&p=<?=$nama_kota?>"><?= $nama_kota ?></a></li>


            </ol>

            <div class="card w-50">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <span class="h5 my-2"><i class="fa-solid fa-list"></i> Kategori <?=$Breadcumb?></span>
                    <div class="d-flex align-items-center">
                        <style>
                        select {
                            -webkit-appearance: none;
                            -moz-appearance: none;
                            text-indent: 1px;
                            text-overflow: '';
                        }
                        </style>
                        <!-- <label class="mx-2 ">Periode</label>
                        <select class="form-select" style="width: 150px;" onchange="location = this.value;">
                            <?php
                            echo "<option value='?periode={$periode_select}' selected>{$periode_select}</option>";
                        ?>
                        </select> -->
                    </div>
                </div>
                <div class="card-body ">
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <center>No</center>
                                </th>
                                <th scope="col">
                                    <center>Periode</center>
                                </th>
                                <th scope="col">
                                    <center>Jumlah</center>
                                </th>
                                <th scope="col">

                                </th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php

                            $no = 1;
                            $i = 0;
                            foreach($PERIODE_ALL as $periode){
                                if($countDataPeriode[$i] == 0){
                                    $i++;
                                    continue;
                                }
                            ?>
                            <tr>
                                <td class="dt-type-numeric">    
                                </td>
                                <td>
                                    <center><?= date('d-m-Y', strtotime($periode)); ?></center>
                                </td>
                                <td class="<?= $class ?>">
                                    <center >
                                        <?= $countDataPeriode[$i] ?></center>
                                </td>
                                <td>
                                    <center>
                                        <a href="<?= $main_url?>table/data-satuan.php?j=<?= $jenis?>&q=<?= $class?>&p=<?=$nama_kota?>&periode=<?=$periode?>"
                                            class="btn btn-sm btn-primary"><i class="fa-solid fa-magnifying-glass"></i>
                                            Show</a>
                                    </center>
                                </td>
                            </tr>


                            <?php $i++; } ?>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </main>




    <?php 

    require_once "../template/footer.php";

?>