<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_Model extends CI_Model {

        /**
        * Add data to table person
        * 
        * @param string $table 
        * @param string $table 
        * @return integer
        * @author Mydel-Ar A. Asturiano
        */
        function add_person($table, $data){
                $this->db->trans_begin();
                $this->db->insert($table, $data);
                if($this->db->affected_rows() == 0){
                        $this->db->trans_rollback();
                        return 400;
                }
                else{
                        $this->db->trans_commit();
                }
                return 0;
        }

        /**
        * Get user and pass
        * 
        * @param string $table 
        * @param string $table 
        * @return integer
        * @author Mydel-Ar A. Asturiano
        */
        function check_user($table, $account){

                $user_name = $account['text_username'];
                $pass_word = base64_encode($account['text_password']);

                $query = "
                        SELECT 
                                * 
                        FROM 
                                {$table}
                        WHERE
                                user_name = '{$user_name}' AND
                                user_pass = '{$pass_word}'    
                ";
                $query = $this->db->query($query); # EXECUTE QUERY
                if($query->num_rows() == 0){
                        return true;
                }
                return false;
        }

        /**
        * Get user and pass
        * 
        * @param string $table 
        * @param string $table 
        * @return integer
        * @author Mydel-Ar A. Asturiano
        */
        function get_user_info($table, $user_data, &$return_data){

                $user_name = $user_data['username'];
                $pass_word = base64_encode($user_data['password']);
                
                $query = "
                    SELECT 
                        a.user_id,
                        a.group_code,
                        a.full_name,
                        a.user_name,
                        a.user_stat,
                        a.date_enter,
                        a.date_update,
                        a.ip_address,
                        a.log,
                        b.group_name 
                    FROM 
                        {$table} a
                    LEFT OUTER JOIN
                        tbl_user_group b ON a.group_code = b.group_code
                    WHERE
                        user_name = '{$user_name}'
                        AND a.user_pass = '{$pass_word}'  
                        AND a.user_stat = 'A' 
                ";
                $query = $this->db->query($query);
                $return_data = $query->row();;
                if($query->num_rows() == 0){
                        return 400;
                }
                return 0;
        }
}
