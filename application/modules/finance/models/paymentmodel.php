<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Finance
 *  Model				: PaymentModel
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PaymentModel extends CI_Model{

	private $tbl = 'kaio_payment';

	public function __construct()
	{
		parent::__construct();
	}
	
	public  function getlist($start,$finish,$filter){ 
		$this->db->select('a.*,b.nama_customer,c.nmr_inv');
		$this->db->from($this->tbl.' As a');		
		$this->db->join('kaio_customer AS b','b.id=a.customer_id');
		$this->db->join('kaio_invoice AS c','c.inv_id=a.inv_id');
		$this->db->order_by('b.nama_customer','asc');
		
		if(!empty($filter)){
			if(isset($filter['nmr_inv']) AND !empty($filter['nmr_inv'])){
				$this->db->where('a.nmr_inv',$filter['nmr_inv']);
			}
			if(isset($filter['customer_id']) AND $filter['customer_id'] > 0){
				$this->db->where('a.customer_id',$filter['customer_id']);
			}
			if(isset($filter['due_date'])){
				$this->db->where('a.due_date',$filter['due_date']);
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
