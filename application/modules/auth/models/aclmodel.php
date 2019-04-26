<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Auth for cloud
 *  Model 				: Acl Model
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AclModel extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	function get_group_id($user_id){
		$this->db->select('group_id');
		$this->db->from('user_has_groups');
		$this->db->where('user_id', $user_id);
		return $this->db->get('users')->result_array();		
	}
	
	function cek_acl($c,$m,$user_id){
		$this->db->select('b.rule_class AS controller,b.rule_method AS method,a.*');
		$this->db->join('kaio_rules AS b','b.rule_id=a.rule_id');
		$this->db->where('b.rule_class', $c);
		$this->db->where('b.rule_method', $m);
		$this->db->where('a.user_id', $user_id);
		return $this->db->get('kaio_akses_level AS a')->result_array();		
	}
	
	/*
	*	Jika berhasil membuat akses level return true
	*	Jika gagal di karenakan rule group belum di definisikan
	* 	return false
	*/
	function buat_akses_level($user_id,$groups){
		for($x=0; $x < count($groups); $x++){
			$my = $this->get_list_role_rules($groups[$x]);
			
			if(!empty($my)){
				for($i=0; $i < count($my); $i++){
					$data[$i]['user_id'] = $user_id;
					$data[$i]['rule_id'] = $my[$i]['rule_id'];
					
					$this->db->insert('kaio_akses_level', $data[$i]);
				}
				return true;
			} else {
				return false;
			}
		}
	}
	
	function hapus_akses_level($user_id)
	{
		$this->db->where_in('user_id',$user_id);
		$this->db->delete('kaio_akses_level');
		return true;
	}
	
	function get_mygroup_id($group_name){
		$this->db->select('group_id');
		$this->db->where('group_name', $group_name);
		return $this->db->get('kaio_groups')->result_array();		
	}
	
	/* 
	*  get rule group 
	*  return array jika rule group telah di definisikan
	*  return null/false jika blm di definisikan
	*/
	function get_list_role_rules($group_id){
		$this->db->select('*');
		$this->db->where('group_id', $group_id);
		return $this->db->get('kaio_role_rules')->result_array();		
	}
	
	/* return true jika user di blok */
	function is_block($user_id){
		$this->db->select('block');
		$this->db->where('user_id', $user_id);
		$res = $this->db->get('kaio_users')->result_array();		
		if($res[0]['block']=='Y'){
			return true;
		} else {
			return false;
		}
	}
	
	/* return true jika user active */
	function is_active($email,$password){
		$this->db->select('status');
		$this->db->where('email', $email);
		$this->db->where('password', md5($password));
		$res = $this->db->get('kaio_users')->result_array();		

		if($res[0]['status']==1){
			return true;
		} else {
			return false;
		}
	}	
	
	function update_login($user_id,$data){
		$this->db->set('last_login', $data['last_login']);
		//$this->db->set('jmlh', '`jmlh`+1',FALSE);
		$this->db->where('user_id', $user_id);
		$this->db->update('kaio_users');
	}
}

?>
