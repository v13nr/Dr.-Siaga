<?php  

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Faskes for cloud
 *  Controller			: Jadwal 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jadwal extends CI_Controller {
	private $c = 'jadwal';
 
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
		$group_id 		= $this->session->userdata('group_id');
		$customer_id 	= $this->session->userdata('customer_id');
		
		// cek acl
		if( (!$this->acl->cek_acl($this->c,'index',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		$this->load->library('pagination');
		
		// load model
		$this->load->model('JadwalDokterModel');
		$this->load->model('customer/CustomerFaskesModel');
		$this->load->model('faskes/FaskesModel');
		
		$this->load->helper('array_object');
		
		// get faskes_id for customer
		$filter['customer_id']= $customer_id;
			
		// get faskes id based on customer id
		$faskes = $this->CustomerFaskesModel->getlist(20,0,$filter);
		$faskes = object_to_array($faskes);
		
		if(empty($faskes) AND empty($customer_id)){
			// jika bukan customer
			$data['faskes_approved']= false;
			$jadwal['faskes_id']	= 0;
			
			$faskes = $this->FaskesModel->getlist(20,0,$filter);
			$faskes = object_to_array($faskes);
		} else if((empty($faskes) AND count($customer_id) > 0)){
			// jika customer tp belum aktif
			$jadwal['faskes_id']	= 1000000;
			$data['faskes_approved']= false;
		} else {
			// jika customer 
			$data['faskes_approved']= true;
			$jadwal['faskes_id']	= $faskes[0]['faskes_id'];			
		}
				
		// configuration paging
		$config['base_url'] 	= site_url()."faskes/dokterpoli/index/";
		$config['total_rows'] 	= $this->JadwalDokterModel->jmlhdata($filter);
		$config['per_page'] 	=  20;
		$config['first_link'] 	= '<<';
		$config['last_link'] 	= '>>';
		$config['next_link'] 	= 'Next';
		$config['prev_link'] 	= 'Prev';
		
		$this->pagination->initialize($config);
		
		// get jadwal
		$jadwal = $this->JadwalDokterModel->getlist($config['per_page'],$page,$jadwal);
		
		// prepare data
		$data['jmlh_data']	= $this->JadwalDokterModel->jmlhdata($filter);
		$data['jmlh_item']	= $this->config->item('jmlh_item');
		$data['action'] 	= site_url().'/faskes/jadwal/add';
		$data['results'] 	= $jadwal;
		$data['file'] 		= 'jadwal/list';
		$data['title'] 		= $this->config->item('app_name');
		$data['version'] 	= $this->config->item('version');
		$data['page'] 		= $page;
		$data['c'] 			= $this->c;
		$data['subtitle'] 	= "Daftar Jadwal Dokter";
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
		$group_id 		= $this->session->userdata('group_id');
		$customer_id 	= $this->session->userdata('customer_id');
		
		// cek acl
		if( (!$this->acl->cek_acl($this->c,'add',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model
		$this->load->model('PoliDokterModel');	
		$this->load->model('PoliModel');
		$this->load->model('customer/CustomerFaskesModel');
		$this->load->model('doctor/DoctorModel');
		$this->load->model('faskes/FaskesModel');
		
		$this->load->helper('array_object');
		
		$filter['customer_id']		= $customer_id;
		
		// get faskes id based on customer id
		$faskes = $this->CustomerFaskesModel->getlist(20,0,$filter);
		$faskes = object_to_array($faskes);
		
		if(empty($faskes)){
			// jika bukan customer
			$data['faskes_approved']= false;
			$poli		= null;
			
			$faskes = $this->FaskesModel->getlist(20,0,$filter);
			$faskes = object_to_array($faskes);
		} else {
			// jika customer 
			$data['faskes_approved']= true;
			$fpoli['faskes_id']		= $faskes[0]['faskes_id'];
			
			// get poli based on faskes 
			$poli 	= $this->PoliModel->getlist(20,0,$fpoli);
			
			$poli 	= object_to_array($poli);			
		}
				
		if($group_id=='11890083'){
			$file = 'jadwal/form_sa';
		} else {
			$file = 'jadwal/form';
		}
		//print_r($faskes); exit;		
		// prepare data
		$data['faskes'] 	= $faskes;
		$data['poli'] 		= $poli;
		$data['action'] 	= site_url().'/faskes/jadwal/update';
		$data['results'] 	= null;
		$data['file'] 		= $file;
		$data['title'] 		= $this->config->item('app_name');
		$data['subtitle'] 	= "Add Jadwal Dokter";
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		
		$this->page($data);		
	}
	
	public function edit(){
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
		// load config 
		$this->load->config('drsiaga');
		
		$user_id 		= $this->session->userdata('user_id');
		$customer_id 	= $this->session->userdata('customer_id');
		$group_id		= $this->session->userdata('group_id');
		
		// cek acl
		if( (!$this->acl->cek_acl($this->c,'edit',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model
		$this->load->model('JadwalDokterModel');	
		$this->load->model('FaskesModel');
		$this->load->model('PoliModel');
		$this->load->model('customer/CustomerFaskesModel');
		
		$ffaskes['customer_id']		= $customer_id;
		
		// get faskes id based on customer id
		$faskes = $this->CustomerFaskesModel->getlist(20,0,$ffaskes);
		
		$this->load->helper('array_object');
		
		$faskes = object_to_array($faskes);
			
		if(empty($faskes)){
			// jika bukan customer
			$data['faskes_approved']= false;
			$fpoli['faskes_id']		= 0;	
			
			$faskes = $this->FaskesModel->getlist(20,0,$ffaskes);
			$faskes = object_to_array($faskes);
		} else {
			// jika customer 
			$data['faskes_approved']= true;
			$fpoli['faskes_id']		= $faskes[0]['faskes_id'];	
		}
				
		// get poli based on faskes 
		$poli 	= $this->PoliModel->getlist(0,0,$fpoli);
		
		$poli 	= object_to_array($poli);
		//print_r($poli); exit;
		$filter['jadwal_id'] 	= $this->uri->segment(4);
				
		$jadwal = $this->JadwalDokterModel->getlist(0,0,$filter);
		
		$jadwal = object_to_array($jadwal);
		
		if($group_id=='11890083'){
			$file = 'jadwal/form_edit_sa';
		} else {
			$file = 'jadwal/form_edit';
		}
				
		// prepare data
		$data['action'] 	= base_url('faskes/jadwal/update');		
		$data['file'] 		= $file;
		$data['title'] 		= $this->config->item('app_name');
		$data['subtitle'] 	= "Edit Jadwal Dokter";
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		$data['results'] 	= $jadwal;
		$data['poli'] 		= $poli;
		$data['faskes'] 	= $faskes;
		
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
	
		redirect(site_url('faskes/jadwal'));	
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
		$this->load->model('JadwalDokterModel');
		$this->load->helper('waktu');
		
		$data['jadwal_id'] 			= $this->input->post('jadwal_id');
		$data['dokter_id'] 			= $this->input->post('dokter_id');
		$data['faskes_id'] 			= $this->input->post('faskes_id');
		$data['poli_id'] 			= $this->input->post('poli_id');
		$data['spesialis_id'] 		= $this->input->post('spesialis_id');
		$data['last_updated'] 		= date('Y-m-d H:i:s');
		
		$hari 						= $this->input->post('hari');		
		$jam_mulai 					= $this->input->post('jam_mulai');
		$jam_selesai 				= $this->input->post('jam_selesai');
		$ket 						= $this->input->post('ket');
		
		for($i=0; $i < count($hari); $i++){
			
			$data['hari'] 			= $hari[$i];
			$data['jam_mulai'] 		= $jam_mulai[$i];
			$data['jam_selesai'] 	= $jam_selesai[$i];		
			$data['ket'] 			= $ket[$i];				
			
			$res = $this->JadwalDokterModel->saveData($data);
		}
			
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
		
		// cek acl
		if( (!$this->acl->cek_acl($this->c,'hapus',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model
		$this->load->model('JadwalDokterModel');
		
		$jadwal_id 	= explode(",",$this->input->post('jadwal'));
	
		$this->JadwalDokterModel->hapus($jadwal_id);
		
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
	