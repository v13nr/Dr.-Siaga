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
		$this->dbmaster->select('a.*,b.nama_dokter,c.nama_faskes,d.nama_poli');
		$this->dbmaster->from($this->tbl.' As a');		
		$this->dbmaster->join('kaio_dokter7 AS b','b.id=a.dokter_id');
		$this->dbmaster->join('kaio_faskes AS c','c.faskes_id=a.faskes_id');
		$this->dbmaster->join('kaio_poli AS d','d.faskes_id=a.faskes_id');
		$this->dbmaster->order_by('b.nama_dokter','asc');
		
		if(!empty($filter)){
			if(isset($filter['faskes_id']) AND $filter['faskes_id'] > 0){
				$this->dbmaster->where('a.faskes_id',$filter['faskes_id']);
			}
			if(isset($filter['dokter_id']) AND $filter['dokter_id'] > 0){
				$this->dbmaster->where('a.dokter_id',$filter['dokter_id']);
			}				
		}
						
		return $this->dbmaster->get()->result();
	}
	
	public function jmlhdata($filter){
		$this->dbmaster->join('kaio_dokter AS b','b.id=a.dokter_id');
		$this->dbmaster->join('kaio_faskes AS c','c.faskes_id=a.faskes_id');
		$this->dbmaster->join('kaio_poli AS d','d.faskes_id=a.faskes_id');
		
		return $this->dbmaster->count_all_results($this->tbl.' AS a');
	}
	
	public function hapus($id=0){
		$this->dbmaster->where_in('id',$id);
		$this->dbmaster->delete($this->tbl);
		return true;
	}
	
	public function get_by_id($id){ 
		$this->dbmaster->select('*');
		$this->dbmaster->where('id', $id);
		return $this->dbmaster->get($this->tbl)->result_array();
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
	
}

?>
