<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Facebook
 *  Model				: FbPageCustomerModel 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FbPageCustomerModel extends CI_Model{

	private $tbl = 'kaio_fb_page_customer';

	public function _construct()
	{
		parent::_construct();
	}
	
	public  function getlist($start,$finish,$search){ 
		$this->db->select('a.*,b.nama_page,b.page_id,b.token,c.nama_customer');
		$this->db->from($this->tbl.' AS a');		
		$this->db->join('kaio_fb_page AS b','b.fb_page_id=a.fb_page_id');
		$this->db->join('kaio_customer AS c','c.id=a.customer_id');
		$this->db->order_by('c.nama_customer','asc');
		
		if(!empty($search)){
			if(isset($search['fb_page_id']) AND $search['fb_page_id'] > 0){
				$this->db->where('a.fb_page_id',$search['fb_page_id']);
			}		
			if(isset($search['customer_id']) AND $search['customer_id'] > 0){
				$this->db->where('a.customer_id', $search['customer_id']); 
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
