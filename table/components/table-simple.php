<style>
th,
td {
    white-space: nowrap;
}
</style>
<table class="display" id="exampleNoSetting">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">
                                    <center>Polda</center>
                                </th>
                                <th scope="col">
                                    <center>Polres</center>
                                </th>
                                <th scope="col">
                                    <center>Diupload</center>
                                </th>
                                <th scope="col">
                                    <center>Diverifikasi</center>
                                </th>
                                <th scope="col">
                                    <center>Belum Diverifikasi</center>
                                </th>
                                <th scope="col">
                                    <center>Ditolak</center>
                                </th>
                                <th scope="col">
                                    <center>Persentase</center>
                                </th>
                                <!-- <?php if (userLogin()['role'] == 1) { ?>
                                    <th scope="col">
                                        <center>Setting</center>
                                    </th>
                                <?php } ?> -->
                            </tr>
                        </thead>
                        <style>
                            .size {
                                width: 170px;
                            }
                        </style>

                        <tbody>
                            <?php
                            // Ambil data Max, Min, Max_upload, dan Min_upload dari tabel verifikasi_polres
                            $queryData = "SELECT Min, Max, Min_upload, Max_upload FROM verifikasi_polres";
                            $resultData = $koneksi->query($queryData);

                            if ($resultData->num_rows > 0) {
                                $row = $resultData->fetch_assoc();
                                $MaxPersentase = $row['Max'];
                                $MinPersentase = $row['Min'];
                                $MaxUpload = $row['Max_upload'];
                                $MinUpload = $row['Min_upload'];
                            } else {
                                // Set nilai default jika data tidak ditemukan
                                $MaxPersentase = 0;
                                $MinPersentase = 0;
                                $MaxUpload = 0;
                                $MinUpload = 0;
                            }


                            // Ambil parameter dari URL
                            $triwulan = isset($_GET['triwulan']) ? $_GET['triwulan'] : '';
                            $program = isset($_GET['program']) ? $_GET['program'] : '';
                            $giat = isset($_GET['giat']) ? $_GET['giat'] : '';
                            
                            // Query untuk mendapatkan data verifikasi
                            $query = "SELECT Polda, Polres, SUM(Sudah_diupload) AS Total_diupload, SUM(Sudah_diverifikasi) AS Total_diverifikasi, 
    SUM(Belum_diverifikasi) AS Total_belum_diverifikasi, SUM(Ditolak) AS Total_ditolak, 
    SUM(Ditolak_akumulasi) AS Total_ditolak_akumulasi, Persentase
  FROM verifikasi_polres 
  WHERE 1=1";



                            if (!empty($triwulan)) {
                                $query .= " AND Triwulan = '$triwulan'";
                            }
                            if (!empty($program)) {
                                $programChar = chr(64 + $program);
                                $query .= " AND program = '$programChar'";
                            }
                            if (!empty($giat)) {
                                $query .= " AND giat = '$giat'";
                                
                            }

                          // mencari min max
                          $max = 0;
                          $min = 0;
                          $maxFile = 0;
                          $minFile = 0;
                          if(!empty($giat)){
                              $max = $MaxPersentase;
                              $min = $MinPersentase;
                              $maxFile = $MaxUpload;
                              $minFile = $MinUpload;
                          }else if(!empty($program)){
                              // program = 1 maka di convert menjadi A, begitu juga dengan B, C sampai Z
                              $queryMinMax = "SELECT min, max, min_file, max_file FROM batasan WHERE satuan = 'Polres' AND nama = '$programChar'";
                              $minMaxRes = mysqli_query($koneksi, $queryMinMax);
                              $minMax = mysqli_fetch_array($minMaxRes);
                              $max = $minMax["max"];
                              $min = $minMax["min"];
                              $maxFile = $minMax["max_file"];
                              $minFile = $minMax["min_file"];
                          }else{
                              // mendapatkan triwulan
                              $queryMinMax = "SELECT min, max, min_file, max_file FROM batasan WHERE satuan = 'Polres' AND nama = 'Triwulan $triwulan'";
                              $minMaxRes = mysqli_query($koneksi, $queryMinMax);
                              $minMax = mysqli_fetch_array($minMaxRes);
                              // handle error null 
                              $max = !isset($minMax["max"]) ? 0 : $minMax["max"];
                              $min = !isset($minMax["min"]) ? 0 : $minMax["min"];
                              $maxFile = !isset($minMax["max_file"]) ? 0 : $minMax["max_file"];
                              $minFile = !isset($minMax["min_file"]) ? 0 : $minMax["min_file"];
                          }
                          

                            $query .= " GROUP BY Polres ORDER BY Polres";

                            // Menjalankan query
                            $queryPersentase = mysqli_query($koneksi, $query);

                            // Proses data untuk setiap Polres
                            $no = 1;
                            while ($dataPersentase = mysqli_fetch_array($queryPersentase)) {
                                $Polda = $dataPersentase["Polda"];
                                $Polres = $dataPersentase["Polres"];
                                $Total_diupload = $dataPersentase["Total_diupload"];
                                $Total_diverifikasi = $dataPersentase["Total_diverifikasi"];
                                $Total_belum_diverifikasi = $dataPersentase["Total_belum_diverifikasi"];
                                $Total_ditolak = $dataPersentase["Total_ditolak"];
                                $Persentase = $dataPersentase["Persentase"]; // Langsung ambil dari database

                                // // Cek jika persentase sudah ada, jika tidak maka hitung menggunakan rumus
                                // if (empty($dataPersentase["Persentase"])) {
                                // // Hitung Persentase hanya jika MaxSudahUpload tidak nol
                                // if ($MaxUpload != 0) {
                                // $Persentase = ($MaxPersentase * $Total_diverifikasi) / $MaxUpload;
                                // } else {
                                // $Persentase = 0; // Atau bisa diatur ke nilai default lainnya
                                // }
                                // } else {
                                // // Jika sudah ada nilai persentase yang diupload
                                // $Persentase = $dataPersentase["Persentase"];
                                // }
                            ?>
                                <tr>
                                    <td>
                                        <center><?= $no++ ?></center>
                                    </td>
                                    <td>
                                        <center><?= $Polda ?></center>
                                    </td>
                                    <td>
                                        <center><?= $Polres ?></center>
                                    </td>
                                    <td>
                                        <center><?= $Total_diupload ?></center>
                                    </td>
                                    <td>
                                        <center><?= $Total_diverifikasi ?></center>
                                    </td>
                                    <td>
                                        <center><?= $Total_belum_diverifikasi ?></center>
                                    </td>
                                    <td>
                                        <center><?= $Total_ditolak ?></center>
                                    </td>
                                    <td>
                                        <center>
                                            <?php
                                            // Tentukan warna berdasarkan kondisi
                                            if ($Persentase < $min) {
                                                $color = "#e60505"; // Merah (di bawah Min)
                                            } elseif ($Persentase >= $max) {
                                                $color = "green"; // Hijau (sama dengan atau di atas Max)
                                            } else {
                                                $color = "#fcb603"; // Kuning (antara Min dan Max)
                                            }
                                            ?>
                                            <span style="color: <?= $color ?>; font-weight: bold;">
                                                <?= number_format($Persentase, 2) ?>%
                                            </span>
                                        </center>

                                    </td>
                                    <!-- <td>
                                        <center><?= number_format($Persentase, 2) ?>%</center>
                                    </td> -->
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <div style="margin-top: 10px; display: flex; justify-content: right; padding-right: 20px; color: #7d7e80; font-size: 15px; font-weight: 450;">
                        --- Min : <span style="color: #fcb603; margin-left: 5px; font-weight: 600;"><?= number_format($min, 2) ?>% (<?= $minFile ?>)</span>
                        &nbsp;&nbsp;--- Max : <span style="color: green; margin-left: 5px; font-weight: 600;"><?= number_format($max, 2) ?>% (<?= $maxFile ?>)</span>
                    </div>


             