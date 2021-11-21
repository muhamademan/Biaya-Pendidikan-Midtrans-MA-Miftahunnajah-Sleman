<?php

class M_bangunan extends CI_Model
{
    public function getBangunan()
    {
        return $this->db->query("SELECT bb.*, ta.tahun_ajaran
        FROM biaya_bangunan bb, tahun_ajaran ta
        WHERE bb.id_bangunan = ta.id_bangunan")->result_array();
    }
}