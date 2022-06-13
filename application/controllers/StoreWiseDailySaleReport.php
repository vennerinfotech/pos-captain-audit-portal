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
  # This is Purchase Controller
  ###########################################################
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class StoreWiseDailySaleReport extends Cl_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Authentication_model');
        $this->load->model('Purchase_model');
        $this->load->model('StoreWiseDailySale_Model');
        $this->load->model('Master_model');
        $this->load->model('Common_model');
        $this->Common_model->setDefaultTimezone();
        $this->load->library('form_validation');
        
        if (!$this->session->has_userdata('user_id')) {
            redirect('Authentication/index');
        }
        if (!$this->session->has_userdata('outlet_id')) {
            $this->session->set_flashdata('exception_2', lang('please_click_green_button'));

            $this->session->set_userdata("clicked_controller", $this->uri->segment(1));
            $this->session->set_userdata("clicked_method", $this->uri->segment(2));
            redirect('Outlet/outlets');
        }
        $getAccessURL = ucfirst($this->uri->segment(1));
        if (!in_array($getAccessURL, $this->session->userdata('menu_access'))) {
            redirect('Authentication/userProfile');
        }
        $login_session['active_menu_tmp'] = '';
        $this->session->set_userdata($login_session);
    }

     /**
     * purchases info
     * @access public
     * @return void
     * @param no
     */
    public function storewisedailysalereport() {
        $outlet_id = $this->session->userdata('outlet_id');
        $data = array();
        
        
        $data['main_content'] = $this->load->view('storewisedailysalereport/storewisedailysalereport', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public function GetDailySaleReportByStore() {
        $data = array();
        if ($this->input->post('submit')) {
            $start_date =htmlspecialchars($this->input->post($this->security->xss_clean('startDate')));
            $data['start_date'] = $start_date;
            $end_date =htmlspecialchars($this->input->post($this->security->xss_clean('endDate')));
            $data['end_date'] = $end_date;
            $data['StoreSaleReportByDate'] = $this->StoreWiseDailySale_Model->StoresaleReportByDate($start_date, $end_date);
        }
        else
        {
            $data['StoreSaleReportByDate'] = $this->StoreWiseDailySale_Model->StoresaleReportByDate(date("Y-m-d"), date("Y-m-d"));
        }
        
        $data['main_content'] = $this->load->view('storewisedailysalereport/storewisedailysalereport', $data, TRUE);
        $this->load->view('userHome', $data);
    }
}
