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
  # This is Report Controller
  ###########################################################
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Hr extends Cl_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Authentication_model');
        $this->load->model('Common_model');
        $this->load->model('Hr_Model');
        $this->load->model('Inventory_model');
        $this->load->model('Sale_model');
        $this->load->library('form_validation');
        $this->Common_model->setDefaultTimezone();
        
        if (!$this->session->has_userdata('user_id')) {
            redirect('Authentication/index');
        }

        if (!$this->session->has_userdata('outlet_id')) {
            $this->session->set_flashdata('exception_2', 'Please click on green Enter button of an outlet');
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
     * print Daily Summary Report
     * @access public
     * @return void
     * @param string
     */
    public function printDailySummaryReport($selectedDate = '',$outlet_id){
        $data = array(); 
        $data['result'] = $this->Report_model->dailySummaryReport($selectedDate,$outlet_id);
        $data['selectedDate'] = $selectedDate; 
        $data['outlet_id'] = $outlet_id;

        $this->load->view('report/printDailySummaryReport', $data); 
    }

    /**
     * Print Staff Detail
     * @access public
     * @return void
     * @param string
     */
    public function staff()
    {
        $outlet_id = $this->session->userdata('outlet_id');

        $data = array();
        $data['staffdetails'] = $this->Common_model->getAllByOutletId($outlet_id, "tbl_outet_staff");
        $data['main_content'] = $this->load->view('hr/staff', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    /**
     * deactivate Staff
     * @access public
     * @return void
     * @param int
     */
    public function deactivateUser($encrypted_id) {
        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');
        $staff_info = array();
        $staff_info['active_status'] = 'Inactive';
        $this->Common_model->updateInformation($staff_info, $id, "tbl_outet_staff");
        redirect('Hr/staff');
    }

     /**
     * activate Staff
     * @access public
     * @return void
     * @param int
     */
    public function activateUser($encrypted_id) {
        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');
        $staff_info = array();
        $staff_info['active_status'] = 'Active';
        $this->Common_model->updateInformation($staff_info, $id, "tbl_outet_staff");
        redirect('Hr/staff');
    }

    /**
     * delete User
     * @access public
     * @return void
     * @param int
     */
    public function deleteUser($id) {
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');
        $this->Common_model->deleteStatusChange($id, "tbl_outet_staff");
        $this->session->set_flashdata('exception',  lang('delete_success'));
        redirect('Hr/staff');
    }
    
    /**
     * add/edit expense
     * @access public
     * @return void
     * @param int
     */
    public function addEditStaff($encrypted_id = "") {
        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');
        $company_id = $this->session->userdata('company_id');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('date',lang('date'), 'required|max_length[10]');
            $this->form_validation->set_rules('name',lang('name'), 'required|max_length[50]');
            $this->form_validation->set_rules('designation',lang('designation'), 'required|max_length[100]');
            $this->form_validation->set_rules('phone',lang('phone'), 'required|max_length[15]');
            $this->form_validation->set_rules('salary',lang('salary'), 'required|max_length[20]');
            $this->form_validation->set_rules('description',lang('description'), 'required|max_length[100]');
            if ($this->form_validation->run() == TRUE) {
                $expnse_info = array();
                $expnse_info['staff_joiningdate'] = date("Y-m-d", strtotime($this->input->post($this->security->xss_clean('date'))));
                $expnse_info['staff_name'] =htmlspecialchars($this->input->post($this->security->xss_clean('name')));
                $expnse_info['staff_designation'] =htmlspecialchars($this->input->post($this->security->xss_clean('designation')));
                $expnse_info['staff_phone'] =htmlspecialchars($this->input->post($this->security->xss_clean('phone')));
                $expnse_info['staff_salary'] =htmlspecialchars($this->input->post($this->security->xss_clean('salary')));
                $expnse_info['staff_description'] =htmlspecialchars($this->input->post($this->security->xss_clean('description')));
                $expnse_info['del_status'] = 'Live';
                $expnse_info['user_id'] = $this->session->userdata('user_id');
                $expnse_info['outlet_id'] = $this->session->userdata('outlet_id');

                if ($id == "") {
                    $expnse_info['active_status'] = 'Active';
                    $this->Common_model->insertInformation($expnse_info, "tbl_outet_staff");
                    $this->session->set_flashdata('exception', lang('insertion_success'));
                } else {
                    $this->Common_model->updateInformation($expnse_info, $id, "tbl_outet_staff");
                    $this->session->set_flashdata('exception', lang('update_success'));
                }
                redirect('Hr/staff');
            } else {
                if ($id == "") {
                    $data = array();
                    $data['main_content'] = $this->load->view('hr/addStaff', $data, TRUE);
                    $this->load->view('userHome', $data);
                } else {
                    $data = array();
                    $data['encrypted_id'] = $encrypted_id;
                    $data['staff_information'] = $this->Common_model->getDataById($id, "tbl_outet_staff");
                    $data['main_content'] = $this->load->view('hr/editStaff', $data, TRUE);
                    $this->load->view('userHome', $data);
                }
            }
        } else {
            if ($id == "") {
                $data = array();
                $data['outlets'] = $this->Common_model->getAllOutlestByAssign();
                $data['main_content'] = $this->load->view('hr/addStaff', $data, TRUE);
                $this->load->view('userHome', $data);
            } else {
                $data = array();
                $data['encrypted_id'] = $encrypted_id;
                $data['outlets'] = $this->Common_model->getAllOutlestByAssign();
                $data['staff_information'] = $this->Common_model->getDataById($id, "tbl_outet_staff");
                $data['main_content'] = $this->load->view('hr/editStaff', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        }
    }
}
