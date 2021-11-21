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
                                <th>Biaya SPP</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($pembayaran_spp as $ds) : ?>
                            <tr class="text-center">
                                <td class="py-0 align-middle"><?= $no++; ?></td>
                                <td class="py-1 align-middle text-center"><?= $ds['tahun_ajaran']; ?></td>
                                <td class="py-1 align-middle text-center"><?= $ds['biaya_spp']; ?></td>
                                <?php if ($ds['status'] == 'ON') : ?>
                                <td class="py-1 align-middle text-center"><span
                                        class="badge bg-success text-white">ON</span>
                                </td>
                                <?php endif; ?>
                                <?php if ($ds['status'] == 'OFF') : ?>
                                <td class="py-1 align-middle text-center"><span
                                        class="badge bg-danger text-white">OFF</span>
                                </td>
                                <?php endif; ?>



                                <td class="py-1 align-middle text-center" width="10%">
                                    <a href="<?= base_url('master/ubahSpp/') . $ds['id_spp']; ?>"><span
                                            class="bg-success rounded py-1 pl-1 pr-0"><i
                                                class="fa fa-edit text-light mx-1"></i></span></a>

                                    <a href="<?= base_url('master/hapusSpp/') . $ds['id_spp']; ?>"
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
                            foreach ($bayar_spp as $ds) : ?>
                            <tr class="text-center">
                                <td class="py-0 align-middle"><?= $no++; ?></td>
                                <td class="py-1 align-middle text-center"><?= $ds['nis']; ?></td>
                                <td class="py-1 align-middle text-center"><?= $ds['nama']; ?></td>
                                <td class="py-1 align-middle text-center"><?= $ds['jenis_pembayaran']; ?></td>
                                <td class="py-1 align-middle text-center"><?= $ds['tahun_ajaran']; ?></td>
                                <!-- <?php if ($ds['status'] == 'ON') : ?>
                                <td class="py-1 align-middle text-center"><span
                                        class="badge bg-success text-white">ON</span>
                                </td>
                                <?php endif; ?>
                                <?php if ($ds['status'] == 'OFF') : ?>
                                <td class="py-1 align-middle text-center"><span
                                        class="badge bg-danger text-white">OFF</span>
                                </td>
                                <?php endif; ?> -->



                                <td class="py-1 align-middle text-center" width="10%">
                                    <!-- <a href="<?= base_url('master/ubahSpp/') . $ds['id_spp']; ?>"><span
                                            class="bg-success rounded py-1 pl-1 pr-0"><i
                                                class="fa fa-edit text-light mx-1"></i></span></a>

                                    <a href="<?= base_url('master/hapusSpp/') . $ds['id_spp']; ?>"
                                        class="tombol-delete-user"><span class="bg-danger rounded p-1"><i
                                                class="fa fa-trash text-light mx-1"></i></span></a> -->

                                    <!-- Action Hapus Akun Admin -->
                                    <a href="<?= base_url('master/hapusSpp/') . $ds['id_spp']; ?>"
                                        class="tombol-delete-user" data-toggle="modal"
                                        data-target="#hapusSpp<?= $ds['id_spp'] ?>"><span
                                            class="bg-danger rounded p-1"><i
                                                class="fa fa-trash text-light mx-1"></i></span></a>

                                    <!-- modal hapus akun admin -->
                                    <div class="modal fade" id="hapusSpp<?= $ds['id_spp'] ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="hapusSppLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title font-weight-bold" id="hapusSppLabel">
                                                        Hapus Data Admin
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body"> Apakah anda yakin ingin menghapus siswa bernama
                                                    <b><?= $ds['nama']; ?></b> yang telah teregistrasi ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <!-- <button type="submit" class="btn btn-success">Hapus</button> -->
                                                    <a href="<?= base_url('master/hapusSpp/') . $ds['id_spp']; ?>"
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

<!-- Modal Tambah Data Siswa Aktif -->
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
                <form action="<?= base_url('master/tambahSpp'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" class="form-control form-control-user" id="id_spp" name="id_spp"
                            placeholder="Masukan id" value="<?= set_value('id_spp'); ?>">
                        <?= form_error('id_spp', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername" class="font-weight-bold">Nama Siswa</label>
                        <!-- <select class="form-control" id="Formenu" name="id_tahun"> -->
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
                        name="jenis_pembayaran" placeholder="Masukan id" value="Spp Bulanan">
                    <?= form_error('nama_santri', '<small class="text-danger pl-3">', '</small>'); ?>
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