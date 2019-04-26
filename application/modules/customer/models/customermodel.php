<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Customer
 *  Model				: CustomerModel 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CustomerModel extends CI_Model{

	private $tbl = 'kaio_customer';

	public function _construct()
	{
		parent::_construct();
	}
	
	public  function getlist($start,$finish,$search){ 
		$this->db->select('*');
		$this->db->from($this->tbl);		
		$this->db->order_by('nama_customer','asc');
		
		if(!empty($search)){
			if(isset($search['id']) AND $search['id'] > 0){
				$this->db->where('id',$search['id']);
			}		
			if(isset($search['search'])){
				$this->db->like('kota', $search['search'], 'both'); 
			}			
		}
		
		if($start > 0 OR $finish > 0){
			$this->db->limit($start,$finish);
		}
		
		return $this->db->get()->result();
	}
	
	public function jmlhdata($search){
		if(!empty($search)){
			if(isset($search['id']) AND $search['id'] > 0){
				$this->db->where('id',$search['id']);
			}		
			if(isset($search['search'])){
				$this->db->like('kota', $search['search'], 'both'); 
			}			
		}
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
	
	public function customer_id_max(){
		$this->db->select_max('id');
		$result = $this->db->get($this->tbl)->row();	
		return $result->id;
	}
	
}

?>
