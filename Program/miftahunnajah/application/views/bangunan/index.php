<!-- Begin Page Content -->
<!-- <div class="container-fluid">
    <div class="col-md-12 mb-5">
        <?= $this->session->flashdata('message'); ?>
        <div class="card shadow">
            <div class="card-header bg-primary border-bottom-warning py-2">
                <div class="row">
                    <div class="col">
                        <span class="text-light"></span>
                    </div>
                    <div class="col text-right">
                        <button class="btn btn-success py-0" data-toggle="modal" data-target="#new">Tambah</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm table-striped" id="example" width="100%"
                        cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Tahun Ajaran</th>
                                <th>Biaya Bangunan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($dt_bangunan as $db) : ?>
                            <tr class="text-center">
                                <td class="py-0 align-middle"><?= $no++; ?></td>
                                <td class="py-1 align-middle text-center"><?= $db['tahun_ajaran']; ?></td>
                                <td class="py-1 align-middle text-center"><?= $db['biaya_bangunan']; ?></td>
                                <?php if ($db['status'] == 'ON') : ?>
                                <td class="py-1 align-middle text-center"><span
                                        class="badge bg-success text-white">ON</span>
                                </td>
                                <?php endif; ?>
                                <?php if ($db['status'] == 'OFF') : ?>
                                <td class="py-1 align-middle text-center"><span
                                        class="badge bg-danger text-white">OFF</span>
                                </td>
                                <?php endif; ?>

                                
                                <td class="py-1 align-middle text-center" width="10%">
                                    <a href="<?= base_url('master/ubahBangunan/') . $db['id_bangunan']; ?>"><span
                                            class="bg-success rounded py-1 pl-1 pr-0"><i
                                                class="fa fa-edit text-light mx-1"></i></span></a>

                                    <a href="<?= base_url('master/hapusBangunan/') . $db['id_bangunan']; ?>"
                                        class="tombol-delete-user"><span class="bg-danger rounded p-1"><i
                                                class="fa fa-trash text-light mx-1"></i></span></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div> -->

<!-- Modal Tambah Data Biaya Bangunan -->
<!-- <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Biaya Bangunan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('master/addBangunan'); ?>" method="post">
                    <div class="form-group">
                        <label for="exampleInputUsername" class="font-weight-bold">Tahun Ajaran</label>
                        <select class="form-control" id="Formenu" name="id_tahun">
                            <?php foreach ($thn_ajaran as $s) : ?>
                            <option value="<?= $s['id_tahun'] ?>"><?= $s['tahun_ajaran'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername" class="font-weight-bold">Biaya Bangunan</label>
                        <input type="text" name="biaya_bangunan" class="form-control" id="exampleInputUsername"
                            placeholder="Biaya Bangunan" required>
                    </div>
                    <div class="form-group">
                        <label>Status :</label><br>
                        &nbsp<input type="radio" name="status" id="ON" class="with-gap" value="ON">
                        <label for="ON" class="m-l-20">ON</label>
                        <input type="radio" name="status" id="OFF" class="with-gap" value="OFF">
                        <label for="OFF" class="m-l-20">OFF</label>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div> -->













<div class="container-fluid">
    <div class="col-md-12 mb-5">
        <?= $this->session->flashdata('message'); ?>
        <div class="card shadow">
            <div class="card-header bg-primary border-bottom-warning py-2">
                <div class="row">
                    <div class="col">
                        <span class="text-light"></span>
                    </div>
                    <div class="col text-right">
                        <button class="btn btn-success py-0" data-toggle="modal" data-target="#new">Tambah</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <!-- <th>Id Bulanan</th> -->
                                <th>Nis</th>
                                <th>Nama Siswa</th>
                                <th>Jenis Pembayaran</th>
                                <th>Tahun Ajaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($bayar_bg as $db) : ?>
                            <tr class="text-center">
                                <td class="py-0 align-middle"><?= $no++; ?></td>
                                <td class="py-1 align-middle text-center"><?= $db['nis']; ?></td>
                                <td class="py-1 align-middle text-center"><?= $db['nama']; ?></td>
                                <td class="py-1 align-middle text-center"><?= $db['jenis_pembayaran']; ?></td>
                                <td class="py-1 align-middle text-center"><?= $db['tahun_ajaran']; ?></td>

                                <!-- Action -->
                                <td class="py-1 align-middle text-center" width="10%">

                                    <!-- Action Hapus Registrasi Pembayaran Tahunan -->
                                    <a href="<?= base_url('master/hapusBangunan/') . $db['id_bangunan']; ?>"
                                        class="tombol-delete-user" data-toggle="modal"
                                        data-target="#hapusbangunan<?= $db['id_bangunan'] ?>"><span
                                            class="bg-danger rounded p-1"><i
                                                class="fa fa-trash text-light mx-1"></i></span></a>

                                    <!-- modal hapus akun admin -->
                                    <div class="modal fade" id="hapusbangunan<?= $db['id_bangunan'] ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="hapusbangunanLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title font-weight-bold" id="hapusbangunanLabel">
                                                        Hapus Data Admin
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body"> Apakah anda yakin ingin menghapus siswa bernama
                                                    <b><?= $db['nama']; ?></b> yang telah teregistrasi ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <!-- <button type="submit" class="btn btn-success">Hapus</button> -->
                                                    <a href="<?= base_url('master/hapusBangunan/') . $db['id_bangunan']; ?>"
                                                        class="btn btn-primary">Hapus</a>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Batal</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal Tambah Data Biaya Bangunan -->
<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrasi Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('master/addBangunan'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" class="form-control form-control-user" id="id_bangunan" name="id_bangunan"
                            placeholder="Masukan id" value="<?= set_value('id_bangunan'); ?>">
                        <?= form_error('id_bangunan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername" class="font-weight-bold">Nama Siswa</label>
                        <select class="bootstrap-select strings" title="Nis / Nama" name="nis[]" id="id_siswa"
                            data-actions-box="true" data-virtual-scroll="false" data-live-search="true" multiple
                            required>
                            <?php foreach ($dtsiswa as $dt) : ?>
                            <option value="<?= $dt['id_siswa'] ?>"><?= $dt['nis'] . ' | ' . $dt['nama'] . ''; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername" class="font-weight-bold">Tahun Ajaran</label>
                        <select class="form-control" id="Formenu" name="tahun_ajaran">
                            <?php foreach ($ajar as $s) : ?>
                            <option value="<?= $s['tahun_ajaran'] ?>">
                                <?= $s['id_tahun'] . ' | ' . $s['tahun_ajaran']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input type="text" class="form-control form-control-user" hidden="" id="jenis_pembayaran"
                        name="jenis_pembayaran" placeholder="Masukan id" value="Biaya Tahunan">
                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('.bootstrap-select').selectpicker();
});
</script>