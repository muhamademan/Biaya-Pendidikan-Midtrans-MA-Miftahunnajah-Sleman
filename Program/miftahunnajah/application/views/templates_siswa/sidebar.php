<!-- <?php
        $this->db->select('nis');
        $data['siswa'] = $this->db->get('siswa')->row_array();
        ?> -->

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <!-- <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon">
        <i class="fas fa-school"></i>
    </div>
    <div class="sidebar-brand-text mx-3">MIFTAHUNNAJAH SLEMAN</div>
</a> -->

    <div class="sidebar-brand d-flex align-items-center justify-content-center">
        <a class="nav-link" href="<?= base_url('siswa'); ?>">
            <div class="sidebar-brand-icon">
                <img src="<?= base_url('assets/'); ?>img/madrasah.png" class="img-profile" height="30" alt="">
            </div>
            <!-- <div class="sidebar-brand-text mx-1 text-light">MA Miftahunnajah</div> -->
        </a>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Siswa Miftahunnajah
    </div>

    <!-- Nav Item - Info Pembayaran -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('informasi/info_bayar'); ?>">
            <i class="fas fa-fw fa-info-circle"></i>
            <span>Info Pembayaran</span></a>
    </li>



    <!-- Nav Item - Pembayaran Siswa -->
    <?php if ($siswa['role_id'] == 3) : ?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pembayaran</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Jenis Pembayaran</h6>
                <a class="collapse-item font-weight-bold" href="<?= base_url('siswa_bulanan/spp'); ?>">Pembayaran
                    SPP</a>
                <a class="collapse-item font-weight-bold" href="<?= base_url('siswa_tahunan/tahunan'); ?>">Pembayaran
                    Tahunan</a>
                <a class="collapse-item font-weight-bold" href="<?= base_url('siswa_bangunan/bangunan'); ?>">Pembayaran
                    Bangunan</a>
            </div>
        </div>
    </li>
    <?php endif; ?>








    <!-- Nav Item - Dashboard -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li> -->

    <!-- Nav Item - My profile -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-user"></i>
            <span>Profile</span></a>
    </li> -->

    <!-- Nav Item - Data Admin -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Admin</span></a>
    </li> -->

    <!-- Nav Item - Laporan Pembayaran -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-folder"></i>
            <span>Laporan Pembayaran</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Master Data</h6>
                <a class="collapse-item" href="buttons.html">Keuangan SPP</a>
                <a class="collapse-item" href="cards.html">Keuangan Tahunan</a>
                <a class="collapse-item" href="cards.html">Keuangan Bangunan</a>
                <a class="collapse-item" href="cards.html">Tunggakan</a>
            </div>
        </div>
    </li> -->

    <!-- Konfigurasi -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Konfigurasi</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Konfigurasi:</h6>
                <a class="collapse-item" href="utilities-color.html">Edit Akun</a>
                <a class="collapse-item" href="utilities-color.html">Akses Menu</a>
                <a class="collapse-item" href="utilities-border.html">Menu Management</a>
                <a class="collapse-item" href="utilities-animation.html">Submenu Management</a>
            </div>
        </div>
    </li> -->

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">



    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->