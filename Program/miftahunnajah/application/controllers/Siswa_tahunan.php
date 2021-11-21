<?php
defined('BASEPATH') or exit('no direct script access allowed');

class Siswa_tahunan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in_siswa();

        $this->load->model('M_master');
        $this->load->model('M_tahunajaran');
        // $this->load->model('M_spp');
        $this->load->model('M_tahunan');
        // $this->load->model('M_bangunan');
        $this->load->model('M_transaksi');
    }





    // PEMBAYARAN TAHUNAN ONLINE
    public function tahunan()
    {
        $data['id_transaksi'] = $this->M_transaksi->id_transaksi1();
        $data['tgl_bayar'] = date("Y-m-d");
        $data['title'] = 'Pembayaran Tahunan Online';
        $data['siswa'] = $this->db->get_where('siswa', ['nis' => $this->session->userdata('nis')])->row_array();

        $nis = $data['siswa']['nis'];
        $nia = $data['siswa']['id_siswa'];

        // mengambil data pembayaran spp
        $data['pem_bulan'] = $this->M_transaksi->pembayaran_tahunan()->result();

        $sql = "SELECT a.id_tahunan, a.id_siswa, a.tahun_ajaran, a.jenis_pembayaran, f.total_tahunan, f.jml_bulan,IF(f.jml_bulan = 1, 'Lunas', 'Belum Lunas') AS status_bayar 
				FROM biaya_tahunan a
				LEFT JOIN 
				(
					SELECT e.id_siswa,e.tahun_ajaran, SUM(e.besar_tahunan) AS total_tahunan, COUNT(e.id_bulan) AS jml_bulan FROM 
					(
						SELECT b.id_transaksi, b.id_siswa, b.id_bulan, b.id_tahun, c.tahun_ajaran, b.jumlah AS besar_tahunan
						FROM pembayaran_tahunan b
						INNER JOIN tahun_ajaran c ON b.id_tahun = c.id_tahun
						WHERE b.status='0'
					) e GROUP BY e.id_siswa,e.tahun_ajaran
				) f ON a.id_siswa = f.id_siswa AND a.tahun_ajaran = f.tahun_ajaran
				WHERE a.id_siswa = '$nia'";

        $data['bayaran_th'] = $this->db->query($sql)->result();

        $this->load->view('templates_siswa/header', $data);
        $this->load->view('templates_siswa/sidebar', $data);
        $this->load->view('templates_siswa/topbar', $data);
        $this->load->view('pembayaran_siswa/biaya_tahunan', $data);
        $this->load->view('templates_siswa/footer');
    }

    // PEMBAYARAN TAHUNAN ONLINE
    public function bayar_Tahunan($nis, $id_siswa)
    {
        $data['id_transaksi'] = $this->M_transaksi->id_transaksi1();
        $data['tgl_bayar'] = date("Y-m-d");
        $data['title'] = 'Transaksi Pembayaran Tahunan';

        $data['siswa'] = $this->db->get_where('siswa', ['nis' => $this->session->userdata('nis')])->row_array();
        $where1 = array('id_siswa' => $id_siswa);

        $data['siswa1'] = $this->M_transaksi->tampil_data($where1)->result();
        $data['siswa1'] = $this->M_transaksi->tampil_detail($where1)->result();
        $data['user'] = $this->M_transaksi->tampil_user($where1)->row_array();
        $data['tahun'] = $this->M_transaksi->tahun();
        $data['tahun'] = $this->db->get('tahun_ajaran')->result_array();
        $data['tahun_ajaran'] = $this->M_transaksi->session_tahun()->result();
        //$data['pem_bulan'] = $this->M_transaksi->pem_bulan($where1)->result();
        //filter berdasarkan tahun ajaran dan nis
        $sql_th = "SELECT a.*, b.nama_bulan, c.tahun_ajaran 
				FROM pembayaran_tahunan a 
				JOIN bulan b ON a.id_bulan = b.id_bulan 
				JOIN tahun_ajaran c ON a.id_tahun = c.id_tahun 
				WHERE a.id_siswa='" . $id_siswa . "' 
				AND c.tahun_ajaran IN (
					SELECT d.tahun_ajaran FROM biaya_tahunan d WHERE d.id_tahunan='" . $nis . "' 
				)
				ORDER BY a.id_tahun, a.id_bulan";

        $data['pem_tahunan'] = $this->db->query($sql_th)->result();

        $data['thaj'] = $this->db->query("SELECT b.id_tahun 
						FROM biaya_tahunan a
						INNER JOIN tahun_ajaran b ON a.tahun_ajaran = b.tahun_ajaran  
						WHERE a.id_tahunan='" . $nis . "'")->row()->id_tahun;
        $data['id_tahunan'] = $nis;

        $this->load->view('templates_siswa/header', $data);
        $this->load->view('templates_siswa/sidebar', $data);
        $this->load->view('templates_siswa/topbar', $data);
        $this->load->view('pembayaran_siswa/siswa_tahunan', $data);
        $this->load->view('templates_siswa/footer');
    }


    public function tambah_Tahunan()
    {

        // Ambil data yang dikirim dari form
        $bulan = $this->input->post('bulan[]', TRUE);
        $id_siswa = $this->input->post('id_siswa');
        $nis = $this->input->post('nis');
        $nama_siswa = $this->input->post('nama_siswa');
        // $id_trans = rand(000000, 999999);
        $id_transaksi =  $this->input->post('id_transaksi');
        $tgl_bayar = $this->input->post('tgl_bayar');
        $id_tahun = $this->input->post('tahun_ajaran');
        $metode_pembayaran = $this->input->post('metode_pembayaran', TRUE);
        $id = $this->input->post('id');
        $id_tahunan = $this->input->post('id_tahunan');
        $data = array();

        $statustype = $this->input->post('result_type');
        $statusdata = $this->input->post('result_data');
        $json = json_decode($statusdata, true);
        //echo $json['order_id'];exit;
        $status = ($metode_pembayaran == 'Manual' ? '0' : ($statustype == 'success' ? '0' : ($statustype == 'pending' ? '1' : '2')));
        $orderid = ($metode_pembayaran == 'Manual' ? '' : $json['order_id']);
        $index = 0; // Set index array awal dengan 0


        #penyesuaian tambahan untuk simpan jumlah tabel spp_bulanan
        $jmltahunan = $this->db->query("SELECT besar_tahunan FROM tahun_ajaran WHERE id_tahun = '" . $id_tahun . "'")->row()->besar_tahunan;
        foreach ($bulan as $key) { // Kita buat perulangan berdasarkan nis sampai data terakhir
            array_push($data, array(
                'id_bulan' => $key,
                'id_siswa' => $id_siswa,
                'nis' => $nis,  // Ambil dan set data nama sesuai index array dari $index
                'nama_siswa' => $nama_siswa,
                // 'id_trans' => $id_trans,  // Ambil dan set data telepon sesuai index array dari $index
                'id_transaksi' => $id_transaksi++,
                'tgl_bayar' => $tgl_bayar,
                'metode_pembayaran' => $metode_pembayaran,
                'jumlah' => $jmltahunan,
                'id_tahun' => $id_tahun,
                'id' => $id,  // Ambil dan set data alamat sesuai index array dari $index
                'status' => $status,
                'order_id' => $orderid
            ));

            $key;
        }
        // var_dump($data);
        // exit();
        $sql = $this->M_transaksi->save_batch1($data);
        if ($sql) { // Jika sukses
            echo "<script>alert('Data berhasil disimpan');window.location = '" . base_url('siswa_tahunan/bayar_Tahunan/' . $id_tahunan . '/' . $id_siswa, '') . "';</script>";
        } else { // Jika gagal
            echo "<script>alert('Data gagal disimpan');window.location = '" . base_url('siswa_tahunan/bayar_Tahunan/' . $id_tahunan . '/' . $id_siswa, '') . "';</script>";
        }
    }


    // CETAK STATUS PEMBAYARAN BIAYA TAHUNAN
    public function cetak_tahunan($id, $id_siswa)
    {
        $data['tgl_cetak'] = date("Y-m-d");
        // $data['tgl_cetak'] = date("Y-m-d H:i:s");
        $data['title'] = 'Cetak Kartu Pembayaran Biaya Tahunan';
        $data['siswa'] = $this->db->get_where('siswa', ['nis' => $this->session->userdata('nis')])->row_array();
        $where1 = array('id_siswa' => $id_siswa);
        $data['siswa1'] = $this->M_transaksi->tampil_detail($where1)->row();

        //filter berdasarkan tahun ajaran dan id_siswa
        $sql = "SELECT a.*, b.nama_bulan, c.tahun_ajaran 
				FROM pembayaran_tahunan a 
				JOIN bulan b ON a.id_bulan = b.id_bulan 
				JOIN tahun_ajaran c ON a.id_tahun = c.id_tahun 
				WHERE a.id_siswa='" . $id_siswa . "' 
				AND c.tahun_ajaran
                IN (
                    SELECT d.tahun_ajaran 
                    FROM biaya_tahunan d 
                    WHERE d.id_tahunan='" . $id . "'
                    )
                    ORDER BY a.id_tahun, a.id_bulan";

        $data['pem_tahun'] = $this->db->query($sql)->result_array();
        $data['thaj'] = $this->db->query("SELECT b.tahun_ajaran 
						FROM biaya_tahunan a
						inner join tahun_ajaran b ON a.tahun_ajaran = b.tahun_ajaran  
						WHERE a.id_tahunan='" . $id . "'")->row()->tahun_ajaran;

        $data['id_th'] = $id;
        $this->load->view('templates_siswa/header', $data);
        $this->load->view('templates_siswa/sidebar', $data);
        $this->load->view('templates_siswa/topbar', $data);
        $this->load->view('kartu_siswa/kartu_tahunan', $data);
        $this->load->view('templates_siswa/footer');
    }

    public function hapusTahunan($id_transaksi, $id_siswa, $nis)
    {
        $where = $id_transaksi;
        $where2 = array('id_transaksi' => $id_transaksi);
        $this->M_transaksi->copy_input($where);
        $this->M_transaksi->hapus_data($where2, 'pembayaran_tahunan');
        if ($where2) { // Jika sukses
            echo "<script>alert('Data berhasil dihapus');window.location = '" . base_url('siswa_tahunan/bayar_Tahunan/' . $nis . '/' . $id_siswa, '') . "';</script>";
        } else { // Jika gagal
            echo "<script>alert('Data gagal dihapus');window.location = '" . base_url('siswa_tahunan/bayar_Tahunan/' . $nis . '/' . $id_siswa, '') . "';</script>";
        }
    }

    // CETAK KWITANSI PEMBAYARAN Tahunan
    public function kwitansiTahunan($nis, $id_siswa)
    {
        $data['tgl_cetak'] = date("Y-m-d");
        $data['title'] = 'Kwitansi Pembayaran Biaya Tahunan';
        $data['siswa'] = $this->db->get_where('siswa', ['nis' => $this->session->userdata('nis')])->row_array();

        $where1 = array('id_siswa' => $id_siswa);
        // $where2 = array('id_siswa' => $id_siswa, 'id_transaksi' => $id);
        $data['siswa1'] = $this->M_transaksi->tampil_detail($where1)->row();

        $data['bayaran_thn'] = $this->db->query("SELECT * FROM pembayaran_tahunan 
        WHERE nis = " . $nis . " AND id_siswa='" . $id_siswa . "'")->row_array();

        $this->load->view('templates_siswa/header', $data);
        $this->load->view('templates_siswa/sidebar', $data);
        $this->load->view('templates_siswa/topbar', $data);
        $this->load->view('kartu_siswa/kwitansi_tahunan', $data);
        $this->load->view('templates_siswa/footer');
    }
}