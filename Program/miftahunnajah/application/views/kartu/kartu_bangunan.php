<style>
@media print {

    h3,
    .sidebar,
    #siswa,
    #cari-tunggakan,
    #cetak-tunggakan,
    /* hr, */
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
}
</style>
<div class="container-fluid">
    <button id="cetak-tunggakan" class="btn btn-outline-success fa fa-print" onclick="print()"></button>
    <center>
        <table>
            <tr>
                <td>
                    <img src="<?= base_url('assets/img/ma.png') ?>" style="width: 170px; height: 150px;">
                </td>
                <td>
                    <center>
                        <h5>Islamic Boarding School</h5>
                        <h3>MADRASAH ALIYAH MIFTAHUNNAJAH SLEMAN</h3>
                        <h6>Ds. Wonorejo 01/08, Sardonoharjo, Ngaglik, Sleman, Daerah Istimewa Yogyakarta 55581
                            <br>Telp. (0274) 9107446 / 081 392317772
                        </h6><br>
                        <h4>KARTU PEMBAYARAN BANGUNAN PADA TAHUN AJARAN <?= $pem_tahun[0]['tahun_ajaran'] ?? $thaj ?>
                        </h4>
                    </center>
                </td>
            </tr>
        </table>
        <!-- <h4>KARTU SPP TAHUN AJARAN <?= $pem_tahun[0]['tahun_ajaran'] ?? $thaj ?></h4> -->
        <td>
            <p style="text-align: left; font-weight: bold;">Nama : <?= $siswa->nama ?></p>
            <p style="text-align: left; font-weight: bold;">NIS : <?= $siswa->nis ?></p>
            <!-- <p style="text-align: left; font-weight: bold;">NIS : <?= $pem_bangunan['jumlah']; ?></p> -->
            <p style="text-align: left; font-weight: bold;">Tanggal Cetak: <?= $tgl_cetak ?></p>
        </td>
    </center>
    <hr>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 5%;text-align: center">No.</th>
                <th style="width: 15%;text-align: center">Bayar Bulan</th>
                <th style="width: 15%;text-align: center">Tagihan Biaya Bangunan</th>
                <th style="width: 20%;text-align: center">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            //echo var_dump($pem_tahun);exit;
            for ($i = 1; $i <= 2; $i++) {
                $bulan = str_pad($i, 2, "0", STR_PAD_LEFT);
                $nm_bulan = $this->db->query("SELECT nama_bulan FROM bulan WHERE id_bulan='" . $bulan . "'")->row()->nama_bulan;

                $rpspp = '';
                $ket = 'Belum Lunas';
                if (count($pem_bangunan) > 0) {
                    foreach ($pem_bangunan as $pb) {
                        if ($pb['id_bulan'] == $bulan) {
                            $rpspp = number_format($pb['jumlah'], 0, ',', '.');
                            $ket = '<b>Lunas</b>';
                        }
                    }
                }

                echo '<tr>
							<td style="text-align: center;">' . $i . '</td>
							<td style="text-align: center;">' . $nm_bulan . '</td>
							<td style="text-align: right;">' . $rpspp . '</td>
							<td style="text-align: left;">' . $ket . '</td>
						  </td>';
            }
            ?>
        </tbody>
    </table>
</div>
</div>