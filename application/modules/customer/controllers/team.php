<?php  

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Customer for cloud
 *  Controller			: Team 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Team extends CI_Controller {
	private $c = 'customeruser';
 
	public function _construct(){
		parent::_construct();	
	}
	
	public function index($page=0){
		
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
		// load config 
		$this->load->config('drsiaga');
		 
		$user_id 	= $this->session->userdata('user_id');
		$group_id 	= $this->session->userdata('group_id');
	
		// cek acl
		if( (!$this->acl->cek_acl($this->c,'index',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		$this->load->library('pagination');
		
		// load model
		$this->load->model('CustomerUserModel');
		
		$filter = null;
			
		if(empty($this->input->post('search'))){
			$search = null;
		} else {
			$filter['search'] = $search['search'] = $this->input->post('search');
		}
		
		// configuration paging
		$config['base_url'] 	= site_url()."customeruser";
		$config['total_rows'] 	= $this->CustomerUserModel->jmlhdata($filter);
		$config['per_page'] 	=  20;
		$config['first_link'] 	= '<<';
		$config['last_link'] 	= '>>';
		$config['next_link'] 	= 'Next';
		$config['prev_link'] 	= 'Prev';
		
		$this->pagination->initialize($config);
		
		$customeruser = $this->CustomerUserModel->getlist($config['per_page'],$page,$filter);
		
		// prepare data
		$data['jmlh_data']	= $this->CustomerUserModel->jmlhdata($filter);
		$data['jmlh_item']	= $this->config->item('jmlh_item');
		$data['action'] 	= site_url().'customeruser/add';
		$data['results'] 	= $customeruser;
		$data['file'] 		= 'customeruser/list';
		$data['title'] 		= $this->config->item('app_name');
		$data['version'] 	= $this->config->item('version');
		$data['page'] 		= $page;
		$data['c'] 			= $this->c;
		$data['subtitle'] 	= "Daftar User Customer";
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		
		$this->page($data);
		
	}
	
	public function add (){
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		 
		$user_id 	= $this->session->userdata('user_id');
		$group_id 	= $this->session->userdata('group_id');
	
		// cek acl
		if( (!$this->acl->cek_acl($this->c,'add',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model & config
		$this->load->config('drsiaga');

		// prepare data
		$data['results'] 	= null;
		$data['file'] 		= 'customer/form';
		$data['title'] 		= $this->config->item('app_name');
		$data['subtitle'] 	= "Add Customer";
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		$data['c'] 			= $this->c;
		
		$this->page($data);		
	}
	
	public function edit($id=0){
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		 
		$user_id 	= $this->session->userdata('user_id');
		$group_id 	= $this->session->userdata('group_id');
	
		// cek acl
		if( (!$this->acl->cek_acl($this->c,'edit',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model
		$this->load->model('CustomerModel');
		$this->load->config('drsiaga');
				
		$customer = $this->CustomerModel->get_by_id($id);
		
		// prepare data
		$data['results'] 	= $customer;
		$data['file'] 		= 'customer/form';
		$data['title'] 		= $this->config->item('app_name');
		$data['subtitle'] 	= "Edit Customer";
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		
		$this->page($data);	
		
	}
	
    public function update(){
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
		if($this->input->post('button')=='Save'){
			$this->save();
		} else {
			$this->hapus();
		}
	
		redirect(site_url('customer'));	
    }
	
    private function save(){ 
		// load config 
		$this->load->config('drsiaga');
		
		$user_id 	= $this->session->userdata('user_id');
		$group_id 	= $this->session->userdata('group_id');
	
		// only super admin can access this page 
		if( (!$this->acl->cek_acl($this->c,'edit',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model
		$this->load->model('CustomerModel');
		
		$data['id'] 			= $this->input->post('id');
		$data['nama_customer'] 	= $this->input->post('nama_customer');
		$data['tlp'] 			= $this->input->post('tlp');
		$data['email'] 			= $this->input->post('email');
		$data['contact_person']	= $this->input->post('contact_person');
		$data['alamat'] 		= $this->input->post('alamat');
		$data['kota'] 			= $this->input->post('kota');
		
		$res = $this->CustomerModel->saveData($data);
		
		if($res){
			$text = 'Data berhasil di simpan';
		} else {
			$text = $res;
		}

		$this->session->set_flashdata('msg',$text);
	}
	
	private function hapus($id=0){
		// load config 
		$this->load->config('drsiaga');
		
		$user_id 	= $this->session->userdata('user_id');
		$group_id 	= $this->session->userdata('group_id');
	
		// only super admin can access this page 
		if( (!$this->acl->cek_acl($this->c,'hapus',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
				
		// load model
		$this->load->model('CustomerModel');
		
		$id = $this->input->post('id');
		
		for($i=0; $i < count($id); $i++){
			$this->CustomerModel->hapus($id[$i]);
		}

		$text = 'Data berhasil di hapus';
		
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