<?php
class M_spp extends CI_Model
{
    public function getSpp()
    {
        return $this->db->query("SELECT bs.*, t.tahun_ajaran 
        FROM biaya_spp bs, tahun_ajaran t
        WHERE bs.id_tahun = t.id_tahun")->result_array();
    }

    // public function ubahSpp($id_spp)
    // {
    //     return $this->db->query("SELECT bs.*, t.tahun_ajaran 
    //     FROM biaya_spp bs, tahun_ajaran t
    //     WHERE bs.id_tahun = t.id_tahun
    //     AND id_spp = $id_spp")->result_array();
    // }

    function edit_data($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}