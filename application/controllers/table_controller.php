<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('TITLE','TABLE');

class Table_Controller extends CI_Controller {

        function __construct() {
                parent::__construct();

                # LIBRARY
                $this->load->library('form_validation');
                $this->load->library('pagination'); 
                $this->load->library('table');

                # HELPER
                $this->load->helper('url');
                $this->load->helper('path');  
                $this->load->helper('form');  

                ### MODEL
                $this->load->model('table_model');        
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
                        'create_failed' => 'Create table failed',
                        'create_success' => 'Create table success',
                );
                return $message[$key];
        }

        /**
        * Index
        * Redirect to main page
        * 
        * @author Mydel-Ar A. Asturiano
        */
        public function index(){
                # MAIN
                
                $table = "tbl_users";
                $return = $this->table_model->create_tbl_users($table);
                if($return != 0){
                        $alert_message = $this->message('create_failed') ." ". $table;
                        echo $alert_message;
                        echo "<br>";
                }
                else{
                        $alert_message = $this->message('create_success') ." ". $table;
                        echo $alert_message;
                        echo "<br>";
                }

                $table = "tbl_user_group";
                $return = $this->table_model->create_tbl_user_group($table);
                if($return != 0){
                        $alert_message = $this->message('create_failed') ." ". $table;
                        echo $alert_message;
                        echo "<br>";
                }
                else{
                        $alert_message = $this->message('create_success') ." ". $table;
                        echo $alert_message;
                        echo "<br>";
                }
        }
}