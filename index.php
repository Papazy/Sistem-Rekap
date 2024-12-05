<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location: auth/login.php");
    exit;
}

require_once "config/conn.php";
require_once "user/function/functions.php";
require_once "utils.php";
require_once "utils2.php";

$title = "Dashboard - Sistem Evaluasi Polres";
require_once "template/header.php";
require_once "template/navbar.php";
require_once "template/sidebar.php";

$TRIWULAN_SELECTED = "None";
if (isset($_GET['triwulan'])) {
    $TRIWULAN_SELECTED = $_GET['triwulan'];
}

$DAERAH = "Polres";
if (isset($_GET['d'])) {
    $DAERAH = $_GET['d'];
}
$jenis = $DAERAH == "Polda" ? "polda" : "polres";
$satker = $DAERAH == "Polda" ? "Satker" : "Polres";


$queryLaporan = mysqli_query($koneksi, "SELECT * FROM laporan_" . $jenis . "");
$totalLaporan = mysqli_num_rows($queryLaporan);

$queryPeriode = mysqli_query($koneksi, "SELECT DISTINCT Periode FROM laporan_" . $jenis . " WHERE Triwulan='{$TRIWULAN_SELECTED}' ");

$PERIODE_ALL = array();
while ($periode = mysqli_fetch_array($queryPeriode)) {
    $PERIODE_ALL[] = $periode["Periode"];
}

$periode_select = "None";
if (count($PERIODE_ALL) > 0) {
    if (isset($_GET["periode"])) {
        $periode_select = $_GET["periode"];
    } else {
        $periode_select = "None";
    }
}

if ($periode_select == "None") {

    $queryPG = mysqli_query($koneksi, "SELECT DISTINCT " . $satker . " FROM persentase_" . $jenis . " WHERE Triwulan ='{$TRIWULAN_SELECTED}'");
} else {
    $queryPG = mysqli_query($koneksi, "SELECT DISTINCT " . $satker . " FROM persentase_" . $jenis . " WHERE Periode = '{$periode_select}'");
}
$POLRES_ALL = array();
$i = 0;
while ($polres = mysqli_fetch_array($queryPG)) {
    $POLRES_ALL[$i] = $polres[$satker];
    $i++;
}
$NILAI_POLRES_ALL = array();


foreach ($POLRES_ALL as $satuan) {
    if ($periode_select == "None") {
        $queryNilai = mysqli_query($koneksi, "SELECT * FROM persentase_" . $jenis . " WHERE " . $satker . " = '$satuan' AND Triwulan ='{$TRIWULAN_SELECTED}'");
    } else {
        $queryNilai = mysqli_query($koneksi, "SELECT * FROM persentase_" . $jenis . " WHERE " . $satker . " = '$satuan' AND Periode = '{$periode_select}'");
    }
    $nilai = 0;
    $jumlah = 0;
    while ($data = mysqli_fetch_array($queryNilai)) {
        $nilai += (float) $data['Persentase'];
        $jumlah++;
    }
    if ($jumlah != 0) {
        $NILAI_POLRES_ALL[] = $nilai / $jumlah;
    }

}

$Min = 0;
$Max = 0;
if ($periode_select == "None") {
    $queryMinMax = mysqli_query($koneksi, "SELECT Min, Max FROM laporan_" . $jenis . " WHERE Triwulan ='{$TRIWULAN_SELECTED}'");
} else {
    $queryMinMax = mysqli_query($koneksi, "SELECT Min, Max FROM laporan_" . $jenis . " WHERE Periode = '{$periode_select}'");
}
while ($data = mysqli_fetch_array($queryMinMax)) {
    $Min = $data['Min'];
    $Max = $data['Max'];
    break;
}

// var_dump($Min);
// print_r("<br>");
// var_dump($Max);
// print_r("<br>");
// var_dump($NILAI_POLRES_ALL);
// print_r("<br>");

$backgroundColorArray = array();
foreach ($NILAI_POLRES_ALL as $nilai) {
    if ($nilai >= $Max) {
        $backgroundColorArray[] = 'rgba(0, 255, 0, 0.5)'; // Hijau
    } elseif ($nilai > $Min) {
        $backgroundColorArray[] = 'rgba(255, 255, 0, 0.5)'; // Kuning
    } else {
        $backgroundColorArray[] = 'rgba(255, 0, 0, 0.5)'; // Merah
    }
}

// var_dump($backgroundColorArray);


// Menghitung NIlai Kartu
// POLRES
$polres_merah = 0;
$polres_kuning = 0;
$polres_hijau = 0;

$polda_merah = 0;
$polda_kuning = 0;
$polda_hijau = 0;

if ($periode_select != "None") {
    $polres_merah = hitungPersentaseDariPeriode("Polres", $periode_select, "Merah");
    $polres_kuning = hitungPersentaseDariPeriode("Polres", $periode_select, "Kuning");
    $polres_hijau = hitungPersentaseDariPeriode("Polres", $periode_select, "Hijau");
    // POLDA

    $polda_merah = hitungPersentaseDariPeriode("Polda", $periode_select, "Merah");
    $polda_kuning = hitungPersentaseDariPeriode("Polda", $periode_select, "Kuning");
    $polda_hijau = hitungPersentaseDariPeriode("Polda", $periode_select, "Hijau");


} else {
    $polres_merah = hitungPersentaseDariTriwulan("Polres", $TRIWULAN_SELECTED, "Merah");
    $polres_kuning = hitungPersentaseDariTriwulan("Polres", $TRIWULAN_SELECTED, "Kuning");
    $polres_hijau = hitungPersentaseDariTriwulan("Polres", $TRIWULAN_SELECTED, "Hijau");
    // POLDA

    $polda_merah = hitungPersentaseDariTriwulan("Polda", $TRIWULAN_SELECTED, "Merah");
    $polda_kuning = hitungPersentaseDariTriwulan("Polda", $TRIWULAN_SELECTED, "Kuning");
    $polda_hijau = hitungPersentaseDariTriwulan("Polda", $TRIWULAN_SELECTED, "Hijau");
}

// print_r("<br>");
// var_dump($polres_merah);
// print_r("<br>");
// var_dump($polda_merah);

if ($polres_hijau == 0 && $polres_kuning == 0 && $polres_merah == 0) {
    $persentase = 0;
} else {
    $persentase = $polres_hijau / ($polres_hijau + $polres_kuning + $polres_merah) * 100;
}

if ($polda_hijau == 0 && $polda_kuning == 0 && $polda_merah == 0) {
    $persentase_polda = 0;
} else {
    $persentase_polda = $polda_hijau / ($polda_hijau + $polda_kuning + $polda_merah) * 100;
}
?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 ">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-3">
                <li class="breadcrumb-item active">&nbsp;Home</li>
            </ol>

            <div class="row">
                <div class="" style="width: 20%; flex:0 0 auto;">
                    <h5 class="mb-3">
                        <center>Tercapai <i class="fa-regular fa-face-smile" style="color: green;"></i></center>
                    </h5>
                    <div class="card bg-success text-white mb-4">
                        <a href="<?= $main_url ?>table/data-daerah.php?j=polda<?php if ($periode_select != 'None') {
                              echo '&p=' . $periode_select;
                          } else {
                              echo '&triwulan=' . $TRIWULAN_SELECTED;
                          } ?>&q=Hijau" style="text-decoration:none; color:white;">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h4>Polda</h4>
                                </div>
                                <div>
                                    <?= $polda_hijau ?>
                                </div>
                            </div>
                        </a>
                        <a href="<?= $main_url ?>table/data-daerah.php?j=polres<?php if ($periode_select != 'None') {
                              echo '&p=' . $periode_select;
                          } else {
                              echo '&triwulan=' . $TRIWULAN_SELECTED;
                          } ?>&q=Hijau" style="text-decoration:none; color:white;">
                            <div class="card-body border-top border-dark d-flex align-items-center justify-content-between"
                                style="--bs-border-opacity: .5;">
                                <div>
                                    <h6>Polres</h6>
                                </div>
                                <div>
                                    <?= $polres_hijau ?>
                                </div>

                            </div>
                        </a>
                    </div>
                </div>
                <div class="" style="width: 20%; flex:0 0 auto; ">
                    <h5 class="mb-3">
                        <center>Cukup <i class="fa-regular fa-face-meh" style="color: #C7BA28;"></i></center>
                    </h5>
                    <a href="<?= $main_url ?>table/data-daerah.php?j=Polda<?php if ($periode_select != 'None') {
                          echo '&p=' . $periode_select;
                      } else {
                          echo '&triwulan=' . $TRIWULAN_SELECTED;
                      } ?>&q=Kuning" style="text-decoration:none; color:white;">
                        <div class="card bg-warning text-white mb-4">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h4>Polda</h4>
                                </div>
                                <div>
                                    <?= $polda_kuning ?>
                                </div>
                            </div>
                    </a>
                    <a href="<?= $main_url ?>table/data-daerah.php?j=polres<?php if ($periode_select != 'None') {
                          echo '&p=' . $periode_select;
                      } else {
                          echo '&triwulan=' . $TRIWULAN_SELECTED;
                      } ?>&q=Kuning" style="text-decoration:none; color:white;">
                        <div class="card-body border-top border-dark d-flex align-items-center justify-content-between"
                            style="--bs-border-opacity: .5;">
                            <div>
                                <h6>Polres</h6>
                            </div>
                            <div>
                                <?= $polres_kuning ?>
                            </div>

                        </div>
                </div>
                </a>
            </div>
            <div class="" style="width: 20%; flex:0 0 auto;">
                <h5 class="mb-3">
                    <center>Tidak <i class="fa-regular fa-face-frown" style="color: red;"></i></center>
                </h5>
                <a href="<?= $main_url ?>table/data-daerah.php?j=polda<?php if ($periode_select != 'None') {
                      echo '&p=' . $periode_select;
                  } else {
                      echo '&triwulan=' . $TRIWULAN_SELECTED;
                  } ?>&q=Merah" style="text-decoration:none; color:white;">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h4>Polda</h4>
                            </div>
                            <div>
                                <?= $polda_merah ?>
                            </div>
                        </div>
                </a>
                <a href="<?= $main_url ?>table/data-daerah.php?j=polres<?php if ($periode_select != 'None') {
                      echo '&p=' . $periode_select;
                  } else {
                      echo '&triwulan=' . $TRIWULAN_SELECTED;
                  } ?>&q=Merah" style="text-decoration:none; color:white;">
                    <div class="card-body border-top border-dark d-flex align-items-center justify-content-between"
                        style="--bs-border-opacity: .5;">
                        <div>
                            <h6>Polres</h6>
                        </div>
                        <div>
                            <?= $polres_merah ?>
                        </div>

                    </div>
            </div>
            </a>
        </div>
        <div class="" style="width: 20%; flex:0 0 auto;">
            <h5 class="mb-3">
                <center>Persentase <i class="fa-solid fa-percent" style="color: blue;"></i></center>
            </h5>
            <a href="<?= $main_url ?>gabungan/polres.php" style="text-decoration:none; color:white;">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h4>Polda</h4>
                        </div>
                        <div>
                            <?= number_format($persentase_polda, 2) ?>%
                        </div>
                    </div>
                    <div class="card-body border-top border-dark d-flex align-items-center justify-content-between"
                        style="--bs-border-opacity: .5;">
                        <div>
                            <h6>Polres</h6>
                        </div>
                        <div>
                            <?= number_format($persentase, 2) ?>%
                        </div>

                    </div>
                </div>
            </a>
        </div>
        <div class="" style="width: 20%; flex:0 0 auto;">
            <h5 class="mb-3">
                <center>Jumlah <i class="fa-solid fa-hotel" style="color: gray;"></i></center>
            </h5>
            <div class="card bg-secondary text-white mb-4">
                <a href="<?= $main_url ?>laporan/polda.php" style="text-decoration:none; color:white;">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h4>Polda</h4>
                        </div>
                        <div>
                            <?= $polda_hijau + $polda_kuning + $polda_merah ?>
                        </div>
                    </div>
                <a href="<?= $main_url ?>laporan/polres.php" style="text-decoration:none; color:white;">
                    <div class="card-body border-top border-dark d-flex align-items-center justify-content-between" style="--bs-border-opacity: .5;">
                    <div>
                        <h6>Polres</h6>
                        </div>
                        <div>
                            <?= $polres_hijau + $polres_kuning + $polres_merah ?>
                        </div>

                    </div>
                </div>
            </a>
        </div>

</div>
<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between">
                <div class="d-inline-flex align-items-center">
                    <i class="fas fa-chart-bar me-1"></i>
                    Capaian
                    <select class="form-select ms-2" name="daerah" id="daerah" onchange="updateDaerah(this.value)">
                        <option value="Polda" <?php if ($DAERAH == "Polda") echo 'selected'; ?>>Polda</option>
                        <option value="Polres" <?php if ($DAERAH == "Polres") echo 'selected'; ?>>Polres</option>
                    </select>

                    </div>
                        <div class="d-inline-flex align-items-center gap-2">

                            <select class="form-select" name="triwulan" id="triwulan" onchange="updateTriwulan(this.value)">
                            <option value="" selected>- Triwulan -</option>
                                <?php
                                // Mengambil data triwulan sesuai dengan pilihan daerah (Polda atau Polres)
                                if ($DAERAH == "Polda") {
                                    $queryTriwulan = mysqli_query($koneksi, "SELECT DISTINCT Triwulan FROM persentase_polda");
                                } else if ($DAERAH == "Polres") {
                                    $queryTriwulan = mysqli_query($koneksi, "SELECT DISTINCT Triwulan FROM persentase_polres");
                                }
                                
                                // Menampilkan opsi Triwulan sesuai dengan data yang diambil
                                while ($triwulan = mysqli_fetch_assoc($queryTriwulan)) {
                                    $selected = ($triwulan['Triwulan'] == $TRIWULAN_SELECTED) ? 'selected' : '';
                                    echo "<option value='{$triwulan['Triwulan']}&d={$DAERAH}' $selected>Triwulan {$triwulan['Triwulan']}</option>";
                                }
                                ?>
                            </select>

                            <select class="form-select" style="width: 150px;" onchange="updatePeriode(this.value)">
                            <option value="" selected>- Periode -</option>
                                <?php
                                // Mengambil periode sesuai dengan pilihan daerah (Polda atau Polres) dan Triwulan yang dipilih
                                if ($DAERAH == "Polda") {
                                    $queryPeriode = mysqli_query($koneksi, "SELECT DISTINCT Periode FROM persentase_polda WHERE Triwulan = '$TRIWULAN_SELECTED'");
                                } else if ($DAERAH == "Polres") {
                                    $queryPeriode = mysqli_query($koneksi, "SELECT DISTINCT Periode FROM persentase_polres WHERE Triwulan = '$TRIWULAN_SELECTED'");
                                }

                                // Menampilkan opsi Periode sesuai dengan data yang diambil
                                while ($periode = mysqli_fetch_assoc($queryPeriode)) {
                                    $selected = ($periode['Periode'] == $periode_select) ? 'selected' : '';
                                    echo "<option value='{$periode['Periode']}&triwulan={$TRIWULAN_SELECTED}&d={$DAERAH}' $selected>" . date("d-m-Y", strtotime($periode['Periode'])) . "</option>";
                                }
                                ?>
                            </select>
                            
                    <div class="d-inline-flex align-items-center gap-1 border border-dark rounded px-1 py-1"
                        style="--bs-border-opacity: .25; background-color:white">
                        <div id="itable" style=" padding:2px 5px; border-radius:5px; cursor:pointer;">
                            <i class="fa-solid fa-table"></i>
                        </div>
                        <div id="ichart"
                            style=" padding:2px 5px; border-radius:5px; cursor:pointer; background-color:rgba(0,0,0,0.15)">
                            <i class="fa-solid fa-chart-simple"></i>
                        </div>

                    </div>
                </div>
            </div>

            <body>
                <style type="text/css">
                    table {
                        margin: 0px auto;
                    }
                </style>

                <div style="width: 100%; margin: 0px auto; overflow: auto;">
                    <?php if (count($NILAI_POLRES_ALL)) { ?>
                        <canvas id="myChart"></canvas>
                        <div class="table-chart" style="display:none">
                            <?php require_once "table/components/table-simple.php"; ?>
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-success text-center" role="alert">
                           -- Silakan Pilih Triwulan --
                        </div>
                    <?php } ?>

                </div>

                <br />
                <br />
                <script>
                    // Ambil referensi ke elemen-elemen ikon
                    const tableIcon = document.getElementById('itable');
                    const chartIcon = document.getElementById('ichart');

                    // Tambahkan event listener untuk itable
                    tableIcon.addEventListener('click', function () {
                        // Tambahkan background-color pada itable
                        tableIcon.style.backgroundColor = 'rgba(0, 0, 0, 0.15)';
                        // Hapus background-color dari ichard
                        chartIcon.style.backgroundColor = 'transparent';
                        console.log("ditekan")
                    });

                    // Tambahkan event listener untuk ichard
                    chartIcon.addEventListener('click', function () {
                        // Tambahkan background-color pada ichard
                        chartIcon.style.backgroundColor = 'rgba(0, 0, 0, 0.15)';
                        // Hapus background-color dari itable
                        tableIcon.style.backgroundColor = 'transparent';
                        console.log("ditekan")
                    });



                    var ctx = document.getElementById('myChart');
                    Chart.register(ChartDataLabels);
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: <?php echo json_encode($POLRES_ALL); ?>,
                            datasets: [{
                                label: 'Nilai',
                                data: <?php echo json_encode($NILAI_POLRES_ALL); ?>,
                                backgroundColor: <?php echo json_encode($backgroundColorArray); ?>,
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {

                            scales: {
                                x: [{
                                    ticks: {
                                        autoSkip: false,
                                        maxRotation: 90,
                                        minRotation: 90
                                    }
                                }],
                                y: {
                                    beginAtZero: true,
                                    min: 0,
                                    max: 100
                                }
                            },
                            layout: {
                                padding: 35
                            },
                            onClick: (event, elements) => {
                                console.log(myChart.data.labels[elements[0].index]);
                                var namaKota = myChart.data.labels[elements[0].index];
                                <?php if ($periode_select == "None") { ?>

                                    window.location = "<?php echo $main_url; ?>table/data-triwulan-daerah.php?p=" +
                                        namaKota +
                                        "&triwulan=<?= $TRIWULAN_SELECTED ?>&j=<?= $DAERAH; ?>";
                                <?php } else { ?>
                                    window.location = "<?php echo $main_url; ?>table/data-periode.php?q=" +
                                        namaKota +
                                        "&periode=<?= $periode_select ?>&triwulan=<?= $TRIWULAN_SELECTED ?>&d=<?= $DAERAH; ?>";
                                <?php } ?>
                            },
                            plugins: {
                                legend: {
                                    position: 'bottom'
                                },
                                title: {
                                    display: true,
                                    text: 'Grafik <?= $DAERAH ?> - Triwulan <?= $TRIWULAN_SELECTED ?> <?= $periode_select == "None" ? "" : " - Periode " . date("d M Y", strtotime($periode_select)); ?>',
                                    font: {
                                        size: 24
                                    },
                                    padding: 20
                                },
                                datalabels: {
                                    anchor: 'end',
                                    align: 'end',
                                    color: 'blue',
                                    font: {
                                        weight: 'bold'
                                    },
                                    formatter: function (value, context) {
                                        if (typeof value === 'number' && !isNaN(value) && Number.isFinite(
                                            value) && Number(value) === value) {
                                            return value.toFixed(2) + '%';
                                        } else {
                                            return value + '%';
                                        }
                                    }
                                }
                            }
                        }
                    });

                    tableIcon.addEventListener('click', tampilTable);
                    chartIcon.addEventListener('click', tampilChart);

                    function tampilChart() {
                        var table = document.querySelector('.table-chart');
                        table.style.display = 'none';
                        var chart = document.getElementById('myChart');
                        chart.style.display = 'block';
                    }

                    function tampilTable() {
                        var table = document.querySelector('.table-chart');
                        table.style.display = 'block';
                        var chart = document.getElementById('myChart');
                        chart.style.display = 'none';
                    }

                    function updateTriwulan(triwulan) {
                        window.location = "<?php echo $main_url; ?>index.php?triwulan=" + triwulan;
                    }


                    function updateDaerah(daerah) {
                        window.location = "<?php echo $main_url; ?>index.php?d=" + daerah;
                    }

                    function updatePeriode(periode) {
                        window.location = "<?php echo $main_url; ?>index.php?periode=" + periode;
                    }


                    $('#print-chart-btn').on('click', function () {
                        window.jsPDF = window.jspdf.jsPDF;
                        var canvas = document.querySelector("#myChart");
                        var canvas_img = canvas.toDataURL("image/png", 1.0); //JPEG will not match background color
                        var pdf = new jsPDF('landscape', 'in', 'letter'); //orientation, units, page size
                        pdf.addImage(canvas_img, 'png', .5, 1.75, 10, 5); //image, type, padding left, padding top, width, height
                        pdf.autoPrint(); //print window automatically opened with pdf
                        var blob = pdf.output("bloburl");
                        window.open(blob);
                    });
                </script>
            </body>
            <div class="card-body"><canvas id="myBarChart" height="85"></canvas></div>
        </div>
    </div>
</div>
</div>
</main>

<?php

require_once "template/footer.php";

?>