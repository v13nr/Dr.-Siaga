<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Chat
 *  Model				: CustomerBotModel
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CustomerBotModel extends CI_Model{
	private $tbl = 'kaio_customer_bot';

	public function __construct()
	{
		parent::__construct();	
	}
	
	public  function getlist($start,$finish,$search){ 
		$this->db->select('a.*,b.nama_bot,c.nama_customer');
		$this->db->from($this->tbl.' AS a');	
		$this->db->join('kaio_bot AS b','b.bot_id=a.bot_id');
		$this->db->join('kaio_customer AS c','c.id=a.customer_id');
		$this->db->order_by('c.nama_customer','asc');
		
		if(!empty($search)){
			if(isset($search['customer_id']) AND $search['customer_id'] > 0){
				$this->db->where('a.customer_id',$search['customer_id']);
			}		
		}
		
		if($start > 0 OR $finish > 0){
			$this->db->limit($start,$finish);
		}
		
		return $this->db->get()->result_array();
	}
	
	public function jmlhdata($search){		
		if(!empty($search)){
			if(isset($search['customer_id']) AND $search['customer_id'] > 0){
				$this->db->where('a.customer_id',$search['customer_id']);
			}		
		}
		return $this->db->count_all_results($this->tbl.' as a');
	}
	
	public function hapus($id=0){
		$this->db->where_in('id',$id);
		$this->db->delete($this->tbl);
		return true;
	}
	
	public function get_by_id($id){ 
		$this->db->select('a.*,f.nama');
		$this->db->join('kaio_faskes AS f','f.id=a.faskes_id','left');
		$this->db->where('a.id', $id);
		return $this->db->get($this->tbl.' AS a')->result_array();
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
		
	public function search($search){
		$this->db->select('a.*');
		$this->db->like('a.nama', $search); 

		return $this->db->get($this->tbl.' AS a')->result_array();		
		
	}
		
}

?>
