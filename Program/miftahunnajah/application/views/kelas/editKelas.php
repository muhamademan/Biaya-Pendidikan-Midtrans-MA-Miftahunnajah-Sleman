<div class="container-fluid">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary border-bottom-warning">
                <span class="text-light">Edit Kelas</span>
            </div>
            <div class="card-body">
                <form action="<?= base_url('data_kelas/proseseditKelas/') ?>" method="post">
                    <input type="hidden" name="id_kelas" value="<?= $ubahKelas['id_kelas']; ?>">
                    <div class="form-group">
                        <label for="NamaKelas">Nama Kelas</label>
                        <input name="nama_kelas" type="text" class="form-control" id="NamaKelas"
                            value="<?= $ubahKelas['nama_kelas']; ?>">
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary py-0">Simpan</button>
                        <a href="<?= base_url('data_kelas/datakelas') ?>" class="btn btn-secondary py-0">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>