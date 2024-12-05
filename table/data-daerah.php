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
    $queryMinMax = mysqli_query($koneksi, "SELECT Min, Max FROM laporan_".$jenis."");
    while($data = mysqli_fetch_array($queryMinMax)){
        $Min = $data['Min'];
        $Max = $data['Max'];
        break;
    }
    $periode_select = "None";
    if (isset($_GET['p'])) {
        $periode_select = $_GET['p'];
    }

    $TRIWULAN_SELECTED = isset($_GET['triwulan']) ? $_GET['triwulan'] : "None";

    $KATEGORI = "Hijau";
    if(isset($_GET["q"])){
        $KATEGORI = $_GET["q"];
    }
    $kategori_title = ""; 
    if($KATEGORI == "Hijau"){
        $kategori_title = "Lulus" ;

    }elseif($KATEGORI == "Kuning"){
        $kategori_title = "Cukup";
    }else{
        $kategori_title = "Tidak Lulus";
    }


    if($periode_select == "None"){
        $queryPG = mysqli_query($koneksi, "SELECT DISTINCT ".$satuan." FROM persentase_".$jenis." WHERE Triwulan = '$TRIWULAN_SELECTED'");
    }else{
        $queryPG = mysqli_query($koneksi, "SELECT DISTINCT ".$satuan." FROM persentase_".$jenis." WHERE Periode = '$periode_select' ");
    }
    
    $POLRES_ALL =  array();
    $i = 0;
    while($polres = mysqli_fetch_array($queryPG)){
        $POLRES_ALL[$i] = $polres[$satuan];
        $i++;
    }
    $NILAI_POLRES_ALL = array();

    foreach($POLRES_ALL as $satu){
        if($periode_select == "None"){
            $queryNilai = mysqli_query($koneksi, "SELECT * FROM persentase_".$jenis." WHERE ".$satuan." = '$satu' AND Triwulan = '$TRIWULAN_SELECTED'");
            $periodeSQL = mysqli_query($koneksi, "SELECT * FROM persentase_".$jenis." WHERE ".$satuan." = '$satu' AND Triwulan = '$TRIWULAN_SELECTED'");

        }else{
            $queryNilai = mysqli_query($koneksi, "SELECT * FROM persentase_".$jenis." WHERE ".$satuan." = '$satu' AND Periode = '$periode_select'");
            $periodeSQL = mysqli_query($koneksi, "SELECT * FROM persentase_".$jenis." WHERE ".$satuan." = '$satu' AND Periode = '$periode_select'");
        }
        $nilai = 0;
        $jumlah = 0;
       
        $periodeSQL = mysqli_fetch_array($periodeSQL);
        
        while($data = mysqli_fetch_array($queryNilai)){
            
            // var_dump($data["id"]);
            // var_dump($data[$satuan]);
            // var_dump($data["Persentase"]);
            // print_r("<br>");
            if($periode_select == "None"){
                $periode = $data["Periode"];
            }else{
                $periode = $periode_select;

            }
            
            $PG = $data["PG"];
            $queryMinMax = mysqli_query($koneksi, "SELECT Min, Max FROM laporan_".$jenis." WHERE Periode = '$periode' AND PG = '$PG'");
            while($datas = mysqli_fetch_array($queryMinMax)){
                $Min = $datas['Min'];
                $Max = $datas['Max'];
                break;
            }

            // print_r($data);
            // print_r("<br>");
            $nilai = $data['Persentase'];
            if($KATEGORI == "Hijau"){
                if ($nilai >= $Max){
                    $jumlah++;
                }
            }elseif($KATEGORI == "Kuning"){
                if ($nilai < $Max && $nilai > $Min){
                    $jumlah++;
                }
            }else{
                if ($nilai <= $Min){
                    $jumlah++;
                }
            }
        }
        $NILAI_POLRES_ALL[] = $jumlah;

    }
    // var_dump($NILAI_POLRES_ALL);

    // var_dump($NILAI_POLRES_ALL);
    if($periode_select != "None"){
        $headerTable = "".$title_jenis." - Kategori ".$kategori_title." - Periode : ".$periode_select."";
    }else{
        $headerTable = "".$title_jenis." - Kategori ".$kategori_title." - Triwulan : ".$TRIWULAN_SELECTED."";
    }
        
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data <?=$title_jenis?></h1>
            <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a style="text-decoration: none;" href="../index.php">Home</a></li>
                <li class="breadcrumb-item active"><a style="text-decoration: none;" href="../index.php"><?=$title_jenis?> </a></li>
                <li class="breadcrumb-item active"><a style="text-decoration: none;" href="../table/danger.php?j=<?=$jenis?>"><?= $kategori_title?> </a></li>
                <?php if($periode_select != "None"){?>
                    <li class="breadcrumb-item active"><a style="text-decoration: none;" href="../table/danger.php?j=<?=$jenis?>"><?= $periode_select?> </a></li>
                <?php } ?>
                
            </ol>
          
                <div class="card w-75">
                    <div class="card-header">
                        <span class="h5 my-2"><i class="fa-solid fa-list"></i> Kategori <?=$kategori_title?></span>

                    </div>
                    <div class="card-body ">
                        <table class="display" id="exampleNoSetting">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">
                                        <center>Polres</center>
                                    </th>
                                    <th scope="col">
                                        <center>Total</center>
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
                                    <th scope="row"><?=$no++;?></th>
                                    <td align="center"><?= $polres;?></td>
                                    <td><center><?= $NILAI_POLRES_ALL[$i]?></center</td>
                                    <td align="center">
                                        <!-- Kalau tidak ada periode maka kembali ke data-daerah dengan periode -->
                                    <a href="<?= $main_url?>table/data-<?= $periode_select == "None" ? "triwulan" : "periode" ?>-daerah.php?j=<?=$jenis?>&q=<?=$KATEGORI?>&p=<?=$polres?>&<?= $periode_select == "None" ? "triwulan=".$TRIWULAN_SELECTED : "periode=".$periode_select?>" class="btn btn-sm btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Show</a>
                                    
                                        
                                    </td>
                                </tr>

                                <?php $i++;} ?>
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="dt-type-numeric">TOTAL</th>
                                    <td align="center"></td>
                                    <td ><center><?= $TOTAL_PG?></center</td>
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