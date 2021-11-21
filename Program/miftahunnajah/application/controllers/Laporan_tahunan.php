<?php
defined('BASEPATH') or exit('no direct script access allowed');

class Laporan_tahunan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('M_transaksi');
        $this->load->helper('url');
    }


    // LAPORAN PEMBAYARAN TAHUNAN
    public function lap_tahunan()
    {
        if (isset($_GET['filter']) && !empty($_GET['filter'])) {
            $filter = $_GET['filter'];
            if ($filter == '1') {
                $tanggal1 = $_GET['tanggal'];
                $tanggal2 = $_GET['tanggal2'];
                // $ket = 'Data Transaksi dari Tanggal ' . date('d-m-y', strtotime($tanggal1)) . ' - ' . date('d-m-y', strtotime($tanggal2));
                $url_cetak = 'laporan_tahunan/cetaktgl?tanggal1=' . $tanggal1 . '&tanggal2=' . $tanggal2 . '';
                $pembayaran_tahunan = $this->M_transaksi->view_by_date1($tanggal1, $tanggal2)->result();
            } else if ($filter == '2') {
                $nis = $_GET['nis'];
                // $ket = 'Data Transaksi Pembayaran Tahunan dari Siswa dengan Nomor Induk ' . $nis;
                $url_cetak = 'laporan_tahunan/cetaksiswa?&nis=' . $nis;
                $pembayaran_tahunan = $this->M_transaksi->view_by_nis1($nis)->result();
            } else {
                $tahun = $_GET['tahun'];
                // $ket = 'Data Transaksi Tahun Ajaran ' . $tahun;
                $url_cetak = 'laporan_tahunan/cetaktahun?&tahun=' . $tahun;
                $pembayaran_tahunan = $this->M_transaksi->view_by_year1($tahun)->result();
            }
        } else {
            // $ket = 'Semua Data Transaksi';
            $url_cetak = 'laporan_tahunan/cetak';
            $pembayaran_tahunan = $this->M_transaksi->view_all1();
        }
        // $data['ket'] = $ket;
        $data['url_cetak'] = base_url($url_cetak);
        $data['pembayaran_tahunan'] = $pembayaran_tahunan;
        $data['nis'] = $this->M_transaksi->nis();
        $data['tahun'] = $this->M_transaksi->tahun();

        $data['title'] = "Laporan Pembayaran Biaya Tahunan";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $data['user'] = $this->db->get('user')->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan_thn/tahunan', $data);
        $this->load->view('templates/footer');
    }


    // CETAK BERDASARKAN SEMUA DATA PEMBAYARAN TAHUNAN
    public function cetak()
    {
        $total_thn = "SELECT SUM(jumlah) as jml FROM pembayaran_tahunan";
        $data['total'] = $this->db->query($total_thn)->row_array();


        $data['tgl_cetak'] = date('d M Y');
        $ket = 'Semua Data Pembayaran Biaya Tahunan';
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['pembayaran_tahunan'] = $this->M_transaksi->view_all1();
        $data['ket'] = $ket;
        $this->load->view('laporan_thn/cetak_thn', $data);
    }

    // CETAK BERDASARKAN TANGGAL TRANSAKSI PEMBAYARAN TAHUNAN YANG DIPILIH
    public function cetaktgl()
    {
        // $total_thn = "SELECT SUM(jumlah) as jml FROM pembayaran_tahunan";
        // $data['total'] = $this->db->query($total_thn)->row_array();

        $data['tgl_cetak'] = date('d M Y');
        $tanggal1 = $_GET['tanggal1'];
        $tanggal2 = $_GET['tanggal2'];
        $ket = 'Data Pembayaran mulai dari Tanggal ' . date('d-m-Y', strtotime($tanggal1)) . ' sampai ' . date('d-m-Y', strtotime($tanggal2));
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['pembayaran_tahunan'] = $this->M_transaksi->view_by_date1($tanggal1, $tanggal2)->result();
        $data['total'] = $this->db->query("SELECT SUM(jumlah) as jml FROM pembayaran_tahunan WHERE tgl_bayar")->row_array();
        $data['ket'] = $ket;
        $this->load->view('laporan_thn/cetak_thn', $data);
    }

    // CETAK BERDASARKAN DATA SISWA YANG DIPILIH
    public function cetaksiswa()
    {
        $data['tgl_cetak'] = date('d M Y');
        $nis = $_GET['nis'];
        $ket = 'Data Pembayaran dengan Nomor Induk ' . $nis;
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['pembayaran_tahunan'] = $this->M_transaksi->view_by_nis1($nis)->result();
        // total pembayaran biaya tahunan berdasarkan nis siswa
        $data['total'] = $this->db->query("SELECT SUM(jumlah) as jml FROM pembayaran_tahunan WHERE nis = $nis")->row_array();
        $data['ket'] = $ket;
        $this->load->view('laporan_thn/cetak_thn', $data);
    }

    // CETAK BERDASARKAN DATA TAHUN AJARAN YANG DIPILIH
    public function cetaktahun()
    {
        $data['tgl_cetak'] = date('d M Y');
        $tahun = $_GET['tahun'];
        $ket = 'Data Pembayaran Biaya Tahunan Pada Tahun Ajaran ' . $tahun;
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['pembayaran_tahunan'] = $this->M_transaksi->view_by_year1($tahun)->result();
        // total pembayaran biaya tahunan berdasarkan tahun ajaran
        $data['total'] = $this->db->query("SELECT SUM(jumlah) as jml FROM pembayaran_tahunan WHERE id_tahun = $tahun")->row_array();
        $data['ket'] = $ket;
        $this->load->view('laporan_thn/cetak_thn', $data);
    }
}