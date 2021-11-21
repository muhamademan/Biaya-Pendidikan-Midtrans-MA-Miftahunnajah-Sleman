<?php
class M_master extends CI_Model
{
    public function getSiswa()
    {
        return $this->db->query("SELECT * FROM siswa")->result_array();
    }

    public function editSiswa($id_siswa)
    {
        return $this->db->query("SELECT * FROM siswa WHERE id_siswa = $id_siswa")->result_array();
    }

    function tampil_detail($where1)
    {
        $this->db->select('*');
        $this->db->from('siswa');
        $this->db->where_in('id_siswa', $where1);
        return $query = $this->db->get();
    }
}