<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Faskes
 *  Model				: JadwalDokterModel
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class JadwalDokterModel extends CI_Model{
	private $dbmaster;
	private $tbl = 'kaio_jadwal_dokter';

	public function __construct()
	{
		parent::__construct();
		
		// load second db
		$this->dbmaster = $this->load->database('dbmaster', TRUE);	
	}
	
	public  function getlist($start,$finish,$search){ 
		$this->dbmaster->select('a.*,b.nama_faskes,c.nama_poli,d.gelar,d.gelar_depan,d.nama_dokter,d.gelar_belakang,e.title');
		$this->dbmaster->from($this->tbl.' AS a');
		$this->dbmaster->join('kaio_faskes AS b','b.faskes_id=a.faskes_id');
		$this->dbmaster->join('kaio_poli AS c','c.poli_id=a.poli_id');			
		$this->dbmaster->join('kaio_dokter AS d','d.id=a.dokter_id');
		$this->dbmaster->join('kaio_spesialis AS e','e.id=d.spesialis_id');	

		$this->dbmaster->order_by('d.nama_dokter','asc');
		$this->dbmaster->order_by('a.hari','asc');		
		
		if(!empty($search)){
			if(isset($search['jadwal_id']) AND $search['jadwal_id'] > 0){
				$this->dbmaster->where('a.jadwal_id',$search['jadwal_id']);
			}
			if(isset($search['faskes_id']) AND $search['faskes_id'] > 0){
				$this->dbmaster->where('a.faskes_id',$search['faskes_id']);
			}	
			if(isset($search['poli_id']) AND $search['poli_id'] > 0){
				$this->dbmaster->where('a.poli_id',$search['poli_id']);
			}	
			if(isset($search['dokter_id']) AND $search['dokter_id'] > 0){
				$this->dbmaster->where('a.dokter_id',$search['dokter_id']);
			}	
			if(isset($search['spesialis_id']) AND $search['spesialis_id'] > 0){
				$this->dbmaster->where('d.spesialis_id',$search['spesialis_id']);
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
	
	public function hapus($hapus){
		
		if(isset($hapus['faskes_id']) AND $hapus['faskes_id'] > 0){
			$this->dbmaster->where_in('faskes_id',$hapus['jadwal_id']);
		}
		
		if(isset($hapus['poli_id']) AND $hapus['poli_id'] > 0){
			$this->dbmaster->where_in('poli_id',$hapus['poli_id']);
		}
		
		if(isset($hapus['dokter_id']) AND $hapus['dokter_id'] > 0){
			$this->dbmaster->where_in('dokter_id',$hapus['dokter_id']);
		}
		
		if($this->dbmaster->delete($this->tbl)){
			$res = true;
		} else {
			$res = false;
		}
		
		return $res;
	}
		
	public function saveData($data)
	{
		$res = true;
		
		if( empty($data['jadwal_id']) ){
			if(!$this->dbmaster->insert($this->tbl,$data)){  
				//Do your error handling here  
				//return $this->dbmaster->_error_number();
				$res = $this->dbmaster->_error_message();
			} 
		} else {
			$this->dbmaster->where('jadwal_id',$data['jadwal_id']);
			
			if(!$this->dbmaster->update($this->tbl,$data)){  
				//Do your error handling here  
				$res = $this->dbmaster->_error_number();
			}
		} 
		
		return $res;
	}
		
	public function search($search){
		$this->dbmaster->select('a.*');
		$this->dbmaster->like('a.nama', $search); 

		return $this->dbmaster->get($this->tbl.' AS a')->result_array();		
		
	}
		
}

?>
