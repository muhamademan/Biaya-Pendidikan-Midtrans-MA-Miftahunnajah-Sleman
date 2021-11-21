<?php
defined('BASEPATH') or exit('no direct script access allowed');

class Data_kelas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('M_kelas');
    }


    // BAGIAN DATA KELAS MA MIFTAHUNNAJAH
    public function datakelas()
    {
        $data['title'] = 'Data Kelas Siswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['dtkelas'] = $this->M_kelas->getKelas();


        $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required|is_unique[kelas.nama_kelas]', [
            'is_unique' => '<b>Nama kelas sudah ada, silahkan buat nama yang kelas baru!</b>'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kelas/datakelas', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('kelas', [
                'nama_kelas' => $this->input->post('nama_kelas')
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data kelas berhasil <b>ditambahkan.</b> </div>');
            redirect('data_kelas/datakelas');
        }
    }

    // public function addKelas()
    // {
    //     $nama_kelas = $this->input->post('nama_kelas');

    //     $data = [
    //         'nama_kelas' => $nama_kelas
    //     ];

    //     $tambahKelas = $this->db->insert('kelas', $data);
    //     if ($tambahKelas) {
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    //         Data kelas berhasil <b>ditambahkan.</b> </div>');
    //         redirect('data_kelas/datakelas');
    //     }
    // }

    public function ubahKelas($id_kelas = null)
    {
        $data['title'] = 'Edit Kelas';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $where1 = ['id_kelas' => $id_kelas];
        $queryEdit = "SELECT * FROM kelas WHERE id_kelas = $id_kelas";
        $data['ubahKelas'] = $this->db->query($queryEdit)->row_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelas/editKelas', $data);
        $this->load->view('templates/footer');
    }

    public function proseseditKelas()
    {
        $id_kelas = $this->input->post('id_kelas');
        $nama_kelas = $this->input->post('nama_kelas');

        $data = [
            'id_kelas' => $id_kelas,
            'nama_kelas' => $nama_kelas
        ];

        $this->db->where('id_kelas', $id_kelas);
        $edit = $this->db->update('kelas', $data);

        if ($edit) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data kelas berhasil <b>diubah.</b> </div>');
            redirect('data_kelas/datakelas');
        }
    }

    public function hapusKelas($id_kelas = null)
    {
        $this->db->where('id_kelas', $id_kelas);
        $hapus = $this->db->delete('kelas');

        if ($hapus) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data kelas berhasil <b>dihapus.</b> </div>');
            redirect('data_kelas/datakelas');
        }
    }
}