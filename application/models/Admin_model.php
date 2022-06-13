<?php
/*
  ###########################################################
  # PRODUCT NAME:   Pos System
  ###########################################################
  # AUTHER:     Venner Infotech
  ###########################################################
  # EMAIL:      vennerinfotech@gmail.com
  ###########################################################
  # COPYRIGHTS:     RESERVED BY Venner Infotech
  ###########################################################
  # WEBSITE:        http://www.vennerinfotech.com
  ###########################################################
  # This is Admin_model Model
  ###########################################################
 */

class Admin_model extends CI_Model {
    /**
     * get all company info
     * @access public
     * @return object
     * @param no
     */
    public function getAllCompanies() {
        $this->db->select("*");
        $this->db->from("tbl_users");
        $this->db->order_by('tbl_companies.id', 'desc');
        $this->db->where("tbl_users.role", "Admin");
        $this->db->join('tbl_companies', 'tbl_users.company_id = tbl_companies.id');
        return $this->db->get()->result();
    }

}

?>
