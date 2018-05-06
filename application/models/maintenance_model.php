<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Maintenance_Model extends CI_Model {

        /**
        * Get user and pass
        * 
        * @param string $table 
        * @param string $table 
        * @return integer
        * @author Mydel-Ar A. Asturiano
        */
        function get_tbl_users($table){
                
                $query = "
                    SELECT 
                        a.user_id,
                        a.group_code,
                        a.full_name,
                        a.user_name,
                        a.user_pass,
                        a.user_stat,
                        a.date_enter,
                        a.date_update,
                        a.ip_address,
                        a.log,
                        b.group_name 
                    FROM 
                        {$table['a']} a
                    LEFT OUTER JOIN
                        {$table['b']} b ON a.group_code = b.group_code
                    WHERE
                        user_stat = 'A' 
                ";
                $query = $this->db->query($query);
                return $query->result();
        }
}
