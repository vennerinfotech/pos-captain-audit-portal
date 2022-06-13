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
  # This is Kitchen_model Model
  ###########################################################
 */

class Closing_model extends CI_Model {

     public function __construct() {
        parent::__construct();

        $this->load->library('excel'); //load PHPExcel library 
        $this->load->model('Authentication_model');
        $this->load->model('Common_model');
        $this->load->model('Master_model');
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

}

