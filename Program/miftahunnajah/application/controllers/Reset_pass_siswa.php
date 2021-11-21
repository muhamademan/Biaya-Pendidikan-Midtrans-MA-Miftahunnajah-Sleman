<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reset_pass_siswa extends CI_Controller

{
    public function index()
    {
        $this->form_validation->set_rules('nis', 'Nis', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Lupa Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/resetSiswa');
            $this->load->view('templates/auth_footer');
        }
    }

    public function updatePass()
    {
        $nis = $this->input->post('nis');
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        $this->db->set('password', $password);
        $this->db->where('nis', $nis);
        $q1 = $this->db->update('siswa');

        if ($q1) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Password <b>berhasil</b> diperbaharui</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Password gagal</b>diubah!</div>');
        }
        redirect('reset_pass_siswa');
    }
}