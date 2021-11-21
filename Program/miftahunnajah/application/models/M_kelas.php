<?php

class M_kelas extends CI_Model
{
    public function getKelas()
    {
        return $this->db->query("SELECT * FROM kelas")->result_array();
    }

    public function edit_kelas($id_kelas)
    {
        return $this->db->query("SELECT * FROM kelas WHERE id_kelas = $id_kelas")->result_array();
        // $this->db->select('*');
        // $this->db->from('kelas');
        // $this->db->where_in('id_kelas', $where1);
        // return $query = $this->db->get();
    }
}