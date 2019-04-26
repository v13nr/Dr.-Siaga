<?php  

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Faskes for cloud
 *  Controller			: DokterPoli 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DokterPoli extends CI_Controller {
	private $c = 'dokterpoli';
 
	public function __construct(){
		parent::__construct();	
	}
	
	public function index($page=0){
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
		// load config 
		$this->load->config('drsiaga');
		
		$user_id 		= $this->session->userdata('user_id');
		$customer_id 	= $this->session->userdata('customer_id');
		
		// cek acl
		if( (!$this->acl->cek_acl($this->c,'index',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		$this->load->library('pagination');
		
		// load model
		$this->load->model('LayananModel');
		$this->load->model('customer/CustomerFaskesModel');
		$this->load->model('paket/CustomerPaketModel');
		
		// get faskes_id for customer
		$filter['customer_id']= $customer_id;
		
		$faskes = $this->CustomerFaskesModel->getlist(0,0,$filter);
		
		if(empty($faskes)){
			$filter['faskes_id']	= 1000000;	
			$data['faskes_approved']= false;
		} else {
			if($this->session->userdata('group_id')=='11890083'){
				$filter['faskes_id']	= null;
			} else {
				$filter['faskes_id']	= $faskes[0]->faskes_id;	
			}
			$data['faskes_approved']= true;
		}		
				
		// configuration paging
		$config['base_url'] 	= site_url()."faskes/layanan/index/";
		$config['total_rows'] 	= $this->LayananModel->jmlhdata($filter);
		$config['per_page'] 	=  20;
		$config['first_link'] 	= '<<';
		$config['last_link'] 	= '>>';
		$config['next_link'] 	= 'Next';
		$config['prev_link'] 	= 'Prev';
		
		$this->pagination->initialize($config);
								
		$layanan = $this->LayananModel->getlist($config['per_page'],$page,$filter);

		// prepare data
		$data['jmlh_data']	= $this->LayananModel->jmlhdata($filter);
		$data['jmlh_item']	= $this->config->item('jmlh_item');
		$data['action'] 	= site_url().'/faskes/poli/add';
		$data['results'] 	= $layanan;
		$data['file'] 		= 'layanan/list';
		$data['title'] 		= 'Layanan';
		$data['version'] 	= $this->config->item('version');
		$data['page'] 		= $page;
		$data['c'] 			= $this->c;
		$data['subtitle'] 	= "Daftar Layanan";
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
		
		$user_id 		= $this->session->userdata('user_id');
		$customer_id 	= $this->session->userdata('customer_id');
		
		// cek acl
		if( (!$this->acl->cek_acl($this->c,'add',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model
		$this->load->model('LayananModel');	
		$this->load->model('customer/CustomerFaskesModel');
		
		$filter['customer_id']		= $customer_id;
		
		$faskes = $this->CustomerFaskesModel->getlist(20,0,$filter);
		
		$this->load->helper('array_object');
		
		$faskes = object_to_array($faskes);
	
		// prepare data
		$data['faskes'] 	= $faskes;
		$data['action'] 	= site_url().'/faskes/layanan/update';
		$data['results'] 	= null;
		$data['file'] 		= 'layanan/form';
		$data['title'] 		= $this->config->item('app_name');
		$data['subtitle'] 	= "Add/Edit Layanan Faskes";
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		
		$this->page($data);		
	}
	
	public function edit($id=0){
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
		// load config 
		$this->load->config('drsiaga');
		
		$user_id 		= $this->session->userdata('user_id');
		$customer_id 	= $this->session->userdata('customer_id');
		
		// cek acl
		if( (!$this->acl->cek_acl($this->c,'add',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model
		$this->load->model('LayananModel');	

				
		$layanan = $this->LayananModel->get_by_id($id);
		
		// prepare data
		$data['action'] 	= base_url('faskes/layanan/update');		
		$data['file'] 		= 'faskes/layanan/form';
		$data['title'] 		= $this->config->item('app_name');
		$data['subtitle'] 	= "Add/Edit Layanan Faskes";
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		$data['results'] 	= $layanan;
		
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
	
		redirect(site_url('faskes/layanan'));	
    }
	
    private function save(){ 
		// load config 
		$this->load->config('drsiaga');
		
		$user_id 		= $this->session->userdata('user_id');
		
		// cek acl
		if( (!$this->acl->cek_acl($this->c,'edit',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model
		$this->load->model('LayananModel');
		
		$data['layanan_id'] 	= $this->input->post('layanan_id');
		$data['faskes_id'] 		= $this->input->post('faskes_id');
		$data['nama_layanan'] 	= $this->input->post('nama_layanan');
		$data['harga_min'] 		= $this->input->post('harga_min');		

		$res = $this->LayananModel->saveData($data);
		
		if($res){
			$text = 'Data telah berhasil di simpan';
		} else {
			$text = $res;
		}

		$this->session->set_flashdata('msg',$text);
	}  
	
	private function hapus($id=0){
		// load config
		$this->config->load('drsiaga');
		
		$user_id 		= $this->session->userdata('user_id');
		$customer_id 	= $this->session->userdata('customer_id');
		
		// cek acl
		if( (!$this->acl->cek_acl($this->c,'hapus',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model
		$this->load->model('LayananModel');
		
		$id = $this->input->post('layanan_id');

		$res = $this->LayananModel->hapus($id);

		if($res){
			$text = 'Data telah berhasil di hapus';
		} else {
			$text = $res;
		}
		
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
	