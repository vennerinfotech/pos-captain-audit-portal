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
  # This is Purchase_model Model
  ###########################################################
 */
class StoreWiseDailySale_Model extends CI_Model {
 
 
    /**
     * get Purchase Ingredients
     * @access public
     * @return object
     * @param int
     */
    public function getPurchaseIngredients($id) {
        $this->db->select("*");
        $this->db->from("tbl_purchase_ingredients");
        $this->db->order_by('id', 'ASC');
        $this->db->where("purchase_id", $id);
        $this->db->where("del_status", 'Live');
        return $this->db->get()->result();
    }

    /**
     * Store Wise Sale Report ByDate
     * @access public
     * @return object
     * @param string
     * @param string
     * @param string
     * @param string
     * @param int
     */
    public function StoresaleReportByDate($startDate = '', $endDate = '') {
        if ($startDate || $endDate):
            $this->db->select('sale_date,sum(total_payable) as total_payable, payment_method_id, outlet_id');
            $this->db->from('tbl_sales');

            if ($startDate != '' && $endDate != '') {
                $this->db->where('sale_date>=', $startDate);
                $this->db->where('sale_date <=', $endDate);
            }
            if ($startDate != '' && $endDate == '') {
                $this->db->where('sale_date', $startDate);
            }
            if ($startDate == '' && $endDate != '') {
                $this->db->where('sale_date', $endDate);
            }

            $this->db->where('order_status', '3');
            $this->db->group_by('sale_date');
            $this->db->group_by('outlet_id');
            $this->db->where('del_status', "Live");
            $query_result = $this->db->get();
            $result = $query_result->result();
            return $result;
        endif;
    }

}