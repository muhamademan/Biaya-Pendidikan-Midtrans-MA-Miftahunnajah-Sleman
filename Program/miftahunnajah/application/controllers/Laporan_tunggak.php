<?php
defined('BASEPATH') or exit('no direct script access allowed');

class Laporan_tunggak extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('M_transaksi');
        $this->load->helper('url');
    }

    public function lap_tgk($where = null)
    {
        $data['title'] = "Laporan Tunggakan Spp";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $sql_tunggak = "SELECT z.* FROM 
        // 				(
        //                     SELECT g.*, s.nama, ta.besar_spp, '1' AS jenis FROM 
        // 					(
        // 						SELECT a.id_spp AS id_pem, a.id_siswa, a.tahun_ajaran, a.jenis_pembayaran, f.total_spp AS total_bayar, IFNULL(f.jml_bulan, 0) AS jml_bulan, IF(f.jml_bulan = 12, 'Lunas', 'Belum Lunas') AS status_bayar 
        // 						FROM biaya_spp a
        // 						LEFT JOIN 
        // 						(
        // 							SELECT e.id_siswa, e.tahun_ajaran, SUM(e.besar_spp) AS total_spp, COUNT(e.id_bulan) AS jml_bulan FROM 
        // 							(
        // 								SELECT b.id_transaksi, b.nis, b.id_siswa, b.id_bulan,b.id_tahun,c.tahun_ajaran,b.jumlah AS besar_spp
        // 								FROM pembayaran_spp b
        // 								INNER JOIN tahun_ajaran c ON b.id_tahun = c.id_tahun
        // 								WHERE b.status='0'
        // 							) e GROUP BY e.id_siswa, e.tahun_ajaran
        // 						) f ON a.id_siswa = f.id_siswa AND a.tahun_ajaran = f.tahun_ajaran
        // 					) g
        // 					INNER JOIN siswa s ON g.id_siswa = s.id_siswa
        // 					INNER JOIN tahun_ajaran ta ON g.tahun_ajaran = ta.tahun_ajaran
        // 					) z
        // 				WHERE z.status_bayar = 'Belum Lunas'" . $where . " ORDER BY z.id_siswa, z.jenis";

        // $data['result'] = $this->db->query($sql_tunggak)->result_array();

        // $data['siswa'] = $this->db->query("SELECT nis, nama FROM siswa ORDER BY nis")->result();

        $data['tgl_cetak'] = date('d M Y');
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan_tgk/tunggakan', $data);
        $this->load->view('templates/footer');
    }



    public function tunggakan_thn()
    {
        $data['title'] = 'Laporan Tunggakan Tahunan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['tgl_cetak'] = date('d M Y');
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan_tgk/tunggakan_tahunan', $data);
        $this->load->view('templates/footer');
    }



    // Tunggakan Bangunan
    public function tunggakan_bgn()
    {
        $data['title'] = 'Laporan Tunggakan Bangunan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['tgl_cetak'] = date('d M Y');
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan_tgk/tunggakan_bangunan', $data);
        $this->load->view('templates/footer');
    }
}