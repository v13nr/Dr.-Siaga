<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Customer
 *  Model				: CustomerUserModel
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CustomerFaskesModel extends CI_Model{

	private $tbl = 'kaio_customer_faskes';

	public function __construct()
	{
		parent::__construct();
	}
	
	public  function getlist($start,$finish,$filter){ 
		$this->db->select('a.*,b.nama_customer,c.nama_faskes,c.tlp,c.email,c.tipe');
		$this->db->from($this->tbl.' As a');		
		$this->db->join('kaio_customer AS b','b.id=a.customer_id');
		$this->db->join('dbmaster.kaio_faskes AS c','c.faskes_id=a.faskes_id');
		$this->db->order_by('b.nama_customer','asc');
		
		if(!empty($filter)){
			if(isset($filter['faskes_id']) AND $filter['faskes_id'] > 0){
				$this->db->where('a.faskes_id',$filter['faskes_id']);
			}
			if(isset($filter['customer_id']) AND $filter['customer_id'] >= 0){
				$this->db->where('a.customer_id',$filter['customer_id']);
			}		
			if( isset($filter['status']) ){
				$this->db->where('a.status',$filter['status']);
			}			
		}
						
		return $this->db->get()->result();
	}
	
	public function jmlhdata(){
		return $this->db->count_all_results($this->tbl);
	}
	
	public function hapus($id=0){
		$this->db->where_in('faskes_id',$id);
		$this->db->delete($this->tbl);
		return true;
	}
		
	public function saveData($data,$mode)
	{
		if($mode=='new'){
			if(!$this->db->insert($this->tbl,$data)){  
				//Do your error handling here  
				//return $this->db->_error_number();
				return $this->db->_error_message();
			} 
		} else if($mode=='edit') {
			$this->db->where('faskes_id',$data['faskes_id']);
			if(!$this->db->update($this->tbl,$data)){  
				//Do your error handling here  
				return $this->db->_error_number();
			}
		} 
	}
	

	
}

?>
