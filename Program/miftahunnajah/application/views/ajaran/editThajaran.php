<div class="container-fluid">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary border-bottom-warning">
                <span class="text-light">Edit Tahun Ajaran</span>
            </div>
            <div class="card-body">
                <form action="<?= base_url('master/prosesThajaran') ?>" method="post">
                    <input type="hidden" name="id_tahun" value="<?= $edit_ajaran['id_tahun']; ?>">
                    <div class="form-group">
                        <label for="NamaKelas">Tahun Ajaran</label>
                        <input name="tahun_ajaran" type="text" class="form-control" id="NamaKelas"
                            value="<?= $edit_ajaran['tahun_ajaran']; ?>" placeholder="Masukan tahun ajaran">
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Biaya SPP</label>
                        <input name="besar_spp" type="text" class="form-control" id="NamaKelas"
                            value="<?= $edit_ajaran['besar_spp']; ?>" placeholder="Biaya Spp">
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Biaya Tahunan</label>
                        <input name="besar_tahunan" type="text" class="form-control" id="NamaKelas"
                            value="<?= $edit_ajaran['besar_tahunan']; ?>" placeholder="Biaya Tahunan">
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Biaya Bangunan</label>
                        <input name="besar_bangunan" type="text" class="form-control" id="NamaKelas"
                            value="<?= $edit_ajaran['besar_bangunan']; ?>" placeholder="Biaya Bangunan">
                    </div>
                    <div class="form-group">
                        <label>Pilih Status</label><br>
                        &nbsp<input type="radio" name="status" id="ON" class="with-gap" value="ON" required>
                        <label for="ON" class="m-l-20">ON</label>
                        <input type="radio" name="status" id="OFF" class="with-gap" value="OFF" required>
                        <label for="OFF" class="m-l-20">OFF</label>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary py-0">Simpan</button>
                        <a href="<?= base_url('master/dataajaran') ?>" class="btn btn-secondary py-0">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>