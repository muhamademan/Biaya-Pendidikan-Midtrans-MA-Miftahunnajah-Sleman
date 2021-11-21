<div class="container-fluid">

    <div class="main-body shadow">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-0">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="<?= base_url('assets/img/profile/') . $siswa['image']; ?>" alt="..."
                                class="rounded-circle" width="150">
                            <div class="mt-3">
                                <h4><?= $siswa['nama']; ?></h4>
                                <p class="text-muted font-size-sm"><?= $siswa['nis']; ?></p>
                                <?php if ($siswa['is_active'] == 1) { ?>
                                <p class="badge badge-success"></i>Aktif</p>
                                <?php } else { ?>
                                <p class="badge badge-danger">Tidak Aktif</p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">No.Induk Siswa</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">:
                                <?= $siswa['nis']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Nama Lengkap</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">:
                                <?= $siswa['nama']; ?>
                            </div>
                        </div>
                        <!-- <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Kelas</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $kelas['nama_kelas']; ?>
                            </div>
                        </div> -->
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Tanggal Lahir</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">:
                                <?= $siswa['tgl_lahir']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Jenis Kelamin</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">:
                                <?= $siswa['jenis_kelamin']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email Siswa</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">:
                                <?= $siswa['email']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Nama Wali</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">:
                                <?= $siswa['nama_wali']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">No.Telpon</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">:
                                <?= $siswa['no_hp']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Alamat</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">:
                                <?= $siswa['alamat']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>