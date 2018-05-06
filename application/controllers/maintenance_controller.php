<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('TITLE','MAINTENANCE');

class Maintenance_Controller extends CI_Controller {

        function __construct() {

                parent::__construct();

                ### LIBRARY
                $this->load->library('form_validation');
                $this->load->library('pagination'); 
                $this->load->library('table');
                $this->load->library('custom_validation'); # My custom class validation
                $this->load->library('custom_sanitization'); # My custom class sanitization

                ### HELPER
                $this->load->helper('url');
                $this->load->helper('path');  
                $this->load->helper('form');  
                $this->load->helper('language'); 

                ### MODEL
                $this->load->model('account_model');  
                $this->load->model('maintenance_model');   

                ### SESSION CHECKING
                $this->check_session();  
        }

        /**
        * Session checking
        * 
        * @author Mydel-Ar A. Asturiano
        */
        public function check_session(){
                if(empty($this->session->userdata('username'))){
                        redirect('account_controller/login','refresh'); 
                } 
        }

        /**
        * Index
        * Redirect to landing page
        * 
        * @author Mydel-Ar A. Asturiano
        */
        public function index(){
                ### LANDING PAGE
                $this->users();  
        }

        public function message($key){
                ### MAIN
                $message = array(
                        # DATABASE MESSAGE
                        'error_insert' => 'Insert failed to table ',
                        'success_insert' => 'Insert success to table ',
                        'retrieve_failed' => 'Retrieve failed from table ',
                        # VALIDATION MESSAGE
                        'username_blank' => 'Username is blank',
                        'password_blank' => 'Password is blank',
                        'login_failed' => 'Login failed',
                        'login_success' => 'Login success',
                );
                return $message[$key];
        }
    
        public function users(){ 
                ### TITLE
                $data['title']  = TITLE; 

                ### ALERT COLOR CLASS
                $alert_danger = "alert alert-danger fade in";
                $alert_success = "alert alert-success";
                $alert_info = "alert alert-info";
                $error_line_no = " line " . __LINE__;

                ### FORM
                $data['button_add'] = array(
                        'name' => 'button_add',
                        'id' => 'button_add',
                        'style' => 'width:100px',
                        'type' => 'button',
                        'class' => 'form-control',
                        'disabled' => 'disabled',
                        'value' => 'Submit',
                );

                $table = array(
                        "a" => "tbl_users",
                        "b" => "tbl_user_group",
                );
                $data['tbl_users_list'] = $this->maintenance_model->get_tbl_users($table);

                if(isset($_POST)){

                        $data['error_class'] = "";
                        $data['error_message'] = "";
                        
                        if(!empty($this->input->post('button_submit'))){

                                $trigger = 0;
                                if($trigger == 0){
                                        $return = $this->validation($alert_class, $alert_message);
                                        if($return != 0){
                                                $data['error_class'] = $alert_class;
                                                $data['error_message'] = $alert_message;
                                                $trigger = 400;
                                        }
                                }

                                if($trigger == 0){
                                        $return = $this->execution($alert_class, $alert_message);
                                        if($return != 0){
                                                $data['error_class'] = $alert_class;
                                                $data['error_message'] = $alert_message;
                                                $trigger = 400;
                                        }
                                        if($return == 0){
                                                $data['error_class'] = $alert_class;
                                                $data['error_message'] = $alert_message;
                                                $trigger = 0;
                                                # SESSION SETTING
                                                $this->session($data);
                                        }
                                }
                        }
                }

                ### USERS VIEW
                $this->load->view('users_view',$data);
        }
}