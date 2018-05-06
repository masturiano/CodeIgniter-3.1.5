<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('TITLE','HOME');

class Home_Controller extends CI_Controller {

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
                $this->load->helper('language');  
        }

	public function index(){
                # MAIN
		$this->home();   
	}
    
        public function home(){    
                # TITLE
                $data['title']  = TITLE; 

                # MODEL
                //$this->load->model('get_user'); 

                #FORM
                $data['price_option'] = array(
                        'select'        => 'Select',
                        'rel_price'     => 'Relative',
                        'fran_price'    => 'Franchise',
                );  
        
                # VIEW
                $this->load->view('home_view',$data);  
        }
}