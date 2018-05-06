<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Custom_Validation {

        /**
        * Email format
        * 
        * @param string $string 
        * @return integer
        * @author Mydel-Ar A. Asturiano
        */
        public function is_email($string){
                if (!filter_var($string, FILTER_VALIDATE_EMAIL)) {
                    return 400;
                }
                return 0; 
        }
}