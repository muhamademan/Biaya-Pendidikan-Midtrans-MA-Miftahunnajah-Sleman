<div class="alert alert-warning alert-dismissible fade show mr-4 ml-4" role="alert">
    <strong>Perhatian!</strong> Pastikan pada saat menambahkan data siswa, <b>No.Induk Siswa</b> berbeda dengan siswa
    lain.
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
                                <th>Gambar</th>
                                <th>No.Induk Siswa</th>
                                <th>Kelas</th>
                                <th>Nama Siswa</th>
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
                                <td class="py-1 align-middle text-center"><?= $ds['nis']; ?></td>
                                <td class="py-1 align-middle text-center"><?= $ds['nama_kelas']; ?></td>
                                <td class="py-1 align-middle text-center"><?= $ds['nama']; ?></td>
                                <?php if ($ds['is_active'] == 1) : ?>
                                <td class="py-1 align-middle text-center"><span
                                        class="badge bg-success text-white">Active</span></td>
                                <?php endif; ?>
                                <?php if ($ds['is_active'] == 0) : ?>
                                <td class="py-1 align-middle text-center"><span class="badge bg-danger text-white">Tidak
                                        Aktive</span>
                                </td>
                                <?php endif; ?>

                                <!-- Action -->
                                <td class="py-1 align-middle text-center" width="10%">

                                    <a href="<?= base_url('master/detailSiswa/') . $ds['id_siswa']; ?>"><span
                                            class="bg-warning rounded py-1 pl-1 pr-0"><i
                                                class="fa fa-th-list text-light mx-1"></i></span></a>

                                    <a href="<?= base_url('master/ubahSiswa/') . $ds['id_siswa']; ?>"><span
                                            class="bg-success rounded py-1 pl-1 pr-0"><i
                                                class="fa fa-edit text-light mx-1"></i></span></a>

                                    <!-- Action Hapus Akun Siswa -->
                                    <a href="<?= base_url('master/hapusSiswa/') . $ds['id_siswa']; ?>"
                                        class="tombol-delete-user" data-toggle="modal"
                                        data-target="#hapusSiswa<?= $ds['id_siswa'] ?>"><span
                                            class="bg-danger rounded p-1"><i
                                                class="fa fa-trash text-light mx-1"></i></span></a>

                                    <!-- modal hapus akun Siswa -->
                                    <div class="modal fade" id="hapusSiswa<?= $ds['id_siswa'] ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="hapusSiswaLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title font-weight-bold" id="hapusSiswaLabel">
                                                        Hapus Data Siswa
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
                                                    <!-- <button type="submit" class="btn btn-success">Hapus</button> -->
                                                    <a href="<?= base_url('master/hapusSiswa/') . $ds['id_siswa']; ?>"
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('master/datasiswa'); ?>" method="post">
                    <div class="form-group">
                        <label for="exampleInputUsername" class="font-weight-bold">No.Induk Siswa*</label>
                        <input type="text" name="nis" class="form-control" id="exampleInputUsername"
                            placeholder="Masukan NIS" required>
                    </div>
                    <div class="form-group">
                        <label for="Kelas" class="font-weight-bold">Kelas*</label>
                        <select class="form-control" name="id_kelas" id="Kelas" required>
                            <option value="" selected disabled>--Pilih Kelas--</option>
                            <?php foreach ($dtkelas as $dt) : ?>
                            <option value="<?= $dt['id_kelas']; ?>"><?= $dt['nama_kelas']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername" class="font-weight-bold">Nama Lengkap*</label>
                        <input type="text" name="nama" class="form-control" id="exampleInputUsername"
                            placeholder="Masukan nama" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail" class="font-weight-bold">Email*</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail"
                            placeholder="Masukan email" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail" class="font-weight-bold">Tanggal Lahir*</label>
                        <input type="date" name="tgl_lahir" class="form-control" id="exampleInputEmail"
                            placeholder="Masukan tanggal lahir" required>
                    </div>
                    <div class="form-group">
                        <label for="laki-laki" class="font-weight-bold">Jenis Kelamin*</label><br>
                        &nbsp<input type="radio" name="jenis_kelamin" id="laki-laki" class="with-gap" value="laki-laki">
                        <label for="laki-laki" class="m-l-20">Laki-Laki</label>
                        <input type="radio" name="jenis_kelamin" id="perempuan" class="with-gap" value="perempuan">
                        <label for="perempuan" class="m-l-20">perempuan</label>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail" class="font-weight-bold">Nama Wali*</label>
                        <input type="text" name="nama_wali" class="form-control" id="exampleInputEmail"
                            placeholder="Masukan nama wali" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail" class="font-weight-bold">No.Telepon*</label>
                        <input type="text" name="no_hp" class="form-control" id="exampleInputEmail"
                            placeholder="Masukan no.telp" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail" class="font-weight-bold">Alamat Siswa*</label>
                        <input type="text" name="alamat" class="form-control" id="exampleInputEmail"
                            placeholder="Masukan alamat siswa" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail" class="font-weight-bold">Password*</label>
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