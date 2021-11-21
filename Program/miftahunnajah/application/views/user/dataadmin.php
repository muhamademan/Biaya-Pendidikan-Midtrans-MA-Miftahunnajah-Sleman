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
                                <th>Gambar</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>No.Telp</th>
                                <th>Posisi</th>
                                <th>Status</th>
                                <th>Jenis Kelamin</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($dtuser as $us) : ?>
                            <tr class="text-center">
                                <td class="py-0 align-middle"><?= $no++; ?></td>
                                <td class="py-1 align-middle"><img
                                        src="<?= base_url('assets/img/profile/') . $us['image']; ?>"
                                        class="card-img m-2" alt="..." style="max-width: 30px"></td>
                                <td class="py-1 align-middle text-left"><?= $us['name']; ?></td>
                                <td class="py-1 align-middle text-left"><?= $us['email']; ?></td>
                                <td class="py-1 align-middle text-left"><?= $us['no_hp']; ?></td>
                                <td class="py-1 align-middle text-left"><?= $us['role']; ?></td>
                                <?php if ($us['is_active'] == 1) : ?>
                                <td class="py-1 align-middle text-center"><span
                                        class="badge bg-success text-white">Active</span></td>
                                <?php endif; ?>
                                <?php if ($us['is_active'] == 0) : ?>
                                <td class="py-1 align-middle text-center"><span class="badge bg-danger text-white">Tidak
                                        Aktive</span>
                                </td>
                                <?php endif; ?>
                                <td class="py-1 align-middle text-left"><?= $us['jenis_kelamin']; ?></td>

                                <!-- Action Edit Akun Admin -->
                                <td class="py-1 align-middle text-center" width="10%">
                                    <a href="<?= base_url('user/editAdmin/') . $us['id']; ?>"><span
                                            class="bg-success rounded py-1 pl-1 pr-0"><i
                                                class="fa fa-edit text-light mx-1"></i></span></a>

                                    <!-- Action Hapus Akun Admin -->
                                    <a href="<?= base_url('user/deleteadmin/') . $us['id']; ?>"
                                        class="tombol-delete-user" data-toggle="modal"
                                        data-target="#hapusAdmin<?= $us['id'] ?>"><span class="bg-danger rounded p-1"><i
                                                class="fa fa-trash text-light mx-1"></i></span></a>

                                    <!-- modal hapus akun admin -->
                                    <div class="modal fade" id="hapusAdmin<?= $us['id'] ?>" tabindex="-1" role="dialog"
                                        aria-labelledby="hapusAdminLabel" aria-hidden="true">
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
                                                <div class="modal-body"> Apakah anda yakin ingin menghapus akun
                                                    <b><?= $us['name']; ?></b> ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <!-- <button type="submit" class="btn btn-success">Hapus</button> -->
                                                    <a href="<?= base_url('user/deleteadmin/') . $us['id']; ?>"
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

<!-- Modal Tambah Akun Admin-->
<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Akun Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('user/addadmin'); ?>" method="post">
                    <div class="form-group">
                        <label for="peran">Posisi</label>
                        <select class="form-control" name="role_id" id="peran" required>
                            <option value="" selected disabled>--Pilih Posisi--</option>
                            <?php foreach ($usrole as $ur) : ?>
                            <option value="<?= $ur['id'] ?>"><?= $ur['role'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" id="exampleInputUsername" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail">Email</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername">No.Telp</label>
                        <input type="number" name="no_hp" class="form-control" id="exampleInputUsername" required>
                    </div>
                    <!-- <div class="form-group">
                        <label for="exampleInputUsername">Jenis Kelamin</label>
                        <input type="text" name="jenis_kelamin" class="form-control" id="exampleInputUsername" required>
                    </div> -->
                    <div class="form-group">
                        <label for="exampleInputUsername">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="exampleInputUsername" class="form-control" required>
                            <option value="" selected disabled>---Pilih Jenis Kelamin---</option>
                            <option value="1">Laki-Laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword" required>
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