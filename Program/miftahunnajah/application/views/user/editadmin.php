<div class="container-fluid">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary border-bottom-warning">
                <span class="text-light">Edit Admin Pelatihan</span>
            </div>
            <div class="card-body">
                <form action="<?= base_url('user/proseseditAdmin/') ?>" method="post">
                    <input type="hidden" name="id" value="<?= $edit_user['id']; ?>">
                    <div class="form-group">
                        <label for="peran">Posisi</label>
                        <select class="form-control" name="role_id" id="peran">
                            <!-- <option value="" selected disabled>--Pilih Posisi--</option> -->
                            <?php foreach ($edit_role as $ur) : ?>
                            <option value="<?= $ur['id'] ?>"><?= $ur['role'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Nama Lengkap</label>
                        <input name="name" type="text" class="form-control" id="NamaKelas"
                            value="<?= $edit_user['name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Username</label>
                        <input name="email" type="text" class="form-control" id="NamaKelas"
                            value="<?= $edit_user['email']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="exampleInputUsername" class="form-control" required>
                            <!-- <option value="" selected disabled>---Pilih Jenis Kelamin---</option> -->
                            <option value="" selected><?= $edit_user['jenis_kelamin']; ?></option>
                            <option value="1">Laki-Laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">No.Telp</label>
                        <input name="no_hp" type="number" class="form-control" id="NamaKelas"
                            value="<?= $edit_user['no_hp']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Status</label>
                        <select name="is_active" id="NamaStatus" class="form-control">
                            <option value="" selected disabled>--Pilih Status--</option>
                            <option value="0">Tidak Aktif</option>
                            <option value="1">Aktif</option>
                        </select>
                        <!-- <input name="is_active" type="radio" class="form-control" id="NamaKelas"
                            value="<?= $edit_user['is_active']; ?>"> -->
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary py-0">Simpan</button>
                        <a href="<?= base_url('user/dataadmin') ?>" class="btn btn-secondary py-0">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>