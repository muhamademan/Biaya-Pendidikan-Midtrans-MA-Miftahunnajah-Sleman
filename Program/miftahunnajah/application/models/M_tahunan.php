<?php
class M_tahunan extends CI_Model
{
    public function getTahunan()
    {
        return $this->db->query("SELECT bt.*, ta.tahun_ajaran
        FROM biaya_tahunan bt, tahun_ajaran ta
        WHERE bt.id_tahun = ta.id_tahun")->result_array();
    }
}