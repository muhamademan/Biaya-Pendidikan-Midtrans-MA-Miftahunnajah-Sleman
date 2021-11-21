<?php
defined('BASEPATH') or exit('no direct script access allowed');

class Informasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in_siswa();

        $this->load->model('M_redaksi');
        $this->load->model('M_master');
        $this->load->model('M_tahunajaran');
        $this->load->model('M_bangunan');
        $this->load->model('M_transaksi');
    }


    public function bangunan()
    {
        $data['id_transaksi'] = $this->M_transaksi->id_transaksi2();
        $data['tgl_bayar'] = date("Y-m-d");
        $data['title'] = 'Pembayaran Bangunan Online';
        $data['siswa'] = $this->db->get_where('siswa', ['nis' => $this->session->userdata('nis')])->row_array();

        // mengambil data pembayaran sesuai siswa yang sedang login
        $nii = $data['siswa']['nis'];
        $nia = $data['siswa']['id_siswa'];

        // mengambil data pembayaran bangunan
        $data['pem_bulan'] = $this->M_transaksi->pembayaran_bangunan()->result();


        $sql_bangunan = "SELECT a.id_bangunan, a.id_siswa, a.tahun_ajaran, a.jenis_pembayaran, f.total_bangunan, f.jml_bulan,
                        IF(f.jml_bulan = 2, 'Lunas', 'Belum Lunas') AS status_bayar
                        FROM biaya_bangunan a
                        LEFT JOIN (
                            SELECT e.id_siswa,e.tahun_ajaran, SUM(e.besar_bangunan) AS total_bangunan, COUNT(e.id_bulan) AS jml_bulan
                            FROM 
                        (
                            SELECT b.id_transaksi, b.nis, b.id_siswa, b.id_bulan, b.id_tahun, c.tahun_ajaran, b.jumlah AS besar_bangunan
                            FROM pembayaran_bangunan b
                            INNER JOIN tahun_ajaran c ON b.id_tahun = c.id_tahun
                            WHERE b.status='0'
                            ) e 
                            GROUP BY e.id_siswa, e.tahun_ajaran
                            ) f 
                            ON a.id_siswa = f.id_siswa 
                            AND a.tahun_ajaran = f.tahun_ajaran
                            WHERE a.id_siswa = '$nia'";

        $data['bayaran_bangunan'] = $this->db->query($sql_bangunan)->result();

        $this->load->view('templates_siswa/header', $data);
        $this->load->view('templates_siswa/sidebar', $data);
        $this->load->view('templates_siswa/topbar', $data);
        $this->load->view('info/info_bayar_siswa', $data);
        $this->load->view('templates_siswa/footer');
    }


    public function info_bayar()
    {
        $data['title'] = 'Infomrasi Pembayaran Biaya Pendidikan';
        $data['siswa'] = $this->db->get_where('siswa', ['nis' => $this->session->userdata('nis')])->row_array();

        $nia = $data['siswa']['id_siswa'];
        // Query menampilkan informasi data pembayaran bulanan pada siswa
        $data['pem_bulan'] = $this->M_transaksi->pembayaran_spp()->result();

        $sql = "SELECT a.id_spp, a.id_siswa, a.tahun_ajaran, a.jenis_pembayaran, f.total_spp,f.jml_bulan,IF(f.jml_bulan = 12,   'Lunas', 'Belum Lunas') AS status_bayar 
				FROM biaya_spp a
				LEFT JOIN 
				(
					SELECT e.id_siswa, e.tahun_ajaran, SUM(e.besar_spp) AS total_spp, COUNT(e.id_bulan) AS jml_bulan FROM 
					(
						SELECT b.id_transaksi,b.id_siswa,b.id_bulan,b.id_tahun,c.tahun_ajaran,b.jumlah AS besar_spp
						FROM pembayaran_spp b
						INNER JOIN tahun_ajaran c ON b.id_tahun = c.id_tahun
						WHERE b.status='0'
					) e GROUP BY e.id_siswa,e.tahun_ajaran
				) f ON a.id_siswa = f.id_siswa AND a.tahun_ajaran = f.tahun_ajaran
				WHERE a.id_siswa = '$nia'
				";

        $data['bayaran_spp'] = $this->db->query($sql)->result();

        // Query menampilkan informasi data pembayaran tahunan pada siswa
        $sql = "SELECT a.id_tahunan, a.id_siswa, a.tahun_ajaran, a.jenis_pembayaran, f.total_tahunan, f.jml_bulan,IF(f.jml_bulan = 1, 'Lunas', 'Belum Lunas') AS status_bayar 
				FROM biaya_tahunan a
				LEFT JOIN 
				(
					SELECT e.id_siswa,e.tahun_ajaran, SUM(e.besar_tahunan) AS total_tahunan, COUNT(e.id_bulan) AS jml_bulan FROM 
					(
						SELECT b.id_transaksi, b.id_siswa, b.id_bulan, b.id_tahun, c.tahun_ajaran, b.jumlah AS besar_tahunan
						FROM pembayaran_tahunan b
						INNER JOIN tahun_ajaran c ON b.id_tahun = c.id_tahun
						WHERE b.status='0'
					) e GROUP BY e.id_siswa,e.tahun_ajaran
				) f ON a.id_siswa = f.id_siswa AND a.tahun_ajaran = f.tahun_ajaran
				WHERE a.id_siswa = '$nia'";

        $data['bayaran_th'] = $this->db->query($sql)->result();



        // Query menampilkan informasi data pembayaran bangunan pada siswa
        $sql_bangunan = "SELECT a.id_bangunan, a.id_siswa, a.tahun_ajaran, a.jenis_pembayaran, f.total_bangunan, f.jml_bulan,
                        IF(f.jml_bulan = 1, 'Lunas', 'Belum Lunas') AS status_bayar
                        FROM biaya_bangunan a
                        LEFT JOIN (
                            SELECT e.id_siswa,e.tahun_ajaran, SUM(e.besar_bangunan) AS total_bangunan, COUNT(e.id_bulan) AS jml_bulan
                            FROM 
                        (
                            SELECT b.id_transaksi, b.nis, b.id_siswa, b.id_bulan, b.id_tahun, c.tahun_ajaran, b.jumlah AS besar_bangunan
                            FROM pembayaran_bangunan b
                            INNER JOIN tahun_ajaran c ON b.id_tahun = c.id_tahun
                            WHERE b.status='0'
                            ) e 
                            GROUP BY e.id_siswa, e.tahun_ajaran
                            ) f 
                            ON a.id_siswa = f.id_siswa 
                            AND a.tahun_ajaran = f.tahun_ajaran
                            WHERE a.id_siswa = '$nia'";
        $data['bayaran_bangunan'] = $this->db->query($sql_bangunan)->result();


        // Query menampilkan informasi pembayaran / cara pembayaran online pada siswa
        $data['dtredaksi'] = $this->M_redaksi->getRedaksi();

        $this->load->view('templates_siswa/header', $data);
        $this->load->view('templates_siswa/sidebar', $data);
        $this->load->view('templates_siswa/topbar', $data);
        $this->load->view('info/info_bayar_siswa', $data);
        $this->load->view('templates_siswa/footer');
    }
}