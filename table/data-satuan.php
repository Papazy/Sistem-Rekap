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
    $periode = $_GET["periode"];
    
    
    $PERSENTASE = array();
    $PG = array();
    $Min = 0;
    $Max = 0;
    $queryMinMax = mysqli_query($koneksi, "SELECT Min, Max FROM laporan_".$jenis." WHERE Periode = '$periode'");
    while($data = mysqli_fetch_array($queryMinMax)){
        $Min = $data['Min'];
        $Max = $data['Max'];
        break;
    }

    $queryPersentase = mysqli_query($koneksi, "SELECT * FROM persentase_".$jenis." WHERE ".$satuan." = '$nama_kota' AND Periode = '$periode'");
    while($data = mysqli_fetch_array($queryPersentase)){
        // print_r($data);
        // print_r("<br>");
        if($class == "danger"){
            if((float)$data['Persentase'] < (float)$Min){
                $PG[] = $data['PG'];
                $PERSENTASE[] = $data['Persentase'];
            }
        }else if($class == "warning"){
            if((float)$data['Persentase'] >= (float)$Min && (float)$data['Persentase'] <= (float)$Max){
                $PG[] = $data['PG'];
                $PERSENTASE[] = $data['Persentase'];
            }
        }else if($class == "success"){
            if((float)$data['Persentase'] > (float)$Max){
                $PG[] = $data['PG'];
                $PERSENTASE[] = $data['Persentase'];
            }
        }
    }
    $title_jenis = $jenis == "polres" ? "Polres" : "Polda";
$headerTable = "".$title_jenis." - Triwulan : ".$TRIWULAN_SELECTED."";


    $Breadcumb = ($class == "danger") ? "Tidak Lulus" : (($class == "warning") ? "Cukup" : "Lulus");
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Polres <?= $nama_kota; ?></h1>
            <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a style="text-decoration: none;" href="../index.php">Home</a></li>

                <li class="breadcrumb-item active"><a style="text-decoration: none;" href="../index.php"><?=$title_jenis?> </a></li>
                <li class="breadcrumb-item"><a style="text-decoration: none;"
                        href="../table/<?= $class ?>.php?j=<?=$jenis?>"><?= $Breadcumb ?></a></li>
                <li class="breadcrumb-item active"><a style="text-decoration: none;"
                        href="../table/data-jenis.php?j=<?=$jenis?>&q=<?= $class ?>&p=<?=$nama_kota?>"><?= $nama_kota ?></a></li>
                <li class="breadcrumb-item active"><a style="text-decoration: none;"
                        href="../table/data-satuan.php?j=<?= $jenis?>&q=<?= $class ?>&p=<?=$nama_kota?>&periode=<?=$periode?>"><?=  date('d-m-Y', strtotime($periode)); ?></a></li>
            </ol>

            <div class="card w-75">
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

                        <label class="px-2 py-1 mx-1 card bg-danger fw-bold fs-12">Min: <?=$Min . "%";?></label>
                        <label class="px-2 py-1 mx-1 card bg-success fw-bold fs-12">Max: <?=$Max . "%";?></label>
                    </div>
                </div>
                <div class="card-body ">
                    <table class="table table-hover w-75" id="example">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">
                                    <center>PG</center>
                                </th>
                                <th scope="col" style="width:50%">
                                    <center>Persentase</center>
                                </th>
                               

                            </tr>
                        </thead>

                        <tbody>
                            <?php

                            $no = 1;
                            $i = 0;
                            foreach($PERSENTASE as $persen){
                                $class_bo = ($class == "danger") ? "bg-danger" : (($class == "warning") ? "bg-warning" : "bg-success");
                            ?>
                            <tr>
                                <th class="dt-type-numeric"></th>
                                <td>
                                    <center><?= $PG[$i] ?></center>
                                </td>
                                <td class="<?= $class_bo ?>">
                                    <center>
                                        <?= $persen . "%" ?></center>
                                </td>
                               
                            </tr>


                            <?php 
                            $i++; } ?>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </main>




    <?php 

    require_once "../template/footer.php";

?>