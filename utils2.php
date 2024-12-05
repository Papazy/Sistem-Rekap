<?php
require_once ("config/conn.php");
function get_data_kartu_dashboard($jenis, $class)
{
    global $koneksi;
    $title_jenis = $jenis == "polres" ? "Polres" : "Polda";
    $satuan = $jenis == "polres" ? "Polres" : "Satker";


    $Min = 0;
    $Max = 0;

    $queryPG = mysqli_query($koneksi, "SELECT DISTINCT " . $satuan . " FROM persentase_" . $jenis . "");
    $POLRES_ALL = array();
    $i = 0;
    while ($polres = mysqli_fetch_array($queryPG)) {
        $POLRES_ALL[$i] = $polres[$satuan];
        $i++;
    }
    $NILAI_TOTAL = 0;

    foreach ($POLRES_ALL as $satu) {
        $queryNilai = mysqli_query($koneksi, "SELECT * FROM persentase_" . $jenis . " WHERE " . $satuan . " = '$satu'");
        $periodeSQL = mysqli_query($koneksi, "SELECT * FROM persentase_" . $jenis . " WHERE " . $satuan . " = '$satu'");
        $nilai = 0;
        $jumlah = 0;

        $periodeSQL = mysqli_fetch_array($periodeSQL);
        $periode = $periodeSQL['Periode'];

        $queryMinMax = mysqli_query($koneksi, "SELECT Min, Max FROM laporan_" . $jenis . " WHERE Periode = '$periode'");
        while ($data = mysqli_fetch_array($queryMinMax)) {
            $Min = $data['Min'];
            $Max = $data['Max'];
            break;
        }

        while ($data = mysqli_fetch_array($queryNilai)) {
            $nilai = $data['Persentase'];
            if ($class == "merah") {
                if ($nilai <= $Min) {
                    $jumlah++;
                }
            } else if ($class == "kuning") {
                if ($nilai < $Max && $nilai > $Min) {
                    $jumlah++;
                }
            } else if ($class == "hijau") {
                if ($nilai >= $Max) {
                    $jumlah++;
                }
            }
        }
        $NILAI_TOTAL += $jumlah;
        // var_dump($jumlah);
        // print_r("<br>");
    }
    return $NILAI_TOTAL;
}
?>