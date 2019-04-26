<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Messanger
 *  Model				: BotContentModel
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BotContentModel extends CI_Model{
	private $tbl = 'kaio_bot_content';

	public function __construct()
	{
		parent::__construct();	
	}
	
	public  function getlist($start,$finish,$search){ 
		$this->db->select('a.*,b.nama_bot,c.block_name,e.nama_customer');
		$this->db->from($this->tbl.' AS a');	
		$this->db->join('kaio_bot AS b','b.bot_id=a.bot_id');
		$this->db->join('kaio_bot_block AS c','c.block_id=a.block_id');
		$this->db->join('kaio_bot_group AS d','d.botgroup_id=a.botgroup_id');
		$this->db->join('kaio_customer AS e','e.id=a.customer_id');
		$this->db->order_by('e.nama_customer','asc');
		$this->db->group_by('a.block_id');
		
		if(!empty($search)){
			if(isset($search['bot_id']) AND $search['bot_id'] > 0){
				$this->db->where('a.bot_id',$search['bot_id']);
			}	
			if(isset($search['block_id']) AND $search['block_id'] > 0){
				$this->db->where('a.block_id',$search['block_id']);
			}		
			if(isset($search['botgroup_id']) AND $search['botgroup_id'] > 0){
				$this->db->where('a.botgroup_id',$search['botgroup_id']);
			}				
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
