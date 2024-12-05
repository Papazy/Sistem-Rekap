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


    $Min = 0;
    $Max = 0;
    
    
    $queryPG = mysqli_query($koneksi, "SELECT DISTINCT ".$satuan." FROM persentase_".$jenis."");
    $POLRES_ALL =  array();
    $i = 0;
    while($polres = mysqli_fetch_array($queryPG)){
        $POLRES_ALL[$i] = $polres[$satuan];
        $i++;
    }
    $NILAI_POLRES_ALL = array();
    
    foreach($POLRES_ALL as $satu){
        $queryNilai = mysqli_query($koneksi, "SELECT * FROM persentase_".$jenis." WHERE ".$satuan." = '$satu'");
        $periodeSQL = mysqli_query($koneksi, "SELECT * FROM persentase_".$jenis." WHERE ".$satuan." = '$satu'");
        $nilai = 0;
        $jumlah = 0;
       
        $periodeSQL = mysqli_fetch_array($periodeSQL);
        $periode = $periodeSQL['Periode'];

        $queryMinMax = mysqli_query($koneksi, "SELECT Min, Max FROM laporan_".$jenis." WHERE Periode = '$periode'");
        while($data = mysqli_fetch_array($queryMinMax)){
            $Min = $data['Min'];
            $Max = $data['Max'];
            break;
        }
    
        while($data = mysqli_fetch_array($queryNilai)){
            $nilai = $data['Persentase'];
            if ($nilai >=  $Max){
                $jumlah++;
            }
        }
        $NILAI_POLRES_ALL[] = $jumlah;

    }

    // var_dump($NILAI_POLRES_ALL);
        
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data <?=$title_jenis?></h1>
            <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a style="text-decoration: none;" href="../index.php">Home</a></li>
                <li class="breadcrumb-item active"><a style="text-decoration: none;" href="../index.php"><?=$title_jenis?> </a></li>
                <li class="breadcrumb-item active"><a style="text-decoration: none;" href="../table/success.php?j=<?=$jenis?>">Lulus </a></li>
                
            </ol>
          
                <div class="card w-75">
                    <div class="card-header">
                        <span class="h5 my-2"><i class="fa-solid fa-list"></i> Kategori Lulus</span>

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
                                    <th scope="col"><center>No.</center></th>
                                    <th scope="col">
                                        <center>Polres</center>
                                    </th>
                                    <th scope="col">
                                        <center>Total Persentase</center>
                                    </th>
                                    <th scope="col">
                                        
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $i = 0;
                                    $no = 1;
                                    $TOTAL_PG = 0;
                                    foreach($POLRES_ALL as $polres){
                                    
                                        if ($NILAI_POLRES_ALL[$i] == 0){
                                            $i++;
                                            continue;
                                        }    
                                        $TOTAL_PG += $NILAI_POLRES_ALL[$i];
                                ?>

                                <tr>
                                    <th scope="row"></th>
                                    <td align="center"><?= $polres;?></td>
                                    <td align="center"><center><?= $NILAI_POLRES_ALL[$i]?></center></td>
                                    <td align="center">
                                    <a href="<?= $main_url?>table/data-jenis.php?j=<?=$jenis?>&q=success&p=<?=$polres?>" class="btn btn-sm btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Show</a>
                                        
                                    </td>
                                </tr>

                                <?php $i++;} ?>
                               
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="row">TOTAL</th>
                                    <td align="center"></td>
                                    <td align="center"><center><?= $TOTAL_PG?></center></td>
                                    <td align="center"></td>
                                </tr>
                                </tfoot>

                        </table>
                    </div>
          
        </div>
</div>
</main>




<?php 

    require_once "../template/footer.php";

?>