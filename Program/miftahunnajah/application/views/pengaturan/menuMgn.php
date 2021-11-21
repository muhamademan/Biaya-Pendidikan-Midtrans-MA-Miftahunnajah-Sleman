<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> -->

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="col-md-7 mb-5">
            <?= $this->session->flashdata('message'); ?>
            <div class="card shadow">
                <div class="card-header bg-primary border-bottom-warning py-2">
                    <div class="row">
                        <div class="col">
                            <span class="text-light"></span>
                        </div>
                        <div class="col text-right">
                            <button class="btn btn-success py-0" data-toggle="modal"
                                data-target="#newMenu">Tambah</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Menu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($menu as $mm) : ?>
                                <tr class="text-center">
                                    <td class="py-0 align-middle"><?= $no++; ?></td>
                                    <td class="py-1 align-middle text-left"><?= $mm['menu']; ?></td>

                                    <!-- Action -->
                                    <td class="py-1 align-middle text-center" width="20%">
                                        <!-- Ubah Menu Management -->
                                        <a href="<?= base_url('pengaturan/editMenu/') . $mm['id']; ?>"
                                            data-toggle="modal" data-target="#editMenu<?= $mm['id'] ?>"><span
                                                class="bg-success rounded py-1 pl-1 pr-0"><i
                                                    class="fa fa-edit text-light mx-1"></i></span></a>

                                        <!-- Modal Edit Menu Management -->
                                        <div class="modal fade" id="editMenu<?= $mm['id'] ?>" tabindex="-1"
                                            role="dialog" aria-labelledby="editMenuLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-md" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title font-weight-bold" id="editMenuLabel">Edit
                                                            Menu Management
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?= base_url('pengaturan/editMenu'); ?>"
                                                            method="post">
                                                            <div class="form-group">
                                                                <input type="hidden" name="id"
                                                                    value="<?= $mm['id']; ?>">
                                                                Menu Management
                                                                <input name="menu" type="text" class="form-control mt-2"
                                                                    id="NamaMenu" value="<?= $mm['menu']; ?>"
                                                                    placeholder="Nama menu">
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

                                        <!-- Hapus Menu Management -->
                                        <a href="<?= base_url('pengaturan/hapusMenu') . $mm['id']; ?>"
                                            class="tombol-delete-user" data-toggle="modal"
                                            data-target="#hapusMenu<?= $mm['id'] ?>"><span
                                                class="bg-danger rounded p-1"><i
                                                    class="fa fa-trash text-light mx-1"></i></span></a>

                                        <div class="modal fade" id="hapusMenu<?= $mm['id'] ?>" tabindex="-1"
                                            role="dialog" aria-labelledby="hapusMenuLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-md" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title font-weight-bold" id="hapusMenuLabel">
                                                            Hapus Menu Management
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body"> Apakah anda yakin ingin menghapus menu
                                                        <b><?= $mm['menu']; ?></b> ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <!-- <button type="button" class="btn btn-success">Hapus</button> -->
                                                        <a href="<?= base_url('pengaturan/hapusMenu/') . $mm['id']; ?>"
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

<!-- Modal Tambah Menu Management -->
<div class="modal fade" id="newMenu" tabindex="-1" role="dialog" aria-labelledby="newMenuLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuLabel">Tambah Menu Management</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('pengaturan/addMenu'); ?>" method="post">
                    <div class="form-group">
                        <label for="exampleInputUsername" class="font-weight-bold">Menu Management</label>
                        <input type="text" name="menu" class="form-control" id="exampleInputUsername"
                            placeholder="Nama menu" required>
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