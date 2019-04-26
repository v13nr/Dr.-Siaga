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

class Superadmin extends CI_Controller {
	private $c = 'superadmin';
 
	public function __construct(){
		parent::__construct();	
	}
	
	public function index(){
		$user_id 	= $this->session->userdata('user_id');
		$group_id 	= $this->session->userdata('group_id');
		
		// hanya superadmin yg dpt akses hal ini
		if($group_id != '11890083'){
			echo $this->config->item('forbiden');
			exit();
		}	
		// load model & config
		$this->load->config('drsiaga');
		
		$data['results'] 		= null;
		$data['file'] 			= 'superadmin/dashboard';
		$data['title'] 			= $this->config->item('app_name');
		$data['subtitle'] 		= 'Dashboard';		
		$data['version'] 		= $this->config->item('version');
		$data['keyword'] 		= '';
		$data['desc'] 			= '';
		
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