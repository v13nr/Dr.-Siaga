<?php  

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Paket for cloud
 *  Controller			: Paket 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
*	Controller untuk Peket
*	Khusus untuk superadmin
*/

class Paket extends CI_Controller {
	private $c = 'paket';
 
	public function __construct(){
		parent::__construct();	
	}
	 
    function index($page=0){ 
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
		// load config 
		$this->load->config('drsiaga');
		
		$user_id 	= $this->session->userdata('user_id');
		$group_id 	= $this->session->userdata('group_id');
	
		// only super admin can access this page 
		if($group_id != '11890083'){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
						
		// load model
		$this->load->model('PaketModel');
						
		$paket = $this->PaketModel->getlist();

		// prepare data
		$data['jmlh_data']	= $this->PaketModel->jmlhdata();
		$data['jmlh_item']	= $this->config->item('jmlh_item');
		$data['action'] 	= site_url().'paket/add';
		$data['results'] 	= $paket;
		$data['file'] 		= 'paket/paket/list';
		$data['title'] 		= $this->config->item('app_name');;
		$data['version'] 	= $this->config->item('version');
		$data['c'] 			= $this->c;
		$data['subtitle'] 	= "Daftar Paket";
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		$data['page'] 		= $page;
		
		$this->page($data);
		
    }
	
	public function add(){
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
		// load config 
		$this->load->config('drsiaga');
		
		$user_id 	= $this->session->userdata('user_id');
		$group_id 	= $this->session->userdata('group_id');
	
		// only super admin can access this page 
		if($group_id != '11890083'){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
				
		// prepare data
		$data['file'] 		= 'paket/paket/form';
		$data['action'] 	= site_url().'paket/update';
		$data['title'] 		= $this->config->item('app_name');
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		$data['results'] 	= null;
		$data['subtitle'] 	= "Add / Edit Paket";
	
		$this->page($data); 		
		
	}
	
	
	public function edit($id=0){
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
	
		// load config 
		$this->load->config('drsiaga');
		
		$user_id 	= $this->session->userdata('user_id');
		$group_id 	= $this->session->userdata('group_id');
	
		// only super admin can access this page 
		if($group_id != '11890083'){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model
		$this->load->model('PaketModel');
		
		$paket = $this->PaketModel->get_by_id($id);
		
		// prepare data
		$data['action'] 	= base_url('paket/update');
		$data['results'] 	= $paket;
		$data['file'] 		= 'paket/paket/form';
		$data['title'] 		= $this->config->item('app_name');
		$data['version'] 	= $this->config->item('version');
		$data['subtitle'] 	= "Add / Edit Paket";
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		
		$this->page($data); 
	}
	
    public function update(){
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
		if($this->input->post('button')=='Save'){
			if($this->input->post('id')){
				$data['updatetype'] = "edit";
			} else {
				$data['updatetype'] = "new";
			}
			$this->save();
		} else {
			$this->hapus();
		}
		
		redirect('paket');	
    }
	
    private function save(){ 
		// load config 
		$this->load->config('drsiaga');
		
		$user_id 	= $this->session->userdata('user_id');
		$group_id 	= $this->session->userdata('group_id');
	
		// only super admin can access this page 
		if($group_id != '11890083'){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model
		$this->load->model('PaketModel');
		
		$data['paket_id'] 			= $this->input->post('paket_id');
		$data['nama_paket'] 		= $this->input->post('nama_paket');
		$data['harga']				=  str_replace('.','',$this->input->post('harga'));
		$data['max_jmlh_faskes']	= $this->input->post('max_jmlh_faskes');
		$data['max_jmlh_poli']		= $this->input->post('max_jmlh_poli');
		$data['max_jmlh_dokter'] 	= $this->input->post('max_jmlh_dokter');
		$data['max_jmlh_bot'] 		= $this->input->post('max_jmlh_bot');
		$data['max_jmlh_user'] 		= $this->input->post('max_jmlh_user');
		$data['durasi_trial'] 		= $this->input->post('durasi_trial');	
		
		$this->PaketModel->saveData($data); 
		
		$text = 'Data berhasil di simpan';
					 
		$this->session->set_flashdata('msg',$text);
	}
	
	private function hapus($id=0){
		
		// load config 
		$this->load->config('drsiaga');
		
		$user_id 	= $this->session->userdata('user_id');
		$group_id 	= $this->session->userdata('group_id');
	
		// only super admin can access this page 
		if($group_id != '11890083'){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model
		$this->load->model('PaketModel');
		
		$id = $this->input->post('id');

		for($i=0; $i < count($id); $i++){
			$this->PaketModel->hapus($id[$i]);
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

?>