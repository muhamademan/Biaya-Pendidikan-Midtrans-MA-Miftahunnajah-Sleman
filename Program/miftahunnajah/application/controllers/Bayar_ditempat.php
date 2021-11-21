<?php
defined('BASEPATH') or exit('no direct script access allowed');

class Bayar_ditempat extends CI_Controller
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
    }

    public function index()
    {
        $data['title'] = 'Pembayaran Langsung';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['dtsiswa'] = $this->M_master->getSiswa();
        $data['tahun'] = $this->M_transaksi->tahun();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('bayar_langsung/index', $data);
        $this->load->view('templates/footer');
    }

    public function detail($id_siswa)
    {
        $data['id_transaksi'] = $this->M_transaksi->id_transaksi();
        $data['tgl_bayar'] = date("Y-m-d");
        $data['title'] = 'Pembayaran Biaya Pendidikan';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $where1 = array('id_siswa' => $id_siswa);

        $th_ajaran = "SELECT biaya_spp.tahun_ajaran
        FROM biaya_spp";
        $data1['th_ajaran1'] = $this->db->query($th_ajaran)->row_array();
        $tr = $data1['th_ajaran1'];
        $data1['santri'] = $this->M_transaksi->tampil_detail($where1)->result();
        $data['santri'] = $this->M_transaksi->tampil_detail($where1)->result();
        // var_dump($tr);
        // exit();
        $sql = "SELECT a.id_tahun, a.id_siswa, a.nama_siswa, b.id_tahun, SUM(b.besar_spp), b.tahun_ajaran
                FROM pembayaran_spp a, tahun_ajaran b
                WHERE a.id_tahun = b.id_tahun
                AND id_siswa = $id_siswa AND tahun_ajaran = '2020/2021'";

        $data1['coba'] = $this->db->query($sql)->row_array();
        $data1['spp'] = $data1['coba']['SUM(b.besar_spp)'];

        $sql = "SELECT a.id_spp, a.id_siswa, a.tahun_ajaran, a.jenis_pembayaran, f.total_spp,f.jml_bulan,IF(f.jml_bulan = 12, 'Lunas', 'Belum Lunas') AS status_bayar 
				FROM biaya_spp a
				LEFT JOIN 
				(
					SELECT e.id_siswa,e.tahun_ajaran, SUM(e.besar_spp) AS total_spp, COUNT(e.id_bulan) AS jml_bulan FROM 
					(
						SELECT b.id_transaksi,b.id_siswa,b.id_bulan,b.id_tahun,c.tahun_ajaran,b.jumlah AS besar_spp
						FROM pembayaran_spp b
						INNER JOIN tahun_ajaran c ON b.id_tahun = c.id_tahun
						WHERE b.status='0'
					) e GROUP BY e.id_siswa,e.tahun_ajaran
				) f ON a.id_siswa = f.id_siswa AND a.tahun_ajaran = f.tahun_ajaran
				WHERE a.id_siswa = '" . $id_siswa . "'
				";

        $sql_tahunan = "SELECT a.id_tahunan, a.id_siswa, a.tahun_ajaran, a.jenis_pembayaran, f.total_tahunan, f.jml_bulan,
                        IF(f.jml_bulan = 1, 'Lunas', 'Belum Lunas') AS status_bayar
                        FROM biaya_tahunan a
                        LEFT JOIN (
                            SELECT e.id_siswa,e.tahun_ajaran, SUM(e.besar_tahunan) AS total_tahunan, COUNT(e.id_bulan) AS jml_bulan
                            FROM 
                        (
                            SELECT b.id_transaksi,b.nis, b.id_siswa, b.id_bulan, b.id_tahun, c.tahun_ajaran, b.jumlah AS besar_tahunan
                            FROM pembayaran_tahunan b
                            INNER JOIN tahun_ajaran c ON b.id_tahun = c.id_tahun
                            WHERE b.status='0'
                            ) e 
                            GROUP BY e.id_siswa, e.tahun_ajaran
                            ) f 
                            ON a.id_siswa = f.id_siswa 
                            AND a.tahun_ajaran = f.tahun_ajaran
                            WHERE a.id_siswa = '" . $id_siswa . "'";


        $sql_bangunan = "SELECT a.id_bangunan, a.id_siswa, a.tahun_ajaran, a.jenis_pembayaran, f.total_bangunan, f.jml_bulan,
                        IF(f.jml_bulan = 1, 'Lunas', 'Belum Lunas') AS status_bayar
                        FROM biaya_bangunan a
                        LEFT JOIN (
                            SELECT e.id_siswa,e.tahun_ajaran, SUM(e.besar_bangunan) AS total_bangunan, COUNT(e.id_bulan) AS jml_bulan
                            FROM 
                        (
                            SELECT b.id_transaksi, b.nis, b.id_siswa, b.id_bulan, b.id_tahun, c.tahun_ajaran, b.jumlah AS besar_bangunan
                            FROM pembayaran_bangunan b
                            INNER JOIN tahun_ajaran c ON b.id_tahun = c.id_tahun
                            WHERE b.status='0'
                            ) e 
                            GROUP BY e.id_siswa, e.tahun_ajaran
                            ) f 
                            ON a.id_siswa = f.id_siswa 
                            AND a.tahun_ajaran = f.tahun_ajaran
                            WHERE a.id_siswa = '" . $id_siswa . "'";


        $data1['bayaran_spp'] = $this->db->query($sql)->result();
        $data1['bayaran_tahunan'] = $this->db->query($sql_tahunan)->result();
        $data1['bayaran_bangunan'] = $this->db->query($sql_bangunan)->result();
        // $data1['pembayaran_tahunan'] = $this->M_transaksi->bayar_tahunan()($where1)->result();
        // $data1['pembayaran_lainnya'] = $this->M_transaksi->pembayaran_lainnya($where1)->result();
        // $data1['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data1['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $query = $this->db->query('SELECT * FROM tahun_aktif 
				WHERE id_siswa =' . $id_siswa . '');


        if ($query->num_rows() == 0) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('bayar_langsung/detail_siswa', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('bayar_langsung/detail_siswa', $data1);
            $this->load->view('bayar_langsung/pembayaran_spp', $data1);
            $this->load->view('bayar_langsung/pembayaran_tahunan', $data1);
            $this->load->view('bayar_langsung/pembayaran_bangunan', $data1);
            $this->load->view('templates/footer');
        }
    }


    // BAGIAN PEMBAYARAN BULANAN (SPP)
    public function bayar_Spp($id, $id_siswa)
    {
        $data['id_transaksi'] = $this->M_transaksi->id_transaksi();
        $data['tgl_bayar'] = date("Y-m-d");
        $data['title'] = 'Pembayaran Bulanan(SPP)';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $where1 = array('id_siswa' => $id_siswa);

        $data['siswa'] = $this->M_transaksi->tampil_data($where1)->result();
        $data['siswa'] = $this->M_transaksi->tampil_detail($where1)->result();
        $data['tahun'] = $this->M_transaksi->tahun();
        $data['tahun'] = $this->db->get('tahun_ajaran')->result_array();
        $data['tahun_ajaran'] = $this->M_transaksi->session_tahun()->result();
        //$data['pem_bulan'] = $this->M_transaksi->pem_bulan($where1)->result();
        //filter berdasarkan tahun ajaran dan nis
        $sql = "SELECT a.*, b.nama_bulan, c.tahun_ajaran 
				FROM pembayaran_spp a 
				JOIN bulan b ON a.id_bulan = b.id_bulan 
				JOIN tahun_ajaran c ON a.id_tahun = c.id_tahun 
				WHERE a.id_siswa='" . $id_siswa . "' 
				AND c.tahun_ajaran IN (
					SELECT d.tahun_ajaran FROM biaya_spp d WHERE d.id_spp='" . $id . "' 
				)
				ORDER BY a.id_tahun,a.id_bulan";

        $data['pem_bulan'] = $this->db->query($sql)->result();
        $data['thaj'] = $this->db->query("SELECT b.id_tahun 
						FROM biaya_spp a
						INNER JOIN tahun_ajaran b ON a.tahun_ajaran = b.tahun_ajaran  
						WHERE a.id_spp='" . $id . "'")->row()->id_tahun;
        $data['id_spp'] = $id;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('bayar_langsung/bayar_Spp', $data);
        $this->load->view('templates/footer');
    }


    public function tambah_aksi()
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
        $id_spp = $this->input->post('id_spp');
        $data = array();

        $statustype = $this->input->post('result_type');
        $statusdata = $this->input->post('result_data');
        $json = json_decode($statusdata, true);
        //echo $json['order_id'];exit;
        $status = ($metode_pembayaran == 'Manual' ? '0' : ($statustype == 'success' ? '0' : ($statustype == 'pending' ? '1' : '2')));
        $orderid = ($metode_pembayaran == 'Manual' ? '' : $json['order_id']);
        $index = 0; // Set index array awal dengan 0


        #penyesuaian tambahan untuk simpan jumlah tabel spp_bulanan
        $jmlspp = $this->db->query("select besar_spp from tahun_ajaran where id_tahun = '" . $id_tahun . "'")->row()->besar_spp;
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
                'jumlah' => $jmlspp,
                'id_tahun' => $id_tahun,
                'id' => $id,  // Ambil dan set data alamat sesuai index array dari $index
                'Status' => $status,
                'order_id' => $orderid
            ));

            $key;
        }
        // var_dump($data);
        // exit();
        $sql = $this->M_transaksi->save_batch($data);
        if ($sql) { // Jika sukses
            echo "<script>alert('Data berhasil disimpan');window.location = '" . base_url('bayar_ditempat/bayar_Spp/' . $id_spp . '/' . $id_siswa, '') . "';</script>";
        } else { // Jika gagal
            echo "<script>alert('Data gagal disimpan');window.location = '" . base_url('bayar_ditempat/bayar_Spp/' . $id_spp . '/' . $id_siswa, '') . "';</script>";
        }
    }


    public function hapus_spp($id_transaksi, $id_siswa, $nis)
    {
        $where = $id_transaksi;
        $where2 = array('id_transaksi' => $id_transaksi);
        $this->M_transaksi->copy_input($where);
        $this->M_transaksi->hapus_data($where2, 'pembayaran_spp');
        if ($where2) { // Jika sukses
            echo "<script>alert('Data berhasil dihapus');window.location = '" . base_url('bayar_ditempat/bayar_spp/' . $nis . '/' . $id_siswa, '') . "';</script>";
        } else { // Jika gagal
            echo "<script>alert('Data gagal dihapus');window.location = '" . base_url('bayar_ditempat/bayar_spp/' . $nis . '/' . $id_siswa, '') . "';</script>";
        }
    }

    // CETAK STATUS PEMBAYARAN SPP
    public function cetak_spp($id, $id_siswa)
    {
        $data['tgl_cetak'] = date("d M Y");
        $data['tgl_ctk'] = date("d M Y");
        $data['title'] = 'Cetak Kartu Pembayaran SPP';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $where1 = array('id_siswa' => $id_siswa);
        $data['siswa'] = $this->M_transaksi->tampil_detail($where1)->row();

        //filter berdasarkan tahun ajaran dan id_siswa
        $sql = "SELECT a.*, b.nama_bulan, c.tahun_ajaran 
				FROM pembayaran_spp a 
				JOIN bulan b ON a.id_bulan = b.id_bulan 
				JOIN tahun_ajaran c ON a.id_tahun = c.id_tahun 
				WHERE a.id_siswa='" . $id_siswa . "' 
				AND c.tahun_ajaran
                IN (SELECT d.tahun_ajaran FROM biaya_spp d WHERE d.id_spp='" . $id . "')
                ORDER BY a.id_tahun,a.id_bulan";

        $data['pem_bulan'] = $this->db->query($sql)->result_array();
        $data['thaj'] = $this->db->query("SELECT b.tahun_ajaran 
						FROM biaya_spp a
						inner join tahun_ajaran b ON a.tahun_ajaran = b.tahun_ajaran  
						WHERE a.id_spp='" . $id . "'")->row()->tahun_ajaran;

        $data['id_th'] = $id;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kartu/kartu_spp', $data);
        $this->load->view('templates/footer');
    }

    // CETAK KWITANSI PEMBAYARAN BULANAN (SPP)
    public function kwitansi_Spp($nis, $id_siswa)
    {
        $data['tgl_cetak'] = date("d M Y");
        $data['title'] = 'Kwitansi Pembayaran SPP';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $where1 = array('id_siswa' => $id_siswa);
        // $where2 = array('id_siswa' => $id_siswa, 'id_transaksi' => $nis);
        $data['siswa'] = $this->M_transaksi->tampil_detail($where1)->row();

        $data['bayaran_spp'] = $this->db->query("SELECT * FROM pembayaran_spp 
        WHERE nis = " . $nis . " AND id_siswa='" . $id_siswa . "'")->row_array();

        // $data['bspp'] = $this->db->query('SELECT jumlah FROM pembayaran_spp WHERE id_siswa')->row();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kartu/kwitansi_spp', $data);
        $this->load->view('templates/footer');
    }



    // BAGIAN PEMBAYARAN TAHUNAN
    public function bayar_Tahunan($nis, $id_siswa)
    {
        $data['id_transaksi'] = $this->M_transaksi->id_transaksi1();
        $data['tgl_bayar'] = date("d M Y");
        $data['title'] = 'Transaksi Pembayaran Tahunan';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $where1 = array('id_siswa' => $id_siswa);

        $data['siswa'] = $this->M_transaksi->tampil_data($where1)->result();
        $data['siswa'] = $this->M_transaksi->tampil_detail($where1)->result();
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

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('bayar_langsung/bayar_Tahunan', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_Tahunan()
    {
        // Ambil data yang dikirim dari form
        $bulan = $this->input->post('bulan[]', TRUE);
        $id_siswa = $this->input->post('id_siswa');
        $nis = $this->input->post('nis');
        $nama_siswa = $this->input->post('nama_siswa');
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
            echo "<script>alert('Data berhasil disimpan');window.location = '" . base_url('bayar_ditempat/bayar_Tahunan/' . $id_tahunan . '/' . $id_siswa, '') . "';</script>";
        } else { // Jika gagal
            echo "<script>alert('Data gagal disimpan');window.location = '" . base_url('bayar_ditempat/bayar_Tahunan/' . $id_tahunan . '/' . $id_siswa, '') . "';</script>";
        }
    }

    public function hapusTahunan($id_transaksi, $id_siswa, $nis)
    {
        $where = $id_transaksi;
        $where2 = array('id_transaksi' => $id_transaksi);
        $this->M_transaksi->copy_input($where);
        $this->M_transaksi->hapus_data($where2, 'pembayaran_tahunan');
        if ($where2) { // Jika sukses
            echo "<script>alert('Data berhasil dihapus');window.location = '" . base_url('bayar_ditempat/bayar_Tahunan/' . $nis . '/' . $id_siswa, '') . "';</script>";
        } else { // Jika gagal
            echo "<script>alert('Data gagal dihapus');window.location = '" . base_url('bayar_ditempat/bayar_Tahunan/' . $nis . '/' . $id_siswa, '') . "';</script>";
        }
    }

    // CETAK KWITANSI PEMBAYARAN Tahunan
    public function kwitansiTahunan($nis, $id_siswa)
    {
        $data['tgl_cetak'] = date("d M Y");
        $data['title'] = 'Kwitansi Pembayaran Biaya Tahunan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $where1 = array('id_siswa' => $id_siswa);
        // $where2 = array('id_siswa' => $id_siswa, 'id_transaksi' => $id);
        $data['siswa'] = $this->M_transaksi->tampil_detail($where1)->row();

        $data['bayaran_thn'] = $this->db->query("SELECT * FROM pembayaran_tahunan 
        WHERE nis = " . $nis . " AND id_siswa='" . $id_siswa . "'")->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kartu/kwitansi_tahun', $data);
        $this->load->view('templates/footer');
    }

    // CETAK STATUS PEMBAYARAN BIAYA TAHUNAN
    public function cetak_tahunan($id, $id_siswa)
    {
        $data['tgl_cetak'] = date("Y-m-d H:i:s");
        $data['title'] = 'Cetak Kartu Pembayaran Biaya Tahunan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $where1 = array('id_siswa' => $id_siswa);
        $data['siswa'] = $this->M_transaksi->tampil_detail($where1)->row();

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
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kartu/kartu_tahunan', $data);
        $this->load->view('templates/footer');
    }




    // BAGIAN PEMBAYARAN BANGUNAN
    public function bayar_Bangunan($nis, $id_siswa)
    {
        $data['id_transaksi'] = $this->M_transaksi->id_transaksi2();
        $data['tgl_bayar'] = date("Y-m-d");
        $data['title'] = 'Transaksi Pembayaran Bangunan';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $where1 = array('id_siswa' => $id_siswa);

        $data['siswa'] = $this->M_transaksi->tampil_data($where1)->result();
        $data['siswa'] = $this->M_transaksi->tampil_detail($where1)->result();
        $data['tahun'] = $this->M_transaksi->tahun();
        $data['tahun'] = $this->db->get('tahun_ajaran')->result_array();
        $data['tahun_ajaran'] = $this->M_transaksi->session_tahun()->result();
        //$data['pem_bulan'] = $this->M_transaksi->pem_bulan($where1)->result();
        //filter berdasarkan tahun ajaran dan nis
        $sql_th = "SELECT a.*, b.nama_bulan, c.tahun_ajaran 
                 FROM pembayaran_bangunan a 
                 JOIN bulan b ON a.id_bulan = b.id_bulan 
                 JOIN tahun_ajaran c ON a.id_tahun = c.id_tahun 
                 WHERE a.id_siswa='" . $id_siswa . "' 
                 AND c.tahun_ajaran IN (
                     SELECT d.tahun_ajaran FROM biaya_bangunan d WHERE d.id_bangunan='" . $nis . "' 
                 )
                 ORDER BY a.id_tahun, a.id_bulan";

        $data['pem_bangunan'] = $this->db->query($sql_th)->result();

        $data['thaj'] = $this->db->query("SELECT b.id_tahun 
                         FROM biaya_bangunan a
                         INNER JOIN tahun_ajaran b ON a.tahun_ajaran = b.tahun_ajaran  
                         WHERE a.id_bangunan='" . $nis . "'")->row()->id_tahun;
        $data['id_bangunan'] = $nis;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('bayar_langsung/bayar_bangunan', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_Bangunan()
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
        $id_bangunan = $this->input->post('id_bangunan');
        $data = array();

        $statustype = $this->input->post('result_type');
        $statusdata = $this->input->post('result_data');
        $json = json_decode($statusdata, true);
        //echo $json['order_id'];exit;
        $status = ($metode_pembayaran == 'Manual' ? '0' : ($statustype == 'success' ? '0' : ($statustype == 'pending' ? '1' : '2')));
        $orderid = ($metode_pembayaran == 'Manual' ? '' : $json['order_id']);
        $index = 0; // Set index array awal dengan 0


        #penyesuaian tambahan untuk simpan jumlah tabel spp_bulanan
        $jmlbangunan = $this->db->query("SELECT besar_bangunan FROM tahun_ajaran WHERE id_tahun = '" . $id_tahun . "'")->row()->besar_bangunan;
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
                'jumlah' => $jmlbangunan,
                'id_tahun' => $id_tahun,
                'id' => $id,  // Ambil dan set data alamat sesuai index array dari $index
                'Status' => $status,
                'order_id' => $orderid
            ));

            $key;
        }
        // var_dump($data);
        // exit();
        $sql = $this->M_transaksi->save_batch_bgn($data);
        if ($sql) { // Jika sukses
            echo "<script>alert('Data berhasil disimpan');window.location = '" . base_url('bayar_ditempat/bayar_Bangunan/' . $id_bangunan . '/' . $id_siswa, '') . "';</script>";
        } else { // Jika gagal
            echo "<script>alert('Data gagal disimpan');window.location = '" . base_url('bayar_ditempat/bayar_Bangunan/' . $id_bangunan . '/' . $id_siswa, '') . "';</script>";
        }
    }

    public function hapusBangunan($id_transaksi, $id_siswa, $nis)
    {
        $where = $id_transaksi;
        $where2 = array('id_transaksi' => $id_transaksi);
        $this->M_transaksi->copy_input($where);
        $this->M_transaksi->hapus_data($where2, 'pembayaran_bangunan');
        if ($where2) { // Jika sukses
            echo "<script>alert('Data berhasil dihapus');window.location = '" . base_url('bayar_ditempat/bayar_Bangunan/' . $nis . '/' . $id_siswa, '') . "';</script>";
        } else { // Jika gagal
            echo "<script>alert('Data gagal dihapus');window.location = '" . base_url('bayar_ditempat/bayar_Bangunan/' . $nis . '/' . $id_siswa, '') . "';</script>";
        }
    }

    // CETAK KWITANSI PEMBAYARAN Tahunan
    public function kwitansiBangunan($nis, $id_siswa)
    {
        $data['tgl_cetak'] = date("d M Y");
        $data['title'] = 'Kwitansi Pembayaran Biaya Bangunan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $where1 = array('id_siswa' => $id_siswa);
        // $where2 = array('id_siswa' => $id_siswa, 'id_transaksi' => $id);
        $data['siswa'] = $this->M_transaksi->tampil_detail($where1)->row();

        $data['bayaran_bgn'] = $this->db->query("SELECT * FROM pembayaran_bangunan 
        WHERE nis = " . $nis . " AND id_siswa='" . $id_siswa . "'")->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kartu/kwitansi_bangun', $data);
        $this->load->view('templates/footer');
    }

    // CETAK STATUS PEMBAYARAN BIAYA TAHUNAN
    public function cetak_bangunan($id, $id_siswa)
    {
        $data['tgl_cetak'] = date("Y-m-d H:i:s");
        $data['title'] = 'Cetak Kartu Pembayaran Biaya Bangunan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $where1 = array('id_siswa' => $id_siswa);
        $data['siswa'] = $this->M_transaksi->tampil_detail($where1)->row();

        //filter berdasarkan tahun ajaran dan id_siswa
        $sql = "SELECT a.*, b.nama_bulan, c.tahun_ajaran 
        		FROM pembayaran_bangunan a 
        		JOIN bulan b ON a.id_bulan = b.id_bulan 
        		JOIN tahun_ajaran c ON a.id_tahun = c.id_tahun 
        		WHERE a.id_siswa='" . $id_siswa . "' 
        		AND c.tahun_ajaran
                IN (
                    SELECT d.tahun_ajaran 
                    FROM biaya_bangunan d 
                    WHERE d.id_bangunan='" . $id . "'
                    )
                    ORDER BY a.id_tahun, a.id_bulan";

        $data['pem_bangunan'] = $this->db->query($sql)->result_array();
        $data['thaj'] = $this->db->query("SELECT b.tahun_ajaran 
        				FROM biaya_bangunan a
        				inner join tahun_ajaran b ON a.tahun_ajaran = b.tahun_ajaran  
        				WHERE a.id_bangunan='" . $id . "'")->row()->tahun_ajaran;

        $data['id_th'] = $id;

        // $data['tgl_cetak'] = date("Y-m-d");
        // $data['title'] = 'Kwitansi Pembayaran Biaya Bangunan';
        // $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $where1 = array('id_siswa' => $id_siswa);
        // // $where2 = array('id_siswa' => $id_siswa, 'id_transaksi' => $id);
        // $data['siswa'] = $this->M_transaksi->tampil_detail($where1)->row();

        // $data['pem_bangun'] = $this->db->query("SELECT * FROM pembayaran_bangunan 
        // WHERE nis = " . $id . " AND id_siswa='" . $id_siswa . "'")->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kartu/kartu_bangunan', $data);
        $this->load->view('templates/footer');
    }
}