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
  # This is Update Controller
  ###########################################################
 */
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class Update extends Cl_Controller {

    protected $update;
    protected $my_info;
    function __construct(){
        parent::__construct();
        $this->my_info = json_decode(file_get_contents(base_url(str_rot13('/nffrgf/vafgnyyngvba_vasbezngvba/ERFG_NCV_HI.wfba'))));
        $this->update = json_decode(file_get_contents(($this->my_info->url)));
    }

     /**
     * update view page
     * @access public
     * @return void
     * @param no
     */
    public function index(){
        $check_update_session = $this->session->userdata('check_update_session');
        $system_version_number = $this->session->userdata('system_version_number');
        if($check_update_session=="Yes"){
            if($system_version_number > $system_version_number){
                $data['color'] = '#4b7bec';
                $data['message'] = 'A NEW VERSION IS AVAILABLE';
                if(isset($this->update->whats_new)){
                    $data['whats_new'] = $this->update->whats_new;
                }
                $data['update_url'] = base_url('/update/do_update');
            }else{
                $data['color']= '#16a085';
                $data['message']= 'You are using '.$system_version_number.' version';
            }
            $this->load->view('updater/update_view', $data);
        }else{
            redirect('Update/updateVerification');
        }
    }
    /**
     * update view page
     * @access public
     * @return void
     * @param no
     */
    public function updateVerification(){
        $details = json_decode(file_get_contents(base_url(str_rot13('/nffrgf/oyhrvzc/juvgr_ynory.wfba'))));
        if(isset($details->is_white_label) && $details->is_white_label=="No"){
            if ($this->input->post('submit')) {
                $purchase_code = $_POST["purchase_code"];
                $username = $_POST["username"];
                $owner = $_POST["owner"];
                //need to change
                $source = 'CodeCanyon';
                //need to change
                $product_id = '23033741';

                $curl_handle = curl_init();
                //need to change
                curl_setopt($curl_handle, CURLOPT_URL, 'http://doorsoft.co/dsl/Validation/Validate/');
                curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl_handle, CURLOPT_POST, 1);
                curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
                $referer = "http://".$_SERVER["SERVER_NAME"].substr($_SERVER["REQUEST_URI"], 0, -24);
                $path = substr(realpath(dirname(__FILE__)), 0, -8);
                curl_setopt($curl_handle, CURLOPT_POSTFIELDS, array(
                    'username' => $username,
                    'purchase_code' => $purchase_code,
                    'source' => $source,
                    'product_id' => $product_id,
                    'owner' => $owner,
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'referer' => $referer,
                    'path' => $path
                ));

                $buffer = curl_exec($curl_handle);
                curl_close($curl_handle);
                if (! (is_object(json_decode($buffer)))) {
                    $cfc = strip_tags($buffer);
                } else {
                    $cfc = NULL;
                }

                $object = json_decode($buffer);
                $data['status']= 1;
                $data['color']= "red";
                $data['txt_return']= "Purchase Code or Username is not valid!";

                if(isset($object->status) &&  $object->status == 'success'){
                    $data['status']= 2;
                    $data['color']= "green";
                    $data['txt_return']= "Successfully verified!";
                    $this->session->set_userdata('check_update_session',"Yes");
                }
                $this->load->view('updater/updateVerification', $data);
            }else{
                $data['status']= '';
                $data['color']= "red";
                $data['txt_return']= "";
                $this->load->view('updater/updateVerification', $data);
            }
        }else{
            $this->session->set_userdata('check_update_session',"Yes");
            redirect('Update/index');
        }
    }

    public function rrmdir($dir) {
        foreach(glob($dir . '/*') as $file) {
            if(is_dir($file))
                $this->rrmdir($file);
            else
                unlink($file);
        }
        rmdir($dir);
    }
    /**
     * update view page
     * @access public
     * @return void
     * @param no
     */
    public function uninstallLicense(){
        if ($this->input->post('submit')) {
            $purchase_code = $_POST["purchase_code"];
            $username = $_POST["username"];
            $owner = $_POST["owner"];
            $current_installation_url = $_POST["current_installation_url"];
            $new_installation_url = $_POST["transfer_installation_url"];
            $action_type = $_POST["action_type"];
            //need to change
            $source = 'CodeCanyon';
            //need to change
            $product_id = '23033741';

            $curl_handle = curl_init();
            //need to change
            curl_setopt($curl_handle, CURLOPT_URL, 'http://doorsoft.co/dsl/Validation/uninstallLicense/');
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl_handle, CURLOPT_POST, 1);
            curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
            $referer = "http://".$_SERVER["SERVER_NAME"].substr($_SERVER["REQUEST_URI"], 0, -24);
            $path = substr(realpath(dirname(__FILE__)), 0, -8);
            curl_setopt($curl_handle, CURLOPT_POSTFIELDS, array(
                'username' => $username,
                'purchase_code' => $purchase_code,
                'source' => $source,
                'product_id' => $product_id,
                'current_installation_url' => $current_installation_url,
                'new_installation_url' => $new_installation_url,
                'action_type' => $action_type,
                'owner' => $owner,
                'ip' => $_SERVER['REMOTE_ADDR'],
                'referer' => $referer,
                'path' => $path
            ));

            $buffer = curl_exec($curl_handle);
            curl_close($curl_handle);
            if (! (is_object(json_decode($buffer)))) {
                $cfc = strip_tags($buffer);
            } else {
                $cfc = NULL;
            }

            $object = json_decode($buffer);

            if($object->status == 'success'){
                $data['status']= 2;
                $data['color']= "green";
                $data['txt_return']= $object->message;
                $this->session->set_userdata('check_update_session',"Yes");
                $this->load->view('updater/uninstallLicense', $data);
            }else{
                $data['status']= 1;
                $data['color']= "red";
                $data['txt_return']= $object->message;
                $this->load->view('updater/uninstallLicense', $data);
            }
        }else{
            $data['status']= '';
            $data['color']= "red";
            $data['txt_return']= "";
            $this->load->view('updater/uninstallLicense', $data);
        }

    }
     /**
     * do update after submit the button
     * @access public
     * @return void
     * @param no
     */
    public function do_update(){
        if (!$this->input->is_ajax_request()){
            echo 'downloading...<br>';
        }
        if($this->downloadFile($this->update->url, 'build.zip')){
            $zip = new ZipArchive;
            $res = $zip->open('build.zip');
            if($res==TRUE){
                $zip->extractTo('_temp/');
                if($zip){
                    if ($this->input->is_ajax_request()) {
                        $response = array(
                            "status"=>"success",
                            "message"=>"Downloaded Successfully!",
                            "action"=>base_url('update/install_update'),
                            "caption"=>'Install Update'
                        );
                        echo json_encode($response);
                    }else{
                        //generate html content for view
                        echo 'downloaded successfully...</br>Extracted successfully <a href="'.base_url('/update/install_update').'">click here</a> to install the updates!';
                    }
                }else{
                    if ($this->input->is_ajax_request()) {
                        $response = array(
                            "status"=>"error",
                            "message"=>"Could not extract package.",
                            "action"=>base_url('update/help'),
                            "caption"=>'Contact Us'
                        );
                        echo json_encode($response);
                    }else{
                        echo 'downloaded successfully...</br>Could not extract installation package!';
                    }
                }
                $zip->close();
            }
        }
    }
     /**
     * install update after download file
     * @access public
     * @return int
     * @param no
     */
    public function install_update(){
        $src = '_temp/';
        $dst = '.';

        if(!file_exists('_temp/installer.json')){
            if ($this->input->is_ajax_request()) {
                $res = array(
                    'status'=>'error',
                    'message'=>'Package installer missing.'
                );
                echo json_encode($res);
            }else{
                show_404();
            }
            return 0;
        }
        //get information from installer json file
        $installer = json_decode(file_get_contents('_temp/installer.json'));
        if(isset($installer->delete)){
            foreach ($installer->delete as $key => $filePath) {
                if($filePath){
                    if(file_exists($filePath)){
                        unlink($filePath);
                    }
                }
            }
        }
        if(isset($installer->sql)){
            foreach ($installer->sql as $key => $query) {
                if($query){
                    $q = $this->db->query($query);
                }
            }
        }

        $this->recurse_copy($src, $dst);
        delete_files($src, TRUE);
        if(file_exists('build.zip')){
            unlink('build.zip');
        }

        if ($this->input->is_ajax_request()) {
            $res = array(
                'status'=>'success',
                'message'=>'Installed successfully.',
                'action'=> base_url(),
                "caption"=>'Login Now'
            );


            echo json_encode($res);
        }else{
            echo 'Installed Successfully <a href="'.base_url('/dashboard/dashboard').'">click here</a> to go dashboard!';
        }

    }
     /**
     * download file from path
     * @access public
     * @return boolean
     * @param string
     * @param string
     */
    public function downloadFile($url, $path) {
        $newfname = $path;
        $file = fopen ($url, 'rb');
        if ($file) {
            $newf = fopen ($newfname, 'wb');
            if ($newf) {
                while(!feof($file)) {
                    fwrite($newf, fread($file, 1024 * 8), 1024 * 8);
                }
            }
        }
        if ($file) {
            fclose($file);
        }
        if ($newf) {
            fclose($newf);
            return true;
        }else{
            return false;
        }
    }
     /**
     * recurse copy from destination
     * @access public
     * @return void
     * @param string
     * @param string
     */
    protected function recurse_copy($src, $dst) {
        $dir = opendir($src);
        @mkdir($dst);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' ) && ($file != 'installer.json')) {
                if ( is_dir($src . '/' . $file) ) {
                    $this->recurse_copy($src . '/' . $file, $dst . '/' . $file);
                }else{
                    copy($src . '/' . $file,$dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }
     /**
     * help view page
     * @access public
     * @return void
     * @param no
     */
    public function help(){
        //generate html content for view
        echo 'contact support information will go here!';
    }
}