<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> -->

    <?php

    $total = $this->db->get_where('user')->num_rows();
    $total_siswa = $this->db->get_where('siswa')->num_rows();
    $total_aktif = $this->db->get_where('tahun_aktif')->num_rows();
    // $total_spp = $this->db->get_where('pembayaran_spp')->num_rows();

    // $this->db->select_sum('user');
    // var_dump($total_thaktif);
    // die;
    ?>


    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <!-- <?php if ($_SESSION["role_id"] == "1") { ?><a href="<?= base_url('user'); ?>"><?php } ?> -->
            <!-- <a href="<?= base_url('user/dataadmin'); ?>"> -->
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">User Akun</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total; ?> Akun</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <!-- <?php if ($_SESSION["role_id"] == "1") { ?> -->
            <a href="<?= base_url('master/datasiswa'); ?>"><?php } ?>
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data Siswa
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_siswa; ?> Siswa</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-xl-4 col-md-6 mb-4">
            <a href="<?= base_url('master/siswaAktif'); ?>">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Siswa Aktif
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?= number_format($total_aktif) ?> Siswa Aktif</div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <!-- <a href="<?= base_url('pembayaran'); ?>"> -->
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Pembayaran
                                spp</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php foreach ($total_spp as $spp) { ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.
                                    <?= number_format($spp['jum'], 0, ',', '.'); ?>,-</div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>


        <div class="col-xl-4 col-md-6 mb-4">
            <!-- <a href="<?= base_url('pembayaran'); ?>"> -->
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Pembayaran
                                Tahunan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php foreach ($total_thn as $tahunan) { ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.
                                    <?= number_format($tahunan['jum'], 0, ',', '.'); ?>,-</div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>


        <div class="col-xl-4 col-md-6 mb-4">
            <!-- <a href="<?= base_url('pembayaran'); ?>"> -->
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Pembayaran
                                Bangunan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php foreach ($total_bgn as $bangunan) : ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.
                                    <?= number_format($bangunan['jum'], 0, ',', '.'); ?>,-</div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->