<!-- Begin Page Content -->
<!-- <div class="container-fluid"> -->

<!-- Page Heading -->
<!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> -->


<!-- </div> -->
<!-- /.container-fluid -->

<!-- </div> -->
<!-- End of Main Content -->
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
                                <th>Judul</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($dtredaksi as $tj) : ?>
                            <tr class="text-center">
                                <td class="py-0 align-middle"><?= $no++; ?></td>
                                <td class="py-1 align-middle text-center"><?= $tj['judul']; ?></td>

                                <!-- Action -->
                                <td class="py-1 align-middle text-center" width="10%">
                                    <a href="<?= base_url('admin/detailRedaksi/') . $tj['id_redaksi']; ?>"><span
                                            class="bg-success rounded py-1 pl-1 pr-0"><i
                                                class="fa fa-info-circle text-light mx-1"></i></span></a>

                                    <a href="<?= base_url('admin/editRedaksi/') . $tj['id_redaksi']; ?>"><span
                                            class="bg-primary rounded py-1 pl-1 pr-0"><i
                                                class="fa fa-edit text-light mx-1"></i></span></a>

                                    <!-- Action Hapus Akun Admin -->
                                    <a href="<?= base_url('admin/hapusRedaksi/') . $tj['id_redaksi']; ?>"
                                        class="tombol-delete-user" data-toggle="modal"
                                        data-target="#hapusAdmin<?= $tj['id_redaksi']; ?>"><span
                                            class="bg-danger rounded p-1"><i
                                                class="fa fa-trash text-light mx-1"></i></span></a>

                                    <!-- modal hapus akun admin -->
                                    <div class="modal fade" id="hapusAdmin<?= $tj['id_redaksi']; ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="hapusAdminLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title font-weight-bold" id="hapusAdminLabel">
                                                        Hapus Data Admin
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body"> Apakah anda yakin ingin menghapus judul
                                                    <b><?= $tj['judul']; ?></b> ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="<?= base_url('admin/hapusRedaksi/') . $tj['id_redaksi']; ?>"
                                                        class="btn btn-primary"><i class="fa fa-trash"> Hapus</i></a>
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

<!-- Modal Tambah Data Tahun Ajaran -->
<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Redaksi Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/addRedaksi'); ?>" method="post">
                    <div class="form-group">
                        <label for="judul" style="font-weight: bold;">Judul Redaksi</label>
                        <input type="text" name="judul" class="form-control" id="exampleInputUsername" required>
                    </div>
                    <div class="form-group">
                        <label for="isi" style="font-weight: bold;">Isi Redaksi</label>
                        <textarea class="ckeditor" id="ckedtor" name="isi_redaksi" id="exampleInputUsername"
                            required></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"> Simpan</i></button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript" src="<?= base_url('assets/ckeditor/ckeditor.js'); ?>"></script>