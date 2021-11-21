<?php
class M_redaksi extends CI_Model
{
    public function getRedaksi()
    {
        return $this->db->query("SELECT * FROM redaksi_surat")->result_array();
    }

    function tampil_detail($where1)
    {
        $this->db->select('*');
        $this->db->from('redaksi_surat');
        $this->db->where_in('id_redaksi', $where1);
        return $query = $this->db->get();
    }
}