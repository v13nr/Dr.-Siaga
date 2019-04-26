<?php  

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Auth for cloud
 *  Model 				: Auth Model
**/

/*
*	Model untuk Authentikasi
*/

class AuthModel extends CI_Model{
    private $table = 'kaio_users'; 
 
	public function __construct()
	{
		parent::__construct();
	}
 
    function register($data){
        $this->db->insert($this->table, $data);
    }
	
    function login($email, $password){
		$this->db->select('*');
		$this->db->from($this->table.' AS a');
		$this->db->join('kaio_user_group AS b','b.user_id=a.user_id', 'LEFT');
        $this->db->where(array('email' => $email, 'password' => md5($password)));
		$data = $this->db->get()->result_array();

		return $data;
    }
 
    function logout(){
        $this->session->sess_destroy();
    }
	
}
?>