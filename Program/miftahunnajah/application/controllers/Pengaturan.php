<?php
defined('BASEPATH') or exit('no direct script access allowed');

class Pengaturan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('M_pengaturan');
    }


    // BAGIAN PENGATURAN HAK AKSES BENDAHARA
    public function index()
    {
        $data['title'] = "Pengaturan";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $data['user'] = $this->db->get('user')->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pengaturan/index', $data);
        $this->load->view('templates/footer');
    }

    // BAGIAN EDIT PROFILE
    public function myProfile()
    {
        $data['title'] = 'Pengaturan Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $query = "SELECT * FROM user_role WHERE id != 1";

        $data['user_role'] = $this->db->query($query)->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pengaturan/profile', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // from validation
        $this->form_validation->set_rules('name', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pengaturan/editProfile', $data);
            $this->load->view('templates/footer');
        } else {

            // Ambil Data Post
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $useDefault = $this->input->post('useDefault');

            // Cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'jpg|png|svg|jpeg';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];

                    if ($old_image != 'default.png') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            if ($useDefault == 1) {
                $this->db->set('image', 'default.png');
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data profile berhasil <b>di edit.</b>  </div>');
            redirect('pengaturan/myProfile');
        }
    }


    public function changePassword()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Ganti Password';

        $this->form_validation->set_rules('currentPassword', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('newPassword1', 'New Password', 'required|trim|min_length[4]|matches[newPassword2]');
        $this->form_validation->set_rules('newPassword2', 'Confirm New Password', 'required|trim|min_length[4]|matches[newPassword1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pengaturan/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $cpass = $this->input->post('currentPassword');
            $npass = $this->input->post('newPassword1');

            if (!password_verify($cpass, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password lama salah!</div>');
                redirect('pengaturan/changepassword');
            } else {
                if ($npass == $cpass) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password baru sama dengan password lama </div>');
                    redirect('pengaturan/changepassword');
                } else {
                    //true password
                    $pw_hash = password_hash($npass, PASSWORD_DEFAULT);
                    $this->db->set('password', $pw_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil diubah!</div>');
                    redirect('pengaturan/myProfile');
                }
            }
        }
    }


    // BAGIAN USER AKSES MENU MANAGEMENT
    public function aksesMenu()
    {
        $data['title'] = 'Akses Menu';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['aksesMenu'] = $this->M_pengaturan->get_Aksesmenu();
        $data['role'] = $this->db->get('user_role')->result_array();
        $data['u_menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('role_id', 'Role_id', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu_id', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pengaturan/aksesmenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'role_id' => $this->input->post('role_id'),
                'menu_id' => $this->input->post('menu_id')
            ];

            $this->db->insert('user_access_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data user akses menu management berhasil <b>ditambahkan.</b> </div>');
            redirect('pengaturan/aksesMenu');
        }
    }

    public function editAksesMenu()
    {
        $id = $this->input->post('id');
        $role_id = $this->input->post('role_id');
        $menu_id = $this->input->post('menu_id');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $this->db->where('id', $id);
        $editAksesMenu = $this->db->update('user_access_menu', $data);
        if ($editAksesMenu) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data user akses menu berhasil <b>diubah.</b> </div>');
            redirect('pengaturan/aksesMenu');
        }
    }

    public function hapusAksesmenu($id = null)
    {
        // $this->load->model('M_pengaturan');
        // $where = ['id', $id];
        // $this->M_pengaturan->hapus_Aksesmenu($where, 'user_access_menu');
        // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        // Data user akses menu berhasil <b>dihapus.</b> </div>');
        // redirect('pengaturan/aksesMenu');
        $this->db->where('id', $id);
        $deleteAksesmenu = $this->db->delete('user_access_menu');

        if ($deleteAksesmenu) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data submenu management berhasil <b>dihapus.</b> </div>');
            redirect('pengaturan/aksesMenu');
        }
    }


    // BAGIAN MENU MANAGEMENT
    public function menuManagement()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pengaturan/menuMgn', $data);
            $this->load->view('templates/footer');
        }
    }

    public function addMenu()
    {
        $menu = $this->input->post('menu');

        $data = [
            'menu' => $menu
        ];

        $add = $this->db->insert('user_menu', $data);
        if ($add) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data menu management berhasil <b>ditambahkan.</b> </div>');
            redirect('pengaturan/menuManagement');
        }
    }

    public function editMenu()
    {
        $id = $this->input->post('id');
        $menu = $this->input->post('menu');
        $data = [
            'menu' => $menu
        ];

        $this->db->where('id', $id);
        $editMenuManagement = $this->db->update('user_menu', $data);

        if ($editMenuManagement) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Menu management berhasil <b>diubah.</b> </div>');
            redirect('pengaturan/menuManagement');
        endif;
    }

    public function hapusMenu($id)
    {
        // $this->load->model('M_pengaturan');
        // $where = ['id', $id];
        // $this->M_pengaturan->hapus_Menu($where, 'user_menu');
        // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        // Data menu management berhasil <b>dihapus.</b> </div>');
        // redirect('pengaturan/menuManagement');
        $this->db->where('id', $id);
        $deleteMenu = $this->db->delete('user_menu');

        if ($deleteMenu) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data menu management berhasil <b>dihapus.</b> </div>');
            redirect('pengaturan/menuManagement');
        }
    }




    // BAGIAN SUBMENU MANAGEMENT
    public function subMenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['subMenu'] = $this->M_pengaturan->getSubmenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        // form validation tambah submenu
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pengaturan/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];

            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
Data submenu management berhasil <b>ditambahkan.</b> </div>');
            redirect('pengaturan/subMenu');
        }
    }


    public function editSubmenu()
    {
        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $menu_id = $this->input->post('menu_id');
        $url = $this->input->post('url');
        $icon = $this->input->post('icon');
        $is_active = $this->input->post('is_active');

        $data = [
            'id' => $id,
            'title' => $title,
            'menu_id' => $menu_id,
            'url' => $url,
            'icon' => $icon,
            'is_active' => $is_active
        ];

        $this->db->where('id', $id);
        $editSubmenu = $this->db->update('user_sub_menu', $data);

        if ($editSubmenu) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Menu sub menu management berhasil <b>diubah.</b> </div>');
            redirect('pengaturan/subMenu');
        endif;
    }

    public function hapusSubmenu($id)
    {
        $this->db->where('id', $id);
        $deleteSubmenu = $this->db->delete('user_sub_menu');

        if ($deleteSubmenu) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data submenu management berhasil <b>dihapus.</b> </div>');
            redirect('pengaturan/subMenu');
        }
    }
}