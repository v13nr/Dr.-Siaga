<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Paket
 *  Model				: PaketRulesModel
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PaketRulesModel extends CI_Model{

	private $tbl = 'kaio_paket_rules';

	public function _construct()
	{
		parent::_construct();
	}
	
	public  function getlist($start,$finish,$filter){ 
		$this->db->select('*');
		$this->db->from($this->tbl.' AS a');		
		$this->db->join('kaio_paket AS b','b.paket_id=a.paket_id');
		$this->db->join('kaio_rules AS c','c.rule_id=a.rule_id');
		$this->db->order_by('b.nama_paket','asc');
		
		if(!empty($filter)){
			if(isset($filter['paket_id']) AND $filter['paket_id'] > 0){
				$this->db->where('a.paket_id',$filter['paket_id']);
			}
			if(isset($filter['rule_id']) AND $filter['rule_id'] > 0){
				$this->db->where('a.rule_id',$filter['rule_id']);
			}				
		}
						
		return $this->db->get()->result_array();
	}
	
	public function jmlhdata($filter){
		if(!empty($filter)){
			if(isset($filter['paket_id']) AND $filter['paket_id'] > 0){
				$this->db->where('a.paket_id',$filter['paket_id']);
			}
			if(isset($filter['rule_id']) AND $filter['rule_id'] > 0){
				$this->db->where('a.rule_id',$filter['rule_id']);
			}				
		}
		
		return $this->db->count_all_results($this->tbl);
	}
	
	public function hapus($id=0){
		$this->db->where_in('id',$id);
		$this->db->delete($this->tbl);
		return true;
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
