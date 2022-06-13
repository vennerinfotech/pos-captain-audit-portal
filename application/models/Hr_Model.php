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
  # This is Report_model Model
  ###########################################################
 */
class Hr_model extends CI_Model {

    /**
     * get Users
     * @access public
     * @return object
     * @param int
     */
    public function getUsers($outlet_id){
        $result = $this->db->query("SELECT * FROM tbl_users WHERE del_status='Live' AND FIND_IN_SET('$outlet_id' , outlets)")->result();
        return $result;
    }
    
    /**
     * get Register Information
     * @access public
     * @return object
     * @param string
     * @param string
     * @param int
     * @param int
     */
    public function getRegisterInformation($start_date,$end_date,$user_id='',$outlet_id=''){
        $this->db->select("tbl_register.*,tbl_users.full_name as user_name");
        $this->db->from('tbl_register');
        $this->db->join('tbl_users', 'tbl_users.id = tbl_register.user_id', 'left');
        if($user_id!=''){
            $this->db->where("tbl_register.user_id", $user_id);
        }
        if($outlet_id!=''){
            $this->db->where("tbl_register.outlet_id", $outlet_id);
        }
        $this->db->where("DATE(tbl_register.opening_balance_date_time)>=", $start_date);
        $this->db->where("DATE(tbl_register.opening_balance_date_time)<=", $end_date);
        $this->db->order_by('tbl_register.id', 'DESC');
        return $this->db->get()->result();
    }
}

