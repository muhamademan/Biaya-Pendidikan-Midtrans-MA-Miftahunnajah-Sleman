<script type="text/javascript" src="<?= base_url('assets/ckeditor/ckeditor.js'); ?>"></script>
<!-- <script src="<?= base_url('assets//cdn.ckeditor.com/4.16.0/full/ckeditor.js'); ?>"></script> -->
<div class="container-fluid">
    <div class="col-lg">
        <div class="card shadow">
            <div class="card-header bg-primary border-bottom-warning">
                <span class="text-light">Edit Redaksi Pemberitahuan Pembayaran</span>
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/proseseditRedaksi/') ?>" method="post">
                    <input type="hidden" name="id_redaksi" value="<?= $dtredaksi['id_redaksi']; ?>">
                    <div class="form-group">
                        <label for="judul" style="font-weight: bold;">Judul Redaksi</label>
                        <input type="text" name="judul" class="form-control" value="<?= $dtredaksi['judul']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="isi" style="font-weight: bold;">Isi Redaksi</label>
                        <textarea class="ckeditor" id="ckedtor"
                            name="isi_redaksi"><?= $dtredaksi['isi_redaksi']; ?></textarea>
                    </div>

                    <div class="mt-3">
                        <a href="<?= base_url('admin/redaksi') ?>" class="btn btn-secondary py-0"><i
                                class="fa fa-backward"> Kembali</i></a>
                        <button type="submit" class="btn btn-primary py-0"><i class="fa fa-save"> Simpan</i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>