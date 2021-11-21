<div class="container-fluid">
    <div class="col-md-12 mb-5">
        <?= $this->session->flashdata('message'); ?>
        <div class="card shadow">
            <div class="card-header bg-primary border-bottom-warning py-3">
                <div class="row">
                </div>
            </div>
            <form action="<?= base_url('pesan/sendmsg') ?>" method="post" class="form-horizontal">

                <fieldset>
                    <!-- <div class="form-group">
                        <label for="inputEmail" class="col-lg-3 control-label">No Tujuan</label>
                        <div class="col-lg-12">
                            <select name="to" id="to" class="form-control" required>
                                <option value="" selected disabled>Pilih No.Telp</option>
                                <?php foreach ($no_hp as $hp) : ?>
                                <option value="<?= $hp['id_siswa']; ?>"><?= $hp['no_hp']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <?php echo form_error('to', '<span class="text-danger">', '</span>') ?>
                        </div>
                    </div> -->


                    <div class="form-group">
                        <label for="inputEmail" class="col-lg-3 control-label">No Tujuan</label>
                        <div class="col-lg-12">
                            <input type="text" name="to" class="form-control" placeholder="Masukan Nomor Hp" required>
                        </div>
                        <div class="col-md-12">
                            <?php echo form_error('to', '<span class="text-danger">', '</span>') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail" class="col-lg-5 control-label">Pesan Informasi</label>
                        <div class="col-lg-12">
                            <textarea name="message" class="form-control" rows="6" placeholder="Masukan Informasi"
                                required></textarea>
                        </div>
                        <div class="col-md-12">
                            <?php echo form_error('message', '<span class="text-danger">', '</span>') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-outline-secondary"><span
                                    class="fa fa-window-close"></span> Bersihkan</button>
                            <button type="submit" class="btn btn-outline-success"><span class="fa fa-send"></span>
                                Kirim</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>