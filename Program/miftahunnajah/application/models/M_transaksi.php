<?php
class M_transaksi extends CI_Model
{
    public function view()
    {
        return $this->db->get('biaya_spp')->result();
    }
    public function session_tahun()
    {
        $this->db->select('*');
        $this->db->from('tahun_ajaran');
        $this->db->where_in('status', 'ON');
        return $query = $this->db->get();
    }


    public function save_batch($data)
    {
        return $this->db->insert_batch('pembayaran_spp', $data);
    }
    public function save_batch1($data)
    {
        return $this->db->insert_batch('pembayaran_tahunan', $data);
    }

    public function save_batch_bgn($data)
    {
        return $this->db->insert_batch('pembayaran_bangunan', $data);
    }

    // tabel biaya spp / bulanan
    public function save_pem_bulanan($data)
    {
        return $this->db->insert_batch('biaya_spp', $data);
    }

    // tabel biaya tahunan
    public function save_pem_tahunan($data)
    {
        return $this->db->insert_batch('biaya_tahunan', $data);
    }

    // tabel biaya bangunan
    public function save_pem_bangunan($data)
    {
        return $this->db->insert_batch('biaya_bangunan', $data);
    }


    public function save_pem_lainya($data)
    {
        return $this->db->insert_batch('pembayaran_lainnya', $data);
    }


    public function save_thn_aktif($data)
    {
        return $this->db->insert_batch('tahun_aktif', $data);
    }

    function ambil_data()
    {
        return $this->db->get('siswa');
    }


    function input_data($data)
    {
        $this->db->insert('biaya_spp', $data);
    }
    // function input_data1($data)
    // {
    //     $this->db->insert('biaya_spp', $data);
    // }
    // function input_data2($data)
    // {
    //     $this->db->insert('biaya_spp', $data);
    // }

    function multisave($key, $id_transaksi, $nis, $nama_siswa, $id_tahun, $tgl_bayar, $metode_pembayaran, $id)
    {
        $query = "insert into pembayaran_spp values($key, $id_transaksi, $nis, $nama_siswa, $id_tahun, $tgl_bayar, $metode_pembayaran, $id)";
        $this->db->query($query);
    }


    function copy_input($where)
    {
        $this->db->query('INSERT INTO hapus_transaksi (id_transaksi, nis, id_bulan, id_tahun, tgl_bayar, id_user)
                      SELECT id_transaksi, nis, id_bulan, id_tahun, tgl_bayar, id
                      FROM pembayaran_spp WHERE id_transaksi = \'' . $where . '\'');
    }

    function copy_input1($where)
    {
        $this->db->query('INSERT INTO hapus_transaksi (id_transaksi, nis, id_bulan, id_tahun, tgl_bayar, id_user)
                      SELECT id_transaksi, nis, id_bulan, id_tahun, tgl_bayar, id
                      FROM pembayaran_tahunan WHERE id_transaksi = \'' . $where . '\'');
    }

    function copy_input_bgn($where)
    {
        $this->db->query('INSERT INTO hapus_transaksi (id_transaksi, nis, id_bulan, id_tahun, tgl_bayar, id_user)
                      SELECT id_transaksi, nis, id_bulan, id_tahun, tgl_bayar, id
                      FROM pembayaran_bangunan WHERE id_transaksi = \'' . $where . '\'');
    }

    function pem_bulan($where1)
    {
        $this->db->select('*');
        $this->db->from('biaya_spp');
        $this->db->join('bulan', 'pembayaran_spp.id_bulan = bulan.id_bulan');
        $this->db->join('tahun_ajaran', 'pembayaran_spp.id_tahun = tahun_ajaran.id_tahun');
        $this->db->where_in('nis', $where1);
        $this->db->order_by('pembayaran_spp.id_tahun,pembayaran_spp.id_bulan', 'ASC');
        return $query = $this->db->get();
    }


    public function jumlah_spp($where1, $th_ajaran)
    {

        $this->db->select('*');
        $this->db->from('pembayaran_spp');
        $this->db->join('tahun_ajaran', 'pembayaran_spp.besar_spp=tahun_ajaran.besar_spp');
    }
    function pem_bulan_santri($where1)
    {
        $this->db->select('*');
        $this->db->from('pembayaran_spp');
        $this->db->join('bulan', 'pembayaran_spp.id_bulan = bulan.id_bulan');
        $this->db->join('tahun_ajaran', 'pembayaran_spp.id_tahun = tahun_ajaran.id_tahun');
        $this->db->where_in('nis', $where1);
        $this->db->order_by('pembayaran_spp.id_tahun,pembayaran_spp.id_bulan', 'ASC');
        return $query = $this->db->get();
    }

    function tampil_detail($where1)
    {
        $this->db->select('*');
        $this->db->from('siswa');
        $this->db->where_in('id_siswa', $where1);
        return $query = $this->db->get();
    }

    function tampil_detail_spp($where1)
    {
        $this->db->select('*');
        $this->db->from('siswa');
        $this->db->where_in('id_siswa', $where1);
        return $query = $this->db->get();
    }

    function tampil_user($where1)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where_in('id', $where1);
        return $query = $this->db->get();
    }

    function tampil_data()
    {
        $this->db->select('*');
        $this->db->from('siswa');
        return $query = $this->db->get();
    }
    function tampil_data_spp($where1)
    {
        $this->db->select('*');
        $this->db->from('pembayaran_spp');
        $this->db->join('bulan', 'pembayaran_spp.id_bulan = bulan.id_bulan');
        $this->db->join('tahun_ajaran', 'pembayaran_spp.id_tahun = tahun_ajaran.id_tahun');
        $this->db->join('bendahara', 'pembayaran_spp.id = bendahara.id_bendahara');
        $this->db->where_in('nis', $where1);
        $this->db->order_by('pembayaran_spp.id_tahun,pembayaran_spp.id_bulan', 'ASC');
        return $query = $this->db->get();
    }
    function tampil_pem_bulanan()
    {
        $this->db->select('*');
        $this->db->from('pembayaran_bulanan');
        // $this->db->join('santri', 'pembayaran_bulanan.nis = pembayaran_bulanan.nis');
        // $this->db->join('tahun_ajaran', 'pembayaran_bulanan.id_tahun = pembayaran_bulanan.id_tahun');
        // $this->db->order_by('santri.nis', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    function hapus_data($where2, $table)
    {
        $this->db->where($where2);
        $this->db->delete($table);
    }
    function cek_login($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    function ambil_databulan()
    {
        return $this->db->get('bulan');
    }

    function tampil_databulan()
    {
        return $this->db->get('bulan');
    }
    function tampil_data_bulan()
    {
        return $this->db->get('bulan');
    }
    function tampil_datatahun()
    {
        $this->db->select('*');
        $this->db->from('tahun_ajaran');

        $this->db->where_in('Status', 'ON');
        return $query = $this->db->get();
    }
    // function tampil_datatahun($where)
    // {
    // 	return $this->db->get('tahun_ajaran');
    // 	$this->db->query('SELECT tahun_ajaran.id_tahun, tahun_ajaran.tahun_ajaran, tahun_ajaran.besar_spp FROM tahun_ajaran JOIN tahun_aktif ON tahun_ajaran.id_tahun=tahun_aktif.id_tahun WHERE nis=\'' . $where . '\'');
    // }
    function jumlahsppbulanan()
    {
        $query = $this->db->get('pembayaran_spp');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }


    function jmlh_spp_bulanan()
    {
        return $this->db->query("SELECT sum(jumlah) from pembayaran_spp");
    }

    public function pembayaran_spp()
    {
        $this->db->select('*');
        $this->db->from('pembayaran_spp');
        $this->db->join('bulan', 'pembayaran_spp.id_bulan = bulan.id_bulan');
        $this->db->join('user', 'pembayaran_spp.id = user.id');
        $this->db->join('tahun_ajaran', 'pembayaran_spp.id_tahun = tahun_ajaran.id_tahun');
        return $query = $this->db->get();
    }

    public function pembayaran_tahunan()
    {
        $this->db->select('*');
        $this->db->from('pembayaran_tahunan');
        $this->db->join('bulan', 'pembayaran_tahunan.id_bulan = bulan.id_bulan');
        $this->db->join('user', 'pembayaran_tahunan.id = user.id');
        $this->db->join('tahun_ajaran', 'pembayaran_tahunan.id_tahun = tahun_ajaran.id_tahun');
        return $query = $this->db->get();
    }

    public function pembayaran_bangunan()
    {
        $this->db->select('*');
        $this->db->from('pembayaran_bangunan');
        $this->db->join('bulan', 'pembayaran_bangunan.id_bulan = bulan.id_bulan');
        $this->db->join('user', 'pembayaran_bangunan.id = user.id');
        $this->db->join('tahun_ajaran', 'pembayaran_bangunan.id_tahun = tahun_ajaran.id_tahun');
        return $query = $this->db->get();
    }

    public function pembayaran_bulanan($where1)
    {
        $this->db->select('*');
        $this->db->from('pembayaran_bulanan');

        $this->db->where_in('nis', $where1);
        return $query = $this->db->get();
    }
    public function hitungJumlahAsset($where1)
    {
        $query = $this->db->get('pembayaran_bulanan');
        $this->db->where_in('nis', $where1);
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function bayar_tahunan($where1)
    {
        $this->db->select('*');
        $this->db->from('pembayaran_tahunan');
        // $this->db->join('bendahara', 'pembayaran_lainnya.id = bendahara.id_bendahara');
        $this->db->where_in('id_siswa', $where1);
        return $query = $this->db->get()->result();
    }
    // public function pembayaran_lainnya($where1)
    // {
    //     $this->db->select('*');
    //     $this->db->from('pembayaran_tahunan');
    //     // $this->db->join('bendahara', 'pembayaran_lainnya.id = bendahara.id_bendahara');
    //     $this->db->where_in('id_siswa', $where1);
    //     return $query = $this->db->get();
    // }

    function tampil_transaksi($where1)
    {
        $this->db->select('*');
        $this->db->from('pembayaran_spp');
        $this->db->join('bulan', 'pembayaran_spp.id_bulan = bulan.id_bulan');
        $this->db->join('tahun_ajaran', 'pembayaran_spp.id_tahun = tahun_ajaran.id_tahun');
        $this->db->join('bendahara', 'pembayaran_spp.id = bendahara.id_bendahara');
        $this->db->where_in('nis', $where1);
        $this->db->order_by('pembayaran_spp.id_tahun,pembayaran_spp.id_bulan', 'ASC');
        return $query = $this->db->get();
    }

    function tampil_xtrans($where1)
    {
        $this->db->select('*');
        $this->db->from('hapus_transaksi');
        $this->db->join('bulan', 'hapus_transaksi.id_bulan = bulan.id_bulan');
        $this->db->join('tahun_ajaran', 'hapus_transaksi.id_tahun = tahun_ajaran.id_tahun');
        $this->db->join('bendahara', 'hapus_transaksi.id_bendahara = bendahara.id_bendahara');
        $this->db->where_in('nis', $where1);
        return $query = $this->db->get();
    }

    // TABEL PEMBAYARAN BULANAN (SPP)
    public function id_transaksi()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(id_transaksi,3)) AS kd_max FROM pembayaran_spp WHERE DATE(tgl_bayar)=CURDATE()");
        $kd = 1;
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%03s", $tmp);
            }
        } else {
            $kd++;
        }
        $kode = "SPP-";
        date_default_timezone_set('Asia/Jakarta');
        return $kode . date('dmy') . $kd;
    }

    // TABEL PEMBAYARAN TAHUNAN
    public function id_transaksi1()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(id_transaksi,3)) AS kd_max FROM pembayaran_tahunan WHERE DATE(tgl_bayar)=CURDATE()");
        $kd = 1;
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%03s", $tmp);
            }
        } else {
            $kd++;
        }
        $kode = "THN-";
        date_default_timezone_set('Asia/Jakarta');
        return $kode . date('dmy') . $kd;
    }

    // TABEL PEMBAYARAN BANGUNAN
    public function id_transaksi2()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(id_transaksi,3)) AS kd_max FROM pembayaran_bangunan WHERE DATE(tgl_bayar)=CURDATE()");
        $kd = 1;
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%03s", $tmp);
            }
        } else {
            $kd++;
        }
        $kode = "BGN-";
        date_default_timezone_set('Asia/Jakarta');
        return $kode . date('dmy') . $kd;
    }

    /*LAPORAN TRANSAKSI PEMBAYARAN BULANAN, TAHUNAN, DAN BANGUNAN*/

    // PEMBAYARAN BULANAN BERDASARKAN TANGGAL
    public function view_by_date($tanggal1, $tanggal2)
    {
        $this->db->select('*');
        $this->db->from('pembayaran_spp');
        $this->db->join('siswa', 'pembayaran_spp.id_siswa = siswa.id_siswa');
        $this->db->join('bulan', 'pembayaran_spp.id_bulan = bulan.id_bulan');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun = pembayaran_spp.id_tahun');
        $this->db->join('user', 'pembayaran_spp.id = user.id');
        $this->db->where('tgl_bayar BETWEEN"' . date('Y-m-d', strtotime($tanggal1)) . '"and"' . date('Y-m-d', strtotime($tanggal2)) . '"');
        $this->db->order_by('tgl_bayar');
        return $query = $this->db->get(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter  
    }


    // PEMBAYARAN TAHUNAN BERDASARKAN TANGGAL
    public function view_by_date1($tanggal1, $tanggal2)
    {
        $this->db->select('*');
        $this->db->from('pembayaran_tahunan');
        $this->db->join('siswa', 'pembayaran_tahunan.id_siswa = siswa.id_siswa');
        $this->db->join('bulan', 'pembayaran_tahunan.id_bulan = bulan.id_bulan');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun = pembayaran_tahunan.id_tahun');
        $this->db->join('user', 'pembayaran_tahunan.id = user.id');
        $this->db->where('tgl_bayar BETWEEN"' . date('Y-m-d', strtotime($tanggal1)) . '"and"' . date('Y-m-d', strtotime($tanggal2)) . '"');
        $this->db->order_by('tgl_bayar');
        return $query = $this->db->get(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter  
    }


    // PEMBAYARAN BANGUNAN BERDASARKAN TANGGAL
    public function view_by_date2($tanggal1, $tanggal2)
    {
        $this->db->select('*');
        $this->db->from('pembayaran_bangunan');
        $this->db->join('siswa', 'pembayaran_bangunan.id_siswa = siswa.id_siswa');
        $this->db->join('bulan', 'pembayaran_bangunan.id_bulan = bulan.id_bulan');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun = pembayaran_bangunan.id_tahun');
        $this->db->join('user', 'pembayaran_bangunan.id = user.id');
        $this->db->where('tgl_bayar BETWEEN"' . date('Y-m-d', strtotime($tanggal1)) . '"and"' . date('Y-m-d', strtotime($tanggal2)) . '"');
        $this->db->order_by('tgl_bayar');
        return $query = $this->db->get(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter  
    }



    public function nis()
    {
        $this->db->select('*');
        $this->db->from('siswa');
        return $query = $this->db->get()->result();
    }

    public function tahun()
    {
        $this->db->select('*');
        $this->db->from('tahun_ajaran');

        return $query = $this->db->get()->result();
    }

    // PEMBAYARAN BULANAN BERDASARKAN NIS SISWA
    public function view_by_nis($nis)
    {
        $this->db->select('*');
        $this->db->from('pembayaran_spp');
        $this->db->join('siswa', 'pembayaran_spp.nis = siswa.nis');
        $this->db->join('bulan', 'pembayaran_spp.id_bulan = bulan.id_bulan');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun = pembayaran_spp.id_tahun');
        // $this->db->join('bendahara', 'pembayaran_spp.id = bendahara.id_bendahara');
        $this->db->where('pembayaran_spp.nis', $nis);
        $this->db->order_by('siswa.nama');
        return $query = $this->db->get(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter  
    }


    // PEMBAYARAN TAHUNAN BERDASARKAN NIS SISWA
    public function view_by_nis1($nis)
    {
        $this->db->select('*');
        $this->db->from('pembayaran_tahunan');
        $this->db->join('siswa', 'pembayaran_tahunan.nis = siswa.nis');
        $this->db->join('bulan', 'pembayaran_tahunan.id_bulan = bulan.id_bulan');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun = pembayaran_tahunan.id_tahun');
        // $this->db->join('bendahara', 'pembayaran_tahunan.id = bendahara.id_bendahara');
        $this->db->where('pembayaran_tahunan.nis', $nis);
        $this->db->order_by('siswa.nama');
        return $query = $this->db->get(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter  
    }



    // PEMBAYARAN BANGUNAN BERDASARKAN NIS SISWA
    public function view_by_nis2($nis)
    {
        $this->db->select('*');
        $this->db->from('pembayaran_bangunan');
        $this->db->join('siswa', 'pembayaran_bangunan.nis = siswa.nis');
        $this->db->join('bulan', 'pembayaran_bangunan.id_bulan = bulan.id_bulan');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun = pembayaran_bangunan.id_tahun');
        // $this->db->join('bendahara', 'pembayaran_bangunan.id = bendahara.id_bendahara');
        $this->db->where('pembayaran_bangunan.nis', $nis);
        $this->db->order_by('siswa.nama');
        return $query = $this->db->get(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter  
    }

    // PEMBAYARAN BULANAN BERDASARKAN TAHUN AJARAN
    public function view_by_year($tahun)
    {
        $this->db->select('*');
        $this->db->from('pembayaran_spp');
        $this->db->join('siswa', 'pembayaran_spp.id_siswa = siswa.id_siswa');
        $this->db->join('bulan', 'pembayaran_spp.id_bulan = bulan.id_bulan');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun = pembayaran_spp.id_tahun');
        $this->db->join('user', 'pembayaran_spp.id = user.id');
        $this->db->where('pembayaran_spp.id_tahun="' . $tahun . '"');
        $this->db->order_by('siswa.nama');
        return $query = $this->db->get();
    }


    // PEMBAYARAN TAHUNAN BERDASARKAN TAHUN AJARAN
    public function view_by_year1($tahun)
    {
        $this->db->select('*');
        $this->db->from('pembayaran_tahunan');
        $this->db->join('siswa', 'pembayaran_tahunan.id_siswa = siswa.id_siswa');
        $this->db->join('bulan', 'pembayaran_tahunan.id_bulan = bulan.id_bulan');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun = pembayaran_tahunan.id_tahun');
        $this->db->join('user', 'pembayaran_tahunan.id = user.id');
        $this->db->where('pembayaran_tahunan.id_tahun="' . $tahun . '"');
        $this->db->order_by('siswa.nama');
        return $query = $this->db->get();
    }



    // PEMBAYARAN BANGUNAN BERDASARKAN TAHUN AJARAN
    public function view_by_year2($tahun)
    {
        $this->db->select('*');
        $this->db->from('pembayaran_bangunan');
        $this->db->join('siswa', 'pembayaran_bangunan.id_siswa = siswa.id_siswa');
        $this->db->join('bulan', 'pembayaran_bangunan.id_bulan = bulan.id_bulan');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun = pembayaran_bangunan.id_tahun');
        $this->db->join('user', 'pembayaran_bangunan.id = user.id');
        $this->db->where('pembayaran_bangunan.id_tahun="' . $tahun . '"');
        $this->db->order_by('siswa.nama');
        return $query = $this->db->get();
    }



    // CETAK PEMBAYARAN BULANAN BERDASARKAN SEMUA DATA
    function view_all()
    {
        $this->db->select('*');
        $this->db->from('pembayaran_spp');
        $this->db->join('siswa', 'siswa.nis = pembayaran_spp.nis');
        $this->db->join('bulan', 'pembayaran_spp.id_bulan = bulan.id_bulan');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun = pembayaran_spp.id_tahun');
        $this->db->where('pembayaran_spp.status', '0');
        $this->db->order_by('id_transaksi');
        return $this->db->get()->result();
    }


    // CETAK PEMBAYARAN TAHUNAN BERDASARKAN SEMUA DATA
    function view_all1()
    {
        $this->db->select('*');
        $this->db->from('pembayaran_tahunan');
        $this->db->join('siswa', 'siswa.nis = pembayaran_tahunan.nis');
        $this->db->join('bulan', 'pembayaran_tahunan.id_bulan = bulan.id_bulan');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun = pembayaran_tahunan.id_tahun');
        $this->db->where('pembayaran_tahunan.status', '0');
        $this->db->order_by('id_transaksi');
        return $this->db->get()->result();
    }


    // CETAK PEMBAYARAN BANGUNAN BERDASARKAN SEMUA DATA
    function view_all2()
    {
        $this->db->select('*');
        $this->db->from('pembayaran_bangunan');
        $this->db->join('siswa', 'siswa.nis = pembayaran_bangunan.nis');
        $this->db->join('bulan', 'pembayaran_bangunan.id_bulan = bulan.id_bulan');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun = pembayaran_bangunan.id_tahun');
        $this->db->where('pembayaran_bangunan.status', '0');
        $this->db->order_by('id_transaksi');
        return $this->db->get()->result();
    }



    public function laporan_kas_umum()
    {
        $this->db->select('*');
        $this->db->from('kas');
        $this->db->order_by('tgl_transaksi', 'DESC');
        return $this->db->get()->result(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter  

    }
    public function kas_umum_laporan($tanggal1, $tanggal2)
    {
        $this->db->select('*');
        $this->db->from('kas');
        $this->db->where('tgl_transaksi BETWEEN"' . date('Y-m-d', strtotime($tanggal1)) . '"and"' . date('Y-m-d', strtotime($tanggal2)) . '"');
        $this->db->order_by('tgl_transaksi', 'DESC');
        return $query = $this->db->get(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter  
    }
    public function kas_masuk($tanggal1, $tanggal2)
    {
        $this->db->select('*');
        $this->db->from('kas');
        $this->db->where('jenis_kas', 'Kas Masuk');
        $this->db->where('tgl_transaksi BETWEEN"' . date('Y-m-d', strtotime($tanggal1)) . '"and"' . date('Y-m-d', strtotime($tanggal2)) . '"');
        $this->db->order_by('tgl_transaksi', 'DESC');
        return $query = $this->db->get(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter  
    }
    public function kas_keluar($tanggal1, $tanggal2)
    {
        $this->db->select('id_kas, tgl_transaksi, keterangan, uang_masuk, uang_keluar, jenis_kas');
        $this->db->from('kas');
        $this->db->where('jenis_kas', 'Kas Keluar');
        $this->db->where('tgl_transaksi BETWEEN"' . date('Y-m-d', strtotime($tanggal1)) . '"and"' . date('Y-m-d', strtotime($tanggal2)) . '"');
        $this->db->order_by('tgl_transaksi', 'DESC');
        return $query = $this->db->get(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter  
    }
    public function per_tahun()
    {
        $sql = "SELECT YEAR(tgl_transaksi) FROM kas";
        $this->db->query($sql)->row_array();
    }
    public function view_tahun($tahun)
    {
        $this->db->select('*');
        $this->db->from('kas');
        $this->db->where('tgl_transaksi="' . $tahun . '"');
        $this->db->order_by('tgl_transaksi');
        return $query = $this->db->get();
    }

    function laporan_lainnya()
    {

        $this->db->select('*');
        $this->db->from('pembayaran_lainnya');
        $this->db->join('santri', 'santri.nis = pembayaran_lainnya.nis');
        $this->db->where('status_bayar', '0');
        $this->db->order_by('id_pem_lainya');
        return $this->db->get()->result();
    }
    public function tanggal_lainya($tanggal1, $tanggal2)
    {
        $this->db->select('*');
        $this->db->from('pembayaran_lainnya');
        $this->db->join('santri', 'pembayaran_lainnya.nis = santri.nis');
        $this->db->where('status_bayar', '0');
        $this->db->where('tanggal_bayar BETWEEN"' . date('Y-m-d', strtotime($tanggal1)) . '"and"' . date('Y-m-d', strtotime($tanggal2)) . '"');
        $this->db->order_by('tanggal_bayar');
        return $query = $this->db->get(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter  
    }
    public function nis_lainya($nis)
    {
        $this->db->select('*');
        $this->db->from('pembayaran_lainnya');
        $this->db->join('santri', 'pembayaran_lainnya.nis = santri.nis');
        $this->db->where('status_bayar', '0');
        $this->db->where('pembayaran_lainnya.nis', $nis);
        $this->db->order_by('santri.nama_santri');
        return $query = $this->db->get(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter  
    }
    public function year_lainya($tahun)
    {
        $this->db->select('*');
        $this->db->from('pembayaran_lainnya');
        $this->db->join('santri', 'pembayaran_lainnya.nis = santri.nis');
        $this->db->where('tahun_ajaran="' . $tahun . '"');
        $this->db->order_by('tahun_ajaran');
        return $query = $this->db->get();
    }
    public function year_lain($tahun)
    {

        return $this->db->query("SELECT YEAR(a.tanggal_bayar), a.id_pem_lainya, a.nis, b.nama_santri, a.jenis_pembayaran, a.tanggal_bayar, a.total_tagihan, a.metode_pembayaran
		FROM pembayaran_lainnya a, santri b
		WHERE YEAR(a.tanggal_bayar) = $tahun
		GROUP BY YEAR(a.tanggal_bayar)
		");
    }



    function update_tunggakan($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}