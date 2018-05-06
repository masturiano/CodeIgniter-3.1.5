<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Language_Hooks {

        function initialize() {

                $ci =& get_instance();

                $ci->load->helper('language');

                $siteLang = $ci->session->userdata('language');

                if ($siteLang != "english") {

                        $ci->lang->load($siteLang,$siteLang);

                } 
                else {

                        $ci->lang->load('english','english');

                }

        }

}