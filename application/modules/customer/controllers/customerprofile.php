<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: User for cloud
 *  Controller			: ProfileCustomer 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CustomerProfile extends CI_Controller {
	private $c = 'customerprofile';

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
		
		$user_id 		= $this->session->userdata('user_id');
		$customer_id 	= $this->session->userdata('customer_id');
	
		// cek acl
		if( (!$this->acl->cek_acl($this->c,'index',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model
		$this->load->model('CustomerModel');
								
		$customer = $this->CustomerModel->get_by_id($customer_id);
				
		// prepare data
		$data['action'] 	= null;
		$data['results'] 	= $customer;
		$data['file'] 		= 'customer/customer/home';
		$data['title'] 		= $this->config->item('app_name');
		$data['version'] 	= $this->config->item('page');
		$data['c'] 			= $this->c;
		$data['subtitle'] 	= "Profile Perusahaan";
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
		$customer_id 	= $this->session->userdata('customer_id');
			
		// cek acl
		if( (!$this->acl->cek_acl($this->c,'edit',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model
		$this->load->model('CustomerModel');
						
		$customer = $this->CustomerModel->get_by_id($customer_id);
						
		$data['results'] 		= $customer; 
		$data['action'] 		= site_url().'/customer/customerprofile/update';
		$data['file'] 			= 'customer/customer/form';
		$data['title'] 			= $this->config->item('app_name');
		$data['subtitle'] 		= 'Customer Profile';
		$data['version'] 		= $this->config->item('version');
		$data['keyword'] 		= null;
		$data['desc'] 			= null;

		$this->page($data);
		
	}
		
    public function update(){ 
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
		$this->save();

		redirect('customer/customerprofile');	
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
		$this->load->model('CustomerModel');
		
		$data['id']			= $this->input->post('id');
		$data['nama_customer'] 		= $this->input->post('nama_customer');
		$data['email'] 				= $this->input->post('email');
		$data['tlp'] 				= $this->input->post('tlp');	
		$data['alamat'] 			= $this->input->post('alamat');	
		$data['kota'] 				= $this->input->post('kota');	
		
		$this->CustomerModel->saveData($data); 
		
		$text = 'Data berhasil di simpan';
					 
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