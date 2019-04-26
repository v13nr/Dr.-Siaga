<?php  

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *	Copyright (C) Kaio Piranti Lunak
 *	Developer: Fatah Iskandar Akbar
 *  Email : info@kaiogroup.com
 *	Date: Juni 2012
**/

class Acl {
	var $CI;
	
	public function __construct(){
      // Copy an instance of CI so we can use the entire framework.
      $this->CI =& get_instance();
	  $this->CI->load->model('auth/AclModel'); 
	}
	
	/*
	*	Jika memiliki akses ke dalam controller & metode return true
	*/
	function cek_acl($c,$m,$user_id){
		if($this->CI->AclModel->cek_acl($c,$m,$user_id)){
			return true;
		} else {
			return false;
		}
	}
	
	function get_group_id($user_id){
		return $this->CI->AclModel->get_group_id($user_id);
	}
	
	function get_mygroup_id($group_name){
		return $this->CI->AclModel->get_mygroup_id($group_name);
	}
	
	function buat_akses_level($user_id,$groups){
		return $this->CI->AclModel->buat_akses_level($user_id,$groups);
	}
	
	function hapus_akses_level($user_id){
		return $this->CI->AclModel->hapus_akses_level($user_id);
	}
	
	/* apakah user id di block ? */
	function is_block($user_id){
		return $this->CI->AclModel->is_block($user_id);
	}
	
	/* apakah user telah active ? */
	function is_active($username,$password){
		return $this->CI->AclModel->is_active($username,$password);
	}	
	
	function update_login($user_id,$data){
		return $this->CI->AclModel->update_login($user_id,$data);
	}
}

/* End of file friend.php */
/* Location: ./application/views/friend.php */