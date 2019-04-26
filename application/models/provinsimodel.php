<?php 

/**
 *	Copyright (C)	: Kaio Piranti Lunak
 *	Developer		: Fatah Iskandar Akbar
 *  Email			: kaiosoftware@gmail.com
 *	Date			: Juni 2015
 *	Module version	: 1.0.0
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProvinsiModel extends CI_Model{
	private $dbmaster;
	private $tbl = 'kaio_provinsi';

	public function _construct()
	{
		parent::_construct();
	}
	
	public  function getlist($start,$finish){ 
		$this->dbmaster->select('a.id_prov,a.nama_prov AS provinsi');
		$this->dbmaster->from($this->tbl.' AS a');
		$this->dbmaster->order_by('a.nama_prov','asc');
		
		if($start > 0 OR $finish > 0){
			$this->dbmaster->limit($start,$finish);
		}
		
		return $this->dbmaster->get()->result();
	}
	
	public function jmlhdata(){
		return $this->dbmaster->count_all_results($this->tbl);
	}
		
}

?>
