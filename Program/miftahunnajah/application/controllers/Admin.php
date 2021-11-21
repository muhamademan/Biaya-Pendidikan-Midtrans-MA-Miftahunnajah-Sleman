<?php
defined('BASEPATH') or exit('no direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('M_redaksi');
    }


    public function index()
    {
        $data['title'] = "Dashboard Halaman";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $data['jml_user'] = ('SELECT count(u.name) FROM user u')->result_array();
        $total1  = "SELECT SUM(jumlah) as jum FROM `pembayaran_spp`";
        $data['total_spp'] = $this->db->query($total1)->result_array();

        $total2 = "SELECT SUM(jumlah) as jum FROM pembayaran_tahunan";
        $data['total_thn'] = $this->db->query($total2)->result_array();

        $total3 = "SELECT SUM(jumlah) as jum FROM pembayaran_bangunan";
        $data['total_bgn'] = $this->db->query($total3)->result_array();




        // $data['user'] = $this->db->get('user')->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function redaksi()
    {
        $data['title'] = 'Informasi Pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['dtredaksi'] = $this->M_redaksi->getRedaksi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/redaksi', $data);
        $this->load->view('templates/footer');
    }

    public function detailRedaksi($id_redaksi = null)
    {
        $data['title'] = 'Detail Redaksi Surat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $where1 = array('id_redaksi' => $id_redaksi);
        $data['dtredaksi'] = $this->M_redaksi->tampil_detail($where1)->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/detailRedaksi', $data);
        $this->load->view('templates/footer');
    }


    public function editRedaksi($id_redaksi)
    {
        $data['title'] = 'Edit Redaksi Surat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $data['dtredaksi'] = $this->M_redaksi->getRedaksi();
        $editRe = "SELECT * FROM redaksi_surat WHERE id_redaksi = $id_redaksi";
        $data['dtredaksi'] = $this->db->query($editRe)->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/editRedaksi', $data);
        $this->load->view('templates/footer');
    }


    public function proseseditRedaksi()
    {

        $id_redaksi = $this->input->post('id_redaksi');
        $judul = $this->input->post('judul');
        // $petunjuk = $this->input->post('petunjuk');
        $isi_redaksi = $this->input->post('isi_redaksi');

        $data = [
            'id_redaksi' => $id_redaksi,
            'judul' => $judul,
            // 'petunjuk' => $petunjuk,
            'isi_redaksi' => $isi_redaksi
        ];

        $this->db->where('id_redaksi', $id_redaksi);
        $edit = $this->db->update('redaksi_surat', $data);

        if ($edit) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data redaksi surat berhasil <b>diperbaharui.</b> </div>');
            redirect('admin/redaksi');
        endif;
    }


    public function hapusRedaksi($id_redaksi)
    {
        $this->db->where('id_redaksi', $id_redaksi);
        $delete = $this->db->delete('redaksi_surat');

        if ($delete) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Surat Redaksi Pembayaran berhasil <b>dihapus.</b> </div>');
            redirect('admin/redaksi');
        }
    }


    public function addRedaksi()
    {
        $judul = $this->input->post('judul');
        $isi_redaksi = $this->input->post('isi_redaksi');

        $data = [
            'judul' => $judul,
            'isi_redaksi' => $isi_redaksi
        ];

        $tambah = $this->db->insert('redaksi_surat', $data);
        if ($tambah) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data redaksi surat pembayaran berhasil <b>ditambahkan.</b> </div>');
            redirect('admin/redaksi');
        }
    }
}