<?php
class M_tahunajaran extends CI_Model
{
    public function getTahunajaran()
    {
        return $this->db->query("SELECT * FROM tahun_ajaran")->result_array();
    }
    public function editAjaran($id_tahun)
    {
        return $this->db->query("SELECT * FROM tahun_ajaran WHERE id_tahun = $id_tahun")->result_array();
    }
    // function ambil_data()
    // {
    //     return $this->db->get('tahun_ajaran')->result_array();
    // }
    // function tampil_data()
    // {
    //     return $this->db->get('tahun_ajaran')->result_array();
    // }
}