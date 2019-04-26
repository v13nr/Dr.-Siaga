<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: User for cloud
 *  Model 				: UserGroupModel
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserGroupModel extends CI_Model{

	private $tbl = 'kaio_user_group';

	public function _construct()
	{
		parent::_construct();
	}
	
	public  function getlist($start,$finish,$filter){ 
		$this->db->select('a.*,b.name,b.email');
		$this->db->from($this->tbl.' AS a');	
		$this->db->join('kaio_users AS b','b.user_id=a.user_id');
		
		if(!empty($filter)){
			if(count($filter['group_id']) > 0){
				for($i=0; $i < count($filter['group_id']); $i++){
					if($i==0){
						$this->db->where('group_id',$filter['group_id'][$i]);
					} else {
						$this->db->or_where('group_id',$filter['group_id'][$i]);
					}
				}
			}
		}
		
		if($start > 0 OR $finish > 0){
			$this->db->limit($start,$finish);
		}
		
		return $this->db->get()->result();
	}
	
	public function jmlhdata($group_id){	
		if($group_id > 0){
			$this->db->where('group_id',$group_id);
		}
		
		return $this->db->count_all_results($this->tbl);
	}
	
	public function hapus($id=0){
		$this->db->where_in('user_id',$id);
		$this->db->delete($this->tbl);
		return true;
	}
	
	public function insert($post) {
		return $this->db->insert($this->tbl,$post);
	}
	
	public function saveData($data){ 
		for($i=0; $i < count($data['group_id']); $i++){
			$post['user_id'] 	= $data['user_id'];
			$post['group_id'] 	= $data['group_id'][$i];
			
			if(!$this->db->insert($this->tbl,$post)){ 
				//Do your error handling here  
				return $this->db->_error_number();
			}			
			
		}
	}
	
	/* return true jika super admin */
	public function is_superadmin($user_id){
		$this->db->select('*');
		$this->db->from($this->tbl);	
		$this->db->where('user_id',$user_id);
		$this->db->where('group_id','11890083');
		
		$res = $this->db->get()->result_array();	

		if(count($res) > 0){
			return 	true;
		} else {
			return 	false;
		}
	}
	
	/* return true jika admin */
	public function is_admin($user_id){
		$this->db->select('*');
		$this->db->from($this->tbl);	
		$this->db->where('user_id',$user_id);
		$this->db->where('group_id','11890091');
		
		$res = $this->db->get()->result_array();	

		if(count($res) > 0){
			return 	true;
		} else {
			return 	false;
		}
	}
	
	/* return true jika patient */
	public function is_patient($user_id){
		$this->db->select('*');
		$this->db->from($this->tbl);	
		$this->db->where('user_id',$user_id);
		$this->db->where('group_id','11890085');
		
		$res = $this->db->get()->result_array();	
		
		if(count($res) > 0){
			return 	true;
		} else {
			return 	false;
		}	
	}
	
	/* return true jika bidan */
	public function is_midwife($user_id){
		$this->db->select('*');
		$this->db->from($this->tbl);	
		$this->db->where('user_id',$user_id);
		$this->db->where('group_id','11890098');
		
		$res = $this->db->get()->result_array();	
		
		if(count($res) > 0){
			return 	true;
		} else {
			return 	false;
		}	
	}
	
	/* return true jika perawat */
	public function is_nurse($user_id){
		$this->db->select('*');
		$this->db->from($this->tbl);	
		$this->db->where('user_id',$user_id);
		$this->db->where('group_id','11890094');
		
		$res = $this->db->get()->result_array();	
		
		if(count($res) > 0){
			return 	true;
		} else {
			return 	false;
		}	
	}
	
	/* return true jika apoteker */
	public function is_apoteker($user_id){
		$this->db->select('*');
		$this->db->from($this->tbl);	
		$this->db->where('user_id',$user_id);
		$this->db->where('group_id','11890097');
		
		$res = $this->db->get()->result_array();	
		
		if(count($res) > 0){
			return 	true;
		} else {
			return 	false;
		}	
	}
	
	/* return true jika doctor */
	public function is_doctor($user_id){
		$this->db->select('*');
		$this->db->from($this->tbl);	
		$this->db->where('user_id',$user_id);
		
		$res = $this->db->get()->result_array();	
		
		if(count($res) > 0 AND $res[0]['group_id']=='11890093'){
			return 	true;
		} else {
			return 	false;
		}		
	}
}

?>
