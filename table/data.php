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
    $TRIWULAN_SELECTED = isset($_GET['triwulan']) ? $_GET['triwulan'] : 1;
    
    $PERIODE = array();
    $PERSENTASE = array();

    $query = mysqli_query($koneksi, "SELECT DISTINCT Periode FROM persentase_polres WHERE Polres = '$nama_kota'");
    while($data = mysqli_fetch_array($query)){
        // var_dump($data["Periode"]);
        $PERIODE[] = $data["Periode"];
    }

    foreach ($PERIODE as $period){
        $total = 0;
        $count = 0;
        $query = mysqli_query($koneksi, "SELECT Persentase FROM persentase_polres WHERE Polres = '$nama_kota' AND Periode = '$period' AND Triwulan = '$TRIWULAN_SELECTED'");
        while($data = mysqli_fetch_array($query)){
            // var_dump($data["Persentase"]);
            // var_dump($data["Persentase"]);
            $total = $total + (float)$data["Persentase"];
            $count++;
        }
        if ($count == 0){
            $count = 1;
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
                <li class="breadcrumb-item"><a href="../index.php">Triwulan <?=$TRIWULAN_SELECTED?></a></li>
                <li class="breadcrumb-item active"><a href="../table/data.php?q=<?= $nama_kota?>"><?= $nama_kota; ?></a>
                </li>
            </ol>

            <div class="card w-75">
                <div class="card-header">
                    <span class="h5 my-2"><i class="fa-solid fa-list"></i> Data Polres <?= $nama_kota; ?></span>

                </div>
                <div class="card-body ">
                    <style>
                    /* Style untuk table */
                    #datatablesSimple {
                        width: 100%;
                        border-collapse: collapse;
                    }

                    #datatablesSimple th,
                    #datatablesSimple td {
                        padding: 8px;
                        text-align: center;
                    }

                    /* Style untuk baris ganjil */
                    #datatablesSimple tbody tr:nth-child(odd) {
                        background-color: #f2f2f2;
                    }

                    /* Style untuk tombol */
                    .btn {
                        padding: 6px 12px;
                        font-size: 14px;
                    }
                    </style>
                    <table class="display" id="exampleNoSetting">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">
                                    <center>Periode</center>
                                </th>
                                <th scope="col">
                                    <center>Total Persentase</center>
                                </th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                            $i = 0;
                            $no = 1;
                            
                            foreach($PERIODE as $period){
                                // print_r('$PERSENTASE[$i]');
                                // print_r($PERSENTASE[$i]);
                                if($PERSENTASE[$i] == 0){
                                    $i++;
                                    continue;
                                }
                             ?>

                            <tr>
                                <td class="dt-type-numeric"></td>
                                <td ><center><?= $period ?></center></td>
                                <td ><center><?= $PERSENTASE[$i] ?></center></td>
                                <td >
                                    <a href="<?= $main_url ?>table/data-periode.php?q=<?= $nama_kota ?>&periode=<?= $period?>&triwulan=<?= $TRIWULAN_SELECTED?>"
                                        class="btn btn-sm btn-primary"><i class="fa-solid fa-magnifying-glass"></i>
                                        Show</a>

                                </td>
                            </tr>

                            <?php $i++; $no++; } ?>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </main>




    <?php 

    require_once "../template/footer.php";

?>