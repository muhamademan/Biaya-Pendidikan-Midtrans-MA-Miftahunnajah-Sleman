<div class="container-fluid">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary border-bottom-warning">
                <span class="text-light">Edit Admin Pelatihan</span>
            </div>
            <div class="card-body">
                <form action="<?= base_url('master/proseseditSiswa/') ?>" method="post">
                    <input type="hidden" name="id_siswa" value="<?= $ubah_siswa['id_siswa']; ?>">
                    <div class="form-group">
                        <label for="NamaKelas">NIS</label>
                        <input name="nis" type="text" class="form-control" id="NamaKelas"
                            value="<?= $ubah_siswa['nis']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="Kelas">Kelas</label>
                        <select class="form-control" name="id_kelas" id="Kelas" required>
                            <option value="" selected disabled>--Pilih Kelas--</option>
                            <?php foreach ($ubah_kelas as $uh) : ?>
                            <option value="<?= $uh['id_kelas']; ?>"><?= $uh['nama_kelas']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Nama Lengkap</label>
                        <input name="nama" type="text" class="form-control" id="NamaKelas"
                            value="<?= $ubah_siswa['nama']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Email</label>
                        <input name="email" type="email" class="form-control" id="NamaKelas"
                            value="<?= $ubah_siswa['email']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="exampleInputUsername" class="form-control" required>
                            <!-- <option value="" selected disabled>---Pilih Jenis Kelamin---</option> -->
                            <option value="" selected><?= $ubah_siswa['jenis_kelamin']; ?></option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Tanggal Lahir</label>
                        <input name="tgl_lahir" type="date" class="form-control" id="NamaKelas"
                            value="<?= $ubah_siswa['tgl_lahir']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Nama Wali</label>
                        <input name="nama_wali" type="text" class="form-control" id="NamaKelas"
                            value="<?= $ubah_siswa['nama_wali']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">No.Telp</label>
                        <input name="no_hp" type="number" class="form-control" id="NamaKelas"
                            value="<?= $ubah_siswa['no_hp']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Alamat</label>
                        <input name="alamat" type="text" class="form-control" id="NamaKelas"
                            value="<?= $ubah_siswa['alamat']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Status</label>
                        <select name="is_active" id="NamaStatus" class="form-control" required>
                            <option value="" selected disabled>--Pilih Status--</option>
                            <option value="0">Tidak Aktif</option>
                            <option value="1">Aktif</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary py-0">Simpan</button>
                        <a href="<?= base_url('master/datasiswa') ?>" class="btn btn-secondary py-0">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>