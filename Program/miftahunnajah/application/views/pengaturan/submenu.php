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
                            <button class="btn btn-success py-0" data-toggle="modal" data-target="#newSubmenu">Tambah
                                Submenu</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Menu</th>
                                    <th>Url</th>
                                    <th>Icon</th>
                                    <th>Active</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($subMenu as $sm) : ?>
                                <tr class="text-center">
                                    <td class="py-0 align-middle"><?= $no++; ?></td>
                                    <td class="py-1 align-middle text-left"><?= $sm['title']; ?></td>
                                    <td class="py-1 align-middle text-left"><?= $sm['menu']; ?></td>
                                    <td class="py-1 align-middle text-left"><?= $sm['url']; ?></td>
                                    <td class="py-1 align-middle text-left"><?= $sm['icon']; ?></td>
                                    <!-- <td class="py-1 align-middle text-center"><?= $sm['is_active']; ?></td> -->
                                    <?php if ($sm['is_active'] == 1) : ?>
                                    <td class="py-1 align-middle text-center"><span
                                            class="badge bg-success text-white">ON</span>
                                    </td>
                                    <?php endif; ?>
                                    <?php if ($sm['is_active'] == 0) : ?>
                                    <td class="py-1 align-middle text-center"><span
                                            class="badge bg-danger text-white">OFF</span>
                                    </td>
                                    <?php endif; ?>

                                    <!-- Action -->
                                    <td class="py-1 align-middle text-center" width="20%">
                                        <!-- Ubah Submenu Management -->
                                        <a href="<?= base_url('pengaturan/editSubmenu/') . $sm['id']; ?>"
                                            data-toggle="modal" data-target="#editSubmenu<?= $sm['id'] ?>"><span
                                                class="bg-success rounded py-1 pl-1 pr-0"><i
                                                    class="fa fa-edit text-light mx-1"></i></span></a>

                                        <!-- Modal Edit Submenu Management -->
                                        <div class="modal fade" id="editSubmenu<?= $sm['id'] ?>" tabindex="-1"
                                            role="dialog" aria-labelledby="editMenuLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-md" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title font-weight-bold" id="editMenuLabel">Edit
                                                            Submenu Management
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?= base_url('pengaturan/editSubmenu'); ?>"
                                                            method="post">
                                                            <input type="hidden" name="id" value="<?= $sm['id']; ?>">
                                                            <div class="form-group">
                                                                <input name="title" type="text"
                                                                    class="form-control mt-2" id="NamaMenu"
                                                                    value="<?= $sm['title']; ?>"
                                                                    placeholder="Title submenu" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <select name="menu_id" id="menu_id" class="form-control"
                                                                    required>
                                                                    <option value="" selected disabled>
                                                                        <?= $sm['menu']; ?></option>
                                                                    <?php foreach ($menu as $m) : ?>
                                                                    <option value="<?= $m['id']; ?>"><?= $m['menu']; ?>
                                                                    </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <input name="url" type="text" class="form-control mt-2"
                                                                    id="NamaMenu" value="<?= $sm['url']; ?>"
                                                                    placeholder="Alamat url" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <input name="icon" type="text" class="form-control mt-2"
                                                                    id="NamaMenu" value="<?= $sm['icon']; ?>"
                                                                    placeholder="Icon submenu" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <!-- <label for="NamaKelas">Status Submenu</label> -->
                                                                <select name="is_active" id="NamaStatus"
                                                                    class="form-control">
                                                                    <option value="" selected disabled>--Pilih Status--
                                                                    </option>
                                                                    <option value="0">Tidak Aktif</option>
                                                                    <option value="1">Aktif</option>
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

                                        <!-- Hapus Submenu Management -->
                                        <a href="<?= base_url('pengaturan/hapusSubmenu/') . $sm['id']; ?>"
                                            class="tombol-delete-user" data-toggle="modal"
                                            data-target="#hapusSubmenu<?= $sm['id'] ?>"><span
                                                class="bg-danger rounded p-1"><i
                                                    class="fa fa-trash text-light mx-1"></i></span></a>

                                        <div class="modal fade" id="hapusSubmenu<?= $sm['id'] ?>" tabindex="-1"
                                            role="dialog" aria-labelledby="hapusSubmenuLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-md" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title font-weight-bold" id="hapusSubmenuLabel">
                                                            Hapus Submenu Management
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body"> Apakah anda yakin ingin menghapus submenu
                                                        <b><?= $sm['title']; ?></b> ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <!-- <button type="submit" class="btn btn-success">Hapus</button> -->
                                                        <a href="<?= base_url('pengaturan/hapusSubmenu/') . $sm['id']; ?>"
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

<!-- Modal Tambah Submenu Management -->
<div class="modal fade" id="newSubmenu" tabindex="-1" role="dialog" aria-labelledby="newSubmenuLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubmenuLabel">Tambah Submenu Management</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('pengaturan/subMenu'); ?>" method="post">
                    <div class="form-group">
                        <!-- <label for="exampleInputUsername" class="font-weight-bold">Title Submenu</label> -->
                        <input type="text" name="title" class="form-control" id="exampleInputUsername"
                            placeholder="Title submenu" required>
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Pilih Menu</option>
                            <?php foreach ($menu as $m) : ?>
                            <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="url" class="form-control" id="exampleInputUsername"
                            placeholder="Alamat url" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="icon" class="form-control" id="exampleInputUsername"
                            placeholder="Icon submenu" required>
                    </div>
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
<script type="text/javascript">
$(document).ready(function() {
    $('.bootstrap-select').selectpicker();
});
</script>