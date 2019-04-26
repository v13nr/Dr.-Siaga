<?php  

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Superadmin for cloud
 *  Controller			: Superadmin 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
 
	public function _construct(){
		parent::_construct();	
	}
	
	public function index(){
		
		if(!$this->session->userdata('logged_in')){
			redirect('user/account/login');
		}
				
		// load model & config
		$this->load->config('drsiaga');
		
		$user_id 	= $this->session->userdata('user_id');
		$group_id 	= $this->session->userdata('group_id');
		
		if($group_id=='11890083'){
			$file = 'dashboard/superadmin';
		} else if($group_id=='11890091'){
			$file = 'dashboard/admin';
		}
		
		$data['results'] 		= null;
		$data['file'] 			= $file;
		$data['title'] 			= $this->config->item('app_name');
		$data['subtitle'] 		= 'Dashboard';		
		$data['version'] 		= $this->config->item('version');
		$data['keyword'] 		= '';
		$data['desc'] 			= '';
		
		$this->page($data);
		
	}
	
	private function page($data){
		// Write to $title
		$this->template->write('title', $data['title']);

		// Write to $subtitle
		$this->template->write('subtitle', $data['subtitle']);
		
		// Write to Header
		$this->template->write_view('header', 'templates/default/header.php'); 
		
		// Write to Sidebar
		//$this->template->write_view('sidebar', 'templates/default/sidebar.php');
		  
		// Write to Content
		$this->template->write_view('main', 'templates/default/main.php', $data);
					
		// Write to Footer
		$this->template->write_view('footer', 'templates/default/footer.php'); 
		  
		// Render the template
		$this->template->render();		

	}
			
}

?>