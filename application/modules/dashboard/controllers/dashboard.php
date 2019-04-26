<?php  

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Dashboard for cloud
 *  Controller			: Dashboard untuk menghandle jika user belum di definisikan group id atau tidak mempunyai akses ke rule
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
 
	public function __construct(){
		parent::__construct();	
	}
	
	public function index(){
		
		if(!$this->session->userdata('logged_in')){
			//redirect('user/account/login');
		}
				
		// load model & config
		$this->load->config('drsiaga');
		
		echo $user_id 	= $this->session->userdata('user_id');
		$group_id 	= $this->session->userdata('group_id');
		
		if($group_id=='11890083'){
			// superadmin
			redirect('dashboard/superadmin');
		} else if($group_id=='11890091'){
			// admin
			redirect('dashboard/admin');
		} else {
			// jika group tidak di definisikan
			
		}
		
	}
			
}

?>