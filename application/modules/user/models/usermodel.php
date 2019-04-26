<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: User
 *  Model				: UserModel
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model{

	private $tbl = 'kaio_users';

	public function _construct()
	{
		parent::_construct();
	}
	
	public  function getlist($start,$finish,$filter){ 
		$this->db->select('a.*,b.group_id,c.group_name');
		$this->db->from($this->tbl.' AS a');	
		$this->db->join('kaio_user_group AS b','b.user_id=a.user_id');
		$this->db->join('kaio_groups AS c','c.group_id=b.group_id');
		$this->db->order_by('a.tgl_register','desc');
		
		if(!empty($filter)){
			if(isset($filter['user_id']) AND $filter['user_id'] > 0){
				$this->dbmaster->where('a.user_id',$filter['user_id']);
			}
			if(isset($filter['email']) AND !empty($filter['email']) ){
				$this->dbmaster->where('a.email',$filter['email']);
			}
			if(isset($filter['block']) AND !empty($filter['block']) ){
				$this->dbmaster->where('a.block',$filter['block']);
			}			
			if(isset($filter['status']) AND  !empty($filter['status'])){
				$this->dbmaster->where('status',$filter['status']);
			}					
		}
		
		if($start > 0 OR $finish > 0){
			$this->db->limit($start,$finish);
		}
		
		return $this->db->get()->result();
	}
	
	public function jmlhdata($filter){
		
		if(!empty($filter)){
			if(isset($filter['mode']) AND $filter['mode']=='hari'){
				if( isset($filter['sstart']) OR isset($filter['sfinish']) ){
					$this->db->where('tgl_register >=',$filter['sstart']);
					$this->db->where('tgl_register <=',$filter['sfinish']);
				}
			} else if(isset($filter['mode']) AND $filter['mode']=='bulan'){
				$this->db->where('MONTH(tgl_register)='.$filter['bln'].' AND YEAR(tgl_register)='.$filter['thn']);
			} else if(isset($filter['mode']) AND $filter['mode']=='growth'){
				$this->db->where('MONTH(tgl_register)',$filter['tgl']);
				$this->db->where('YEAR(tgl_register)',$filter['thn']);
			} else if(isset($filter['mode']) AND $filter['mode']=='gender'){
				$this->db->where('sex',$filter['gender']);
			}
		}
	
		return $this->db->count_all_results($this->tbl);
	}
	
	public function hapus($id=0){
		$this->db->where_in('user_id',$id);
		$this->db->delete($this->tbl);
		return true;
	}
	
	public function get_by_id($id){ 
		$this->db->select('a.*,b.group_id');
		$this->db->join('kaio_user_group AS b','b.user_id=a.user_id');
		$this->db->where('a.user_id', $id);
		
		return $this->db->get($this->tbl.' AS a')->result_array();
	}
	
	public function saveData($data){ 
		if(empty($data['user_id'])){
  
			if(!$this->db->insert($this->tbl,$data)){  
				//Do your error handling here  
				//return $this->db->_error_message();
				return $this->db->_error_number();
			} 
		} else {
			$this->db->where('user_id',$data['user_id']);
			if(!$this->db->update($this->tbl,$data)){  
				//Do your error handling here  
				//return $this->db->_error_message();
				return $this->db->_error_number();
			}
		}
	}
	
	function get_user_id($email){
		$this->db->select('user_id');
		$this->db->where('email', $email);
		
		return $this->db->get($this->tbl)->result_array();	
	}
	
	/* get user id dgn fb id */
	function get_user_id_with_fb_id($fb_id){
		$this->db->select('user_id');
		$this->db->where('fb_id', $fb_id);
		
		return $this->db->get($this->tbl)->result_array();	
	}
	
	/* get user id dgn mobile phone */
	function get_user_id_with_phone($hp){
		$this->db->select('user_id');
		$this->db->where('hp', $hp);
		
		return $this->db->get($this->tbl)->result_array();	
	}

	public function get_by_vercode($vercode){ 
		$this->db->select('*');
		$this->db->where('vcode', $vercode);
		
		return $this->db->get($this->tbl)->result_array();
	}
	
	public function max_timeline(){
		$this->db->select_max('user_id');
		$result = $this->db->get($this->tbl)->row();	
		return $result->user_id;
	}
	
	public function whos_login($tgls,$tglf){
		$this->db->select('*');
		$this->db->where('last_login >=', $tgls);
		$this->db->where('last_login <=', $tglf);
		$this->db->order_by('last_login','desc');
		
		return $this->db->get($this->tbl)->result_array();		
		
	}
	
	public function search($search){
		$this->db->select('a.*');
		$this->db->like('a.email', $search); 

		return $this->db->get($this->tbl.' AS a')->result_array();		
		
	}
}

?>
