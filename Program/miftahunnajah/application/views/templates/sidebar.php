<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <!-- <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon">
        <i class="fas fa-school"></i>
    </div>
    <div class="sidebar-brand-text mx-3">MIFTAHUNNAJAH SLEMAN</div>
</a> -->
    <?php if ($user['role_id'] == 1) : ?>
    <div class="sidebar-brand d-flex align-items-center justify-content-center">
        <a class="nav-link" href="<?= base_url('admin'); ?>">
            <div class="sidebar-brand-icon">
                <img src="<?= base_url('assets/'); ?>img/madrasah.png" class="img-profile" height="30" alt="">
            </div>
            <!-- <div class="sidebar-brand-text mx-1 text-light">MA Miftahunnajah</div> -->
        </a>
    </div>
    <?php endif; ?>

    <?php if ($user['role_id'] == 2) : ?>
    <div class="sidebar-brand d-flex align-items-center justify-content-center">
        <a class="nav-link" href="<?= base_url('user/dashboard'); ?>">
            <div class="sidebar-brand-icon">
                <img src="<?= base_url('assets/'); ?>img/madrasah.png" class="img-profile" height="30" alt="">
            </div>
            <!-- <div class="sidebar-brand-text mx-1 text-light">MA Miftahunnajah</div> -->
        </a>
    </div>
    <?php endif; ?>
    <!-- Divider -->
    <hr class="sidebar-divider">



    <!-- QUERY MENU -->
    <?php
    $role_id = $this->session->userdata('role_id');

    $queryMenu = "SELECT `user_menu`.`id`, `menu` 
                            FROM `user_menu` JOIN `user_access_menu`
                            ON `user_menu`.`id` = `user_access_menu`.`menu_id` 
                            WHERE `user_access_menu`.`role_id` = $role_id 
                            ORDER BY `user_access_menu`.`menu_id` ASC
                            ";

    $menu = $this->db->query($queryMenu)->result_array();
    ?>


    <!-- LOOPING MENU -->
    <?php foreach ($menu as $m) : ?>

    <div class="sidebar-heading">
        <?= $m['menu']; ?>
    </div>

    <!-- MENYIAPKAN SUB-MENU SESUAI MENU -->
    <?php
        $menuId = $m['id'];
        $querySubMenu = "SELECT * FROM `user_sub_menu`
                                WHERE `menu_id` = $menuId
                                AND `is_active` = 1
                            ";
        $subMenu = $this->db->query($querySubMenu)->result_array();
        ?>

    <!-- Nav Item - Dashboard -->
    <?php foreach ($subMenu as $sm) : ?>
    <?php if ($title == $sm['title']) : ?>
    <li class="nav-item active">
        <?php else : ?>
    <li class="nav-item">
        <?php endif; ?>
        <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
            <i class="<?= $sm['icon']; ?>"></i>
            <span><?= $sm['title']; ?></span></a>
    </li>
    <?php endforeach; ?>
    <?php endforeach; ?>

    <?php if ($user['role_id'] == 1) : ?>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('Pesan/index'); ?>">
            <i class="fas fa-fw fa-info"></i>
            <span>Kirim Pesan</span></a>
    </li>
    <?php endif; ?>





    <!-- Data Master Bendahara -->
    <?php if ($user['role_id'] == 1) : ?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-folder-open"></i>
            <span>Data Management</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Management</h6>
                <a class="collapse-item font-weight-bold" href="<?= base_url('data_kelas/datakelas'); ?>">Data Kelas</a>
                <a class="collapse-item font-weight-bold" href="<?= base_url('master/datasiswa'); ?>">Data Siswa</a>
                <a class="collapse-item font-weight-bold" href="<?= base_url('master/dataajaran'); ?>">Tahun Ajaran</a>
                <a class="collapse-item font-weight-bold" href="<?= base_url('master/siswaaktif'); ?>">Siswa Aktif</a>
                <a class="collapse-item font-weight-bold" href="<?= base_url('master/bayar_spp'); ?>">Pembayaran
                    Spp</a>
                <a class="collapse-item font-weight-bold" href="<?= base_url('master/bayar_tahunan'); ?>">Pembayaran
                    Tahunan</a>
                <a class="collapse-item font-weight-bold" href="<?= base_url('master/bayar_bangunan'); ?>">Pembayaran
                    Bangunan</a>
            </div>
        </div>
    </li>
    <?php endif; ?>

    <?php if ($user['role_id'] == 1) : ?>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('bayar_ditempat/index'); ?>">
            <i class="fas fa-fw fa-money-bill-wave"></i>
            <span>Menu Pay</span></a>
    </li>
    <?php endif; ?>


    <!-- <?php if ($user['role_id'] == 2) : ?>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('user/dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <?php endif; ?> -->

    <!-- Nav Item - Laporan Pembayaran -->
    <?php if ($user['role_id'] == 1 || $user['role_id'] == 2) : ?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-file-pdf"></i>
            <span>Laporan Pembayaran</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data Pembayaran</h6>
                <a class="collapse-item font-weight-bold" href="<?= base_url('laporan/laporan_spp'); ?>">Laporan SPP</a>
                <a class="collapse-item font-weight-bold" href="<?= base_url('laporan_tahunan/lap_tahunan'); ?>">Laporan
                    Tahunan</a>
                <a class="collapse-item font-weight-bold"
                    href="<?= base_url('laporan_bangunan/lap_bangunan'); ?>">Laporan
                    Bangunan</a>
            </div>
        </div>
    </li>
    <?php endif; ?>



    <!-- Nav Item - Laporan Tunggakan -->
    <?php if ($user['role_id'] == 1) : ?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
            aria-controls="collapseOne">
            <i class="fas fa-fw fa-file-invoice-dollar"></i>
            <span>Laporan Tunggakan</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tunggakan Pembayaran</h6>
                <a class="collapse-item font-weight-bold" href="<?= base_url('laporan_tunggak/lap_tgk'); ?>">Tunggakan
                    Spp</a>
                <a class="collapse-item font-weight-bold"
                    href="<?= base_url('laporan_tunggak/tunggakan_thn'); ?>">Tunggakan Tahunan</a>
                <a class="collapse-item font-weight-bold"
                    href="<?= base_url('laporan_tunggak/tunggakan_bgn'); ?>">Tunggakan Bangunan</a>
            </div>
        </div>
    </li>
    <?php endif; ?>



    <!-- Konfigurasi Kepala Sekolah -->
    <?php if ($user['role_id'] == 2) : ?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Pengaturan</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Konfigurasi:</h6> -->
                <a class="collapse-item font-weight-bold" href="<?= base_url('pengaturan/myProfile'); ?>">Edit
                    Profile</a>
                <a class="collapse-item font-weight-bold" href="<?= base_url('pengaturan/aksesMenu'); ?>">Akses Menu</a>
                <a class="collapse-item font-weight-bold" href="<?= base_url('pengaturan/menuManagement'); ?>">Menu
                    Management</a>
                <a class="collapse-item font-weight-bold" href="<?= base_url('pengaturan/subMenu'); ?>">Submenu
                    Management</a>
            </div>
        </div>
    </li>
    <?php endif; ?>


    <!-- Pengaturan Bendahara -->
    <!-- <?php if ($user['role_id'] == 1) : ?>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('pengaturan/index'); ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Pengaturan</span></a>
    </li>
    <?php endif; ?> -->



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