<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: User for cloud
 *  Controller			: User 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	private $c = 'user';

	public function _construct(){
		parent::_construct();	
	}

	public function index($page=0)
	{
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
		// load config
		$this->config->load('drsiaga');
		
		$user_id 	= $this->session->userdata('user_id');
		$group_id 	= $this->session->userdata('group_id');
	
		// only super admin can access this page 
		if($group_id != '11890083'){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load library pagination
		$this->load->library('pagination');
		
		// load model
		$this->load->model('UserModel');
		
		// configuration paging
		$config['base_url'] 	= site_url()."user/index/";
		$config['total_rows'] 	= $this->UserModel->jmlhdata($filter=null);
		$config['per_page'] 	=  50;
		$config['first_link'] 	= '<<';
		$config['last_link'] 	= '>>';
		$config['next_link'] 	= 'Next';
		$config['prev_link'] 	= 'Prev';
		
		$this->pagination->initialize($config);
				
		$user = $this->UserModel->getlist($config['per_page'],$page,$filter);
		
		// prepare data
		$data['jmlh_data'] 	= $this->UserModel->jmlhdata($filter=null);
		$data['jmlh_item'] 	= 50;
		$data['action'] 	= site_url().'/user/edit';
		$data['results'] 	= $user;
		$data['file'] 		= 'member/list';
		$data['title'] 		= $this->config->item('app_name');
		$data['version'] 	= $this->config->item('page');
		$data['page'] 		= $page;
		$data['c'] 			= $this->c;
		$data['subtitle'] 	= "Daftar User";
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		
		$this->page($data);
		
	}

	public function add(){
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
		$user_id = $this->session->userdata('user_id');
				
		$user_id 	= $this->session->userdata('user_id');
		$group_id 	= $this->session->userdata('group_id');
	
		// only super admin can access this page 
		if($group_id != '11890083'){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model
		$this->load->model('UserModel');
		$this->load->model('auth/GroupModel');
		
		$group = $this->GroupModel->getlist(); 
				
		$data['results'] 		= null;
		$data['action'] 		= site_url().'/user/update';
		$data['file'] 			= 'member/form';
		$data['listgroup'] 		= $this->GroupModel->getlist(); 
		$data['title'] 			= $this->config->item('app_name');
		$data['subtitle'] 		= 'User Profile';
		$data['version'] 		= $this->config->item('version');
		$data['keyword'] 		= null;
		$data['desc'] 			= null;
		
		$this->page($data);

	}
	
	public function edit(){
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
	
		$user_id 	= $this->session->userdata('user_id');
		$group_id 	= $this->session->userdata('group_id');
	
		// only super admin can access this page 
		if($group_id != '11890083'){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model
		$this->load->model('UserModel');
		$this->load->model('auth/GroupModel');
		$this->load->model('doctor/DoctorUserModel');
		$this->load->model('doctor/SpesialisModel');
		
		$this->load->config('drsiaga');
		
		$dokter_info 	= array(0=>0);
		
		if($group_id == '11890093'){
			//get dokter profile
			$dokter_info = $this->DoctorUserModel->get_by_user_id($user_id);
		}
		
		// get user info
		$user_info = $this->UserModel->get_by_id($user_id);
		$user_info = array_merge($user_info,$dokter_info);
				
		$data['results'] 		= $user_info; 
		//$data['action'] 		= site_url().'/user/update';
		$data['file'] 			= 'member/form_edit';
		$data['listgroup'] 		= $this->GroupModel->getlist(); 
		$data['list_spesialis'] = $this->SpesialisModel->getlist(0,0);
		$data['group'] 			= $group_id ;
		$data['title'] 			= $this->config->item('app_name');
		$data['subtitle'] 		= 'User Profile';
		$data['version'] 		= $this->config->item('version');
		$data['keyword'] 		= null;
		$data['desc'] 			= null;

		$this->page($data);
		
	}
	
    public function update(){ 
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
		if($this->input->post('button')=='Save'){
			$this->save();
			$url = site_url('user');
		} else if($this->input->post('button')=='SaveUser'){
			$this->SaveUser();
			$url = site_url('user');
		} else {
			$this->hapus();
		}
		
		if( $this->session->userdata('user_id')=='1819' ){
			$url = site_url('user');
		} else {
			$url = site_url('user/edit/'.$this->session->userdata('user_id'));
		}
		
		redirect($url,'refresh');	
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