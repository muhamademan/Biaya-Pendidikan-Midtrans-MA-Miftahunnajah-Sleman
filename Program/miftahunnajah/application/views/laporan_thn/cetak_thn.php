<?php
$pdf = new FPDF("L", "cm", "F4");

$pdf->SetMargins(2, 1, 1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
$pdf->Image('assets/img/ma.png', 2.5, 0.5, 3, 2.5);
$pdf->SetX(8);
$pdf->MultiCell(19.5, 0.7, "ISLAMIC BOARDING SCHOOL", 0, 'C');
$pdf->SetFont('Times', 'B', 14);
$pdf->SetX(8);
$pdf->MultiCell(19.5, 0.7, "MADRASAH ALIYAH MIFTAHUNNAJAH SLEMAN", 0, 'C');
$pdf->SetFont('Times', '', 12);
$pdf->SetX(8);
$pdf->MultiCell(19.5, 0.7, 'Ds. Wonorejo 01/08, Sardonoharjo, Ngaglik, Sleman, Daerah Istimewa Yogyakarta 55581, Telp. (0274) 9107446', 0, 'C');
$pdf->Line(2, 3.1, 31, 3.1);
$pdf->SetLineWidth(0.1);
$pdf->Line(2, 3.2, 31, 3.2);
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial', 'B', 11);
$pdf->MultiCell(31, 0.7, "DATA PEMBAYARAN BIAYA TAHUNAN SISWA MA MIFTAHUNNAJAH SLEMAN", 0, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(31, 0.7, '' . $ket . '', 0, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(5, 0.6, "Di cetak pada : " . date("d/M/Y H:i"), 0, 0, 'C');
$pdf->ln(1);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'ID TRANSAKSI', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'NIS', 1, 0, 'C');
$pdf->Cell(4.5, 0.8, 'NAMA', 1, 0, 'C');
$pdf->Cell(3.5, 0.8, 'BULAN', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'TANGGAL BAYAR', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'METODE PEMBAYARAN', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'BIAYA', 1, 0, 'C');

$pdf->ln();

if (!empty($pembayaran_tahunan)) {
    $no = 1;
    foreach ($pembayaran_tahunan as $data) {
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(1, 0.6, $no++, 1, 0, 'C');
        $pdf->Cell(4, 0.6, $data->id_transaksi, 1, 0, 'C');
        $pdf->Cell(3, 0.6, $data->nis, 1, 0, 'C');
        $pdf->Cell(4.5, 0.6, $data->nama, 1, 0, 'C');
        if ($data->id_bulan <= 12) {
            $tahun = substr($data->tahun_ajaran, 0, 4);
        } else {
            $tahun = substr($data->tahun_ajaran, 0, 4);
        }
        $pdf->Cell(3.5, 0.6, $data->nama_bulan . ' ' . $tahun, 1, 0, 'C');
        $pdf->Cell(4, 0.6, date('d-m-Y', strtotime($data->tgl_bayar)), 1, 0, 'C');
        $pdf->Cell(5, 0.6, $data->metode_pembayaran, 1, 0, 'C');
        $pdf->Cell(3, 0.6, 'Rp. ' . number_format($data->besar_tahunan, 0, ',', '.'), 1, 0, 'C');
        $pdf->ln();
    }
    // BAGIAN TOTAL PEMBAYARAN TAHUNAN
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(25, 0.8, 'TOTAL PEMBAYARAN BIAYA TAHUNAN', 1, 0, 'C');
    // $pdf->Cell(8, 0.8, $total['jml'], 1, 0, 'C');
    $pdf->Cell(3, 0.8, 'Rp. ' . number_format($total['jml'], 0, ',', '.'), 1, 0, 'C');
}

$pdf->SetFont('Times', '', 12);
$pdf->SetX(25);
$pdf->MultiCell(31, 3.5, 'Yogyakarta, ' . $tgl_cetak);
$pdf->SetX(25);
$pdf->MultiCell(31, 2.1, '( ......................................... )');
$pdf->Output("Laporan Pembayaran tahunan.pdf", "I");