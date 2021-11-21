<?php
defined('BASEPATH') or exit('no direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    // public function halaman_awal()
    // {
    //     $this->load->view('auth/awal');
    // }




    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Admin';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer', $data);
        } else {
            // jika validasi berhasil
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        // jika usernya ada
        if ($user) {
            // jika usernya aktif
            if ($user['is_active'] == 1) {
                // cek passwordnya
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } elseif ($user['role_id'] == 2) {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Password salah! </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> 
                Email belum diaktifikasi! </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> 
            Email belum terdaftar! </div>');
            redirect('auth');
        }
    }


    public function lupa_password()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has alredy registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password 4 character!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'User Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/lupa_pass_admin');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.png',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 3,
                'is_active' => 1,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Password berhasil dirubah</div>');
            redirect('auth');
        }
    }

    // Reset Password Admin
    public function indexreset1()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Lupa Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/lupa_pass_admin');
            $this->load->view('templates/auth_footer');
        } else {
            // Ketika vaidasinya lolos/sukses
            $this->resetPassword1();
        }
    }

    public function resetPassword1()
    {
        $email = $this->input->post('email');
        $QueryEmail = "SELECT id FROM `user` WHERE email = '$email'";
        $var = $user['Email'] = $this->db->query($QueryEmail)->result_array();

        if ($var == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        <b>Email tidak terdaftar!</b></div>');
            redirect('auth/indexreset1');
        } else {
            $data = [
                'email' => $this->input->post('email'),
            ];
            $cek = $this->session->set_userdata($data);
            redirect('reset_pass_admin');
        }
    }




    // LOGIN SISWA
    public function login_siswa()
    {
        // if ($this->session->userdata('nis')) {
        //     redirect('siswa');
        // }

        $this->form_validation->set_rules('nis', 'nis', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        // $this->form_validation->set_rules('captcha', 'Captcha', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Siswa';
            $this->load->view('templates_siswa/auth_header', $data);
            $this->load->view('auth/login_siswa');
            $this->load->view('templates_siswa/auth_footer', $data);
        } else {
            $this->_loginsiswa();
        }
    }


    private function _loginsiswa()
    {
        $nis = $this->input->post('nis');
        $password = $this->input->post('password');

        $siswa = $this->db->get_where('siswa', ['nis' => $nis])->row_array();
        if ($siswa) {
            if ($siswa['is_active'] == 1) {
                if (password_verify($password, $siswa['password'])) {
                    $data = [
                        'nis' => $siswa['nis'],
                        'role_id' => $siswa['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($siswa['role_id'] == 3) {
                        redirect('siswa');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Password salah! </div>');
                    redirect('auth/login_siswa');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                NIS tidak aktif! </div>');
                redirect('auth/login_siswa');
            }
        } else {
            // Tidak ada user dengan email itu
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            NIS tidak terdaftar! </div>');
            redirect('auth/login_siswa');
        }
    }


    public function lupa_password_siswa()
    {
        // if ($this->session->userdata('nis')) {
        //     redirect('siswa');
        // }

        $this->form_validation->set_rules('nis', 'nis', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password 4 character!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'User Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/lupa_pass_siswa');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.png',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 3,
                'is_active' => 1,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Password berhasil dirubah</div>');
            redirect('auth/login_siswa');
        }
    }

    // Reset Password Siswa
    public function indexreset2()
    {
        $this->form_validation->set_rules('nis', 'Nis', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Lupa Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/lupa_pass_siswa');
            $this->load->view('templates/auth_footer');
        } else {
            // Ketika vaidasinya lolos/sukses
            $this->resetPassword2();
        }
    }

    public function resetPassword2()
    {
        $nis = $this->input->post('nis');
        $QueryNis = "SELECT id_siswa FROM `siswa` WHERE nis = '$nis'";
        $var = $user['Email'] = $this->db->query($QueryNis)->result_array();

        if ($var == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        <b>NIS tidak terdaftar!</b></div>');
            redirect('auth/indexreset2');
        } else {
            $data = [
                'nis' => $this->input->post('nis'),
            ];
            $cek = $this->session->set_userdata($data);
            redirect('reset_pass_siswa');
        }
    }






    // REGISTRASI AKUN
    public function registrasi()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email sudah digunakan!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]', [
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        $this->form_validation->set_rules('no_hp', 'No.Telepon', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Halaman Registrasi';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registrasi');
            $this->load->view('templates/auth_footer', $data);
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.png',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'no_hp' => $this->input->post('no_hp'),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => date('Y-m-d')
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Selamat! akun berhasil dibuat. Silahkan Login </div>');
            redirect('auth');
        }
    }

    // BAGIAN LOGOUT
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah keluar dari halaman! </div>');
        redirect('auth');
    }


    // BAGIAN BLOK HAK AKSES MENU
    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}