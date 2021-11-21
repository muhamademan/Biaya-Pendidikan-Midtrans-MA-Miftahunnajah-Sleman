<div class="container-fluid">
    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-2 text-gray-800">Tabel <?= $title; ?></h1> -->
    <!-- DataTales Example -->
    <div class="card-header shadow bg-primary border-bottom-warning py-3 col-6">
        <div class="row">
        </div>
    </div>
    <div class="card col-6 shadow mb-4">
        <div class="card-body col-12">
            <div class="container">
                <link rel="stylesheet" href="<?php echo base_url('assets/vendor/jquery/jquery-ui.min.css'); ?>" />
                <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
                <!-- Load file jquery -->
                <form method="get" action="" class="form">
                    <div class="form-group">
                        <label>Filter Berdasarkan</label>
                        <select class="form-control" name="filter" id="filter" style="width: 50%">
                            <option value="">Pilih Salah Satu</option>
                            <option value="1">Tanggal</option>
                            <option value="2">Siswa Miftahunnajah</option>
                            <option value="3">Tahun Ajaran</option>
                        </select>
                    </div>
                    <div class="form-group" id="form-tanggal">
                        <label>Dari Tanggal</label>
                        <input type="date" name="tanggal" class="form-control input-tanggal" style="width: 50%" />
                    </div>
                    <div class="form-group" id="form-tanggal2">
                        <label>Sampai Tanggal</label>
                        <input type="date" name="tanggal2" class="form-control input-tanggal2" style="width: 50%" />
                    </div>
                    <div class="form-group" id="form-nis">
                        <label>NIS/Nama Siswa</label>
                        <select name="nis" class="bootstrap-select strings" style="width: 50%" data-actions-box="true"
                            data-virtual-scroll="false" data-live-search="true">
                            <option value="" selected disabled>Pilih</option>
                            <?php
                            foreach ($nis as $data) { // Ambil data tahun dari model yang dikirim dari controller
                                echo '<option value="' . $data->nis . '">' . $data->nis . ' | ' . $data->nama . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" id="form-tahun">
                        <label>Tahun Ajaran</label>
                        <select name="tahun" class="bootstrap-select strings" style="width: 50%" data-actions-box="true"
                            data-virtual-scroll="false" data-live-search="true">
                            <option value="" selected disabled>Pilih</option>
                            <?php
                            foreach ($tahun as $data) { // Ambil data tahun dari model yang dikirim dari controller
                                echo '<option value="' . $data->id_tahun . '">' . $data->tahun_ajaran . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"> Tampilkan</i></button>
                    <a href="<?php echo base_url() . "laporan_tahunan/lap_tahunan"; ?>" class="btn btn-success mb-0"><i
                            class="fas fa-refresh"></i></a>
                </form>
            </div>
        </div>
    </div>

    <div class="card-header shadow bg-primary border-bottom-warning py-3">
        <div class="row">
        </div>
    </div>
    <div class="card shadow mb-4">
        <!-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger"><?php echo $ket; ?></h6>
        </div> -->
        <div class="card-body">
            <a href="<?php echo $url_cetak; ?>" target="_blank" class=" btn btn-danger mb-3"><i
                    class="fas fa-file-pdf"></i>
                Print</a>
            <!-- <a href="<?php echo $url_cetak; ?> class=" btn btn-danger mb-4"><i class="fas fa-file-pdf"></i> Download pdf</a> -->
            <!-- <a href="<?php echo base_url() . "laporan_tahunan/tahunan"; ?>"><i class="fas fa-refresh"></i>
                Refresh</a> -->
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead style="text-align: center">
                        <tr>
                            <th style="text-align: center;">NO</th>
                            <th style="text-align: center;">ID Transaksi</th>
                            <th style="text-align: center;">NIS</th>
                            <th style="text-align: center;">Nama</th>
                            <th style="text-align: center;">Bulan</th>
                            <th style="text-align: center;">Tanggal</th>
                            <th style="text-align: center;">Metode Pembayaran</th>
                            <th style="text-align: center;">Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($pembayaran_tahunan)) {
                            $no = 1;
                            foreach ($pembayaran_tahunan as $data) {
                        ?>
                        <tr>
                            <td style="text-align: center;"><?php echo $no++ ?></td>
                            <td style="text-align: center;"><?php echo $data->id_transaksi ?></td>
                            <td style="text-align: center;"><?php echo $data->nis ?></td>
                            <td style="text-align: center;"><?php echo $data->nama ?></td>
                            <?php
                                    if ($data->id_bulan <= 12) {
                                        $tahun = substr($data->tahun_ajaran, 0, 4);
                                    } else {
                                        $tahun = substr($data->tahun_ajaran, 0, 4);
                                    }
                                    ?>
                            <td style="text-align: center;"><?php echo $data->nama_bulan . ' ' . $tahun ?></td>
                            <td style="text-align: center;">
                                <?php echo date('d-m-Y', strtotime($data->tgl_bayar)); ?></td>
                            <td style="text-align: center;"><?php echo $data->metode_pembayaran ?></td>
                            <td style="text-align: center;">
                                <?php echo 'Rp. ' . number_format($data->besar_tahunan, 0, ',', '.'); ?></td>
                        </tr>
                        <?php }
                        }
                        ?>
                    </tbody>
                    <script src="<?php echo base_url('assets/vendor/jquery/jquery-ui.min.js'); ?>"></script>
                    <!-- Load file plugin js jquery-ui -->
                    <script>
                    $(document).ready(function() { // Ketika halaman selesai di load
                        $('#form-tanggal, #form-tanggal2, #form-nis, #form-tahun')
                            .hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya
                        $('#filter').change(function() { // Ketika user memilih filter
                            if ($(this).val() == '1') { // Jika filter nya 1 (per tanggal)
                                $('#form-nis, #form-bulan, #form-tahun').hide();
                                $('#form-tanggal').show(); // Tampilkan form tanggal
                                $('#form-tanggal2').show(); // Tampilkan form tanggal
                            } else if ($(this).val() == '2') { // Jika filter nya 2 (per bulan)
                                $('#form-tanggal, #form-tanggal2, #form-bulan, #form-tahun').hide();
                                $('#form-nis').show(); // Tampilkan form bulan dan tahun
                            } else if ($(this).val() == '3') { // Jika filter nya 2 (per bulan)
                                $('#form-tanggal, #form-tanggal2, #form-nis').hide();
                                $('#form-tahun').show(); // Tampilkan form bulan dan tahun
                            } else { // Jika filternya 3 (per tahun)
                                $('#form-tanggal, #form-tanggal2, #form-nis, #form-tahun').hide();
                            }
                            $('#form-tanggal input, #form-bulan select, #form-tahun select').val(
                                ''); // Clear data pada textbox tanggal, combobox bulan & tahun
                        })
                    })
                    </script>
                </table>
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