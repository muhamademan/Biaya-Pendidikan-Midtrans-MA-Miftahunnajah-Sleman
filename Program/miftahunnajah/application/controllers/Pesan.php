<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url', 'html', 'form');
    }
    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = "Kirim Informasi";

        $data['no_hp'] = $this->db->get('siswa')->result_array();
        // $this->load->view('pesan/send', ['title' => $data]);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pesan/send', $data);
        $this->load->view('templates/footer');
    }




    public function sendmsg()
    {
        $userkey = "f067e7da84fa";
        $passkey = "a92d4328cdc97a98775bf525";
        $telepon = $this->input->post('to');
        $message = $this->input->post('message');

        $url = 'https://console.zenziva.net/reguler/api/sendsms/';

        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
            'userkey' => $userkey,
            'passkey' => $passkey,
            'to' => $telepon,
            'message' => $message
        ));
        $results = json_decode(curl_exec($curlHandle), true);
        curl_close($curlHandle);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Pesan berhasil <b>di kirim.</b> </div>');
        redirect('pesan');
    }
}