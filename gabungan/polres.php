<?php
session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location: ../auth/login.php");
    exit;
}

require_once "../config/conn.php";
require_once "../user/function/functions.php";

$title = "gabungan - Sistem Evaluasi Polres";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

$queryPeriode = mysqli_query($koneksi, "SELECT DISTINCT Periode FROM laporan_polres");
$PERIODE_ALL = array();
while ($periode = mysqli_fetch_array($queryPeriode)) {
    $PERIODE_ALL[] = $periode["Periode"];
}
$periode_select = 0;
if (count($PERIODE_ALL) > 0) {
    $periode_select = $PERIODE_ALL[count($PERIODE_ALL) - 1];
}
if (isset($_GET['periode'])) {
    $periode_select = $_GET['periode'];
}

$query_jenis = mysqli_query($koneksi, "SELECT COUNT(*) as TOTAL FROM kegiatan_polres");
$jenis = mysqli_fetch_array($query_jenis);
$TOTAL_PG = $jenis['TOTAL'];

$query_jenis = mysqli_query($koneksi, "SELECT * FROM kegiatan_polres");
$PG_ALL = array();
while ($jenis = mysqli_fetch_array($query_jenis)) {
    $PG_ALL[] = $jenis['PG'];
}

// print_r($PG_ALL);
// print_r("<br>");
?>

<div id="layoutSidenav_content">
    <main>
        <div class="px-4">
            <div class="d-flex align-items-end mb-2">
                <div class="col">
                    <h1 class="mt-4">Total</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                        <li class="breadcrumb-item active">Total</li>
                    </ol>
                </div>
                <div class="col-auto me-3">
                    <a href="<?php echo $main_url ?>gabungan/polda.php" class="btn btn-secondary">
                        Data Polda
                        <i class="fa-solid fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
            <div class="card d-flex flex-column">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <span class="h5 my-2"><i class="fa-solid fa-list"></i> Data Polres</span>
                    <div class="d-flex align-items-center">
                        <label class="mx-2 ">Periode</label>
                        <select class="form-select" style="width: 150px;" onchange="location = this.value;">
                            <?php
                            foreach ($PERIODE_ALL as $periode) {
                                $selected = $periode == $periode_select ? "selected" : "";
                                echo "<option value='?periode={$periode}' {$selected}>{$periode}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="card-body table-responsive">
                    <div class="row mt-3">
                        <div class="col-auto">
                            <table class="table table-hover text-nowrap" id="example">
                                <thead class="thead-dark">
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Polres</th>
                                        <th colspan="<?= $TOTAL_PG ?>">Program Giat</th>
                                        <th rowspan="2">Total</th>
                                        <th rowspan="2">Min</th>
                                        <th rowspan="2">Max</th>
                                        <th rowspan="2">Periode</th>
                                    </tr>
                                    <tr>
                                        <?php
                                        foreach ($PG_ALL as $program) {
                                            echo "<th>{$program}</th>";
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    // Mendapatkan semua Polres
                                    $queryPG = mysqli_query($koneksi, "SELECT DISTINCT Polres FROM persentase_polres");
                                    $queryData = mysqli_query($koneksi, "SELECT Min, Max, Periode FROM laporan_polres where Periode = '{$periode_select}'");

                                    $Min = null;
                                    $Max = null;
                                    $Periode = null;

                                    while ($row = mysqli_fetch_array($queryData)) {
                                        // Mengambil nilai Min pertama kali
                                        if ($Min === null) {
                                            $Min = (float) $row["Min"];
                                        }
                                        // Mengambil nilai Max pertama kali
                                        if ($Max === null) {
                                            $Max = (float) $row["Max"];
                                        }
                                        // Mengambil nilai Periode pertama kali
                                        if ($Periode === null) {
                                            $Periode = $row["Periode"];
                                        }
                                    }

                                    // Inisialisasi array untuk menyimpan data polda berdasarkan PG
                                    $dataPolres = array();
                                    while ($row = mysqli_fetch_assoc($queryPG)) {
                                        $dataPolres[$row['Polres']] = array();

                                        foreach ($PG_ALL as $pg) {
                                            $dataPolres[$row['Polres']][$pg] = -1;
                                        }
                                    }

                                    // Mengambil data dari database dan mengisi array $dataPolres
                                    $queryData = mysqli_query($koneksi, "SELECT Polres, PG, Persentase FROM persentase_polres WHERE Periode = '{$periode_select}'");
                                    while ($data = mysqli_fetch_assoc($queryData)) {
                                        $dataPolres[$data['Polres']][$data['PG']] = $data['Persentase'];
                                    }

                                    // Menyusun data Polres berdasarkan PG ke dalam table
                                    foreach ($dataPolres as $polres => $pg) {
                                        $total = 0;
                                        $count = 0;
                                        echo "<tr>";
                                        echo "<td class='dt-type-numeric'></td>";
                                        echo "<td>{$polres}</td>";
                                        foreach ($PG_ALL as $program) { // Sesuaikan dengan PG yang Anda perlukan
                                            if ($pg[$program] != -1) {
                                                $total = $total + (float) $pg[$program];
                                            }
                                            $persen = $pg[$program];
                                            $count++;
                                            if ($pg[$program] == -1) {
                                                echo "<td></td>"; // Jika nilai null, tampilkan sel kosong
                                                $count--;
                                            } elseif ($persen >= $Max) {
                                                echo "<td class='table-success'><center>{$persen}</center></td>"; // Jika persen lebih besar atau sama dengan Max, gunakan bg-successfull
                                            } elseif ($persen > $Min) {
                                                echo "<td class='table-warning'><center>{$persen}</center></td>"; // Jika persen di antara Min dan Max, gunakan bg-warning
                                            } else {
                                                echo "<td class='table-danger'><center>{$persen}</center></td>"; // Jika persen kurang dari atau sama dengan Min, gunakan bg-danger
                                            }
                                        }
                                        if ($count) {
                                            $total = $total / $count;
                                        }
                                        if ($total == -1) {
                                            echo "<td></td>"; // Jika nilai null, tampilkan sel kosong
                                            $count--;
                                        } elseif ($total >= $Max) {
                                            echo "<td class='table-success'><center>{$total}</center></td>"; // Jika total lebih besar atau sama dengan Max, gunakan bg-successfull
                                        } elseif ($total > $Min) {
                                            echo "<td class='table-warning'><center>{$total}</center></td>"; // Jika total di antara Min dan Max, gunakan bg-warning
                                        } else {
                                            echo "<td class='table-danger'><center>{$total}</center></td>"; // Jika total kurang dari atau sama dengan Min, gunakan bg-danger
                                        }
                                        // echo "<td>{$total}</td>"; // Kolom Min
                                        echo "<td><center>{$Min}</center></td>"; // Kolom Min
                                        echo "<td><center>{$Max}</center></td>"; // Kolom Max
                                        echo "<td><center>{$Periode}</center></td>"; // Kolom Priode
                                        echo "</tr>";
                                        $no++;
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function updateURL(select) {
            var selectedPeriode = select.value;
            var currentURL = new URL(window.location.href);
            currentURL.searchParams.set('periode', selectedPeriode);
            window.location.href = currentURL.href;
        }
    </script>

    <?php
    require_once "../template/footer.php";
    ?>