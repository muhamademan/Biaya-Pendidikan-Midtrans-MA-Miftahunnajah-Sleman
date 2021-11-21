<?php
defined('BASEPATH') or exit('no direct script access allowed');

class Laporan_bangunan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('M_transaksi');
        $this->load->helper('url');
    }


    // LAPORAN PEMBAYARAN BANGUNAN
    public function lap_bangunan()
    {
        if (isset($_GET['filter']) && !empty($_GET['filter'])) {
            $filter = $_GET['filter'];
            if ($filter == '1') {
                $tanggal1 = $_GET['tanggal'];
                $tanggal2 = $_GET['tanggal2'];
                // $ket = 'Data Transaksi dari Tanggal ' . date('d-m-y', strtotime($tanggal1)) . ' - ' . date('d-m-y', strtotime($tanggal2));
                $url_cetak = 'laporan_bangunan/cetaktgl?tanggal1=' . $tanggal1 . '&tanggal2=' . $tanggal2 . '';
                $pembayaran_bangunan = $this->M_transaksi->view_by_date2($tanggal1, $tanggal2)->result();
            } else if ($filter == '2') {
                $nis = $_GET['nis'];
                // $ket = 'Data Transaksi Pembayaran bangunan dari Siswa dengan Nomor Induk ' . $nis;
                $url_cetak = 'laporan_bangunan/cetaksiswa?&nis=' . $nis;
                $pembayaran_bangunan = $this->M_transaksi->view_by_nis2($nis)->result();
            } else {
                $tahun = $_GET['tahun'];
                // $ket = 'Data Transaksi Tahun Ajaran ' . $tahun;
                $url_cetak = 'laporan_bangunan/cetaktahun?&tahun=' . $tahun;
                $pembayaran_bangunan = $this->M_transaksi->view_by_year2($tahun)->result();
            }
        } else {
            // $ket = 'Semua Data Transaksi';
            $url_cetak = 'laporan_bangunan/cetak';
            $pembayaran_bangunan = $this->M_transaksi->view_all2();
        }
        // $data['ket'] = $ket;
        $data['url_cetak'] = base_url($url_cetak);
        $data['pembayaran_bangunan'] = $pembayaran_bangunan;
        $data['nis'] = $this->M_transaksi->nis();
        $data['tahun'] = $this->M_transaksi->tahun();

        $data['title'] = "Laporan Pembayaran Biaya Bangunan";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $data['user'] = $this->db->get('user')->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan_bgn/bangunan', $data);
        $this->load->view('templates/footer');
    }


    // CETAK BERDASARKAN SEMUA DATA PEMBAYARAN BANGUNAN
    public function cetak()
    {
        $total_bgn = "SELECT SUM(jumlah) as jml FROM pembayaran_bangunan";
        $data['total'] = $this->db->query($total_bgn)->row_array();

        $data['tgl_cetak'] = date('d M Y');
        $ket = 'Semua Data Pembayaran Biaya Bangunan';
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['pembayaran_bangunan'] = $this->M_transaksi->view_all2();
        $data['ket'] = $ket;
        $this->load->view('laporan_bgn/cetak_bgn', $data);
    }

    // CETAK BERDASARKAN TANGGAL TRANSAKSI PEMBAYARAN BANGUNAN YANG DIPILIH
    public function cetaktgl()
    {
        $data['tgl_cetak'] = date('d M Y');
        $tanggal1 = $_GET['tanggal1'];
        $tanggal2 = $_GET['tanggal2'];
        $ket = 'Data Pembayaran mulai dari Tanggal ' . date('d-m-Y', strtotime($tanggal1)) . ' sampai ' . date('d-m-Y', strtotime($tanggal2));
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['pembayaran_bangunan'] = $this->M_transaksi->view_by_date2($tanggal1, $tanggal2)->result();
        $data['total'] = $this->db->query("SELECT SUM(jumlah) as jml FROM pembayaran_bangunan WHERE tgl_bayar")->row_array();
        $data['ket'] = $ket;
        $this->load->view('laporan_bgn/cetak_bgn', $data);
    }

    // CETAK BERDASARKAN DATA SISWA YANG DIPILIH
    public function cetaksiswa()
    {
        $data['tgl_cetak'] = date('d M Y');
        $nis = $_GET['nis'];
        $ket = 'Data Pembayaran dengan Nomor Induk ' . $nis;
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['pembayaran_bangunan'] = $this->M_transaksi->view_by_nis2($nis)->result();
        // total pembayaran bangunan berdasarkan nis siswa
        $data['total'] = $this->db->query("SELECT SUM(jumlah) as jml FROM pembayaran_bangunan WHERE nis = $nis")->row_array();
        $data['ket'] = $ket;
        $this->load->view('laporan_bgn/cetak_bgn', $data);
    }

    // CETAK BERDASARKAN DATA TAHUN AJARAN YANG DIPILIH
    public function cetaktahun()
    {
        $data['tgl_cetak'] = date('d M Y');
        $tahun = $_GET['tahun'];

        $ket = 'Data Pembayaran Biaya Bangunan Pada Tahun Ajaran ' . $tahun;
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['pembayaran_bangunan'] = $this->M_transaksi->view_by_year2($tahun)->result();
        // total pembayaran bangunan berdasarkan tahun ajaran
        $data['total'] = $this->db->query("SELECT SUM(jumlah) as jml FROM pembayaran_bangunan WHERE id_tahun = $tahun")->row_array();
        $data['ket'] = $ket;
        $this->load->view('laporan_bgn/cetak_bgn', $data);
    }
}