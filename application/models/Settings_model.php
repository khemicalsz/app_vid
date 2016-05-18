<?php
class Settings_model extends CI_Model{
	function __construct() {
		parent::__construct();
	}
	
	
	function getSettings()
	{
		$this->db->select('*');
		$this->db->from('settings');
		$rs = $this->db->get();
		return $rs->result();
	}

	public function checkAdmin($user_id){
        $query_str = "SELECT * FROM `aauth_user_to_group` WHERE `user_id` = '".$user_id."' and `group_id` = '1';";
                            
        $result = $this->db->query($query_str);
        return $result->result();
    }

    public function checkEmail($user_id, $email){
        $query_str = "SELECT * FROM `aauth_users` WHERE `id` != '".$user_id."' and `email` = '".$email."';";
                            
        $result = $this->db->query($query_str);
        return $result->result();
    }

    public function removeAdminRole($user_id){
                
        $query_str = "
            DELETE FROM `aauth_user_to_group` WHERE `user_id` = '".$user_id."' and `group_id` = '1'; 
        "; 
        
        if($this->db->query($query_str)){
            return true;
        } else{
            return false;
        }
        
    }

    public function addAdminRole($user_id){
        
        $query_str = "
            INSERT INTO `aauth_user_to_group` (
                `user_id`, 
                `group_id`) VALUES (

                '".$user_id."', 
                '1'); 
        "; 
        
        if($this->db->query($query_str)){
            return true;
        } else{
            return false;
        }
        
    }
} 