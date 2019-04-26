<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Faskes
 *  Model				: PoliDokterModel
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PoliDokterModel extends CI_Model{
	private $dbmaster;
	private $tbl = 'kaio_poli_dokter';

	public function __construct()
	{
		parent::__construct();
		
		// load second db
		$this->dbmaster = $this->load->database('dbmaster', TRUE);	
	}
	
	public  function getlist($start,$finish,$search){ 
		$this->dbmaster->select('a.*,b.gelar,b.gelar_depan,b.gelar_belakang,b.nama_dokter,c.title,e.nama_faskes,d.nama_poli');
		$this->dbmaster->from($this->tbl.' AS a');
		$this->dbmaster->join('kaio_dokter AS b','b.id=a.dokter_id');
		$this->dbmaster->join('kaio_spesialis AS c','c.id=a.spesialis_id');	
		$this->dbmaster->join('kaio_poli AS d','d.poli_id=a.poli_id');	
		$this->dbmaster->join('kaio_faskes AS e','e.faskes_id=a.faskes_id');		
		$this->dbmaster->order_by('b.nama_dokter','asc');
		
		if(!empty($search)){
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
				$this->dbmaster->where('a.spesialis_id',$search['spesialis_id']);
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
	
	public function hapus($data){
		if(isset($data['dokter_id']) AND $data['dokter_id'] > 0){
			$this->dbmaster->where('dokter_id',$data['dokter_id']);
		}
		
		if(isset($data['poli_id']) AND $data['poli_id'] > 0){
			$this->dbmaster->where('poli_id',$data['poli_id']);
		}
		
		if(isset($data['faskes_id']) AND $data['faskes_id'] > 0){
			$this->dbmaster->where('faskes_id',$data['faskes_id']);
		}
		
		if($this->dbmaster->delete($this->tbl)){
			$res = true;
		} else {
			$res = false;
		}
		
		return $res;
	}
		
	public function saveData($data,$mode)
	{
		$res = true;
		
		if($mode=='new'){
			if(!$this->dbmaster->insert($this->tbl,$data)){  
				//Do your error handling here  
				//return $this->dbmaster->_error_number();
				$res = $this->dbmaster->_error_message();
			} 
		} else if($mode=='edit') {
			$this->dbmaster->where('dokter_id',$data['dokter_id']);
			$this->dbmaster->where('poli_id',$data['poli_id']);
			$this->dbmaster->where('faskes_id',$data['faskes_id']);
			
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
	
	public function list_dokter_poli($search,$faskes_id,$poli_id){
		$this->dbmaster->select('a.*,b.id,b.gelar,b.gelar_depan,b.nama_dokter,b.gelar_belakang,c.title');
		$this->dbmaster->join('kaio_dokter AS b','b.id=a.dokter_id');
		$this->dbmaster->join('kaio_spesialis AS c','c.id=b.spesialis_id');
		$this->dbmaster->where('a.faskes_id', $faskes_id);
		$this->dbmaster->where('a.poli_id', $poli_id);
		$this->dbmaster->like('b.nama_dokter', $search); 

		return $this->dbmaster->get($this->tbl.' AS a')->result_array();		
		
	}	
		
}

?>
