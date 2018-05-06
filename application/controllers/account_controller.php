<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('TITLE','ACCOUNT');

class Account_Controller extends CI_Controller {

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
        }

        /**
        * Message
        * 
        * @param string $key 
        * @return string $key
        * @author Mydel-Ar A. Asturiano
        */
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

        /**
        * Index
        * Redirect to landing page
        * 
        * @author Mydel-Ar A. Asturiano
        */
	public function index(){
                ### LANDING PAGE
		$this->login();  
	}
    
        /**
        * Login
        * Main page
        * 
        * @author Mydel-Ar A. Asturiano
        */
        public function login(){ 
                ### TITLE
                $data['title']  = TITLE; 

                ### LANGUAGE
                $data['text_language'] = array(
                        'name' => 'text_language',
                        'id' => 'text_language',                           
                        'style' => 'width:100%',
                        'class' => 'form-control',
                        'placeholder' => 'Language',
                        'value' => $this->input->post('text_language'),
                );

                $data['text_language_option'] = array(
                        'select' => 'Select language',
                        'english' => 'English',
                        'tagalog' => 'Tagalog'
                );

                ### ALERT COLOR CLASS
                $alert_danger = "alert alert-danger fade in";
                $alert_success = "alert alert-success";
                $alert_info = "alert alert-info";
                $error_line_no = " line " . __LINE__;

                ### FORM
                $data['text_username'] = array(
                        'name' => 'text_username',
                        'id' => 'text_username',
                        'maxlength' => '50',
                        'size' => '50',                              
                        'style' => 'width:100%',
                        'type' => 'text',
                        'class' => 'form-control',
                        'placeholder' => 'Username',
                        'value' => $this->input->post('text_username'),
                );

                $data['text_password'] = array(
                        'name' => 'text_password',
                        'id' => 'text_password',
                        'maxlength' => '50',
                        'size' => '50',                              
                        'style' => 'width:100%',
                        'type' => 'password',
                        'class' => 'form-control',
                        'placeholder' => 'Password',
                        'value' => $this->input->post('text_password'),
                );

                $data['button_submit'] = array(
                        'name' => 'button_submit',
                        'id' => 'button_submit',
                        'style' => 'width:100%',
                        'type' => 'submit',
                        'class' => 'form-control',
                        'value' => 'Submit',
                );

                if(isset($_POST)){

                        $data['error_class'] = "";
                        $data['error_message'] = "";
                        
                        if(!empty($this->input->post('button_submit'))){

                                $trigger = false;
                                if($trigger == false){
                                        $return = $this->validation($alert_class, $alert_message);
                                        if($return != 0){
                                                $data['error_class'] = $alert_class;
                                                $data['error_message'] = $alert_message;
                                                $trigger = true;
                                        }
                                }

                                if($trigger == false){
                                        $return = $this->execution($alert_class, $alert_message);
                                        if($return == true){
                                                $data['error_class'] = $alert_class;
                                                $data['error_message'] = $alert_message;
                                                $trigger = true;
                                        }
                                        if($return == false){
                                                $data['error_class'] = $alert_class;
                                                $data['error_message'] = $alert_message;
                                                $trigger = false;
                                                # SESSION SETTING
                                                $this->session($data);
                                        }
                                }
                        }
                }

                ### LOGIN VIEW
                if(empty($this->session->userdata('username'))){
                        $this->load->view('login_view',$data); 
                }
                else{
                        # GET USER INFORMATION
                        $data = $this->user_info($data);
                        ### LOGOUT VIEW
                        $this->load->view('logout_view',$data); 
                }
        }

        /**
        * Validation
        * 
        * @param string &$alert_class 
        * @param string &$alert_message
        * @return string &$alert_class
        * @return string &$alert_message
        * @author Mydel-Ar A. Asturiano
        */
        public function validation(&$alert_class, &$alert_message){

                ### ALERT COLOR CLASS
                $alert_danger = "alert alert-danger fade in";
                $alert_success = "alert alert-success";
                $alert_info = "alert alert-info";
                $error_line_no = " line " . __LINE__;

                if(empty($this->input->post('text_username'))){
                        $alert_class = $alert_danger;
                        $alert_message = $this->message('username_blank');
                        return 400;
                }
                if(empty($this->input->post('text_password'))){
                        $alert_class = $alert_danger;
                        $alert_message = $this->message('password_blank');
                        return 400;
                }

                return 0;
        }

        /**
        * Insert data to table person 
        * 
        * @param string &$alert_class 
        * @param string &$alert_message
        * @return string &$alert_class
        * @return string &$alert_message
        * @author Mydel-Ar A. Asturiano
        */
        public function execution(&$alert_class, &$alert_message){

                ### ALERT COLOR CLASS
                $alert_danger = "alert alert-danger fade in";
                $alert_success = "alert alert-success";
                $alert_info = "alert alert-info";
                $error_line_no = " line " . __LINE__;

                $account = array(
                        "text_username" => $this->input->post('text_username'),
                        "text_password" => $this->input->post('text_password'), 
                );

                $table = "tbl_users";
                $return = $this->account_model->check_user($table, $account);
                if($return != false){
                        $alert_class = $alert_danger;
                        $alert_message = $this->message('login_failed');
                        return true;
                }
                else{
                        $alert_class = $alert_success;
                        $alert_message = $this->message('login_success');
                        return false;
                }

                return false;
        }

        /**
        * Session setting
        * 
        * @param array $data 
        * @author Mydel-Ar A. Asturiano
        */
        public function session($data){
                # SET SESSIONS
                $user_data = array(
                        'username' => $data['text_username']['value'],
                        'password' => $data['text_password']['value'],
                        'date' => date("Y-m-d H:i:s"),
                );    
                $this->session->set_userdata($user_data); 
                # GET USER INFORMATION
                $get_user_info = $this->user_info($data);
                $data_user_info = array(
                        'fullname' => $get_user_info['user_info']['full_name'],
                );  
                $this->session->set_userdata($data_user_info); 
        }

        /**
        * Get user information
        * 
        * @param array $data 
        * @return array $data
        * @author Mydel-Ar A. Asturiano
        */
        public function user_info($data){

                ### ALERT COLOR CLASS
                $alert_danger = "alert alert-danger fade in";
                $alert_success = "alert alert-success";
                $alert_info = "alert alert-info";
                $error_line_no = " line " . __LINE__;

                $user_data = array(
                        'username' => $this->session->userdata('username'),
                        'password' => $this->session->userdata('password'),
                );
                $table = "tbl_users";
                $return = $this->account_model->get_user_info($table, $user_data, $return_data);
                if($return != 0){
                        $alert_class = $alert_danger;
                        $alert_message = $this->message('retrieve_failed') . $error_line_no;
                        return 400;
                }
                else{
                        $data['user_info'] = array(
                                'full_name' => $return_data->full_name,
                        );
                }
                return $data;
        }

        /**
        * Session destroying
        * and redirect to login page
        * 
        * @author Mydel-Ar A. Asturiano
        */
        public function logout(){
                $this->session->sess_destroy(); 
                redirect('account_controller/login','refresh'); 
        }

        public function change_language(){
                ### SET SESSION LANGUAGE
                $user_language = array(
                        'language' => $this->input->post('text_language'),
                );  
                $this->session->set_userdata($user_language);
                ### LOAD LANGUAGE
                if($this->input->post('text_language')){
                        $this->lang->load($this->input->post('text_language'),$this->input->post('text_language'));
                        redirect($_SERVER['HTTP_REFERER']);
                }
                else{
                        $this->lang->load('english','english');
                        redirect($_SERVER['HTTP_REFERER']);
                }
        }
}