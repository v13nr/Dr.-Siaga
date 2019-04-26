<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Hakakses 
 *  Model				: HakaksesModel
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HakaksesModel extends CI_Model{

	private $tbl = 'kaio_akses_level';

	public function _construct()
	{
		parent::_construct();
	}
	
	public  function getlist($start,$finish,$search){
		$this->db->select('a.name,a.user_id,a.username,c.group_name');
		$this->db->from('kaio_users AS a');
		$this->db->join('kaio_user_group AS b','b.user_id=a.user_id');
		$this->db->join('kaio_groups AS c','c.group_id=b.group_id');
		$this->db->order_by('a.name','asc');
		
		if(!empty($search)){
			if(isset($search['search'])){
				$this->db->like('name', $search['search'], 'both'); 
			}
	
		}
		
		$this->db->limit($start,$finish);
		
		return $this->db->get()->result();
	}
		
	public function jmlhdata($search){	
		if(!empty($search)){
			if(isset($search['search'])){
				$this->db->like('name', $search['search'], 'both'); 
			}
	
		}	
		return $this->db->count_all_results('kaio_users');
	}
		
	public function get_by_id($id){ 
		$this->db->select('*');
		$this->db->where('user_id', $id);
		return $this->db->get('kaio_users')->result_array();
	}
	
	public function saveData($data)
	{		
		$this->hapus($data['user_id']);
		
		for($i=0; $i < count($data['rule_id']); $i++){
			$q = "INSERT INTO kaio_akses_level VALUES('".$data['user_id']."','".$data['rule_id'][$i]."')";
			$this->db->query($q);
		}
	}
	
	public function hapus($user_id){
		$this->db->where('user_id',$user_id);
		$this->db->delete($this->tbl);
		return true;
	}
	
	function listakseslevel($rule_method){
		$this->db->select('menu,rule_id,rule_class');
		$this->db->where('rule_method',$rule_method);
		$this->db->order_by('menu','asc');
		return $this->db->get('kaio_rules')->result_array();
	}
	
	/* function untuk mencari nilai ceklist berdasarkan rule method*/
	function getrulemethod($user_id,$arg){
		$this->db->select('a.*,b.rule_method');
		$this->db->join('kaio_rules AS b','b.rule_id=a.rule_id');	
		$this->db->where('a.user_id',$user_id);
		$this->db->where('b.rule_method',$arg);
		return $this->db->get('kaio_akses_level AS a')->result_array();	
	}
	
	/* function untuk mencari rule class yg dpt add */
	function canadd($arg){
		$this->db->where('rule_class',$arg);
		$this->db->where('rule_method','add');
		return $this->db->get('kaio_rules')->result_array();	
	}
	
	/* function untuk mencari rule class yg dpt edit */
	function canedit($arg){
		$this->db->where('rule_class',$arg);
		$this->db->where('rule_method','edit');
		return $this->db->get('kaio_rules')->result_array();	
	}
	
	/* function untuk mencari rule class yg dpt delete */
	function candelete($arg){
		$this->db->where('rule_class',$arg);
		$this->db->where('rule_method','hapus');
		return $this->db->get('kaio_rules')->result_array();	
	}

}

?>
