<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Snap_coba extends CI_Controller
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
        $params = array('server_key' => 'SB-Mid-server-6RBmCh8mmSz0p4k9zHdBverx', 'production' => false);
        $this->load->library('midtrans');
        $this->midtrans->config($params);
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
        $email = $this->input->post('email');
        $namasiswa = $this->input->post('nama_siswa');
        $bulan = $this->input->post('bulan', TRUE);
        $jmlspp = $this->input->post('jml_spp');
        $total = $this->input->post('total_spp');

        // Required
        $transaction_details = array(
            'order_id' => rand(),
            'gross_amount' => $jmlspp, // no decimal allowed for creditcard
        );

        // Optional
        $item1_details = array(
            'id' => 'a1',
            'price' => $jmlspp,
            'quantity' => 1,
            'name' => "SPP"
        );

        // // Optional
        // $item2_details = array(
        //     'id' => 'a2',
        //     'price' => 20000,
        //     'quantity' => 2,
        //     'name' => "Orange"
        // );

        // Optional
        $item_details = array($item1_details);

        // Optional
        // $billing_address = array(
        //     'first_name'    => "Andri",
        //     'last_name'     => "Litani",
        //     'address'       => "Mangga 20",
        //     'city'          => "Jakarta",
        //     'postal_code'   => "16602",
        //     'phone'         => "081122334455",
        //     'country_code'  => 'IDN'
        // );

        // // Optional
        // $shipping_address = array(
        //     'first_name'    => "Obet",
        //     'last_name'     => "Supriadi",
        //     'address'       => "Manggis 90",
        //     'city'          => "Jakarta",
        //     'postal_code'   => "16601",
        //     'phone'         => "08113366345",
        //     'country_code'  => 'IDN'
        // );

        // Optional
        $customer_details = array(
            'first_name'    => $namasiswa,
            'last_name'     => $email,
            // 'email'         => $email,
            'phone'         => "081122334455",
            // 'billing_address'  => $billing_address,
            // 'shipping_address' => $shipping_address
        );

        // Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O", $time),
            'unit' => 'day',
            'duration'  => 1
        );

        $transaction_data = array(
            'transaction_details' => $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );

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

    // public function cekStatusTransaksi($idtrx, $nis, $orderid)
    // {
    //     try {
    //         $response = \Midtrans\Transaction::status($orderid);
    //         if ($response->status_code == 200) {
    //             $sql = "UPDATE pembayaran_spp SET status='0' WHERE id_transaksi='$idtrx' AND nis='$nis' AND order_id='$orderid'";
    //             $this->db->query($sql);
    //             echo 'success';
    //         } else {
    //             if ($response->transaction_status == 'pending') {
    //             } else {
    //                 $sql = "UPDATE pembayaran_spp SET status='1' WHERE id_transaksi='$idtrx' AND nis='$nis' AND order_id='$orderid'";
    //                 $this->db->query($sql);
    //             }
    //             echo $response->transaction_status;
    //         }
    //     } catch (Exception $e) {
    //         echo 'Error: ' . $e->getCode() . ' ' . $e->getMessage();
    //     }
    // }
}