<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> -->

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="col-md-18 mb-5">
            <?= $this->session->flashdata('message'); ?>
            <div class="card shadow">
                <div class="card-header bg-primary border-bottom-warning py-2">
                    <div class="row">
                        <div class="col">
                            <span class="text-light"></span>
                        </div>
                        <div class="col text-right">
                            <button class="btn btn-success py-0" data-toggle="modal"
                                data-target="#newSubmenu">Tambah</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Role</th>
                                    <th>Menu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($aksesMenu as $am) : ?>
                                <tr class="text-center">
                                    <td class="py-0 align-middle"><?= $no++; ?></td>
                                    <td class="py-1 align-middle text-left"><?= $am['role']; ?></td>
                                    <td class="py-1 align-middle text-left"><?= $am['menu']; ?></td>

                                    <!-- Action -->
                                    <td class="py-1 align-middle text-center" width="20%">
                                        <!-- Ubah User Akses Menu -->
                                        <a href="<?= base_url('pengaturan/editAksesmenu/') . $am['id']; ?>"
                                            data-toggle="modal" data-target="#editAksesmenu<?= $am['id'] ?>"><span
                                                class="bg-success rounded py-1 pl-1 pr-0"><i
                                                    class="fa fa-edit text-light mx-1"></i></span></a>

                                        <!-- Modal Edit User Akses Menu -->
                                        <div class="modal fade" id="editAksesmenu<?= $am['id'] ?>" tabindex="-1"
                                            role="dialog" aria-labelledby="editAksesmenuLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-md" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title font-weight-bold"
                                                            id="editAksesmenuLabel">Edit
                                                            User Akses Menu Management
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?= base_url('pengaturan/editAksesmenu'); ?>"
                                                            method="post">
                                                            <input type="hidden" name="id" value="<?= $am['id']; ?>">
                                                            <div class="form-group">
                                                                <select name="role_id" id="role_id" class="form-control"
                                                                    required>
                                                                    <option value="" selected disabled>
                                                                        <?= $am['role']; ?></option>
                                                                    <?php foreach ($role as $r) : ?>
                                                                    <option value="<?= $r['id']; ?>"><?= $r['role']; ?>
                                                                    </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <select name="menu_id" id="menu_id" class="form-control"
                                                                    required>
                                                                    <option value="" selected disabled>
                                                                        <?= $am['menu']; ?></option>
                                                                    <?php foreach ($u_menu as $um) : ?>
                                                                    <option value="<?= $um['id']; ?>">
                                                                        <?= $um['menu']; ?>
                                                                    </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Hapus User Akses Menu -->
                                        <a href="<?= base_url('pengaturan/hapusAksesmenu/') . $am['id']; ?>"
                                            class="tombol-delete-user" data-toggle="modal"
                                            data-target="#hapusAkses<?= $am['id'] ?>"><span
                                                class="bg-danger rounded p-1"><i
                                                    class="fa fa-trash text-light mx-1"></i></span></a>

                                        <div class="modal fade" id="hapusAkses<?= $am['id'] ?>" tabindex="-1"
                                            role="dialog" aria-labelledby="hapusAksesLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-md" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title font-weight-bold" id="hapusAksesLabel">
                                                            Hapus Akses Management
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body"> Apakah anda yakin ingin menghapus akses
                                                        menu
                                                        <b><?= $am['menu']; ?></b> ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <!-- <button type="submit" class="btn btn-success">Hapus</button> -->
                                                        <a href="<?= base_url('pengaturan/hapusAksesmenu/') . $am['id']; ?>"
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

<!-- Modal Tambah User Akses Menu -->
<div class="modal fade" id="newSubmenu" tabindex="-1" role="dialog" aria-labelledby="newSubmenuLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubmenuLabel">Tambah User Akses Menu Management</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('pengaturan/aksesMenu'); ?>" method="post">
                    <div class="form-group">
                        <select name="role_id" id="role_id" class="form-control" required>
                            <option value="" selected disabled>
                                <?= $am['role']; ?></option>
                            <?php foreach ($role as $r) : ?>
                            <option value="<?= $r['id']; ?>"><?= $r['role']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control" required>
                            <option value="" selected disabled>
                                <?= $am['menu']; ?></option>
                            <?php foreach ($u_menu as $um) : ?>
                            <option value="<?= $um['id']; ?>"><?= $um['menu']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- <div class="form-group">
                        <input type="text" name="menu_id" class="form-control" id="exampleInputUsername"
                            placeholder="Menu management" required>
                    </div> -->

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" value="1" name="is_active" id="is_active"
                                checked>
                            <label for="is_active" class="form-check-label">Aktif?</label>
                        </div>
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
</div>
<!-- /.container-fluid -->