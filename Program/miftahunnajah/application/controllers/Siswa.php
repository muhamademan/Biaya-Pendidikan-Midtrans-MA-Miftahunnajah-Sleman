<?php
defined('BASEPATH') or exit('no direct script access allowed');

class Siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        is_logged_in_siswa();

        $this->load->model('M_master');
    }

    public function index()
    {
        $data['title'] = "Selamat Datang Sistem Pembayaran Biaya Pendidikan";
        $data['siswa'] = $this->db->get_where('siswa', ['nis' => $this->session->userdata('nis')])->row_array();

        $data['sis'] = $this->db->get('siswa')->row_array();

        // $queryKelas = "SELECT s.*, k.nama_kelas FROM siswa s, kelas k
        // WHERE s.id_kelas = k.id_kelas";
        // $data['kelas'] = $this->db->query($queryKelas)->result_array();
        // $data['siswa'] = $this->M_master->getSiswa();

        $this->load->view('templates_siswa/header', $data);
        $this->load->view('templates_siswa/sidebar', $data);
        $this->load->view('templates_siswa/topbar', $data);
        $this->load->view('siswa/index', $data);
        $this->load->view('templates_siswa/footer');
    }

    public function detail($id_siswa)
    {
        $data['title'] = "Informasi Siswa MA Miftahunnajah Sleman";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // Mengambil data siswa sesuai dengan id_siswa
        $where1 = array('id_siswa' => $id_siswa);
        $data['dtsiswa'] = $this->M_master->tampil_detail($where1)->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('master/detail_Siswa', $data);
        $this->load->view('templates/footer');
    }
}