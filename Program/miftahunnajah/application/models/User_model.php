<?php
class User_model extends CI_Model
{
    // public function __construct()
    // {
    //     $this->load->database();
    // }
    // public function all()
    // {
    //     $data = $this->db->query("SELECT * from user")->result_array();
    //     return $data->result();
    // }

    // function ambil_data()
    // {
    //     return $this->db->get('siswa')->result_array();
    // }

    function tampil_data()
    {
        $this->db->SELECT('*');
        $this->db->FROM('user');
        $this->db->JOIN('user_role', 'user_role.id = user.role_id');
        $query = $this->db->get()->result_array();
        return $query;
        // return $this->db->query("SELECT * FROM user")->result_array();
    }

    function hapusAdmin($id)
    {
        $this->db->where('id', $id);
        $this->db->from('user');
        return true;
    }


    public function delet_user($id_admin)
    {
        $this->db->where('id', $id_admin);
        $this->db->delete('user');
    }

    function edit_admin()
    {
        $this->db->SELECT('*');
        $this->db->FROM('user');
        $this->db->JOIN('user_role', 'user.role_id = user_role.id');
        $query = $this->db->get()->result_array();
        return $query;
        // return $this->db->query("SELECT * FROM user")->result_array();
    }
}