<style>
@media print {

    h3,
    .sidebar,
    #siswa,
    #cari-tunggakan,
    #cetak-tunggakan,
    hr,
    label {
        display: none;
    }

    .container-fluid {
        background-color: #fff;
    }

    .table {
        margin-bottom: 0;
    }

    .table-bordered {
        color: #000;
        border: 1px solid #000;
    }

    .card,
    .card-header {
        display: none;
    }
}
</style>





<div class="container-fluid">
    <div class="card-header shadow bg-primary border-bottom-warning py-3 col-6">
        <div class="row">
        </div>
    </div>
    <div class="card shadow mb-4 col-6">
        <div class="card-body col-12">
            <div class="container">


                <div class="form-group" id="form-nis">
                    <label>Cari Nama Siswa</label>
                    <input list="id_siswa" name="id_siswa" id="siswa" class="form-control" style="max-width: 200px"
                        placeholder="Nama Siswa" value="<?= $_GET['id_siswa'] ?? '' ?>">
                    <datalist id="id_siswa">
                        <option value="">Semua</option>
                        <?php
                        $siswa = $this->db->query("SELECT id_siswa, nama FROM siswa ORDER BY id_siswa")->result();
                        foreach ($siswa as $data) {
                            echo '<option value="' . $data->id_siswa . '">' . $data->nama . '</option>';
                        }
                        ?>
                    </datalist><br>
                    <button id="cari-tunggakan" class="btn btn-success"
                        onclick="javascript: window.location = '<?= base_url('laporan_tunggak/tunggakan_bgn?id_siswa=') ?>'+$('#siswa').val();"><i
                            class="fas fa-search"> Tampilkan</i></button>
                    <a href="<?php echo base_url('laporan_tunggak/tunggakan_bgn'); ?>"
                        class="btn btn-outline-danger mb-0"><i class="fas fa-refresh"></i></a>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <div style="<?= (isset($_GET['id_siswa']) ? 'display: block;' : 'display: none;') ?>">
        <button id="cetak-tunggakan" class="btn btn-outline-primary" onclick="print()"><i
                class="fas fa-print"></i></button>
        <center>
            <table>
                <tr>
                    <td>
                        <img src="<?= base_url('assets/img/ma.png') ?>" style="width: 130px; height: 100px;">
                    </td>
                    <td>
                        <center>
                            <h5>ISLAMIC BOARDING SCHOOL</h5>
                            <h1>MADRASAH ALIYAH MIFTAHUNNAJAH SLEMAN</h1>
                            <p>Ds. Wonorejo 01/08, Sardonoharjo, Ngaglik, Sleman, Daerah Istimewa Yogyakarta
                                55581,
                                Telp. (0274) 9107446</p>
                        </center>
                    </td>
                </tr>
            </table>
            <h4>Laporan Tunggakan Pembayaran Bangunan</h4>
        </center>
        <hr>
        <table class="table table-bordered mt-5">
            <thead>
                <tr>
                    <th style="width: 5%;text-align: center">No.</th>
                    <!-- <th style="width: 15%;text-align: center">NO. Induk Siswa</th> -->
                    <th style="width: 30%;text-align: center">Nama Siswa</th>
                    <th style="width: 10%;text-align: center">Tahun Ajaran</th>
                    <th style="width: 15%;text-align: center">Total Tagihan</th>
                    <th style="width: 20%;text-align: center">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_GET['id_siswa']) && $_GET['id_siswa'] != '')
                    $where = " AND z.id_siswa='" . $_GET['id_siswa'] . "' ";
                else
                    $where = "";
                $sql_tunggak = "SELECT z.* FROM 
                    (
                        SELECT g.*, s.nama, ta.besar_bangunan, '1' AS jenis FROM 
                        (
                            SELECT a.id_bangunan AS id_pem, a.id_siswa, a.tahun_ajaran, a.jenis_pembayaran, f.total_bangunan AS total_bayar, IFNULL(f.jml_bulan, 0) AS jml_bulan, IF(f.jml_bulan = 1, 'Lunas', 'Belum Lunas') AS status_bayar 
                            FROM biaya_bangunan a
                            LEFT JOIN 
                            (
                                SELECT e.id_siswa, e.tahun_ajaran, SUM(e.besar_bangunan) AS total_bangunan, COUNT(e.id_bulan) AS jml_bulan FROM 
                                (
                                    SELECT b.id_transaksi, b.nis, b.id_siswa, b.id_bulan,b.id_tahun,c.tahun_ajaran,b.jumlah AS besar_bangunan
                                    FROM pembayaran_bangunan b
                                    INNER JOIN tahun_ajaran c ON b.id_tahun = c.id_tahun
                                    WHERE b.status='0'
                                ) e GROUP BY e.id_siswa, e.tahun_ajaran
                            ) f ON a.id_siswa = f.id_siswa AND a.tahun_ajaran = f.tahun_ajaran
                        ) g
                        INNER JOIN siswa s ON g.id_siswa = s.id_siswa
                        INNER JOIN tahun_ajaran ta ON g.tahun_ajaran = ta.tahun_ajaran
                        ) z
                    WHERE z.status_bayar = 'Belum Lunas'" . $where . " ORDER BY z.id_siswa, z.jenis";

                $result = $this->db->query($sql_tunggak)->result_array();
                $nis_old = '';
                $no = 0;
                foreach ($result as $v) {
                    if ($nis_old != trim($v['id_siswa'])) {
                        $no++;
                        $cno = $no;
                        $nis = trim($v['id_siswa']);
                        $nama = $v['nama'];
                        $nis_old = $nis;
                    } else {
                        $cno = '';
                        $nis = '';
                        $nama = '';
                    }

                    echo '<tr>
							<td style="text-align: center;">' . $cno . '</td>
							<td>' . $nama . '</td>
							<td style="text-align: center;">' . $v['tahun_ajaran'] . '</td>
							<td style="text-align: right;"> Rp. ' . number_format(($v['jenis'] == '1' && $v['jml_bulan'] == 0 ? 1 * $v['besar_bangunan'] : ($v['jenis'] == '1' && $v['jml_bulan'] > 0 ? (1 * $v['besar_bangunan']) - $v['total_bayar'] : $v['total_bayar'])), 0, ',', '.') . '</td>
							<td>' . $v['jenis_pembayaran'] . '</td>
						  </td>';
                }
                ?>
            </tbody>
        </table>

        <p class="mt-5" style="text-align: right;">Yogyakarta, <?= $tgl_cetak ?></p>
        <p style="width: 60%;text-align: center">&nbsp;</p>
        <p class="mt-5" style="text-align: right;"><?= $user['name'] ?></p>

    </div>
</div>
</div>