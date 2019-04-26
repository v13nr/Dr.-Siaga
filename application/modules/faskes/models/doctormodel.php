<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Doctor
 *  Model				: DoctorModel
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DoctorModel extends CI_Model{
	private $dbmaster;
	private $tbl = 'kaio_dokter';

	public function __construct()
	{
		parent::__construct();
		
		// load second db
		$this->dbmaster = $this->load->database('dbmaster', TRUE);	
	}
	
	public  function getlist($start,$finish,$filter){ 
		$this->dbmaster->select('a.id,a.nama_dokter,a.gelar,a.gelar_depan,a.gelar_belakang,a.gender,a.status,b.title,b.description,b.alias');
		$this->dbmaster->from($this->tbl.' AS a');
		$this->dbmaster->join('kaio_spesialis AS b','b.id=a.spesialis_id');		
		$this->dbmaster->order_by('a.id','desc');
		
		if(!empty($filter)){
			if(isset($filter['spesialis_id']) AND $filter['spesialis_id'] > 0){
				$this->dbmaster->where('a.spesialis_id',$filter['spesialis_id']);
			}	
		}
		
		if($start > 0 OR $finish > 0){
			$this->dbmaster->limit($start,$finish);
		}
		
		return $this->dbmaster->get()->result_array();
	}
	
	public function jmlhdata($filter){
		if(!empty($filter)){
			if(isset($filter['spesialis_id']) AND $filter['spesialis_id'] > 0){
				$this->dbmaster->where('a.spesialis_id',$filter['spesialis_id']);
			}		
		}
		
		return $this->dbmaster->count_all_results($this->tbl);
	}
		
	public function hapus($id=0){
		$this->dbmaster->where_in('id',$id);
		$this->dbmaster->delete($this->tbl);
		return true;
	}
	
	public function get_by_id($id){ 
		$this->dbmaster->select('a.*,b.title,b.description,c.nama_kabkot,d.nama_prov');
		$this->dbmaster->from($this->tbl.' AS a');
		$this->dbmaster->join('kaio_spesialis AS b','b.id=a.spesialis_id');
		$this->dbmaster->join('kaio_kabkot AS c','c.id_kabkot=a.id_kabkot','left');
		$this->dbmaster->join('kaio_provinsi AS d','d.id_prov=c.id_prov','left');
		
		$this->dbmaster->where('a.id', $id);
		
		return $this->dbmaster->get()->result_array();
	}
		
	public function saveData($data)
	{
		$res = true;
		
		if(empty($data['id'])){
			if(!$this->dbmaster->insert($this->tbl,$data)){  
				//Do your error handling here  
				//return $this->dbmaster->_error_number();
				$res = $this->dbmaster->_error_message();
			} 
		} else {
			$this->dbmaster->where('id',$data['id']);
			if(!$this->dbmaster->update($this->tbl,$data)){  
				//Do your error handling here  
				$res = $this->dbmaster->_error_number();
			}
		} 
		
		return $res;
	}
	
	public function list_dokter($search){
		$this->dbmaster->select('a.*,b.id AS spesialis_id,b.title');
		$this->dbmaster->from($this->tbl.' AS a');
		$this->dbmaster->join('kaio_spesialis AS b','b.id=a.spesialis_id');
		$this->dbmaster->like('a.nama_dokter', $search); 

		return $this->dbmaster->get()->result_array();		
		
	}
	
}

?>
