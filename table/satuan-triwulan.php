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
    if(isset($_GET['q'])) {
        // Ambil nilai dari parameter q
        $nama_kota = $_GET['q'];
    }
    
    $PERIODE = array();
    $PERSENTASE = array();

    $query = mysqli_query($koneksi, "SELECT DISTINCT Periode FROM persentase_polres WHERE Polres = '$nama_kota'");
    while($data = mysqli_fetch_array($query)){
        // var_dump($data["Periode"]);
        $PERIODE[] = $data["Periode"];
    }
    $periode_select = isset($_GET['periode']) ? $_GET['periode'] : $PERIODE[0];
    foreach ($PERIODE as $period){
        $total = 0;
        $count = 0;
        $query = mysqli_query($koneksi, "SELECT Persentase FROM persentase_polres WHERE Polres = '$nama_kota' AND Periode = '$period'");
        while($data = mysqli_fetch_array($query)){
            // var_dump($data["Persentase"]);
            // var_dump($data["Persentase"]);
            $total = $total + (float)$data["Persentase"];
            $count++;
        }
        $PERSENTASE[] = ($total/$count);
    }
    

    // var_dump($PERIODE);
    // var_dump($PERSENTASE);


?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Polres <?= $nama_kota; ?></h1>
            <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item "><a href="../table/data.php?q=<?= $nama_kota?>"><?= $nama_kota; ?></a></li>
                <li class="breadcrumb-item active"><a href="../table/data-periode.php?q=<?= $nama_kota?>&periode=<?=$periode_select;?>"><?= $periode_select; ?></a></li>
            </ol>

            <div class="card w-75">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <span class="h5 my-2"><i class="fa-solid fa-list"></i> Data Polres</span>
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
                        <select class="form-select" style="width: 150px;" onchange="location = this.value;" >
                            <?php
                            echo "<option value='?periode={$periode_select}' selected>{$periode_select}</option>";
                        ?>
                        </select>
                    </div>
                </div>
                <div class="card-body ">
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">
                                    <center>PG</center>
                                </th>
                                <th scope="col">
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
                            $queryLaporan = mysqli_query($koneksi, "SELECT * FROM laporan_polres");
                            while ($data = mysqli_fetch_array($queryLaporan)) {
                                $queryPersentase = mysqli_query($koneksi, "SELECT * FROM persentase_polres WHERE Periode = '{$periode_select}' AND Polres = '{$nama_kota}'");
                                while ($dataPersentase = mysqli_fetch_array($queryPersentase)) {
                                    $class = null;
                                    if((float)$dataPersentase['Persentase'] >= (float) $data["Max"]){
                                        $class = 'bg-success';
                                    }elseif((float)$dataPersentase['Persentase'] > (float) $data["Min"]){
                                        $class = 'bg-warning';
                                    }else{
                                        $class = 'bg-danger';

                                    }
                            ?>
                            <tr>
                                <th scope="row"><?= $no++ ?></th>
                                <td>
                                    <center><?= $data['PG'] ?></center>
                                </td>
                                <td style="padding:0; margin:0">
                                    <center class="<?= $class ?>" style="width:100%; height:100%; margin:0;">
                                        <?= $dataPersentase['Persentase'] . "%" ?></center>
                                </td>
                                <td>
                                    <center><?= $data['Min'] . "%" ?></center>
                                </td>
                                <td>
                                    <center><?= $data['Max'] . "%" ?></center>
                                </td>
                            </tr>


                            <?php }
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