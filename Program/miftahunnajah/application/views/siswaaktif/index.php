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
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($th_aktif as $ds) : ?>
                            <tr class="text-center">
                                <td class="py-0 align-middle"><?= $no++; ?></td>
                                <td class="py-1 align-middle text-center"><?= $ds['nis']; ?></td>
                                <td class="py-1 align-middle text-center"><?= $ds['nama']; ?></td>

                                <!-- Action Hapus siswa aktif -->
                                <td class="py-1 align-middle text-center" width="10%">
                                    <a href="<?= base_url('master/hapusThaktif/') . $ds['id_tahun_aktif']; ?>"
                                        class="tombol-delete-user" data-toggle="modal"
                                        data-target="#hapusThaktif<?= $ds['id_tahun_aktif'] ?>"><span
                                            class="bg-danger rounded p-1"><i
                                                class="fa fa-trash text-light mx-1"></i></span></a>

                                    <!-- modal hapus siswa aktif -->
                                    <div class="modal fade" id="hapusThaktif<?= $ds['id_tahun_aktif'] ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="hapusThaktifLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title font-weight-bold" id="hapusThaktifLabel">
                                                        Hapus Data Siswa Aktif
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body"> Apakah anda yakin ingin menghapus siswa
                                                    <b><?= $ds['nama']; ?></b> ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="<?= base_url('master/hapusThaktif/') . $ds['id_tahun_aktif']; ?>"
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

<!-- Modal Tambah Data Biaya SPP -->
<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Siswa Aktif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('master/tambah_aksi'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" hidden="" id="id_tahun_aktif"
                            name="id_tahun_aktif" placeholder="Masukan id" value="<?= set_value('id_tahun_aktif'); ?>">
                        <!-- <?= form_error('id_tahun_aktif', '<small class="text-danger pl-3">', '</small>'); ?> -->
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername" class="font-weight-bold">Nama Siswa</label>
                        <select class="bootstrap-select strings" title="Nis" name="nis[]" id="bulan"
                            data-actions-box="true" data-virtual-scroll="false" data-live-search="true" multiple
                            required>
                            <?php foreach ($siswa_akf as $dt) : ?>
                            <option value="<?= $dt['id_siswa'] ?>"><?= $dt['nis'] . ' | ' . $dt['nama'] . ''; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
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