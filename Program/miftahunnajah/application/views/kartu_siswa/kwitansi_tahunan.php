<style>
.table td,
.table th {
    border-top: none !important;
}

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
        background-color: #ffff;
    }

    .table {
        margin-bottom: 0;
    }

    .table-bordered {
        color: #000;
        border: 1px solid #000;
    }

    .table td,
    .table th {
        border-top: none !important;
    }
}
</style>


<?php
function terbilang($number)
{
    $dasar = array(1 => 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan');
    $angka = array(1000000000, 1000000, 1000, 100, 10, 1);
    $satuan = array('milyar', 'juta', 'ribu', 'ratus', 'puluh', '');

    $i = 0;
    if ($number == 0) {
        $str = "nol";
    } else {
        $str = "";

        while ($number != 0) {
            $count = (int)($number / $angka[$i]);

            if ($count >= 10) {
                $str .= terbilang($count) . " " . $satuan[$i] . " ";
            } elseif ($count > 0 && $count < 10) {
                $str .= $dasar[$count] . " " . $satuan[$i] . " ";
            }

            $number -= $angka[$i] * $count;
            $i++;
        }

        $str = preg_replace("/satu puluh (\w+)/i", "\\1 Belas", $str);
        $str = preg_replace("/satu (ribu|ratus|puluh|belas)/i", "Se\\1", $str);
    }

    $string = $str . '';
    #ucwords agar karakter awal huruf besar
    return ucwords($string);
}
?>
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
                        <h4>KWITANSI PEMBAYARAN BIAYA TAHUNAN</h4>
                    </center>
                </td>
            </tr>
        </table>
    </center>
    <hr>
    <table class="table">
        <tbody>
            <tr>
                <td style="width: 25%;text-align: left">No. Induk Siswa </td>
                <td style="width: 75%;text-align: left">
                    <strong><?= $siswa1->nis ?></strong>
                </td>
            </tr>
            <tr>
                <td style="width: 25%;text-align: left">Nama Siswa </td>
                <td style="width: 75%;text-align: left">
                    <strong><?= $siswa1->nama ?></strong>
                </td>
            </tr>
            <tr>
                <td style="width: 25%;text-align: left">Tagihan Biaya Tahunan </td>
                <td style="width: 75%;text-align: left">
                    <strong>Rp. <?= number_format($bayaran_thn['jumlah'], 0, ',', '.') ?>,-</strong>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table">
        <!-- <tbody>
            <tr>
                <td colspan="2" style="width: 100%;text-align: right">&nbsp;</td>
            </tr> -->
        <tr class="mb-5">
            <td style="width: 60%;text-align: right">&nbsp;</td>
            <td style="width: 40%;text-align: center">Yogyakarta, <?= $tgl_cetak ?></td>
        </tr>
        <tr>
            <td style="width: 60%;text-align: right">&nbsp;</td>
            <td style="width: 40%;text-align: center; font-weight: bold;">MA Miftahunnajah Sleman</td>
            <!-- <td style="width: 40%;text-align: center"><?= $user['name'] ?></td> -->
        </tr>
        </tbody>
    </table>
</div>
</div>