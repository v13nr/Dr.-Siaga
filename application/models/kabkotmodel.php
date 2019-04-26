<?php 

/**
 *	Copyright (C)	: Kaio Piranti Lunak
 *	Developer		: Fatah Iskandar Akbar
 *  Email			: kaiosoftware@gmail.com
 *	Date			: Juni 2015
 *	Module version	: 1.0.0
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class KabkotModel extends CI_Model{
	private $dbmaster;
	private $tbl = 'kaio_kabkot';

	public function __construct()
	{
		parent::__construct();
		
		// load second db
		$this->dbmaster = $this->load->database('dbmaster', TRUE);	
	}
	
	public  function getlist($start,$finish){ 
		$this->dbmaster->select('a.*,b.nama_prov');
		$this->dbmaster->from($this->tbl.' AS a');
		$this->dbmaster->join('kaio_provinsi AS b','b.id_prov=a.id_prov');
		$this->dbmaster->order_by('b.nama_prov','asc');
		$this->dbmaster->order_by('a.nama_kabkot','asc');
		
		if($start > 0 OR $finish > 0){
			$this->dbmaster->limit($start,$finish);
		}
		
		return $this->dbmaster->get()->result();
	}
	
	public function jmlhdata(){
		return $this->dbmaster->count_all_results($this->tbl);
	}
		
	public function search($search){
		$this->dbmaster->select('a.*,b.nama_prov');
		$this->dbmaster->join('kaio_provinsi AS b','b.id_prov=a.id_prov');
		$this->dbmaster->like('a.nama_kabkot', $search); 

		return $this->dbmaster->get($this->tbl.' AS a')->result_array();		
		
	}
	
}

?>
