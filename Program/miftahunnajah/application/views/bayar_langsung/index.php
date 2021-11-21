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
                                <th>NIS</th>
                                <th>Nama Lengkap</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($dtsiswa as $ds) : ?>
                            <tr class="text-center">
                                <td class="py-0 align-middle"><?= $no++; ?></td>
                                <td class="py-1 align-middle"><img
                                        src="<?= base_url('assets/img/profile/') . $ds['image']; ?>"
                                        class="card-img m-2" alt="..." style="max-width: 30px"></td>
                                <td class="py-1 align-middle text-left"><?= $ds['nis']; ?></td>
                                <td class="py-1 align-middle text-left"><?= $ds['nama']; ?></td>
                                <?php if ($ds['is_active'] == 1) : ?>
                                <td class="py-1 align-middle text-center"><span
                                        class="badge bg-success text-white">Active</span></td>
                                <?php endif; ?>
                                <?php if ($ds['is_active'] == 0) : ?>
                                <td class="py-1 align-middle text-center"><span class="badge bg-danger text-white">Tidak
                                        Aktive</span>
                                </td>
                                <?php endif; ?>

                                <!-- Action button detail-->
                                <td class="py-1 align-middle text-center" width="10%">
                                    <a href="<?= base_url('bayar_ditempat/detail/') . $ds['id_siswa']; ?>"><span
                                            class="btn btn-outline-info">Detail</span></a>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('master/addsiswa'); ?>" method="post">
                    <div class="form-group">
                        <label for="exampleInputUsername" class="font-weight-bold">NIS Siswa</label>
                        <input type="text" name="nis" class="form-control" id="exampleInputUsername"
                            placeholder="Masukan NIS" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername" class="font-weight-bold">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" id="exampleInputUsername"
                            placeholder="Masukan nama" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail" class="font-weight-bold">Email</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail"
                            placeholder="Masukan email" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail" class="font-weight-bold">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control" id="exampleInputEmail"
                            placeholder="Masukan tanggal lahir" required>
                    </div>
                    <div class="form-group">
                        <label for="laki-laki" class="font-weight-bold">Jenis Kelamin</label><br>
                        &nbsp<input type="radio" name="jenis_kelamin" id="laki-laki" class="with-gap" value="laki-laki">
                        <label for="laki-laki" class="m-l-20">Laki-Laki</label>
                        <input type="radio" name="jenis_kelamin" id="perempuan" class="with-gap" value="perempuan">
                        <label for="perempuan" class="m-l-20">perempuan</label>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail" class="font-weight-bold">Nama Wali</label>
                        <input type="text" name="nama_wali" class="form-control" id="exampleInputEmail"
                            placeholder="Masukan nama wali" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail" class="font-weight-bold">No.Telepon</label>
                        <input type="text" name="no_hp" class="form-control" id="exampleInputEmail"
                            placeholder="Masukan no.telp" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail" class="font-weight-bold">Alamat Siswa</label>
                        <input type="text" name="alamat" class="form-control" id="exampleInputEmail"
                            placeholder="Masukan alamat siswa" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail" class="font-weight-bold">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputEmail"
                            placeholder="Masukan password" required>
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