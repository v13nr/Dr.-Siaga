<?php  

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Customer for cloud
 *  Controller			: CustomerFaskes 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CustomerFaskes extends CI_Controller {
	private $c = 'customerfaskes';
 
	public function __construct(){
		parent::__construct();	
	}
	
	public function index($page=0)
	{
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
		// load model & config
		$this->load->config('drsiaga');
		
		$user_id 		= $this->session->userdata('user_id');
		$group_id 		= $this->session->userdata('group_id');
		$customer_id 	= $this->session->userdata('customer_id');
		
		// cek acl
		if( (!$this->acl->cek_acl($this->c,'index',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		$this->load->library('pagination');
		
		$this->load->model('paket/CustomerPaketModel');
		$this->load->model('customer/CustomerFaskesModel');
						
		if($group_id=='11890083'){
			//superadmin
			$filter['customer_id']	= null;
		} else if($group_id=='11890091') {
			//admin faskes 			
			$filter['customer_id']	= $customer_id;
		}
		
		if(empty($this->input->post('search'))){
			$search = null;
		} else {
			$filter['search'] = $search['search'] = $this->input->post('search');
		}
		
		$faskes = $this->CustomerFaskesModel->getlist(20,$page,$filter);
		
		// get paket customer
		$filter_customer['customer_id']	= $customer_id;
		$paket  						= $this->CustomerPaketModel->getlist(0,0,$filter_customer);
		
		// configuration paging
		$config['base_url'] 	= site_url()."faskes/index/";
		$config['total_rows'] 	= count($faskes);
		$config['per_page'] 	=  20;
		$config['first_link'] 	= '<<';
		$config['last_link'] 	= '>>';
		$config['next_link'] 	= 'Next';
		$config['prev_link'] 	= 'Prev';
		
		$this->pagination->initialize($config);
		
		// prepare data
		$data['jmlh_data']	= count($faskes);
		$data['jmlh_item']	= $this->config->item('jmlh_item');
		$data['action'] 	= site_url().'customer/customerfaskes/add';
		$data['results'] 	= $faskes;
		$data['paket'] 		= $paket;
		$data['file'] 		= 'customer/faskes/list';
		$data['title'] 		= 'Fasilitas Kesehatan';
		$data['version'] 	= $this->config->item('version');
		$data['page'] 		= $page;
		$data['c'] 			= $this->c;
		$data['subtitle'] 	= "Fasilitas Kesehatan";
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		
		$this->page($data);
	}
	
	public function add (){
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
		// load config 
		$this->load->config('drsiaga');
		
		$user_id = $this->session->userdata('user_id');
		
		// cek acl
		if( (!$this->acl->cek_acl($this->c,'add',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
			
		// prepare data
		$data['results'] 	= null;
		$data['file'] 		= 'customer/faskes/form';
		$data['action'] 	= site_url('customer/customerfaskes/update');
		$data['title'] 		= $this->config->item('app_name');
		$data['subtitle'] 	= "Add/Edit Faskes";
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		
		$this->page($data);		
	}
	
	public function edit (){
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
		// load config 
		$this->load->config('drsiaga');
		
		$user_id = $this->session->userdata('user_id');
		
		// cek acl
		if( (!$this->acl->cek_acl($this->c,'edit',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		$this->load->model('faskes/FaskesModel');
		$this->load->model('customer/CustomerFaskesModel');
		
		if( !empty( $this->uri->segment(4) ) ){
			$filter['faskes_id']	= $this->uri->segment(4);
			
			/* next, hanya user yang bersangkutan yg dapat melihat data faskes */
			$faskes = $this->FaskesModel->getlist(20,0,$filter);
		} else {
			$faskes	= null;
			$filter['faskes_id']	= 1000000;
		}
		
		$this->load->helper('array_object');
		
		$faskes = object_to_array($faskes);
		
		// get info customer faskes
		$customerfaskes = $this->CustomerFaskesModel->getlist(20,0,$filter);
		
		$customerfaskes = object_to_array($customerfaskes);

		// prepare data
		$data['results'] 		= $faskes;
		$data['file'] 			= 'customer/faskes/form_edit';
		$data['action'] 		= site_url('faskes/update');
		$data['title'] 			= $this->config->item('app_name');
		$data['subtitle'] 		= "Add/Edit Faskes";
		$data['version'] 		= $this->config->item('version');
		$data['keyword'] 		= null;
		$data['desc'] 			= null;
		$data['customerfaskes'] = $customerfaskes;
		
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
		
		redirect('customer/customerfaskes');	
    }
	
    private function save(){ 
		// load config 
		$this->load->config('drsiaga');
		
		$user_id = $this->session->userdata('user_id');
		
		// cek acl
		if( (!$this->acl->cek_acl($this->c,'edit',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model
		$this->load->model('customer/CustomerFaskesModel');
		$this->load->helper('waktu');

		$mode		 				= $this->input->post('mode');
		$data['customer_id'] 		= $this->session->userdata('customer_id');
		$data['faskes_id'] 			= $this->input->post('faskes_id');
		$data['nmr_izin'] 			= $this->input->post('nmr_izin');
		$data['tgl_expired_izin'] 	= waktu($this->input->post('tgl_expired_izin'),'indo','eng','-','-','N');
		
		$res = $this->CustomerFaskesModel->saveData($data,$mode);
		
		$text = 'Data berhasil di simpan';

		$this->session->set_flashdata('msg',$text);
	}  
	
	private function hapus(){
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
		$this->load->model('customer/CustomerFaskesModel');
		
		$id = $this->input->post('faskes_id');
		
		$this->CustomerFaskesModel->hapus($id);

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

?>
	