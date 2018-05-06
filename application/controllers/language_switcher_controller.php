<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('TITLE','LANGUAGE SWITCHER');

class Language_Switcher_Controller extends CI_Controller {
        function __construct() {

                parent::__construct();
        }

        function switchLang($language = "") {

                $language = ($language != "") ? $language : "english";

                $this->session->set_userdata('site_lang', $language);

                redirect($_SERVER['HTTP_REFERER']);
        }        
}