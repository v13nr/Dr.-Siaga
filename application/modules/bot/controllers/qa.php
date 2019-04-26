<?php  

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Bot for cloud
 *  Controller			: Qa (Question & Answer) 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Qa extends CI_Controller {
	private $c = 'qa';
 
	public function _construct(){
		parent::_construct();	
	}
	
	public function index($page=0){		
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		 
		$user_id 	= $this->session->userdata('user_id');
		$group_id 	= $this->session->userdata('group_id');
		
		// cek acl
		/*if(!$this->acl->cek_acl($this->c,'index',$user_id)){
			$text = '<div class="row" style="margin-top:50px">
						<div class="col-sm-9">
							<div class="alert alert-info alert-dismissible" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  <strong>Warning ! You dont have authorizate to access '.$this->c.' page </strong>
							</div>				
						</div>
					</div>';
			$this->session->set_flashdata('msg',$text);
			redirect('dashboard/index');
		}*/
		
		$this->load->library('pagination');
		
		// load model & config
		$this->load->config('drsiaga');
		$this->load->model('QaModel');
		
		// configuration paging
		$config['base_url'] 	= site_url()."customer/index/";
		$config['total_rows'] 	= $this->QaModel->jmlhdata();
		$config['per_page'] 	=  20;
		$config['first_link'] 	= '<<';
		$config['last_link'] 	= '>>';
		$config['next_link'] 	= 'Next';
		$config['prev_link'] 	= 'Prev';
		
		$this->pagination->initialize($config);
		
		$qa = $this->QaModel->getlist($config['per_page'],$page);
		
		// prepare data
		$data['jmlh_data']	= $this->QaModel->jmlhdata();
		$data['jmlh_item']	= $this->config->item('jmlh_item');
		$data['action'] 	= site_url().'bot/qa/add';
		$data['results'] 	= $qa;
		$data['file'] 		= 'qa/list';
		$data['title'] 		= 'Qustion & Answer';
		$data['version'] 	= $this->config->item('version');
		$data['page'] 		= $page;
		$data['c'] 			= $this->c;
		$data['subtitle'] 	= "Daftar Question & Answer";
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