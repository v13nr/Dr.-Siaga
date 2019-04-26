<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Pages for cloud
 *  Controller			: Price 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Price extends CI_Controller {
	private $c = 'price';

	public function __construct(){
		parent::__construct();	
	}

	public function index($page=0)
	{
		$this->load->config('drsiaga');
		
		// prepare data
		$data['title'] 		= $this->config->item('title');
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		$data['results'] 	= null;
		$data['title'] 		= 'Harga Paket Doktersiaga Platform';
		$data['subtitle'] 	= 'Doktersiaga Platform';
		
		$this->load->view('price',$data);
	}
	
}

?>