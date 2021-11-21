<?php
defined('BASEPATH') or exit('no direct script access allowed');

class Master extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('M_master');
        $this->load->model('M_tahunajaran');
        $this->load->model('M_spp');
        $this->load->model('M_tahunan');
        $this->load->model('M_bangunan');
        $this->load->model('M_transaksi');
        $this->load->model('M_thaktif');
        $this->load->helper('url');
    }



    // BAGIAN DATA SISWA MA MIFTAHUNNAJAH
    public function datasiswa()
    {
        $data['title'] = "Data Siswa";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $data['dtsiswa'] = $this->db->get('siswa')->result_array();
        // $data['dtsiswa'] = $this->M_master->getSiswa();

        // $tampilSiswa = "SELECT * FROM kelas";
        // $data['dt_siswa'] = $this->db->query($tampilSiswa)->result_array();

        $data['dtkelas'] = $this->db->get('kelas')->result_array();
        $queryKelas = "SELECT s.*, k.nama_kelas FROM siswa s, kelas k
        WHERE s.id_kelas = k.id_kelas
        ORDER BY s.id_kelas DESC";
        $data['dtsiswa'] = $this->db->query($queryKelas)->result_array();

        $this->form_validation->set_rules('nis', 'NIS', 'required|trim|min_length[10]|is_unique[siswa.nis]', [
            'min_length' => '<b>Panjang NIS minimal 10 angka!<b>',
            'is_unique' => '<b>NIS sudah ada, silahkan menggunakan nis yang baru!</b>'
        ]);
        $this->form_validation->set_rules('id_kelas', 'Id_kelas', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('tgl_lahir', 'Tgl_lahir', 'required|trim');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis_kelamin', 'required|trim');
        $this->form_validation->set_rules('nama_wali', 'Nama_wali', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'No_hp', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[4]', [
            'min_length' => '<b>Password minimal 4 character!</b>'
        ]);


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/siswa', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('siswa', [
                'nis' => $this->input->post('nis'),
                'id_kelas' => $this->input->post('id_kelas'),
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'nama_wali' => $this->input->post('nama_wali'),
                'no_hp' => $this->input->post('no_hp'),
                'alamat' => $this->input->post('alamat'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'is_active' => 1,
                'role_id' => 3,
                'image' => 'default.png'
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data siswa berhasil <b>ditambahkan.</b> </div>');
            redirect('master/datasiswa');
        }
    }

    // public function addsiswa()
    // {
    //     $nis = $this->input->post('nis');
    //     $id_kelas = $this->input->post('id_kelas');
    //     $nama = $this->input->post('nama');
    //     $email = $this->input->post('email');
    //     $tgl_lahir = $this->input->post('tgl_lahir');
    //     $jenis_kelamin = $this->input->post('jenis_kelamin');
    //     $nama_wali = $this->input->post('nama_wali');
    //     $no_hp = $this->input->post('no_hp');
    //     $alamat = $this->input->post('alamat');
    //     $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

    //     $data = [
    //         'nis' => $nis,
    //         'id_kelas' => $id_kelas,
    //         'nama' => $nama,
    //         'email' => $email,
    //         'tgl_lahir' => $tgl_lahir,
    //         'jenis_kelamin' => $jenis_kelamin,
    //         'nama_wali' => $nama_wali,
    //         'no_hp' => $no_hp,
    //         'alamat' => $alamat,
    //         'password' => $password,
    //         'is_active' => 1,
    //         'role_id' => 3,
    //         'image' => 'default.png'
    //     ];

    //     $add = $this->db->insert('siswa', $data);
    //     if ($add) {
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    //         Data siswa berhasil <b>ditambahkan.</b> </div>');
    //         redirect('master/datasiswa');
    //     }
    // }

    public function ubahSiswa($id_siswa = null)
    {
        $data['title'] = 'Edit Data Siswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['ubah_siswa'] = $this->M_master->editSiswa($id_siswa);

        $data['ubah_kelas'] = $this->db->get('kelas')->result_array();

        $editSiswa = "SELECT s.* FROM siswa s, kelas k
                        WHERE s.id_kelas = k.id_kelas
                        AND id_siswa = $id_siswa
                        ORDER BY s.id_kelas";
        $data['ubah_siswa'] = $this->db->query($editSiswa)->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('master/editsiswa', $data);
        $this->load->view('templates/footer');
    }

    public function proseseditSiswa()
    {
        $id_siswa = $this->input->post('id_siswa');
        $id_kelas = $this->input->post('id_kelas');
        $nis = $this->input->post('nis');
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $tgl_lahir = $this->input->post('tgl_lahir');
        $nama_wali = $this->input->post('nama_wali');
        $no_hp = $this->input->post('no_hp');
        $alamat = $this->input->post('alamat');
        $is_active = $this->input->post('is_active');

        $data = [
            'id_siswa' => $id_siswa,
            'id_kelas' => $id_kelas,
            'nis' => $nis,
            'nama' => $nama,
            'email' => $email,
            'jenis_kelamin' => $jenis_kelamin,
            'tgl_lahir' => $tgl_lahir,
            'nama_wali' => $nama_wali,
            'no_hp' => $no_hp,
            'alamat' => $alamat,
            'is_active' => $is_active
        ];

        $this->db->where('id_siswa', $id_siswa);
        $edit = $this->db->update('siswa', $data);

        if ($edit) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data siswa berhasil <b>diubah.</b> </div>');
            redirect('master/datasiswa');
        }
    }


    public function detailSiswa($id_siswa)
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


    public function hapusSiswa($id_siswa = null)
    {
        // $delete = $this->User_model->hapusAdmin('id', $id);
        $this->db->where('id_siswa', $id_siswa);
        $delete = $this->db->delete('siswa');

        if ($delete) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data siswa berhasil <b>dihapus.</b> </div>');
            redirect('master/datasiswa');
        }
    }



    // // BAGIAN DATA KELAS MA MIFTAHUNNAJAH
    // public function datakelas()
    // {
    //     $data['title'] = 'Data Kelas Siswa';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('kelas/datakelas', $data);
    //     $this->load->view('templates/footer');
    // }



    // BAGIAN DATA TAHUN AJARAN MA MIFTAHUNNAJAH
    public function dataajaran()
    {
        $data['title'] = 'Data Tahun Ajaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['dt_thajaran'] = $this->M_tahunajaran->getTahunajaran();


        $this->form_validation->set_rules('tahun_ajaran', 'Tahun_ajaran', 'required|is_unique[tahun_ajaran.tahun_ajaran]', [
            'is_unique' => '<b>Tahun ajaran sudah tersedai, silahkan buat tahun ajaran baru!</b>'
        ]);
        $this->form_validation->set_rules('besar_spp', 'Besar_spp', 'required');
        $this->form_validation->set_rules('besar_tahunan', 'Besar_tahunan', 'required');
        $this->form_validation->set_rules('besar_bangunan', 'Besar_bangunan', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('ajaran/tahunajaran', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('tahun_ajaran', [
                'tahun_ajaran' => $this->input->post('tahun_ajaran'),
                'besar_spp' => $this->input->post('besar_spp'),
                'besar_tahunan' => $this->input->post('besar_tahunan'),
                'besar_bangunan' => $this->input->post('besar_bangunan'),
                'status' => $this->input->post('status')
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data tahun ajaran berhasil <b>ditambahkan.</b> </div>');
            redirect('master/dataajaran');
        }
    }

    // public function addThajaran()
    // {
    //     $tahun_ajaran = $this->input->post('tahun_ajaran');
    //     $besar_spp = $this->input->post('besar_spp');
    //     $besar_tahunan = $this->input->post('besar_tahunan');
    //     $besar_bangunan = $this->input->post('besar_bangunan');
    //     $status = $this->input->post('status');

    //     $data = [
    //         'tahun_ajaran' => $tahun_ajaran,
    //         'besar_spp' => $besar_spp,
    //         'besar_tahunan' => $besar_tahunan,
    //         'besar_bangunan' => $besar_bangunan,
    //         'status' => $status
    //     ];

    //     $add = $this->db->insert('tahun_ajaran', $data);
    //     if ($add) {
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    //         Data tahun ajaran berhasil <b>ditambahkan.</b> </div>');
    //         redirect('master/dataajaran');
    //     }
    // }

    public function ubahThajaran($id_tahun = null)
    {
        $data['title'] = 'Edit Tahun Ajaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['ubahAjaran'] = $this->M_tahunajaran->editAjaran($id_tahun);
        $ubahAjaran = "SELECT * FROM tahun_ajaran WHERE id_tahun = $id_tahun";
        $data['edit_ajaran'] = $this->db->query($ubahAjaran)->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ajaran/editThajaran', $data);
        $this->load->view('templates/footer');
    }

    public function prosesThajaran()
    {
        $id_tahun = $this->input->post('id_tahun');
        $tahun_ajaran = $this->input->post('tahun_ajaran');
        $besar_spp = $this->input->post('besar_spp');
        $besar_tahunan = $this->input->post('besar_tahunan');
        $besar_bangunan = $this->input->post('besar_bangunan');
        $status = $this->input->post('status');

        $data = [
            'tahun_ajaran' => $tahun_ajaran,
            'besar_spp' => $besar_spp,
            'besar_tahunan' => $besar_tahunan,
            'besar_bangunan' => $besar_bangunan,
            'status' => $status
        ];

        $this->db->where('id_tahun', $id_tahun);
        $editThajaran = $this->db->update('tahun_ajaran', $data);

        if ($editThajaran) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Tahun ajaran berhasil <b>diubah.</b> </div>');
            redirect('master/dataajaran');
        endif;
    }

    public function hapusThajaran($id_ajaran = null)
    {
        // $delete = $this->User_model->hapusAdmin('id', $id);
        $this->db->where('id_tahun', $id_ajaran);
        $delete = $this->db->delete('tahun_ajaran');

        if ($delete) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data tahun ajaran berhasil <b>dihapus.</b> </div>');
            redirect('master/dataajaran');
        }
    }


    // BAGIAN DATA SISWA AKTIF DI MA MIFTAHUNNAJAH SELMAN
    public function siswaAktif()
    {
        $data['title'] = 'Data Siswa Aktif';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['th_aktif'] = $this->M_thaktif->tampil_data();
        // $sql['nama_siswa'] = ("SELECT siswa.nis, siswa.nama FROM siswa")->row_array();

        $tambahSiswa = "SELECT a.nis, a.id_siswa, a.nama FROM siswa a";
        $data['siswa_akf'] = $this->db->query($tambahSiswa)->result_array();

        // $sql = "SELECT b.id_tahun_aktif, a.nama, a.nis, b.id_siswa
        //         FROM siswa a, tahun_aktif b
        //         WHERE a.id_siswa = b.id_siswa";

        // $data['siswa_akf'] = $this->db->query($sql)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('siswaaktif/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_aksi()
    {
        // Ambil data yang dikirim dari form
        $id_tahun_aktif = rand(0000, 9999);
        $nis = $this->input->post('nis[]', TRUE);

        $data = array();

        $index = 1; // Set index array awal dengan 0
        foreach ($nis as $key) { // Kita buat perulangan berdasarkan nis sampai data terakhir
            array_push($data, array(
                'id_tahun_aktif' => $id_tahun_aktif,  // Ambil dan set data nama sesuai index array dari $index
                'id_siswa' => $key,
            ));

            $key;
        }
        $this->M_thaktif->save_thn_aktif($data);
        // var_dump($data);
        // exit();

        $this->session->set_flashdata('message11', '<div class="alert alert-success" role="alert">
        Siswa aktif berhasil ditambahkan! <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span></button></div>');
        redirect('master/siswaAktif');
    }

    public function hapusThaktif($id_tahun_aktif)
    {
        $this->db->where('id_tahun_aktif', $id_tahun_aktif);
        $delete = $this->db->delete('tahun_aktif');

        if ($delete) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data siswa aktif berhasil <b>dihapus.</b> </div>');
            redirect('master/siswaAktif');
        }
    }



    // BAGIAN PEMBAYARAN SPP OLEH ADMIN
    public function bayar_spp()
    {
        // $data['title'] = 'Data Pembayaran SPP';
        // $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // // $data['dt_thajaran'] = $this->M_tahunajaran->getTahunajaran();
        // $data['dt_spp'] = $this->M_spp->getSpp();
        // $data['thn_ajaran'] = $this->db->get('tahun_ajaran')->result_array();

        // $this->load->view('templates/header', $data);
        // $this->load->view('templates/sidebar', $data);
        // $this->load->view('templates/topbar', $data);
        // $this->load->view('spp/index', $data);
        // $this->load->view('templates/footer');


        $data['title'] = 'Registrasi Pembayaran Spp';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $sql = "SELECT b.id_spp, a.nama, a.nis, b.id_siswa, b.jenis_pembayaran, b.tahun_ajaran
                FROM siswa a, biaya_spp b
                WHERE a.id_siswa = b.id_siswa";

        $data['bayar_spp'] = $this->db->query($sql)->result_array();

        $th_ajar = "SELECT a.id_tahun, a.tahun_ajaran FROM tahun_ajaran a where status='ON'";
        $data['ajar'] = $this->db->query($th_ajar)->result_array();

        $dt_siswa = "SELECT * FROM siswa WHERE is_active = 1";
        $data['dtsiswa'] = $this->db->query($dt_siswa)->result_array();
        // $data['pembayaran_bulanan'] = $this->M_transaksi->tampil_pem_bulanan();
        // $data1['tahun_aktif'] = $this->M_thaktif->tampil_data();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('spp/index', $data);
        $this->load->view('templates/footer');
    }

    // public function addSpp()
    // {
    //     $id_tahun = $this->input->post('id_tahun');
    //     $biaya_spp = $this->input->post('biaya_spp');
    //     $status = $this->input->post('status');

    //     $data = [
    //         'id_tahun' => $id_tahun,
    //         'biaya_spp' => $biaya_spp,
    //         'status' => $status
    //     ];

    //     $add = $this->db->insert('biaya_spp', $data);
    //     if ($add) {
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    //         Data pembayaran spp berhasil <b>ditambahkan.</b> </div>');
    //         redirect('master/bayar_spp');
    //     }
    // }

    public function tambahSpp()
    {

        // Ambil data yang dikirim dari form
        $id_spp = $this->input->post('id_spp');
        $nis = $this->input->post('nis[]', TRUE);
        $tahun_ajaran = $this->input->post('tahun_ajaran');
        $jenis_pembayaran =  $this->input->post('jenis_pembayaran');
        $data = array();

        $index = 1; // Set index array awal dengan 0
        foreach ($nis as $key) { // Kita buat perulangan berdasarkan nis sampai data terakhir
            array_push($data, array(
                'id_siswa' => $key,
                'id_spp' => $id_spp++,  // Ambil dan set data nama sesuai index array dari $index
                'tahun_ajaran' => $tahun_ajaran,
                // 'id_trans' => $id_trans,  // Ambil dan set data telepon sesuai index array dari $index
                'jenis_pembayaran' => $jenis_pembayaran,

            ));

            $key;
        }

        $sql = $this->M_transaksi->save_pem_bulanan($data);
        // var_dump($data);
        // exit();
        if ($sql) { // Jika sukses
            echo "<script>alert('Data berhasil disimpan');window.location = '" . base_url('master/bayar_spp') . "';</script>";
        } else { // Jika gagal
            echo "<script>alert('Data gagal disimpan');window.location = '" . base_url('master/bayar_spp') . "';</script>";
        }
    }

    // public function ubahSpp($id_spp = null)
    // {
    //     $data['title'] = 'Edit Biaya Spp';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    //     $data['th_ajaran'] = $this->db->get('tahun_ajaran')->result_array();
    //     $this->db->where('id_spp', $id_spp);
    //     $data['bayar_spp'] = $this->db->get('biaya_spp')->row_array();

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('spp/editSpp', $data);
    //     $this->load->view('templates/footer');
    // }

    // public function prosesSpp()
    // {
    //     $id_spp = $this->input->post('id_spp');
    //     $id_tahun = $this->input->post('id_tahun');
    //     // $tahun_ajaran = $this->input->post('tahun_ajaran');
    //     $biaya_spp = $this->input->post('biaya_spp');
    //     $status = $this->input->post('status');

    //     $data = [
    //         'id_spp' => $id_spp,
    //         'id_tahun' => $id_tahun,
    //         'biaya_spp' => $biaya_spp,
    //         'status' => $status
    //     ];

    //     $this->db->where('id_spp', $id_spp);
    //     $editThajaran = $this->db->update('biaya_spp', $data);

    //     if ($editThajaran) :
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    //         Data biaya spp berhasil <b>diubah.</b> </div>');
    //         redirect('master/bayar_spp');
    //     endif;
    // }

    public function hapusSpp($id_spp)
    {
        $this->db->where('id_spp', $id_spp);
        $delete = $this->db->delete('biaya_spp');

        if ($delete) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data registrasi pembayaran spp berhasil <b>dihapus.</b> </div>');
            redirect('master/bayar_spp');
        }
    }



    // BAGIAN PEMBAYARAN TAHUNAN OLEH ADMIN
    public function bayar_tahunan()
    {
        $data['title'] = 'Registrasi Pembayaran Tahunan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $data['dt_tahunan'] = $this->M_tahunan->getTahunan();
        // $data['thn_ajaran'] = $this->db->get('tahun_ajaran')->result_array();

        $sql = "SELECT b.id_tahunan, a.nama, a.nis, b.id_siswa, b.jenis_pembayaran, b.tahun_ajaran
                FROM siswa a, biaya_tahunan b
                WHERE a.id_siswa = b.id_siswa";

        $data['bayar_th'] = $this->db->query($sql)->result_array();

        $th_ajar = "SELECT a.id_tahun, a.tahun_ajaran FROM tahun_ajaran a where status='ON'";
        $data['ajar'] = $this->db->query($th_ajar)->result_array();

        $dt_siswa = "SELECT * FROM siswa WHERE is_active = 1";
        $data['dtsiswa'] = $this->db->query($dt_siswa)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('tahunan/index', $data);
        $this->load->view('templates/footer', $data);
    }


    public function addTahunan()
    {

        // Ambil data yang dikirim dari form
        $id_tahunan = $this->input->post('id_tahunan');
        $nis = $this->input->post('nis[]', TRUE);
        $tahun_ajaran = $this->input->post('tahun_ajaran');
        $jenis_pembayaran =  $this->input->post('jenis_pembayaran');
        $data = array();

        $index = 1; // Set index array awal dengan 0
        foreach ($nis as $key) { // Kita buat perulangan berdasarkan nis sampai data terakhir
            array_push($data, array(
                'id_siswa' => $key,
                'id_tahunan' => $id_tahunan++,  // Ambil dan set data nama sesuai index array dari $index
                'tahun_ajaran' => $tahun_ajaran,
                // 'id_trans' => $id_trans,  // Ambil dan set data telepon sesuai index array dari $index
                'jenis_pembayaran' => $jenis_pembayaran,

            ));

            $key;
        }

        $sql = $this->M_transaksi->save_pem_tahunan($data);
        // var_dump($data);
        // exit();
        if ($sql) { // Jika sukses
            echo "<script>alert('Data berhasil disimpan');window.location = '" . base_url('master/bayar_tahunan') . "';</script>";
        } else { // Jika gagal
            echo "<script>alert('Data gagal disimpan');window.location = '" . base_url('master/bayar_tahunan') . "';</script>";
        }

        // $id_tahun = $this->input->post('id_tahun');
        // // $th_ajaran = $this->input->post('th_ajaran');
        // $biaya_tahunan = $this->input->post('biaya_tahunan');
        // $status = $this->input->post('status');

        // $data = [
        //     'id_tahun' => $id_tahun,
        //     // 'th_ajaran' => $th_ajaran,
        //     'biaya_tahunan' => $biaya_tahunan,
        //     'status' => $status
        // ];

        // $add = $this->db->insert('biaya_tahunan', $data);
        // if ($add) {
        //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        //     Data biaya tahunan berhasil <b>ditambahkan.</b> </div>');
        //     redirect('master/bayar_tahunan');
        // }
    }

    // public function ubahTahunan($id_tahunan = null)
    // {
    //     $data['title'] = 'Edit Biaya Tahunan';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


    //     // $data['bayar_spp'] = $this->M_spp->getSpp();
    //     $data['th_ajaran'] = $this->db->get('tahun_ajaran')->result_array();
    //     $this->db->where('id_tahunan', $id_tahunan);
    //     $data['bayar_tahunan'] = $this->db->get('biaya_tahunan')->row_array();

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('tahunan/editTahunan', $data);
    //     $this->load->view('templates/footer');
    // }

    // public function prosesTahunan()
    // {
    //     $id_tahunan = $this->input->post('id_tahunan');
    //     $id_tahun = $this->input->post('id_tahun');
    //     // $tahun_ajaran = $this->input->post('tahun_ajaran');
    //     $biaya_tahunan = $this->input->post('biaya_tahunan');
    //     $status = $this->input->post('status');

    //     $data = [
    //         'id_tahunan' => $id_tahunan,
    //         'id_tahun' => $id_tahun,
    //         // 'tahun_ajaran' => $tahun_ajaran,
    //         'biaya_tahunan' => $biaya_tahunan,
    //         'status' => $status
    //     ];

    //     $this->db->where('id_tahunan', $id_tahunan);
    //     $editThajaran = $this->db->update('biaya_tahunan', $data);

    //     if ($editThajaran) :
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    //         Data biaya tahunan berhasil <b>diubah.</b> </div>');
    //         redirect('master/bayar_tahunan');
    //     endif;
    // }

    public function hapusTahunan($id_tahunan)
    {
        $this->db->where('id_tahunan', $id_tahunan);
        $delete = $this->db->delete('biaya_tahunan');

        if ($delete) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data biaya tahunan berhasil <b>dihapus.</b> </div>');
            redirect('master/bayar_tahunan');
        }
    }




    // BAGIAN PEMBAYARAN BANGUNAN OLEH ADMIN
    public function bayar_bangunan()
    {
        $data['title'] = 'Data Pembayaran Bangunan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $data['dt_bangunan'] = $this->M_bangunan->getBangunan();
        // $data['thn_ajaran'] = $this->db->get('tahun_ajaran')->result_array();

        $sql_bg = "SELECT b.id_bangunan, a.nama, a.nis, b.id_siswa, b.jenis_pembayaran, b.tahun_ajaran
                FROM siswa a, biaya_bangunan b
                WHERE a.id_siswa = b.id_siswa";

        $data['bayar_bg'] = $this->db->query($sql_bg)->result_array();

        $th_ajar = "SELECT a.id_tahun, a.tahun_ajaran FROM tahun_ajaran a where status='ON'";
        $data['ajar'] = $this->db->query($th_ajar)->result_array();

        $dt_siswa = "SELECT * FROM siswa WHERE is_active = 1";
        $data['dtsiswa'] = $this->db->query($dt_siswa)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('bangunan/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function addBangunan()
    {
        // Ambil data yang dikirim dari form
        $id_bangunan = $this->input->post('id_bangunan');
        $nis = $this->input->post('nis[]', TRUE);
        $tahun_ajaran = $this->input->post('tahun_ajaran');
        $jenis_pembayaran =  $this->input->post('jenis_pembayaran');
        $data = array();

        $index = 1; // Set index array awal dengan 0
        foreach ($nis as $key) { // Kita buat perulangan berdasarkan nis sampai data terakhir
            array_push($data, array(
                'id_siswa' => $key,
                'id_bangunan' => $id_bangunan++,  // Ambil dan set data nama sesuai index array dari $index
                'tahun_ajaran' => $tahun_ajaran,
                // 'id_trans' => $id_trans,  // Ambil dan set data telepon sesuai index array dari $index
                'jenis_pembayaran' => $jenis_pembayaran,

            ));

            $key;
        }

        $sql = $this->M_transaksi->save_pem_bangunan($data);
        // var_dump($data);
        // exit();
        if ($sql) { // Jika sukses
            echo "<script>alert('Data berhasil disimpan');window.location = '" . base_url('master/bayar_bangunan') . "';</script>";
        } else { // Jika gagal
            echo "<script>alert('Data gagal disimpan');window.location = '" . base_url('master/bayar_bangunan') . "';</script>";
        }


        // $id_tahun = $this->input->post('id_tahun');
        // // $th_ajaran = $this->input->post('th_ajaran');
        // $biaya_bangunan = $this->input->post('biaya_bangunan');
        // $status = $this->input->post('status');

        // $data = [
        //     'id_tahun' => $id_tahun,
        //     // 'th_ajaran' => $th_ajaran,
        //     'biaya_bangunan' => $biaya_bangunan,
        //     'status' => $status
        // ];

        // $add = $this->db->insert('biaya_bangunan', $data);
        // if ($add) {
        //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        //     Data biaya bangunan berhasil <b>ditambahkan.</b> </div>');
        //     redirect('master/bayar_bangunan');
        // }
    }

    // public function ubahBangunan($id_bangunan = null)
    // {
    //     $data['title'] = 'Edit Biaya Tahunan';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


    //     // $data['bayar_spp'] = $this->M_spp->getSpp();
    //     $data['th_ajaran'] = $this->db->get('tahun_ajaran')->result_array();
    //     $this->db->where('id_bangunan', $id_bangunan);
    //     $data['bayar_bangunan'] = $this->db->get('biaya_bangunan')->row_array();

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('bangunan/editBangunan', $data);
    //     $this->load->view('templates/footer');
    // }

    // public function prosesBangunan()
    // {
    //     $id_bangunan = $this->input->post('id_bangunan');
    //     $id_tahun = $this->input->post('id_tahun');
    //     // $tahun_ajaran = $this->input->post('tahun_ajaran');
    //     $biaya_bangunan = $this->input->post('biaya_bangunan');
    //     $status = $this->input->post('status');

    //     $data = [
    //         'id_bangunan' => $id_bangunan,
    //         'id_tahun' => $id_tahun,
    //         // 'tahun_ajaran' => $tahun_ajaran,
    //         'biaya_bangunan' => $biaya_bangunan,
    //         'status' => $status
    //     ];

    //     $this->db->where('id_bangunan', $id_bangunan);
    //     $editThajaran = $this->db->update('biaya_bangunan', $data);

    //     if ($editThajaran) :
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    //         Data biaya bangunan berhasil <b>diubah.</b> </div>');
    //         redirect('master/bayar_bangunan');
    //     endif;
    // }

    public function hapusBangunan($id_bangunan)
    {
        $this->db->where('id_bangunan', $id_bangunan);
        $delete = $this->db->delete('biaya_bangunan');

        if ($delete) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data biaya bangunan berhasil <b>dihapus.</b> </div>');
            redirect('master/bayar_bangunan');
        }


        // $this->db->where('id_bangunan', $id_bangunan);
        // $delete = $this->db->delete('biaya_bangunan');

        // if ($delete) {
        //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        //     Data biaya bangunan berhasil <b>dihapus.</b> </div>');
        //     redirect('master/bayar_bangunan');
        // }
    }
}