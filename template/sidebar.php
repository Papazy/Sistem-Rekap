<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion bg-light" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Home</div>
                    <a class="nav-link" href="<?= $main_url ?>index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>

                    <?php if (userLogin()['role'] == 1) { ?>
                        <a class="nav-link" href="<?= $main_url ?>template/judul/edit-judul.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-pen-to-square"></i></div>
                            Edit Judul
                        </a>
                        <a class="nav-link" href="<?= $main_url ?>user/user.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                            Pengguna
                        </a>
                    <?php } ?>

                    <?php if (userLogin()['role'] == 2) { ?>
                        <a class="nav-link" data-bs-toggle="modal" href="template/navbar.php" id="openProfileModal">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-address-card"></i></div>
                            Kartu Nama
                        </a>
                        <script>
                            document.getElementById('openProfileModal').addEventListener('click', function() {
                                var myModal = new bootstrap.Modal(document.getElementById('mdlProfileUser'), {
                                    keyboard: false
                                });
                                myModal.show();
                            });
                        </script>
                    <?php } ?>

                    <a class="nav-link" href="<?= $main_url ?>user/password.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-key"></i></div>
                        Ganti Password
                    </a>

                    <hr class="mb-0">
                    <div class="sb-sidenav-menu-heading">Data</div>
                    <?php if (userLogin()['role'] != 2) { ?>
                        <li>
                            <button class="nav-link btn btn-toggle align-items-center rounded collapsed"
                                data-bs-toggle="collapse" data-bs-target="#add-collapse" aria-expanded="true">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-plus"></i></div>
                                Tambah data
                            </button>
                            <div class="collapse" id="add-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal mb-0 small">
                                    <ul type="none">
                                        <li>
                                            <a class="nav-link" href="<?= $main_url ?>tambah-data/polda/add-polda.php">
                                                <div class="sb-nav-link-icon"><i class="fa-solid fa-building-columns"></i></div>
                                                Polda
                                            </a>
                                        </li>
                                    </ul>
                                    <ul type="none">
                                        <li>
                                            <a class="nav-link" href="<?= $main_url ?>tambah-data/polres/add-polres.php">
                                                <div class="sb-nav-link-icon"><i class="fa-solid fa-landmark-dome"></i></div>
                                                Polres
                                            </a>
                                        </li>
                                    </ul>
                                </ul>
                            </div>
                        </li>
                    <?php } ?>
                    <li>
                        <button class="nav-link btn btn-toggle align-items-center rounded collapsed"
                            data-bs-toggle="collapse" data-bs-target="#report-collapse" aria-expanded="true">
                            <div class="sb-nav-link-icon"><i class="fa-regular fa-paste"></i></div>
                            Laporan
                        </button>
                        <div class="collapse" id="report-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal mb-0 small">
                                <ul type="none">
                                    <li>
                                        <a class="nav-link" href="<?= $main_url ?>laporan/polda/polda.php">
                                            <div class="sb-nav-link-icon"><i class="fa-solid fa-building-columns"></i></div>
                                            Polda
                                        </a>
                                    </li>
                                </ul>
                                <ul type="none">
                                    <li>
                                        <a class="nav-link" href="<?= $main_url ?>laporan/polres/polres.php">
                                            <div class="sb-nav-link-icon"><i class="fa-solid fa-landmark-dome"></i></div>
                                            Polres
                                        </a>
                                    </li>
                                </ul>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <button class="nav-link btn btn-toggle align-items-center rounded collapsed"
                            data-bs-toggle="collapse" data-bs-target="#total-collapse" aria-expanded="true">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-column"></i></div>
                            Total
                        </button>
                        <div class="collapse" id="total-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw- normal mb-0 small">
                                <ul type="none">
                                    <li>
                                        <a class="nav-link" href="<?= $main_url ?>gabungan/polda.php">
                                            <div class="sb-nav-link-icon"><i class="fa-solid fa-building-columns"></i></div>
                                            Polda
                                        </a>
                                    </li>
                                </ul>
                                <ul type="none">
                                    <li>
                                        <a class="nav-link" href="<?= $main_url ?>gabungan/polres.php">
                                            <div class="sb-nav-link-icon"><i class="fa-solid fa-landmark-dome"></i></div>
                                            Polres
                                        </a>
                                    </li>
                                </ul>
                            </ul>
                        </div>
                    </li>
                    <div>
                        <a class="nav-link" href="<?= $main_url ?>triwulan/triwulan.php">
                            <div class="sb-nav-link-icon"><i class="fa-regular fa-clock"></i></div>
                            Triwulan
                        </a>
                    </div>
                    <div>
                        <a class="nav-link" href="<?= $main_url ?>program-giat/pg.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-briefcase"></i></div>
                            Program Giat
                        </a>
                    </div>
                </div>
            </div>
            <div class="sb-sidenav-footer border">
                <div class="small">Logged in as: <?= strtoupper($_SESSION["ssUser"]) ?></div>
            </div>
        </nav>
    </div>