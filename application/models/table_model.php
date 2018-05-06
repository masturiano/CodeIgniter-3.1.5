<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Table_Model extends CI_Model {

        /**
        * Create table tbl_sessions
        * Run manually
        * 
        * @author Mydel-Ar A. Asturiano
        */
        /*
                CREATE TABLE IF NOT EXISTS ci_sessions (
                        id varchar(40) NOT NULL,
                        ip_address varchar(45) NOT NULL,
                        timestamp int(10) unsigned NOT NULL DEFAULT '0',
                        data blob NOT NULL,
                        PRIMARY KEY (id),
                        KEY ci_sessions_timestap (timestamp)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1
        */

        /**
        * Create table tbl_users
        * 
        * @author Mydel-Ar A. Asturiano
        */
        function create_tbl_users(&$table){
                $query = "
                        CREATE TABLE IF NOT EXISTS $table (
                                user_id int(11) NOT NULL AUTO_INCREMENT,
                                group_code int(11) DEFAULT NULL,
                                full_name varchar(100) DEFAULT NULL,
                                user_name varchar(50) DEFAULT NULL,
                                user_pass varchar(50) DEFAULT NULL,
                                user_stat char(1) DEFAULT NULL,
                                date_enter datetime DEFAULT NULL,
                                date_update datetime DEFAULT NULL,
                                ip_address varchar(13) DEFAULT NULL,
                                log int(1) DEFAULT NULL,
                                PRIMARY KEY (user_id)
                        ) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1  
                ";
                $query = $this->db->query($query); # EXECUTE QUERY
                $query = "
                        SHOW tables LIKE '{$table}';
                ";
                $query = $this->db->query($query); # EXECUTE QUERY
                if($query->num_rows() == 0){
                        return 400;
                }
                return 0;
        }

        /**
        * Create table tbl_user_group
        * 
        * @author Mydel-Ar A. Asturiano
        */
        function create_tbl_user_group(&$table){
                $query = "
                        CREATE TABLE IF NOT EXISTS $table (
                                group_code int(11) NOT NULL,
                                group_name varchar(100) DEFAULT NULL,
                                PRIMARY KEY (group_code)
                        ) ENGINE=InnoDB DEFAULT CHARSET=latin1
                ";
                $query = $this->db->query($query); # EXECUTE QUERY
                $query = "
                        SHOW tables LIKE '{$table}';
                ";
                $query = $this->db->query($query); # EXECUTE QUERY
                if($query->num_rows() == 0){
                        return 400;
                }
                return 0;
        }
}
