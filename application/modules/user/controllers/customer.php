<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: User for cloud
 *  Controller			: Customer 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {
	private $c = 'profile';

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
	
		// cek acl
		if( (!$this->acl->cek_acl($this->c,'index',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model
		$this->load->model('UserModel');
						
		$user = $this->UserModel->get_by_id($user_id);
				
		// prepare data
		$data['action'] 	= null;
		$data['results'] 	= $user;
		$data['file'] 		= 'profile/home';
		$data['title'] 		= $this->config->item('app_name');
		$data['version'] 	= $this->config->item('page');
		$data['c'] 			= $this->c;
		$data['subtitle'] 	= "Profile User";
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		
		$this->page($data);
		
	}
	
	public function edit(){
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
		// load config
		$this->config->load('drsiaga');
	
		$user_id 	= $this->session->userdata('user_id');
		$group_id 	= $this->session->userdata('group_id');
			
		// cek acl
		if( (!$this->acl->cek_acl($this->c,'edit',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model
		$this->load->model('UserModel');
						
		$user = $this->UserModel->get_by_id($user_id);
						
		$data['results'] 		= $user; 
		$data['action'] 		= site_url().'/user/profile/update';
		$data['file'] 			= 'profile/form';
		$data['title'] 			= $this->config->item('app_name');
		$data['subtitle'] 		= 'User Profile';
		$data['version'] 		= $this->config->item('version');
		$data['keyword'] 		= null;
		$data['desc'] 			= null;

		$this->page($data);
		
	}
	
	public function form_password(){
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
		// load config
		$this->config->load('drsiaga');
	
		$user_id 	= $this->session->userdata('user_id');
		$group_id 	= $this->session->userdata('group_id');
			
		// cek acl
		if( (!$this->acl->cek_acl($this->c,'edit',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model
		$this->load->model('UserModel');
						
		$user = $this->UserModel->get_by_id($user_id);
						
		$data['results'] 		= $user; 
		$data['action'] 		= site_url().'/user/profile/update';
		$data['file'] 			= 'profile/form_password';
		$data['title'] 			= $this->config->item('app_name');
		$data['subtitle'] 		= 'Ganti Password';
		$data['version'] 		= $this->config->item('version');
		$data['keyword'] 		= null;
		$data['desc'] 			= null;

		$this->page($data);
		
	}
	
    public function update(){ 
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
		if($this->input->post('button')=='SavePassword'){
			$this->savePassword();
		} else {
			$this->save();
		}
		
		redirect('user/profile');	
    }
	
    private function save(){ 
		// load config 
		$this->load->config('drsiaga');
		
		$user_id 	= $this->session->userdata('user_id');
	
		// cek acl
		if( (!$this->acl->cek_acl($this->c,'edit',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model
		$this->load->model('UserModel');
		
		$data['user_id']	= $this->input->post('user_id');
		$data['name'] 		= $this->input->post('name');
		$data['email'] 		= $this->input->post('email');
		$data['hp'] 		= $this->input->post('hp');	
		
		$this->UserModel->saveData($data); 
		
		$text = 'Data berhasil di simpan';
					 
		$this->session->set_flashdata('msg',$text);
	}
	
   private function savePassword(){ 
		// load config 
		$this->load->config('drsiaga');
		
		$user_id 	= $this->session->userdata('user_id');
	
		// cek acl
		if( (!$this->acl->cek_acl($this->c,'edit',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model
		$this->load->model('UserModel');
		
		$data['user_id']		= $this->input->post('user_id');
		$data['password'] 		= md5($this->input->post('password1'));
		
		$this->UserModel->saveData($data); 
		
		$text = 'Password berhasil di rubah';
					 
		$this->session->set_flashdata('msg',$text);
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