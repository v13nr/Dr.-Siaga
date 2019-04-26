<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Pages for cloud
 *  Controller			: Home 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	private $c = 'home';

	public function __construct(){
		parent::__construct();	
	}

	public function index($page=0)
	{
		$group_id 		= $this->session->userdata('group_id');
		
		if($group_id == '11890083'){
			$url = 'superadmin';
		} else if($group_id == '11890091'){
			$url = 'admin';
		}
		
		if( ($this->session->userdata('logged_in')) ){
			redirect('dashboard/'.$url);
		}
		
		$this->load->config('drsiaga');
		
		// prepare data
		$data['title'] 		= $this->config->item('title');
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		$data['results'] 	= null;
		$data['title'] 		= 'Patient Relationship Management';
		$data['subtitle'] 	= 'Doktersiaga Bussines';
		
		$this->load->view('home',$data);
	}
	
}

?>