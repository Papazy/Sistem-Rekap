<?php
require_once "config/conn.php";
// Fungsi untuk menghitung jumlah Persentase PG yang <= Min untuk setiap periode



function hitungPersentaseDariPeriode( $DAERAH, $PERIODE, $KATEGORI)
{
    global $koneksi;
 
    $jenis = $DAERAH == "Polda" ? "polda" : "polres";
    $satker = $DAERAH == "Polda" ? "Satker" : "Polres";

    $SATUAN_SEMUA = array();

    $queryPG = mysqli_query($koneksi, "SELECT DISTINCT " . $satker . " FROM persentase_" . $jenis . " WHERE Periode = '$PERIODE'");
    while($polres = mysqli_fetch_array($queryPG)){
        $SATUAN_SEMUA[] = $polres[$satker];
    }
    // var_dump($SATUAN_SEMUA);
    $NILAI_TOTAL = 0;
    foreach($SATUAN_SEMUA as $satu){
        $queryNilai = mysqli_query($koneksi, "SELECT * FROM persentase_" . $jenis . " WHERE " . $satker . " = '$satu' AND Periode = '$PERIODE'");
        $nilai = 0;
        $jumlah = 0;

        $Min = 0;
        $Max = 0;
        
        
        while ($data = mysqli_fetch_array($queryNilai)) {
            $PG = $data["PG"];
            $queryMinMax = mysqli_query($koneksi, "SELECT Min, Max FROM laporan_" . $jenis . " WHERE Periode = '{$PERIODE}' AND PG ='$PG'");
            while ($datas = mysqli_fetch_array($queryMinMax)) {
                $Min = $datas['Min'];
                $Max = $datas['Max'];
                break;
            }

            $nilai = $data['Persentase'];
            if ($KATEGORI == "Merah") {
                if ($nilai <= $Min) {
                    $jumlah++;
                }
            } else if ($KATEGORI == "Kuning") {
                if ($nilai < $Max && $nilai > $Min) {
                    $jumlah++;
                }
            } else if ($KATEGORI == "Hijau") {
                if ($nilai >= $Max) {
                    $jumlah++;
                }
            }
        }
        $NILAI_TOTAL += $jumlah;
    }
    return $NILAI_TOTAL;
}

function hitungPersentaseDariTriwulan( $DAERAH, $TRIWULAN, $KATEGORI)
{
    global $koneksi;
 
    $jenis = $DAERAH == "Polda" ? "polda" : "polres";
    $satker = $DAERAH == "Polda" ? "Satker" : "Polres";

    $SATUAN_SEMUA = array();

    $queryPG = mysqli_query($koneksi, "SELECT DISTINCT " . $satker . " FROM persentase_" . $jenis . " WHERE Triwulan = '$TRIWULAN'");
    while($polres = mysqli_fetch_array($queryPG)){
        $SATUAN_SEMUA[] = $polres[$satker];
    }
    // var_dump($SATUAN_SEMUA);
    $NILAI_TOTAL = 0;
    foreach($SATUAN_SEMUA as $satu){
        $queryNilai = mysqli_query($koneksi, "SELECT * FROM persentase_" . $jenis . " WHERE " . $satker . " = '$satu' AND Triwulan = '$TRIWULAN'");
        $nilai = 0;
        $jumlah = 0;

        $Min = 0;
        $Max = 0;
        
        while ($data = mysqli_fetch_array($queryNilai)) {
            $periode = $data['Periode'];
            $PG = $data["PG"];
            $queryMinMax = mysqli_query($koneksi, "SELECT Min, Max FROM laporan_" . $jenis . " WHERE Periode = '{$periode}' AND PG ='$PG'");

            while ($datas = mysqli_fetch_array($queryMinMax)) {
                $Min = $datas['Min'];
                $Max = $datas['Max'];
                break;
            }

            $nilai = $data['Persentase'];
            if ($KATEGORI == "Merah") {
                if ($nilai <= $Min) {
                    $jumlah++;
                }
            } else if ($KATEGORI == "Kuning") {
                if ($nilai < $Max && $nilai > $Min) {
                    $jumlah++;
                }
            } else if ($KATEGORI == "Hijau") {
                if ($nilai >= $Max) {
                    $jumlah++;
                }
            }
        }
        $NILAI_TOTAL += $jumlah;
    }
    return $NILAI_TOTAL;
}


function hitungPersentaseMerahDariMinSetiapPeriode()
{
    global $koneksi;
    // Query untuk mendapatkan setiap periode yang unik

    $query_periode = "SELECT DISTINCT Periode FROM persentase_polres";
    $result_periode = mysqli_query($koneksi, $query_periode);

    // Inisialisasi array untuk menyimpan hasil per periode
    $hasil_per_periode = array();

    // Loop melalui setiap periode
    while ($row_periode = mysqli_fetch_assoc($result_periode)) {
        $periode = $row_periode['Periode'];
        $queryMinMax = mysqli_query($koneksi, "SELECT Min, Max FROM laporan_polres WHERE Periode = '$periode'");
        while ($data = mysqli_fetch_array($queryMinMax)) {
            $Min = $data['Min'];
            $Max = $data['Max'];
            break;
        }

        // Query untuk menghitung jumlah data yang memenuhi kriteria untuk periode tertentu
        $query_total_merah = "SELECT COUNT(*) AS total FROM persentase_polres pp
                        WHERE pp.Periode = '$periode' AND pp.Persentase <= " . $Min . "";

        $result_total = mysqli_query($koneksi, $query_total_merah);

        if ($result_total) {
            // Ambil jumlah total dari hasil query
            $row_total = mysqli_fetch_assoc($result_total);
            $total = $row_total['total'];

            // Simpan jumlah total ke dalam array hasil_per_periode
            $hasil_per_periode[$periode] = $total;
        } else {
            // echo "Error: " . mysqli_error($koneksi);
        }
    }



    // Kembalikan array dengan hasil per periode
    return $hasil_per_periode;
}
function hitungPersentaseKuningDariMinSetiapPeriode()
{
    global $koneksi;
    // Query untuk mendapatkan setiap periode yang unik

    $query_periode = "SELECT DISTINCT Periode FROM persentase_polres";
    $result_periode = mysqli_query($koneksi, $query_periode);

    // Inisialisasi array untuk menyimpan hasil per periode
    $hasil_per_periode = array();

    // Loop melalui setiap periode
    while ($row_periode = mysqli_fetch_assoc($result_periode)) {
        $periode = $row_periode['Periode'];
        $queryMinMax = mysqli_query($koneksi, "SELECT Min, Max FROM laporan_polres WHERE Periode = '$periode'");
        while ($data = mysqli_fetch_array($queryMinMax)) {
            $Min = $data['Min'];
            $Max = $data['Max'];
            break;
        }

        // Query untuk menghitung jumlah data yang memenuhi kriteria untuk periode tertentu
        $query_total_merah = "SELECT COUNT(*) AS total FROM persentase_polres pp
                        WHERE pp.Periode = '$periode' AND pp.Persentase < " . $Max . " AND pp.Persentase > " . $Min . "";

        $result_total = mysqli_query($koneksi, $query_total_merah);

        if ($result_total) {
            // Ambil jumlah total dari hasil query
            $row_total = mysqli_fetch_assoc($result_total);
            $total = $row_total['total'];

            // Simpan jumlah total ke dalam array hasil_per_periode
            $hasil_per_periode[$periode] = $total;
        } else {
            // echo "Error: " . mysqli_error($koneksi);
        }
    }



    // Kembalikan array dengan hasil per periode
    return $hasil_per_periode;
}
function hitungPersentaseHijauDariMinSetiapPeriode()
{
    global $koneksi;
    // Query untuk mendapatkan setiap periode yang unik

    $query_periode = "SELECT DISTINCT Periode FROM persentase_polres";
    $result_periode = mysqli_query($koneksi, $query_periode);

    // Inisialisasi array untuk menyimpan hasil per periode
    $hasil_per_periode = array();

    // Loop melalui setiap periode
    while ($row_periode = mysqli_fetch_assoc($result_periode)) {
        $periode = $row_periode['Periode'];
        $queryMinMax = mysqli_query($koneksi, "SELECT Min, Max FROM laporan_polres WHERE Periode = '$periode'");
        while ($data = mysqli_fetch_array($queryMinMax)) {
            $Min = $data['Min'];
            $Max = $data['Max'];
            break;
        }

        // Query untuk menghitung jumlah data yang memenuhi kriteria untuk periode tertentu
        $query_total_merah = "SELECT COUNT(*) AS total FROM persentase_polres pp
                        WHERE pp.Periode = '$periode' AND pp.Persentase >= " . $Max . "";

        $result_total = mysqli_query($koneksi, $query_total_merah);

        if ($result_total) {
            // Ambil jumlah total dari hasil query
            $row_total = mysqli_fetch_assoc($result_total);
            $total = $row_total['total'];

            // Simpan jumlah total ke dalam array hasil_per_periode
            $hasil_per_periode[$periode] = $total;
        } else {
            // echo "Error: " . mysqli_error($koneksi);
        }
    }



    // Kembalikan array dengan hasil per periode
    return $hasil_per_periode;
}
function hitungPersentaseMerahDariMinSetiapPeriode_POLDA()
{
    global $koneksi;
    // Query untuk mendapatkan setiap periode yang unik

    $query_periode = "SELECT DISTINCT Periode FROM persentase_polda";
    $result_periode = mysqli_query($koneksi, $query_periode);

    // Inisialisasi array untuk menyimpan hasil per periode
    $hasil_per_periode = array();

    // Loop melalui setiap periode
    while ($row_periode = mysqli_fetch_assoc($result_periode)) {
        $periode = $row_periode['Periode'];


        $queryMinMax = mysqli_query($koneksi, "SELECT Min, Max FROM laporan_polda WHERE Periode = '$periode'");
        while ($data = mysqli_fetch_array($queryMinMax)) {
            $Min = $data['Min'];
            $Max = $data['Max'];
            break;
        }

        // Query untuk menghitung jumlah data yang memenuhi kriteria untuk periode tertentu
        $query_total_merah = "SELECT COUNT(*) AS total FROM persentase_polda pp
                            
                        WHERE pp.Periode = '$periode' AND pp.Persentase <= " . $Min . "";

        $result_total = mysqli_query($koneksi, $query_total_merah);

        if ($result_total) {
            // Ambil jumlah total dari hasil query
            $row_total = mysqli_fetch_assoc($result_total);
            $total = $row_total['total'];

            // Simpan jumlah total ke dalam array hasil_per_periode
            $hasil_per_periode[$periode] = $total;
        } else {
            // echo "Error: " . mysqli_error($koneksi);
        }
    }



    // Kembalikan array dengan hasil per periode
    return $hasil_per_periode;
}
function hitungPersentaseKuningDariMinSetiapPeriode_POLDA()
{
    global $koneksi;
    // Query untuk mendapatkan setiap periode yang unik

    $query_periode = "SELECT DISTINCT Periode FROM persentase_polda";
    $result_periode = mysqli_query($koneksi, $query_periode);

    // Inisialisasi array untuk menyimpan hasil per periode
    $hasil_per_periode = array();

    // Loop melalui setiap periode
    while ($row_periode = mysqli_fetch_assoc($result_periode)) {
        $periode = $row_periode['Periode'];
        $queryMinMax = mysqli_query($koneksi, "SELECT Min, Max FROM laporan_polda WHERE Periode = '$periode'");
        while ($data = mysqli_fetch_array($queryMinMax)) {
            $Min = $data['Min'];
            $Max = $data['Max'];
            break;
        }

        // Query untuk menghitung jumlah data yang memenuhi kriteria untuk periode tertentu
        $query_total_merah = "SELECT COUNT(*) AS total FROM persentase_polda pp
                            
                        WHERE pp.Periode = '$periode' AND pp.Persentase < " . $Max . " AND pp.Persentase > " . $Min . "";

        $result_total = mysqli_query($koneksi, $query_total_merah);

        if ($result_total) {
            // Ambil jumlah total dari hasil query
            $row_total = mysqli_fetch_assoc($result_total);
            $total = $row_total['total'];

            // Simpan jumlah total ke dalam array hasil_per_periode
            $hasil_per_periode[$periode] = $total;
        } else {
            // echo "Error: " . mysqli_error($koneksi);
        }
    }



    // Kembalikan array dengan hasil per periode
    return $hasil_per_periode;
}
function hitungPersentaseHijauDariMinSetiapPeriode_POLDA()
{
    global $koneksi;
    // Query untuk mendapatkan setiap periode yang unik

    $query_periode = "SELECT DISTINCT Periode FROM persentase_polda";
    $result_periode = mysqli_query($koneksi, $query_periode);

    // Inisialisasi array untuk menyimpan hasil per periode
    $hasil_per_periode = array();

    // Loop melalui setiap periode
    while ($row_periode = mysqli_fetch_assoc($result_periode)) {
        $periode = $row_periode['Periode'];
        $queryMinMax = mysqli_query($koneksi, "SELECT Min, Max FROM laporan_polda WHERE Periode = '$periode'");
        while ($data = mysqli_fetch_array($queryMinMax)) {
            $Min = $data['Min'];
            $Max = $data['Max'];
            break;
        }

        // Query untuk menghitung jumlah data yang memenuhi kriteria untuk periode tertentu
        $query_total_merah = "SELECT COUNT(*) AS total FROM persentase_polda pp
                            
                        WHERE pp.Periode = '$periode' AND pp.Persentase >= " . $Max . "";

        $result_total = mysqli_query($koneksi, $query_total_merah);

        if ($result_total) {
            // Ambil jumlah total dari hasil query
            $row_total = mysqli_fetch_assoc($result_total);
            $total = $row_total['total'];

            // Simpan jumlah total ke dalam array hasil_per_periode
            $hasil_per_periode[$periode] = $total;
        } else {
            // echo "Error: " . mysqli_error($koneksi);
        }
    }



    // Kembalikan array dengan hasil per periode
    return $hasil_per_periode;
}

function jumlahTotalPersentase($arr)
{
    print_r("Eksukusi Jumlah <br>");
    global $koneksi;
    $total = 0;
    foreach ($arr as $ar => $jumlah) {
        var_dump($jumlah);
        print_r("<br>");
        $total = $total + $jumlah;
    }
    return $total;
}

// Contoh pemanggilan fungsi untuk menghitung jumlah Persentase PG yang <= Min untuk setiap periode
// $hasil = hitungPersentaseMerahDariMinSetiapPeriode();

// Tampilkan hasil per periode
// foreach ($hasil as $periode => $jumlah) {
//     // echo "Jumlah Persentase PG yang <= Min dari periode $periode: $jumlah<br>";
// }

// $total = jumlahTotalPersentase($hasil);

function cariJumlahPolresMerah()
{
    $hasil1 = hitungPersentaseMerahDariMinSetiapPeriode();
    $total1 = jumlahTotalPersentase($hasil1);
    return $total1;
}
function cariJumlahPolresKuning()
{
    $hasil1 = hitungPersentaseKuningDariMinSetiapPeriode();
    $total1 = jumlahTotalPersentase($hasil1);
    return $total1;
}
function cariJumlahPolresHijau()
{
    $hasil1 = hitungPersentaseHijauDariMinSetiapPeriode();
    $total1 = jumlahTotalPersentase($hasil1);
    return $total1;
}

// Polda
function cariJumlahPoldaMerah()
{
    $hasil1 = hitungPersentaseMerahDariMinSetiapPeriode_POLDA();
    $total1 = jumlahTotalPersentase($hasil1);
    return $total1;
}
function cariJumlahPoldaKuning()
{
    $hasil1 = hitungPersentaseKuningDariMinSetiapPeriode_POLDA();
    $total1 = jumlahTotalPersentase($hasil1);
    return $total1;
}
function cariJumlahPoldaHijau()
{
    $hasil1 = hitungPersentaseHijauDariMinSetiapPeriode_POLDA();
    $total1 = jumlahTotalPersentase($hasil1);
    return $total1;
}

// echo "Total : $total"

?>