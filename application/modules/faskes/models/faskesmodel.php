<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Faskes
 *  Model				: FaskesModel
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FaskesModel extends CI_Model{
	private $dbmaster;
	private $tbl = 'kaio_faskes';

	public function __construct()
	{
		parent::__construct();
		
		// load second db
		$this->dbmaster = $this->load->database('dbmaster', TRUE);	

	}
	
	public  function getlist($start,$finish,$search){ 
		$this->dbmaster->select('a.*,b.nama_prov,c.nama_kabkot');
		$this->dbmaster->from($this->tbl.' AS a');
		$this->dbmaster->join('kaio_provinsi AS b','b.id_prov=a.id_prov','left');
		$this->dbmaster->join('kaio_kabkot AS c','c.id_kabkot=a.id_kabkot','left');
		
		$this->dbmaster->order_by('nama_faskes','asc');
		
		if(!empty($search)){
			if(isset($search['faskes_id']) AND $search['faskes_id'] > 0){
				$this->dbmaster->where('faskes_id',$search['faskes_id']);
			}
			if(isset($search['prov_id']) AND $search['prov_id'] > 0){
				$this->dbmaster->where('prov_id',$search['prov_id']);
			}
			if(isset($search['kabkot_id']) AND $search['kabkot_id'] > 0){
				$this->dbmaster->where('kabkot_id',$search['kabkot_id']);
			}
			if(isset($search['kec_id']) AND $search['kec_id'] > 0){
				$this->dbmaster->where('kec_id',$search['kec_id']);
			}
			if(isset($search['kel_id']) AND $search['kel_id'] > 0){
				$this->dbmaster->where('kel_id',$search['kel_id']);
			}
			if(isset($search['latitude']) AND  !empty($search['latitude'])){
				$this->dbmaster->where('latitude',$search['latitude']);
			}	
			if(isset($search['longitude']) AND  !empty($search['longitude'])){
				$this->dbmaster->where('longitude',$search['longitude']);
			}	
			if(isset($search['tipe']) AND  !empty($search['tipe'])){
				if(is_array($search['tipe'])){
					for($i=0; $i < count($search['tipe']); $i++){
						if($i > 0){
							$this->dbmaster->or_where('tipe', $search['tipe'][$i]); 
						}
						
						$this->dbmaster->where('tipe',$search['tipe'][$i]);
					}
				} else {
					$this->dbmaster->where('tipe',$search['tipe']);
				}
				
			}		
			if(isset($search['search'])){
				$this->dbmaster->like('nama', $search['search'], 'both'); 
			}			
		}
		
		if($start > 0 OR $finish > 0){
			$this->dbmaster->limit($start,$finish);
		}
		
		return $this->dbmaster->get()->result();
	}
	
	public function jmlhdata($search){
		if(!empty($search)){
			if(isset($search['faskes_id']) AND $search['faskes_id'] > 0){
				$this->dbmaster->where('faskes_id',$search['faskes_id']);
			}
			if(isset($search['prov_id']) AND $search['prov_id'] > 0){
				$this->dbmaster->where('prov_id',$search['prov_id']);
			}
			if(isset($search['kabkot_id']) AND $search['kabkot_id'] > 0){
				$this->dbmaster->where('kabkot_id',$search['kabkot_id']);
			}
			if(isset($search['kec_id']) AND $search['kec_id'] > 0){
				$this->dbmaster->where('kec_id',$search['kec_id']);
			}
			if(isset($search['kel_id']) AND $search['kel_id'] > 0){
				$this->dbmaster->where('kel_id',$search['kel_id']);
			}
			if(isset($search['latitude']) AND  !empty($search['latitude'])){
				$this->dbmaster->where('latitude',$search['latitude']);
			}	
			if(isset($search['longitude']) AND  !empty($search['longitude'])){
				$this->dbmaster->where('longitude',$search['longitude']);
			}	
			if(isset($search['tipe']) AND  !empty($search['tipe'])){
				if(is_array($search['tipe'])){
					for($i=0; $i < count($search['tipe']); $i++){
						if($i > 0){
							$this->dbmaster->or_where('tipe', $search['tipe'][$i]); 
						}
						
						$this->dbmaster->where('tipe',$search['tipe'][$i]);
					}
				} else {
					$this->dbmaster->where('tipe',$search['tipe']);
				}
				
			}		
			if(isset($search['search'])){
				$this->dbmaster->like('nama', $search['search'], 'both'); 
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
		$this->dbmaster->select('a.*,b.id_prov,b.nama_prov,c.id_kabkot,c.nama_kabkot');
		$this->dbmaster->join('kaio_provinsi AS b','b.id_prov=a.prov_id','left');
		$this->dbmaster->join('kaio_kabkot AS c','c.id_kabkot=a.kabkot_id','left');
		$this->dbmaster->where('a.id', $id);
		return $this->dbmaster->get($this->tbl.' AS a')->result_array();
	}
	
	public function saveData($data)
	{
		if(empty($data['faskes_id'])){
			if(!$this->dbmaster->insert($this->tbl,$data)){  
				//Do your error handling here  
				//return $this->dbmaster->_error_number();
				return $this->dbmaster->_error_message();
			} 
		} else {
			$this->dbmaster->where('faskes_id',$data['faskes_id']);
			if(!$this->dbmaster->update($this->tbl,$data)){  
				//Do your error handling here  
				return $this->dbmaster->_error_number();
			}
		} 
	}
	
	public function max_id(){
		$this->dbmaster->select_max('id');
		return $this->dbmaster->get($this->tbl)->result_array();			
	}
	
	public function search($search){
		$this->dbmaster->select('a.*');
		$this->dbmaster->like('a.nama', $search); 

		return $this->dbmaster->get($this->tbl.' AS a')->result_array();		
		
	}
	
	public function get_faskes($search){
		$this->dbmaster->select('a.*');
		$this->dbmaster->where('a.nama', $search); 
		$this->dbmaster->order_by('nama','asc');

		return $this->dbmaster->get($this->tbl.' AS a')->result_array();		
		
	}
	
}

?>
