<?php
class M_thaktif extends CI_Model
{

    function ambil_data()
    {
        return $this->db->get('tahun_aktif')->result_array();
    }
    function tampil_data()
    {
        $this->db->select('*');
        $this->db->from('tahun_aktif');
        $this->db->join('siswa', 'tahun_aktif.id_siswa = siswa.id_siswa');
        // $this->db->join('tahun_ajaran', 'tahun_aktif.id_tahun = tahun_ajaran.id_tahun');
        $this->db->order_by('siswa.id_siswa', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
    function input_data($data, $table)
    {
        $this->db->insert($table, $data);
    }
    function edit_data($where1, $table)
    {
        return $this->db->get_where($table, $where1);
    }
    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    function hapus_data($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    function input_data_tunggakan($data, $table)
    {
        $this->db->insert($table, $data);
    }

    function hapus_tunggakan($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function save_thn_aktif($data)
    {
        return $this->db->insert_batch('tahun_aktif', $data);
    }
}