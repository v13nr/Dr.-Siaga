<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: User
 *  Model				: CustomerUserModel
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CustomerUserModel extends CI_Model{

	private $tbl = 'kaio_customer_user';

	public function __construct()
	{
		parent::__construct();
	}
	
	public  function getlist($start,$finish,$filter){ 
		$this->db->select('a.*,b.nama_customer,c.name,e.desc');
		$this->db->from($this->tbl.' As a');		
		$this->db->join('kaio_customer AS b','b.id=a.customer_id');
		$this->db->join('kaio_users AS c','c.user_id=a.user_id');
		$this->db->join('kaio_user_group AS d','d.user_id=a.user_id');
		$this->db->join('kaio_groups AS e','e.group_id=d.group_id');
		$this->db->order_by('c.name','asc');
		
		if(!empty($filter)){
			if(isset($filter['user_id']) AND $filter['user_id'] > 0){
				$this->db->where('a.user_id',$filter['user_id']);
			}
			if(isset($filter['customer_id']) AND $filter['customer_id'] > 0){
				$this->db->where('a.customer_id',$filter['customer_id']);
			}				
		}
						
		return $this->db->get()->result();
	}
	
	public function jmlhdata(){
		return $this->db->count_all_results($this->tbl);
	}
	
	public function hapus($id=0){
		$this->db->where_in('id',$id);
		$this->db->delete($this->tbl);
		return true;
	}
	
	public function get_by_id($id){ 
		$this->db->select('*');
		$this->db->where('id', $id);
		return $this->db->get($this->tbl)->result_array();
	}
	
	public function saveData($data)
	{
		if(empty($data['id'])){
			if(!$this->db->insert($this->tbl,$data)){  
				//Do your error handling here  
				//return $this->db->_error_number();
				return $this->db->_error_message();
			} 
		} else {
			$this->db->where('id',$data['id']);
			if(!$this->db->update($this->tbl,$data)){  
				//Do your error handling here  
				return $this->db->_error_number();
			}
		} 
	}
	

	
}

?>
