<?php
class M_pengaturan extends CI_Model
{

    // QUERY USER AKSES MENU MANAGEMENT
    public function get_Aksesmenu()
    {
        $queryAksesmenu = "SELECT user_access_menu.*, user_menu.menu, user_role.role
        FROM user_access_menu 
        JOIN user_menu
        ON user_access_menu.menu_id = user_menu.id
        JOIN user_role
        ON user_access_menu.role_id = user_role.id";

        return $this->db->query($queryAksesmenu)->result_array();
    }

    // QUERY HAPUS USER AKSES MENU MANAGEMENT
    public function hapus_Aksesmenu($where)
    {
        $this->db->where($where);
        $this->db->delete('user_access_menu');
    }


    // QUERY MENU MANAGEMENT
    public function hapus_Menu($where)
    {
        $this->db->where($where);
        $this->db->delete('user_menu');
    }


    // QUERY SUBMENU MANAGEMENT
    public function getSubmenu()
    {
        $querySubmenu = "SELECT user_sub_menu.*, user_menu.menu
                    FROM user_sub_menu JOIN user_menu
                    ON user_sub_menu.menu_id = user_menu.id";

        return $this->db->query($querySubmenu)->result_array();
    }

    public function hapus_Submenu($where)
    {
        $this->db->where($where);
        $this->db->delete('user_sub_menu');
    }
}