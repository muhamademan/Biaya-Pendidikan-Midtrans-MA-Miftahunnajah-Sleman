<div class="alert alert-warning alert-dismissible fade show mr-4 ml-4" role="alert">
    <strong>Perhatian!</strong> Pastikan tahun ajaran untuk pembayaran tidak boleh sama.
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
                                <th>Tahun Ajaran</th>
                                <th>Biaya SPP</th>
                                <th>Biaya Tahunan</th>
                                <th>Biaya Bangunan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($dt_thajaran as $tj) : ?>
                            <tr class="text-center">
                                <td class="py-0 align-middle"><?= $no++; ?></td>
                                <td class="py-1 align-middle text-center"><?= $tj['tahun_ajaran']; ?></td>
                                <td class="py-1 align-middle text-center"><?= $tj['besar_spp']; ?></td>
                                <td class="py-1 align-middle text-center"><?= $tj['besar_tahunan']; ?></td>
                                <td class="py-1 align-middle text-center"><?= $tj['besar_bangunan']; ?></td>
                                <!-- <td class="py-1 align-middle text-center"><?= $tj['status']; ?></td> -->
                                <?php if ($tj['status'] == 'ON') : ?>
                                <td class="py-1 align-middle text-center"><span
                                        class="badge bg-success text-white">ON</span>
                                </td>
                                <?php endif; ?>
                                <?php if ($tj['status'] == 'OFF') : ?>
                                <td class="py-1 align-middle text-center"><span
                                        class="badge bg-danger text-white">OFF</span>
                                </td>
                                <?php endif; ?>
                                <!-- Action -->
                                <td class="py-1 align-middle text-center" width="10%">
                                    <a href="<?= base_url('master/ubahThajaran/') . $tj['id_tahun']; ?>"><span
                                            class="bg-success rounded py-1 pl-1 pr-0"><i
                                                class="fa fa-edit text-light mx-1"></i></span></a>

                                    <!-- <a href="<?= base_url('master/hapusThajaran/') . $tj['id_tahun']; ?>"
                                        class="tombol-delete-user" data-toggle="modal"
                                        data-target="#hapusAjaran<?= $tj['id_tahun'] ?>"><span
                                            class="bg-danger rounded p-1"><i
                                                class="fa fa-trash text-light mx-1"></i></span></a> -->

                                    <a href="<?= base_url('master/hapusThajaran/') . $tj['id_tahun']; ?>"
                                        class="tombol-delete-user" data-toggle="modal"
                                        data-target="#hapusAjaran<?= $tj['id_tahun'] ?>"><span
                                            class="bg-danger rounded p-1"><i
                                                class="fa fa-trash text-light mx-1"></i></span></a>

                                    <!-- modal hapus siswa aktif -->
                                    <div class="modal fade" id="hapusAjaran<?= $tj['id_tahun'] ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="hapusAjaranLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title font-weight-bold" id="hapusAjaranLabel">
                                                        Hapus data tahun ajaran
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body"> Apakah anda yakin ingin menghapus tahun ajaran
                                                    <b><?= $tj['tahun_ajaran']; ?></b> ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="<?= base_url('master/hapusThajaran/') . $tj['id_tahun']; ?>"
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

<!-- Modal Tambah Data Tahun Ajaran -->
<div class=" modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Tambah Data Tahun Ajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('master/dataajaran'); ?>" method="post">
                    <div class="form-group">
                        <label for="exampleInputUsername" class="font-weight-bold">Tahun
                            Ajaran</label>
                        <input type="text" name="tahun_ajaran" class="form-control" id="exampleInputUsername"
                            placeholder="Masukan tahun ajaran" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername" class="font-weight-bold">Biaya
                            SPP</label>
                        <input type="text" name="besar_spp" class="form-control" id="exampleInputUsername"
                            placeholder="Masukan Biaya Spp" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername" class="font-weight-bold">Biaya
                            Tahunan</label>
                        <input type="text" name="besar_tahunan" class="form-control" id="exampleInputUsername"
                            placeholder="Masukan Biaya Tahunan" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername" class="font-weight-bold">Biaya
                            Bangunan</label>
                        <input type="text" name="besar_bangunan" class="form-control" id="exampleInputUsername"
                            placeholder="Masukan Biaya Bangunan" required>
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
</div>