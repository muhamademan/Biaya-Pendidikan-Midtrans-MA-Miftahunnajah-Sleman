<?php
defined('BASEPATH') or exit('no direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('M_transaksi');
        $this->load->helper('url');
    }


    // LAPORAN PEMBAYARAN BULANAN (SPP)
    public function laporan_spp()
    {
        if (isset($_GET['filter']) && !empty($_GET['filter'])) {
            $filter = $_GET['filter'];
            if ($filter == '1') {
                $tanggal1 = $_GET['tanggal'];
                $tanggal2 = $_GET['tanggal2'];
                // $ket = 'Data Transaksi dari Tanggal ' . date('d-m-y', strtotime($tanggal1)) . ' - ' . date('d-m-y', strtotime($tanggal2));
                $url_cetak = 'laporan/cetaktgl?tanggal1=' . $tanggal1 . '&tanggal2=' . $tanggal2 . '';
                $pembayaran_spp = $this->M_transaksi->view_by_date($tanggal1, $tanggal2)->result();
            } else if ($filter == '2') {
                $nis = $_GET['nis'];
                // $ket = 'Data Transaksi Pembayaran SPP dari Siswa dengan Nomor Induk ' . $nis;
                $url_cetak = 'laporan/cetaksiswa?&nis=' . $nis;
                $pembayaran_spp = $this->M_transaksi->view_by_nis($nis)->result();
            } else {
                $tahun = $_GET['tahun'];
                // $ket = 'Data Transaksi Tahun Ajaran ' . $tahun;
                $url_cetak = 'laporan/cetaktahun?&tahun=' . $tahun;
                $pembayaran_spp = $this->M_transaksi->view_by_year($tahun)->result();
            }
        } else {
            // $ket = 'Semua Data Transaksi';
            $url_cetak = 'laporan/cetak';
            $pembayaran_spp = $this->M_transaksi->view_all();
        }
        // $data['ket'] = $ket;
        $data['url_cetak'] = base_url($url_cetak);
        $data['pembayaran_spp'] = $pembayaran_spp;
        $data['nis'] = $this->M_transaksi->nis();
        $data['tahun'] = $this->M_transaksi->tahun();


        $data['title'] = "Laporan Pembayaran Biaya Bulanan (SPP)";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $data['siswa'] = $this->M_transaksi->tampil_data()->result();

        // $data['user'] = $this->db->get('user')->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/laporan_spp', $data);
        $this->load->view('templates/footer');
    }

    // CETAK BERDASARKAN SEMUA DATA PEMBAYARAN SPP
    public function cetak()
    {
        $sql_total = "SELECT SUM(jumlah) as jml FROM pembayaran_spp";
        $data['total'] = $this->db->query($sql_total)->row_array();

        $data['tgl_cetak'] = date("d M Y");
        $ket = 'Semua Data Pembayaran Biaya Bulanan (SPP)';
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['pembayaran_spp'] = $this->M_transaksi->view_all();
        $data['ket'] = $ket;
        $this->load->view('laporan/cetak_spp', $data);
    }

    // CETAK BERDASARKAN TANGGAL TRANSAKSI PEMBAYARAN SPP YANG DIPILIH
    public function cetaktgl()
    {
        $data['tgl_cetak'] = date("d M Y");
        $tanggal1 = $_GET['tanggal1'];
        $tanggal2 = $_GET['tanggal2'];
        $ket = 'Data Pembayaran mulai dari Tanggal ' . date('d-m-Y', strtotime($tanggal1)) . ' sampai ' . date('d-m-Y', strtotime($tanggal2));
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['pembayaran_spp'] = $this->M_transaksi->view_by_date($tanggal1, $tanggal2)->result();
        // total pembayaran spp berdasarkan rentang tanggal
        $data['total'] = $this->db->query("SELECT SUM(jumlah) as jml FROM pembayaran_spp WHERE tgl_bayar")->row_array();
        $data['ket'] = $ket;
        $this->load->view('laporan/cetak_spp', $data);
    }

    // CETAK BERDASARKAN DATA SISWA YANG DIPILIH
    public function cetaksiswa()
    {
        $data['tgl_cetak'] = date("d M Y");
        $nis = $_GET['nis'];
        $ket = 'Data Pembayaran dengan Nomor Induk ' . $nis;
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['pembayaran_spp'] = $this->M_transaksi->view_by_nis($nis)->result();
        // total pembayaran spp berdasarkan nis siswa
        $data['total'] = $this->db->query("SELECT SUM(jumlah) as jml FROM pembayaran_spp WHERE nis = $nis")->row_array();
        $data['ket'] = $ket;
        $this->load->view('laporan/cetak_spp', $data);
    }

    // CETAK BERDASARKAN DATA TAHUN AJARAN YANG DIPILIH
    public function cetaktahun()
    {
        $data['tgl_cetak'] = date("d M Y");
        $tahun = $_GET['tahun'];
        $ket = 'Data Pembayaran Biaya Spp Pada Tahun Ajaran ' . $tahun;
        ob_start();
        require('assets/fpdf/fpdf.php');
        $data['pembayaran_spp'] = $this->M_transaksi->view_by_year($tahun)->result();
        // total pembayaran spp berdasarkan tahun ajaran
        $data['total'] = $this->db->query("SELECT SUM(jumlah) as jml FROM pembayaran_spp WHERE id_tahun = $tahun")->row_array();
        $data['ket'] = $ket;
        $this->load->view('laporan/cetak_spp', $data);
    }














    // LAPORAN PEMBAYARAN TAHUNAN
    // public function laporan_tahunan()
    // {
    //     $data['title'] = "Laporan Pembayaran Biaya Tahunan";
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    //     // $data['user'] = $this->db->get('user')->row_array();
    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('laporan/laporan_tahunan', $data);
    //     $this->load->view('templates/footer');
    // }


    // LAPORAN PEBAYARAN BANGUNAN
    public function laporan_bangunan()
    {
        $data['title'] = "Laporan Pembayaran Biaya Bangunan";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $data['user'] = $this->db->get('user')->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/tahunan', $data);
        $this->load->view('templates/footer');
    }


    // LAPORAN PEBAYARAN BANGUNAN
    public function laporan_tunggakan()
    {
        $data['title'] = "Laporan Tunggakan Pembayaran";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $data['user'] = $this->db->get('user')->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/tahunan', $data);
        $this->load->view('templates/footer');
    }
}