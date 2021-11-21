<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Snap_spp extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -  
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */


    public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-6RBmCh8mmSz0p4k9zHdBverx', 'production' => false, 'sanitized' => true, '3ds' => true);
        // $params = array('server_key' => 'SB-Mid-server-6RBmCh8mmSz0p4k9zHdBverx', 'production' => false);
        $this->load->library('midtrans');
        $this->midtrans->config($params);
        $this->load->helper('url');
        //$params = array('server_key' => 'SB-Mid-server-z5T9WhivZDuXrJxC7w-civ_k', 'production' => false, 'sanitized' => true, '3ds' => true);
        //$this->load->library('midtrans');
        //$this->midtrans->config($params);
        #Hendi, 2020-11-24
        require_once APPPATH . 'vendor\midtrans\midtrans-php\Midtrans.php';
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = $this->config->item('serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction
        \Midtrans\Config::$isProduction = $this->config->item('isProduction');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = $this->config->item('isSanitized');
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = $this->config->item('is3ds');
        // Use new notification url(s) disregarding the settings on Midtrans Dashboard Portal (MAP)
        \Midtrans\Config::$overrideNotifUrl = base_url('snap');
        $this->load->helper('url');
    }

    public function index()
    {
        $this->load->view('checkout_snap');
    }

    public function token()
    {
        $id_siswa = $this->input->post('id_siswa');
        $nis = $this->input->post('nis');
        $namasiswa = $this->input->post('nama_siswa');
        $bulan = $this->input->post('bulan', TRUE);
        $jmlspp = $this->input->post('jml_spp');
        $total = $this->input->post('total_spp');

        $transaction_details = array(
            'order_id' => rand(),
            'gross_amount' => $total
        );

        // Optional
        $item_details = array();
        for ($i = 0; $i < count($bulan); $i++) {
            // Optional
            $idbln = $bulan[$i];
            switch ($idbln) {
                case '01':
                    $nmbulan = 'Januari';
                    break;
                case '02':
                    $nmbulan = 'Februari';
                    break;
                case '03':
                    $nmbulan = 'Maret';
                    break;
                case '04':
                    $nmbulan = 'April';
                    break;
                case '05':
                    $nmbulan = 'Mei';
                    break;
                case '06':
                    $nmbulan = 'Juni';
                    break;
                case '07':
                    $nmbulan = 'Juli';
                    break;
                case '08':
                    $nmbulan = 'Agustus';
                    break;
                case '09':
                    $nmbulan = 'September';
                    break;
                case '10':
                    $nmbulan = 'Oktober';
                    break;
                case '11':
                    $nmbulan = 'November';
                    break;
                case '12':
                    $nmbulan = 'Desember';
                    break;
                default:
                    $nmbulan = '';
            }

            $desc = "Pembayaran SPP " . $nmbulan . " " . date("Y");
            $details = array(
                'id' => "$idbln",
                'price' => $jmlspp,
                'quantity' => 1,
                'name' => "$desc"
            );

            array_push($item_details, $details);
        }

        // Optional
        $billing_address = array(
            'first_name' => "$namasiswa",
            'last_name' => 'a',
            'address' => 'a',
            'city' => 'a',
            'postal_code' => 'a',
            'phone' => 'a',
            'country_code' => 'IDN'
        );
        // Optional
        $shipping_address = array(
            'first_name' => "$namasiswa",
            'last_name' => 'a',
            'address' => 'a',
            'city' => 'a',
            'postal_code' => 'a',
            'phone' => 'a',
            'country_code' => 'IDN'
        );
        // Optional
        $customer_details = array(
            'first_name' => "$namasiswa",
            'last_name' => 'a',
            'email' => 'a',
            'phone' => 'a',
            'billing_address' => $billing_address,
            'shipping_address' => $shipping_address
        );
        //echo json_encode($item_details);exit;
        $transaction_data = array(
            'transaction_details' => $transaction_details,
            'item_details' => $item_details,
        );
        //'customer_details' => $customer_details	
        // $snapToken = \Midtrans\Snap::getSnapToken($transaction_data);
        // echo $snapToken;
        error_log(json_encode($transaction_data));
        $snapToken = $this->midtrans->getSnapToken($transaction_data);
        error_log($snapToken);
        echo $snapToken;
    }

    public function finish()
    {
        $result = json_decode($this->input->post('result_data'));
        echo 'RESULT <br><pre>';
        var_dump($result);
        echo '</pre>';
    }

    public function cekStatusTransaksi($idtrx, $nis, $orderid)
    {
        try {
            $response = \Midtrans\Transaction::status($orderid);
            // $response =
            if ($response->status_code == 200) {
                $sql = "UPDATE pembayaran_spp SET status='0' WHERE id_transaksi='$idtrx' AND nis='$nis' AND order_id='$orderid'";
                $this->db->query($sql);
                echo 'success';
            } else {
                if ($response->transaction_status == 'pending') {
                } else {
                    $sql = "UPDATE pembayaran_spp SET status='1' WHERE id_transaksi='$idtrx' AND nis='$nis' AND order_id='$orderid'";
                    $this->db->query($sql);
                }
                echo $response->transaction_status;
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getCode() . ' ' . $e->getMessage();
        }
    }
}
//


// [S3Ct9!2SF3^
// User: miftahu6_admin

// Database: miftahu6_pay