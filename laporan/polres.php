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
$headerTable = "- Polisi Resort Aceh -"
?>

<div id="layoutSidenav_content">
    <main>
        <!-- Modal Edit-->
        <form method="POST" action="edit_polres.php">
            <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modalEdit">
            </div>
        </form>

        <!-- Modal Delete -->
        <form method="POST" action="hapus_polres.php">
            <div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
            </div>
        </form>

        <div class="container-fluid px-4">
            <h1 class="mt-4">Polres</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active">Polres</li>
            </ol>
            <div class="card">
                <div class="card-header">
                    <span class="h5 my-2"><i class="fa-solid fa-list"></i> Data Polres</span>
                    <?php if(userLogin()['role'] == 1) { ?>
                        <a href="<?= $main_url ?>tambah-data/polres/add-polres.php"
                            class="btn btn-sm btn-primary float-end"><i class="fa-solid fa-plus"></i> Tambah</a>
                    <?php } ?>
                </div>
                <div class="card-body">
                    
                    <table class="display" id="exampleNoSetting">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">
                                    <center>Polres</center>
                                </th>
                                <th scope="col">
                                    <center>Periode</center>
                                </th>
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
                                <th scope="col">
                                    <center>Tw</center>
                                </th>
                                <?php if(userLogin()['role'] == 1) { ?>
                                    <th scope="col">
                                        <center>Setting</center>
                                    </th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <style>
                            .size {
                                width: 170px;
                            }      
                        </style>
                        <tbody>
                            <?php
                            

                            $no = 1;
                            $uniqueData = []; // Array untuk menyimpan data yang sudah ditampilkan
                          
                                $queryPersentase = mysqli_query($koneksi, "SELECT DISTINCT * FROM persentase_polres");
                                while ($dataPersentase = mysqli_fetch_array($queryPersentase)) {
                                    // Memeriksa apakah data sudah ditampilkan sebelumnya
                                    $key = $dataPersentase['Polres'] . $dataPersentase['PG'] . $dataPersentase['Periode'];
                                    if (in_array($key, $uniqueData)) {
                                        continue; // Skip jika data sudah ditampilkan sebelumnya
                                    }

                                // Menyimpan key dari data yang akan ditampilkan
                                $uniqueData[] = $key;

                                    $Polres      = $dataPersentase["Polres"];
                                    $PG          = $dataPersentase["PG"];
                                    $Periode     = $dataPersentase["Periode"];
                                    $queryMaxMin = mysqli_query($koneksi, "SELECT Max, Min FROM laporan_polres WHERE PG = '{$PG}' AND Periode = '{$Periode}'");
                                    $dataMinMax  = mysqli_fetch_array($queryMaxMin);
                                    $dataMin     = $dataMinMax["Min"];
                                    $dataMax     = $dataMinMax["Max"];

                                    $class = null;
                                    if((float)$dataPersentase['Persentase'] >= (float) $dataMax){
                                        $class = 'bg-success';
                                    }elseif((float)$dataPersentase['Persentase'] > (float) $dataMin){
                                        $class = 'bg-warning';
                                    }else{
                                        $class = 'bg-danger';

                                    }
                            ?>
                            <tr>
                                <td class="dt-type-numeric"></td>
                                <td><?= $dataPersentase['Polres'] ?></td>
                                <td>
                                    <center><?= date('d-m-Y', strtotime($dataPersentase['Periode'])) ?></center>
                                </td>
                                <td>
                                    <center><?= $dataPersentase['PG'] ?></center>
                                </td>
                                <td class="<?= $class ?>">
                                    <center>
                                        <?= $dataPersentase['Persentase'] . "%" ?></center>
                                </td>
                                <td>
                                    <center><?= $dataMin . "%" ?></center>
                                </td>
                                <td>
                                    <center><?= $dataMax . "%" ?></center>
                                </td>
                                <td>
                                    <center><?= $dataPersentase['Triwulan'] ?></center>
                                </td>
                                <?php if(userLogin()['role'] == 1) { ?>
                                    <td class="size">
                                        <button type="button" class="btn btn-sm btn-warning editButton" id="editButton"
                                            data-id="<?=$dataPersentase['id'] ?>"><i class="fa-solid fa-pen"
                                                title="Edit"></i>
                                            Edit</button>

                                        <button type="button" class="btn btn-sm btn-danger deleteButton"
                                            data-bs-toggle="modal" data-bs-target="#modalHapus<?=$dataPersentase['id'];?>"
                                            data-id="<?=$dataPersentase['id'] ?>"><i class="fa-solid fa-trash"
                                                title="Delete"></i>
                                            Delete</button>

                                    </td>
                                <?php } ?>
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
    <script>


        $('.editButton').click(function() {

            var id = $(this).data('id');
            // console.log(userid);
            // AJAX request
            $.ajax({
                url: 'modal_edit_polres.php',
                type: 'post',
                data: {
                    id: id
                },
                success: function(response) {
                    // Add response in Modal body
                    $('#modalEdit').html(response);

                    // Display Modal
                    $('#modalEdit').modal('show');
                }
            });
        });
        $('.deleteButton').click(function() {

            var id = $(this).data('id');
            $.ajax({
                url: 'modal_hapus_polres.php',
                type: 'post',
                data: {
                    id: id
                },
                success: function(response) {
                    // Add response in Modal body
                    $('#modalHapus').html(response);

                    // Display Modal
                    $('#modalHapus').modal('show');
                }
            });
        });

    </script>


    <?php

    require_once "../template/footer.php";

    ?>

