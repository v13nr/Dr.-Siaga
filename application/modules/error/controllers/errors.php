<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Rule for cloud
 *  Controller			: Rule 
**/


if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Errors extends CI_Controller {
	private $c = 'errors';

	public function __construct(){
		parent::__construct();	
	}

	public function index()
	{
		// load model
		$this->load->config('drsiaga');
				
		// prepare data
		$data['results'] 	= null;
		$data['file'] 		= 'error/view_err';
		$data['title'] 		= $this->config->item('app_name');
		$data['version'] 	= $this->config->item('version');
		$data['subtitle'] 	= null;
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		
		$this->page($data);
	}
	
	public function error_404()
	{
		$this->output->set_status_header('404');
		echo "404 - not found";
	}
	
	public function show_404(){
		// load model
		$this->load->config('drsiaga');
			
		$text = 'Anda kurang beruntung...';
				
		// prepare data
		$data['results'] 	= null;
		$data['file'] 		= 'error/show_404';
		$data['title'] 		= $this->config->item('app_name');
		$data['version'] 	= $this->config->item('version');
		$data['subtitle'] 	= null;
		$data['text'] 		= $text;
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		
		$this->page($data);		
		
	}
		
	private function page($data){
		// Write to $title
		$this->template->write('title', $data['title']);

		// Write to $subtitle
		$this->template->write('subtitle', $data['subtitle']);
		
		// Write to Header
		$this->template->write_view('header', 'templates/default/header.php'); 
		  
		// Write to Content
		$this->template->write_view('main', 'templates/default/main.php', $data);
					
		// Write to Footer
		$this->template->write_view('footer', 'templates/default/footer.php'); 
		  
		// Render the template
		$this->template->render();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */