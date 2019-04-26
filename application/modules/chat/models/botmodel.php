<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Chat
 *  Model				: BotModel
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BotModel extends CI_Model{
	private $dbmaster;
	private $tbl = 'kaio_bot';

	public function __construct()
	{
		parent::__construct();
		
		// load second db
		$this->dbmaster = $this->load->database('dbmaster', TRUE);	
	}
	
	public  function getlist($start,$finish,$search){ 
		$this->dbmaster->select('a.*,f.nama_faskes');
		$this->dbmaster->from($this->tbl.' AS a');	
		$this->dbmaster->order_by('a.nama_poli','asc');
		
		if(!empty($search)){
			if(isset($search['faskes_id']) AND $search['faskes_id'] > 0){
				$this->dbmaster->where('a.faskes_id',$search['faskes_id']);
			}		
		}
		
		if($start > 0 OR $finish > 0){
			$this->dbmaster->limit($start,$finish);
		}
		
		return $this->dbmaster->get()->result();
	}
	
	public function jmlhdata($search){
		$this->dbmaster->join('kaio_faskes AS f','f.faskes_id=a.faskes_id');		
		
		if(!empty($search)){
			if(isset($search['faskes_id']) AND $search['faskes_id'] > 0){
				$this->dbmaster->where('a.faskes_id',$search['faskes_id']);
			}		
		}
		return $this->dbmaster->count_all_results($this->tbl.' as a');
	}
	
	public function hapus($id=0){
		$this->dbmaster->where_in('id',$id);
		$this->dbmaster->delete($this->tbl);
		return true;
	}
	
	public function get_by_id($id){ 
		$this->dbmaster->select('a.*,f.nama');
		$this->dbmaster->join('kaio_faskes AS f','f.id=a.faskes_id','left');
		$this->dbmaster->where('a.id', $id);
		return $this->dbmaster->get($this->tbl.' AS a')->result_array();
	}
	
	public function saveData($data)
	{
		if(empty($data['id'])){
			if(!$this->dbmaster->insert($this->tbl,$data)){  
				//Do your error handling here  
				//return $this->dbmaster->_error_number();
				return $this->dbmaster->_error_message();
			} 
		} else {
			$this->dbmaster->where('id',$data['id']);
			if(!$this->dbmaster->update($this->tbl,$data)){  
				//Do your error handling here  
				return $this->dbmaster->_error_number();
			}
		} 
	}
		
	public function search($search){
		$this->dbmaster->select('a.*');
		$this->dbmaster->like('a.nama', $search); 

		return $this->dbmaster->get($this->tbl.' AS a')->result_array();		
		
	}
		
}

?>
