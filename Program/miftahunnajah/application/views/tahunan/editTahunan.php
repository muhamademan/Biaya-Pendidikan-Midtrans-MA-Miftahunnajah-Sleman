<div class="container-fluid">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary border-bottom-warning">
                <span class="text-light">Edit Biaya Tahunan</span>
            </div>
            <div class="card-body">
                <form action="<?= base_url('master/prosesTahunan') ?>" method="post">
                    <input type="hidden" name="id_tahunan" value="<?= $bayar_tahunan['id_tahunan']; ?>">
                    <div class="form-group">
                        <label for="thajaran">Tahun Ajaran</label>
                        <select class="form-control" id="thajaran" name="id_tahun">
                            <?php foreach ($th_ajaran as $s) : ?>
                            <option value="<?= $s['id_tahun'] ?>" <?php
                                                                        if ($s['id_tahun'] == $bayar_tahunan['id_tahun']) :
                                                                            echo "selected";
                                                                        endif;
                                                                        ?>><?= $s['tahun_ajaran'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="NamaKelas">Biaya SPP</label>
                        <input name="biaya_tahunan" type="text" class="form-control" id="NamaKelas"
                            value="<?= $bayar_tahunan['biaya_tahunan']; ?>">
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
                        <a href="<?= base_url('master/bayar_tahunan') ?>" class="btn btn-secondary py-0">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>