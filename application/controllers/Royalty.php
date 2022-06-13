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
  # This is Table Controller
  ###########################################################
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Royalty extends Cl_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Common_model');
        $this->load->library('form_validation');
        $this->Common_model->setDefaultTimezone();

        if (!$this->session->has_userdata('user_id')) {
            redirect('Authentication/index');
        }
        $getAccessURL = ucfirst($this->uri->segment(1));
        if (!in_array($getAccessURL, $this->session->userdata('menu_access'))) {
            redirect('Authentication/userProfile');
        }
        $login_session['active_menu_tmp'] = '';
        $this->session->set_userdata($login_session);
    }


     /**
     * Royalty
     * @access public
     * @return void
     * @param no
     */
    public function royalty() {
        $company_id = $this->session->userdata('company_id');

        $data = array();
        $data['tables'] = $this->Common_model->getAllByCompanyId($company_id, "tbl_royalty");
        $data['main_content'] = $this->load->view('master/royalty/royalty', $data, TRUE);
        $this->load->view('userHome', $data);
    }


    /**
     * Royalty
     * @access public
     * @return void
     * @param no
     */

    public function outletsalesamount() 
    {
        $id = $_GET['id'];
        $month = $_GET['month'];
        $year = $_GET['year'];
        $sql = "SELECT sum(paid_amount) as paid_amount, sum(vat) as vat, sum(delivery_charge_actual_charge) as delivery_charge_actual_charge from tbl_sales WHERE outlet_id = '$id' and MONTH(sale_date) = '$month' and paid_amount != '' and del_status = 'Live'" ;
        $results = $this->Common_model->customeQuery($sql);
        echo json_encode($results);
    }

    /**
     * Royalty
     * @access public
     * @return void
     * @param no
     */

    public function getfoodmenuid() 
    {
        $id = $_GET['id'];
        $month = $_GET['month'];
        $year = $_GET['year'];

        $sql = "SELECT sum(tbl_sales_details.menu_price_without_discount) as amount
                FROM tbl_sales_details
                left JOIN tbl_sales
                ON tbl_sales_details.sales_id = tbl_sales.id
                left JOIN tbl_food_menus
                ON tbl_sales_details.food_menu_id = tbl_food_menus.id
                WHERE tbl_food_menus.beverage_item = 'Bev Yes' and MONTH(tbl_sales.sale_date) = '$month' and tbl_sales.outlet_id = '$id' and tbl_food_menus.del_status = 'Live' and tbl_sales_details.del_status = 'Live'";


        $results = $this->Common_model->customeQuery($sql);
        // for($k=0;$k<count($results);$k++){
        //     $sql1 = "SELECT * from tbl_food_menus where beverage_item = 'Bev Yes' del_status = 'Live' ";
        //      $results1 = $this->Common_model->customeQuery($sql1);
        //      for($i=0;$i<count($results1);$i++){
        //         $sql2 = "SELECT * from tbl_sales_details where sales_id = '".$results[$k]['id']."' and food_menu_id = '".$results1[$i]['id']."'" ;
        //         $results2 = $this->Common_model->customeQuery($sql2);
        //         for($j=0;$j<count($results2);$j++){
        //             $number+=$results2[$j]['menu_price_without_discount'];
        //         }
        //     }
        // }
        // $data['ids']=$number;
        echo json_encode($results);
    }
	
	// public function getfoodmenuid() 
    // {
    //     $id = $_GET['id'];
    //     $month = $_GET['month'];
    //     $year = $_GET['year'];

    //     $number = '';
    //     $sql0 = "SELECT * from tbl_sales WHERE user_id = '$id' and MONTH(sale_date) = '$month' and paid_amount != '' and del_status='Live'";
    //     $results0 = $this->Common_model->customeQuery($sql0);
    //     for($k=0;$k<count($results0);$k++){
    //         $sql1 = "SELECT * from tbl_food_menus where beverage_item = 'Beverage Yes' or beverage_item = 'Bev Yes' ";
    //         $results1 = $this->Common_model->customeQuery($sql1);
    //         for($i=0;$i<count($results1);$i++){
    //             $sql2 = "SELECT * from tbl_sales_details where sales_id = '".$results0[$k]['id']."' and food_menu_id = '".$results1[$i]['id']."'" ;
    //             $results2 = $this->Common_model->customeQuery($sql2);
    //             for($j=0;$j<count($results2);$j++){
    //                 $number+=$results2[$j]['menu_price_without_discount'];
    //             }
    //         }
    //     }
    //     $data['ids']=$number;
    //     echo json_encode($data);

    // }


     /**
     * delete Table
     * @access public
     * @return void
     * @param int
     */
    public function deleteRoyalty($id) {
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');
        $this->Common_model->deleteStatusChange($id, "tbl_royalty");
        $this->session->set_flashdata('exception', lang('delete_success'));
        redirect('royalty/royalty');
    } 
    /**
     * delete Table
     * @access public
     * @return void
     * @param int
     */
    public function PDFGenerate($id) {
        $encrypted_id = $this->custom->encrypt_decrypt($id, 'decrypt');
        $data = array();
        $data['encrypted_id'] = $encrypted_id;
        $data['table_information'] = $this->Common_model->getDataById($id, "tbl_royalty");
        $data['main_content'] = $this->load->view('master/royalty/PDF', $data, TRUE);
        $this->load->view('userHome', $data);
    }
     /**
     * add/Edit Table
     * @access public
     * @return void
     * @param int
     */
    public function addEditRoyalty($encrypted_id = "") {
        $company_id = $this->session->userdata('company_id');
        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('saleamount',lang('sale_amount'), 'required|max_length[50]');
            $this->form_validation->set_rules('royaltyamount', lang('royalty'), 'required|max_length[50]');
            $this->form_validation->set_rules('gstroyaltyamount', lang('royalty'), 'required|max_length[50]');
            if ($this->form_validation->run() == TRUE) {
                $igc_info = array();
                $igc_info['storeid'] = htmlspecialchars($this->input->post($this->security->xss_clean('outlet')));
                $igc_info['royaltymonth'] = htmlspecialchars($this->input->post($this->security->xss_clean('month')));
                $igc_info['status'] = htmlspecialchars($this->input->post($this->security->xss_clean('status')));
                $igc_info['date'] =htmlspecialchars($this->input->post($this->security->xss_clean('date')));
                $igc_info['totalsale'] =htmlspecialchars($this->input->post($this->security->xss_clean('saleamount')));
                $item_check =$this->input->post($this->security->xss_clean('item_check'));
                if($item_check){
                    $main_check = '';
                    $total_selected = sizeof($item_check);
                    for($i=0;$i<$total_selected;$i++){
                        $main_check.=$item_check[$i];
                        if($i < ($total_selected) -1){
                            $main_check.=",";
                        }
                    }
                }
                $igc_info['item_check'] = $main_check;
                $igc_info['royaltyamount'] =htmlspecialchars($this->input->post($this->security->xss_clean('royaltyamount')));
                $igc_info['gstroyaltyamount'] =htmlspecialchars($this->input->post($this->security->xss_clean('gstroyaltyamount')));
                $igc_info['company_id'] = $this->session->userdata('company_id');
                $igc_info['del_status'] = 'Live';
                if ($id == "") {
                    $this->Common_model->insertInformation($igc_info, "tbl_royalty");
                    $this->session->set_flashdata('exception', lang('insertion_success'));
                } else {
                    $this->Common_model->updateInformation($igc_info, $id, "tbl_royalty");
                    $this->session->set_flashdata('exception', lang('update_success'));
                }
                redirect('royalty/royalty');
            } else {
                if ($id == "") {
                    $data = array();
                    $data['outlets'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, 'tbl_outlets');
                    $data['main_content'] = $this->load->view('master/royalty/addRoyalty', $data, TRUE);
                    $this->load->view('userHome', $data);
                } else {
                    $data = array();
                    $data['encrypted_id'] = $encrypted_id;
                    $data['outlets'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, 'tbl_outlets');
                    $data['table_information'] = $this->Common_model->getDataById($id, "tbl_tables");
                    $data['main_content'] = $this->load->view('master/royalty/editRoyalty', $data, TRUE);
                    $this->load->view('userHome', $data);
                }
            }
        } else {
            if ($id == "") {
                $data = array();
                $data['outlets'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, 'tbl_outlets');
                $data['main_content'] = $this->load->view('master/royalty/addRoyalty', $data, TRUE);
                $this->load->view('userHome', $data);
            } else {
                $data = array();
                $data['encrypted_id'] = $encrypted_id;
                $data['outlets'] = $this->Common_model->getAllByCompanyIdForDropdown($company_id, 'tbl_outlets');
                $data['table_information'] = $this->Common_model->getDataById($id, "tbl_royalty");
                $data['main_content'] = $this->load->view('master/royalty/editRoyalty', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        }
    }
}
