<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Paket
 *  Model				: CustomerPaketModel
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CustomerPaketModel extends CI_Model{

	private $tbl = 'kaio_customer_paket';

	public function __construct()
	{
		parent::__construct();
	}
	
	public  function getlist($start,$finish,$filter){ 
		$this->db->select('a.*,b.nama_customer,c.*');
		$this->db->from($this->tbl.' As a');		
		$this->db->join('kaio_customer AS b','b.id=a.customer_id');
		$this->db->join('kaio_paket AS c','c.paket_id=a.paket_id');
		$this->db->order_by('b.nama_customer','asc');
		
		if(!empty($filter)){
			if(isset($filter['paket_id']) AND $filter['paket_id'] > 0){
				$this->db->where('a.paket_id',$filter['paket_id']);
			}
			if(isset($filter['customer_id']) AND $filter['customer_id'] > 0){
				$this->db->where('a.customer_id',$filter['customer_id']);
			}
			if(isset($filter['tgl_mulai'])){
				$this->db->where('a.tgl_mulai',$filter['tgl_mulai']);
			}		
			if(isset($filter['tgl_expired'])){
				$this->db->where('a.tgl_expired',$filter['tgl_expired']);
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
