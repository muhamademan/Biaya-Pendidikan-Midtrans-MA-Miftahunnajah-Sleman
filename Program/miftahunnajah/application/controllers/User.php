<?php
defined('BASEPATH') or exit('no direct script access allowed');

class User extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('User_model');
        $this->load->helper('url');
    }


    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $data['user'] = $this->db->get('user')->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function dashboard()
    {
        $data['title'] = 'Dashboard Halaman';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $total1  = "SELECT SUM(jumlah) as jum FROM `pembayaran_spp`";
        $data['total_spp'] = $this->db->query($total1)->result_array();

        $total2 = "SELECT SUM(jumlah) as jum FROM pembayaran_tahunan";
        $data['total_thn'] = $this->db->query($total2)->result_array();

        $total3 = "SELECT SUM(jumlah) as jum FROM pembayaran_bangunan";
        $data['total_bgn'] = $this->db->query($total3)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function dataadmin()
    {
        $data['title'] = 'Data Admin';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $data['dtuser'] = $this->User_model->tampil_data();
        $data['usrole'] = $this->db->get('user_role')->result_array();
        $tampilUser = "SELECT user.*, user_role.role, user_role.id AS id_role FROM user, user_role
                    WHERE user.role_id = user_role.id 
                    ORDER BY user.id DESC";

        $data['dtuser'] = $this->db->query($tampilUser)->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/dataadmin', $data);
        $this->load->view('templates/footer');
    }

    public function addadmin()
    {
        $role_id = $this->input->post('role_id');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $no_hp = $this->input->post('no_hp');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

        $data = [
            'role_id' => $role_id,
            'name' => $name,
            'email' => $email,
            'no_hp' => $no_hp,
            'jenis_kelamin' => $jenis_kelamin,
            'password' => $password,
            'is_active' => 1,
            'image' => 'default.png'
        ];

        $add = $this->db->insert('user', $data);
        if ($add) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data akun admin berhasil <b>ditambahkan.</b> </div>');
            redirect('user/dataadmin');
        }
    }

    public function deleteadmin($id = null)
    {
        // $delete = $this->User_model->hapusAdmin('id', $id);
        $this->db->where('id', $id);
        $delete = $this->db->delete('user');

        if ($delete) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data akun admin berhasil <b>dihapus.</b> </div>');
            redirect('user/dataadmin');
        }
    }

    public function editAdmin($id = null)
    {
        $data['title'] = 'Edit Data Admin';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['edit_role'] = $this->db->get('user_role')->result_array();
        $editAdmin = "SELECT u.* FROM user u, user_role ur
                        WHERE ur.id = u.role_id
                        AND u.id = $id";
        $data['edit_user'] = $this->db->query($editAdmin)->row_array();

        // $this->load->model('User_model');
        // $data['edit_user'] = $this->User_model->edit_admin();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/editadmin', $data);
        $this->load->view('templates/footer');
    }

    public function proseseditAdmin()
    {
        $role_id = $this->input->post('role_id');
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $no_hp = $this->input->post('no_hp');
        $is_active = $this->input->post('is_active');
        $jenis_kelamin = $this->input->post('jenis_kelamin');

        $data = [
            'role_id' => $role_id,
            'name' => $name,
            'email' => $email,
            'no_hp' => $no_hp,
            'is_active' => $is_active,
            'jenis_kelamin' => $jenis_kelamin
        ];

        $this->db->where('id', $id);
        $edit = $this->db->update('user', $data);

        if ($edit) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data akun admin berhasil <b>diubah.</b> </div>');
            redirect('user/dataadmin');
        endif;
    }
}