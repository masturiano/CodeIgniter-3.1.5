<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Custom_Sanitization {

        /**
        * Remove multiple spaces replace to single space
        * 
        * @param string $string 
        * @return string
        * @author Mydel-Ar A. Asturiano
        */
        public function is_multiple_space($string){
                $return = preg_replace('!\s+!', ' ', $string);
                return $return; 
        }

}