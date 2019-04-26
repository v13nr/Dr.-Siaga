<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Blog
 *  Model				: BlogModel
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BlogModel extends CI_Model{
	private $dbmaster;
	private $tbl = 'kaio_blog';

	public function _construct()
	{
		parent::_construct();
	}
	
	public  function getlist($start,$finish,$filter){ 
		$this->dbmaster->select('a.*,b.gelar,b.gelar_belakang,b.nama_dokter');
		$this->dbmaster->from($this->tbl.' AS a');
		$this->dbmaster->join('kaio_dokter AS b','b.id=c.dokter_id','left');
		
		if(!empty($filter)){
			if(isset($filter['publish']) AND  $filter['publish'] > 0){
				$this->dbmaster->where('publish',$filter['publish']);
			}
			
			if(isset($filter['author_id']) AND  $filter['author_id'] > 0){
				$this->dbmaster->where('author_id',$filter['author_id']);
			}
			
			if(isset($filter['is_campaign']) AND  $filter['is_campaign'] =='Y'){
				$this->dbmaster->where('is_campaign',$filter['is_campaign']);
			}		

			if(isset($filter['hits'])){
				$this->dbmaster->where('hits < ',$filter['hits']);
			}				
			
			if(isset($filter['order_by']) AND isset($filter['urutan'])){
				$this->dbmaster->order_by($filter['order_by'],$filter['urutan']);
			}
			
		}
		
		if($start > 0 OR $finish > 0){
			$this->dbmaster->limit($start,$finish);
		}
		
		return $this->dbmaster->get()->result();

	}
	
	public function hapus($id=0){
		$this->dbmaster->where_in('id',$id);
		$this->dbmaster->delete($this->tbl);
		return true;
	}
	
	public function get_by_id($id){ 
		$this->dbmaster->select('a.*,b.name AS author_name,b.picture,c.dokter_id AS author_id,c.user_id AS user_id');
		$this->dbmaster->join('kaio_users AS b','b.user_id=a.author_id');
		$this->dbmaster->join('kaio_dokter_user AS c','c.user_id=a.author_id','left');
		$this->dbmaster->where('a.id', $id);
		
		return $this->dbmaster->get($this->tbl.' AS a')->result_array();
	}
	
	public function get_by_url($url){ 
		$this->dbmaster->select('a.*,d.nama_dokter AS name,b.picture,c.dokter_id AS author_id,c.user_id AS user_id,d.gelar,d.nama_dokter,d.gelar_belakang,s.title,s.description AS spesialis_desc');
		$this->dbmaster->join('kaio_users AS b','b.user_id=a.author_id');
		$this->dbmaster->join('kaio_dokter_user AS c','c.user_id=a.author_id','left');
		$this->dbmaster->join('kaio_dokter AS d','d.id=c.dokter_id','left');
		$this->dbmaster->join('kaio_spesialis AS s','s.id=d.spesialis_id','left');
		$this->dbmaster->where('a.link', $url);
		
		return $this->dbmaster->get($this->tbl.' AS a')->result_array();
	}
	
	public function saveData($data)
	{
		if(empty($data['id'])){
			$this->dbmaster->insert($this->tbl,$data);
		} else {
			$this->dbmaster->where('id',$data['id']);
			$this->dbmaster->update($this->tbl,$data);
		}
	}
	
	public function max_id(){
		$this->dbmaster->select_max('id');
		$result = $this->dbmaster->get($this->tbl)->row();	
		return $result->id;
	}
	
	function update_viewer($data){
		$this->dbmaster->set('hits', '`hits`+1',FALSE);
		
		if(!empty($data)){
			if(isset($data['id']) AND $data['id'] > 0){
				$this->dbmaster->where('id', $data['id']);
			}
			if(isset($data['url']) AND $data['url'] != null){
				$this->dbmaster->where('link', $data['url']);
			}			
		}
		
		$this->dbmaster->update('kaio_blog');
	}
	
	public function aktifitas_blog($start,$finish,$filter){ 
		$this->dbmaster->select('u.name,COUNT(*) AS jmlh');
		$this->dbmaster->from($this->tbl.' AS b');
		$this->dbmaster->join('kaio_users AS u','u.user_id=b.author_id');		
		
		if(!empty($filter)){
			if(isset($filter['group_by'])){
				$this->dbmaster->group_by('b.author_id');
			}
		}
		
		if($start > 0 OR $finish > 0){
			$this->dbmaster->limit($start,$finish);
		}		
		
		$this->dbmaster->order_by('jmlh','DESC');
		return $this->dbmaster->get()->result();
	}
	
	public function top_bloger($start,$finish,$filter){
		$this->dbmaster->select('b.*,u.name');
		$this->dbmaster->from($this->tbl.' AS b');
		$this->dbmaster->join('kaio_users AS u','u.user_id=b.author_id');		
		
		if(!empty($filter)){
			if(isset($filter['hits'])){
				$this->dbmaster->where('b.hits > '.$filter['hits']);
			}
		}
		
		if($start > 0 OR $finish > 0){
			$this->dbmaster->limit($start,$finish);
		}		
		
		$this->dbmaster->order_by('hits','DESC');
		
		return $this->dbmaster->get()->result();
		
	}
	
	public function blog_level($min,$max){
		$this->dbmaster->select('b.*,u.name');
		$this->dbmaster->from($this->tbl.' AS b');
		$this->dbmaster->join('kaio_users AS u','u.user_id=b.author_id');		
		
		if(isset($min)){
			$this->dbmaster->where('b.hits >', $min);
		}
		if(isset($max)){
			$this->dbmaster->where('b.hits <', $max);	
		}
		
		$this->dbmaster->order_by('hits','DESC');
		
		return $this->dbmaster->get()->result();		
		
	}
}

?>
