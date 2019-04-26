<?php  

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Admin for cloud
 *  Controller			: Admin 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	private $c = 'admin';
 
	public function __construct(){
		parent::__construct();	
	}
	
	public function index(){
		
		if(!$this->session->userdata('logged_in')){
			redirect('user/account/login');
		}

		// load config
		$this->load->config('drsiaga');
		
		$user_id 	= $this->session->userdata('user_id');
		$group_id 	= $this->session->userdata('group_id');
		
		// hanya admin & superadmin yg dpt akses hal ini
		if( ($group_id != '11890091')  AND ($group_id != '11890083') ){
			echo $this->config->item('forbiden');
			exit();
		}
		
		$data['results'] 		= null;
		$data['file'] 			= 'admin/dashboard';
		$data['title'] 			= $this->config->item('app_name');
		$data['subtitle'] 		= 'Dashboard';		
		$data['version'] 		= $this->config->item('version');
		$data['keyword'] 		= null;
		$data['desc'] 			= null;
		
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