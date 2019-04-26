<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Blog
 *  Model				: BlogCustomerModel
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BlogCustomerModel extends CI_Model{
	private $tbl = 'kaio_blog_customer';

	public function _construct()
	{
		parent::_construct();
	}
	
	public  function getlist($start,$finish,$filter){ 
		$this->db->select('a.*,c.gelar,c.gelar_belakang,c.nama_dokter,d.nama_customer');
		$this->db->from($this->tbl.' AS a');
		$this->db->join('dbmaster.kaio_blog AS b','b.id=a.blog_id');
		$this->db->join('dbmaster.kaio_dokter AS c','c.id=a.dokter_id');
		$this->db->join('kaio_customer AS d','d.id=a.customer_id');
		
		if(!empty($filter)){
			if(isset($filter['publish']) AND  $filter['publish'] > 0){
				$this->db->where('b.publish',$filter['publish']);
			}
			
			if(isset($filter['dokter_id']) AND  $filter['dokter_id'] > 0){
				$this->db->where('a.dokter_id',$filter['dokter_id']);
			}
			
			if(isset($filter['is_campaign']) AND  $filter['is_campaign'] =='Y'){
				$this->db->where('b.is_campaign',$filter['is_campaign']);
			}		

			if(isset($filter['hits'])){
				$this->db->where('b.hits < ',$filter['hits']);
			}				
			
			if(isset($filter['order_by']) AND isset($filter['urutan'])){
				$this->db->order_by($filter['order_by'],$filter['urutan']);
			}
			
		}
		
		if($start > 0 OR $finish > 0){
			$this->db->limit($start,$finish);
		}
		
		return $this->db->get()->result();

	}
	
	public function hapus($id=0){
		$this->db->where_in('id',$id);
		$this->db->delete($this->tbl);
		return true;
	}
			
	public function saveData($data)
	{
		if(empty($data['id'])){
			$this->db->insert($this->tbl,$data);
		} else {
			$this->db->where('id',$data['id']);
			$this->db->update($this->tbl,$data);
		}
	}
	
}

?>
