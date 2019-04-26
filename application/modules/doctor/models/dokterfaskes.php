<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Dokter
 *  Model				: DokterFaskesModel
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DokterFaskesModel extends CI_Model{
	private $dbmaster;
	private $tbl = 'kaio_dokter_faskes';

	public function __construct()
	{
		parent::__construct();
		
		// load second db
		$this->dbmaster = $this->load->database('dbmaster', TRUE);	
	}
	
	public  function getlist($start,$finish,$filter){ 
		$this->db->select('a.*,b.nama_dokter,c.nama_faskes,d.nama_poli');
		$this->db->from($this->tbl.' As a');		
		$this->db->join('kaio_dokter AS b','b.id=a.dokter_id');
		$this->db->join('kaio_faskes AS c','c.faskes_id=a.faskes_id');
		$this->db->join('kaio_poli AS d','d.faskes_id=a.faskes_id');
		$this->db->order_by('b.nama_dokter','asc');
		
		if(!empty($filter)){
			if(isset($filter['faskes_id']) AND $filter['faskes_id'] > 0){
				$this->db->where('a.faskes_id',$filter['faskes_id']);
			}
			if(isset($filter['dokter_id']) AND $filter['dokter_id'] > 0){
				$this->db->where('a.dokter_id',$filter['dokter_id']);
			}				
		}
						
		return $this->db->get()->result();
	}
	
	public function jmlhdata($filter){
		$this->db->join('kaio_dokter AS b','b.id=a.dokter_id');
		$this->db->join('kaio_faskes AS c','c.faskes_id=a.faskes_id');
		$this->db->join('kaio_poli AS d','d.faskes_id=a.faskes_id');
		
		return $this->db->count_all_results($this->tbl.' AS a');
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
