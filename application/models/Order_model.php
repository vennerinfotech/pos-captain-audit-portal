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
  # This is Order_model Model
  ###########################################################
 */
class Order_model extends CI_Model {

     /**
     * get All By Table
     * @access public
     * @return object
     * @param string
     */
    public function getAllByTable($table_name) {
        $result = $this->db->query("SELECT * 
          FROM $table_name 
          WHERE del_status = 'Live'  
          ORDER BY id DESC")->result();
        return $result;
    }
     /**
     * get Info By ID
     * @access public
     * @return object
     * @param string
     */
    public function getInfoByID($table_name) {
        $result = $this->db->query("SELECT * 
          FROM $table_name 
          WHERE  del_status = 'Live'  
          ORDER BY id DESC")->row();
        return $result;
    }
     /**
     * get Menu By Menu Name
     * @access public
     * @return object
     * @param string
     */
    public function getMenuByMenuName($menu_name){
      $this->db->select("*");
      $this->db->from('tbl_food_menus');
      $this->db->where("tbl_food_menus.name", $menu_name);
      $this->db->order_by('id', 'ASC');
      return $this->db->get()->row();      
    }

   


}

?>
