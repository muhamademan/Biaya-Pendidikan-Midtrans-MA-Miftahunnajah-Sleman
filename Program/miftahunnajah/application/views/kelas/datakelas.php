<div class="alert alert-warning alert-dismissible fade show mr-4 ml-4" role="alert">
    <strong>Perhatian!</strong> Nama Kelas Tidak Boleh Sama.
</div>

<div class="container-fluid">
    <div class="col-md-12 mb-5">

        <?php if (validation_errors()) : ?>
        <div class="alert alert-danger" role="alert">
            <?= validation_errors(); ?>
        </div>
        <?php endif; ?>

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
                                <th>Nama Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($dtkelas as $dk) : ?>
                            <tr class="text-center">
                                <td class="py-0 align-middle"><?= $no++; ?></td>
                                <td class="py-1 align-middle text-center"><?= $dk['nama_kelas']; ?></td>

                                <!-- Action -->
                                <td class="py-1 align-middle text-center" width="10%">

                                    <a href="<?= base_url('data_kelas/ubahKelas/') . $dk['id_kelas']; ?>"><span
                                            class="bg-success rounded py-1 pl-1 pr-0"><i
                                                class="fa fa-edit text-light mx-1"></i></span></a>

                                    <a href="<?= base_url('data_kelas/hapusKelas/') . $dk['id_kelas']; ?>"
                                        class="tombol-delete-user" data-toggle="modal"
                                        data-target="#hapusKelas<?= $dk['id_kelas'] ?>"><span
                                            class="bg-danger rounded p-1"><i
                                                class="fa fa-trash text-light mx-1"></i></span></a>

                                    <!-- modal hapus siswa aktif -->
                                    <div class="modal fade" id="hapusKelas<?= $dk['id_kelas'] ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="hapusKelasLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title font-weight-bold" id="hapusKelasLabel">
                                                        Hapus Kelas
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body"> Apakah anda yakin ingin menghapus kelas
                                                    <b><?= $dk['nama_kelas']; ?></b> ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="<?= base_url('data_kelas/hapusKelas/') . $dk['id_kelas']; ?>"
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

<!-- Modal Tambah Data Siswa -->
<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('data_kelas/datakelas'); ?>" method="post">
                    <div class="form-group">
                        <label for="exampleInputUsername" class="font-weight-bold">Kelas</label>
                        <input type="text" name="nama_kelas" class="form-control" id="exampleInputUsername"
                            placeholder="Nama Kelas" required>
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