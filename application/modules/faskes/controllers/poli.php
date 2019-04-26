<?php  

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Faskes for cloud
 *  Controller			: Poli 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Poli extends CI_Controller {
	private $c = 'poli';
 
	public function __construct(){
		parent::__construct();	
	}
	
	public function index($page=0){
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
		
		$this->load->library('pagination');
		
		// load model
		$this->load->model('PoliModel');
		$this->load->model('customer/CustomerFaskesModel');
		$this->load->model('paket/CustomerPaketModel');
		
		// get faskes_id for customer
		$filter['customer_id']	= $customer_id;
		$filter['status']		= 'E';
		
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
		$config['base_url'] 	= site_url()."faskes/poli/index/";
		$config['total_rows'] 	= $this->PoliModel->jmlhdata($filter);
		$config['per_page'] 	=  20;
		$config['first_link'] 	= '<<';
		$config['last_link'] 	= '>>';
		$config['next_link'] 	= 'Next';
		$config['prev_link'] 	= 'Prev';
		
		$this->pagination->initialize($config);
		
		$search['faskes_id']	= $filter['faskes_id'];
									
		$poli = $this->PoliModel->getlist($config['per_page'],$page,$search);
		
		// get paket customer
		$filter_customer['customer_id']	= $customer_id;
		$paket  						= $this->CustomerPaketModel->getlist(0,0,$filter_customer);
	
		// prepare data
		$data['jmlh_data']	= $this->PoliModel->jmlhdata($filter);
		$data['jmlh_item']	= $this->config->item('jmlh_item');
		$data['action'] 	= site_url().'/faskes/poli/add';
		$data['results'] 	= $poli;
		$data['paket'] 		= $paket;
		$data['file'] 		= 'poli/list';
		$data['title'] 		= 'Poliklinik';
		$data['version'] 	= $this->config->item('version');
		$data['page'] 		= $page;
		$data['c'] 			= $this->c;
		$data['subtitle'] 	= "Poliklinik";
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		
		$this->page($data);	
	}
	
	public function add (){
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
		// load config
		$this->config->load('drsiaga');
		
		$user_id 		= $this->session->userdata('user_id');
		$customer_id 	= $this->session->userdata('customer_id');
		
		// cek acl
		if( (!$this->acl->cek_acl($this->c,'add',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model
		$this->load->model('PoliModel');	
		$this->load->model('customer/CustomerFaskesModel');
		
		$filter['customer_id']		= $customer_id;
		
		$faskes = $this->CustomerFaskesModel->getlist(20,0,$filter);
		
		$this->load->helper('array_object');
		
		$faskes = object_to_array($faskes);
		
		// prepare data
		$data['results'] 	= null;
		$data['action'] 	= base_url('faskes/poli/update');
		$data['file'] 		= 'poli/form';
		$data['title'] 		= $this->config->item('app_name');
		$data['subtitle'] 	= "Add/Edit Poliklinik";
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		$data['faskes']		= $faskes;
		
		$this->page($data);		
	}
	
	public function edit($id=0){
	
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
		// load config
		$this->config->load('drsiaga');
		
		$user_id 		= $this->session->userdata('user_id');
		$customer_id 	= $this->session->userdata('customer_id');
		
		// cek acl
		if( (!$this->acl->cek_acl($this->c,'edit',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model
		$this->load->model('PoliModel');
		$this->load->model('FaskesModel');
				
		$poli = $this->PoliModel->get_by_id($id);
		
		// prepare data		
		$data['action'] 	= base_url('faskes/poli/update');
		$data['file'] 		= 'faskes/poli/form';
		$data['title'] 		= $this->config->item('app_name');
		$data['subtitle'] 	= "Add Fasilitas Kesehatan";
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		$data['results'] 	= $poli;
		
		$this->page($data);	
		
	}
	
    public function update(){
		if($this->input->post('button')=='Save'){
			$this->save();
		} else {
			$this->hapus();
		}
	
		redirect(site_url('faskes/poli'));	
    }
	
    private function save(){ 
		// load config
		$this->config->load('drsiaga');
		
		$user_id 		= $this->session->userdata('user_id');
		$customer_id 	= $this->session->userdata('customer_id');
		
		// cek acl
		if( (!$this->acl->cek_acl($this->c,'edit',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model
		$this->load->model('PoliModel');
				
		$data['poli_id'] 				= $this->input->post('poli_id');
		$data['faskes_id'] 				= $this->input->post('faskes_id');
		$data['nama_poli'] 				= $this->input->post('nama_poli');
		$data['alias'] 					= preg_replace("/[^a-zA-Z0-9]/", "-", strtolower($this->input->post('nama_poli'))); 
		$data['jam_buka_pendaftaran'] 	= $this->input->post('jam_buka_pendaftaran');
		$data['jam_tutup_pendaftaran'] 	= $this->input->post('jam_tutup_pendaftaran');
		$data['status']					= $this->input->post('status');
		
		//str_replace(' ','-',strtolower($this->input->post('nama_poli'))); 
		
		$res = $this->PoliModel->saveData($data);
		
		if($res){
			$text = 'Data telah berhasil di simpan';
		} else {
			$text = $res;
		}

		$this->session->set_flashdata('msg',$text);
	}  
	
	/*
	*	Next version data tdk bisa di hapus jika sdng di gunakan di tabel lain
	*/
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
		$this->load->model('PoliModel');
		$this->load->model('PoliDokterModel');
		$this->load->model('JadwalDokterModel');
		$this->load->model('JadwalDokterModel');
		$this->load->model('customer/CustomerFaskesModel');
		
		$customer['customer_id']	= $customer_id;
		
		// get faskes id 
		$faskes = $this->CustomerFaskesModel->getlist(0,0,$customer);
				
		$id = $this->input->post('poli_id');
		
		$delPoli = $this->PoliModel->hapus($id);
				
		if($delPoli){
			$hapus['poli_id']	= $id;
			$hapus['faskes_id']	= $faskes[0]->faskes+_id;
			
			// hapus dokter poli 
			$delDokterPoli = $this->PoliDokterModel->hapus($hapus);	
			
			if($delDokterPoli){
				// hapus jadwal dokter poli
				$delJadwal = $this->JadwalDokterModel->hapus($hapus);
				
				$text = 'Data telah berhasil di hapus';
			} else {
				$text = $delDokterPoli;
			}
			
			
			
		} else {
			$text = $delPoli;
		}
		
		$this->session->set_flashdata('msg',$text);
	}
	
	public function get_poli(){
		$this->load->model('PoliModel');
		$this->load->helper('array_object');
		
		$faskes_id 	= $this->input->get('faskes_id');
		
		$filter['faskes_id']	= $faskes_id;
		
		$res = $this->PoliModel->getlist(0,0,$filter);
		
		//$res = object_to_array($res);
		
		$i=0; 
		foreach($res as $row){
			$data['nama_poli'][$i] 	= ucwords(strtolower($res[$i]->nama_poli));
			$data['poli_id'][$i] 	= $res[$i]->poli_id;
			//$data[$i]		= array('label'=>ucwords(strtolower($res[$i]['nama_poli'])), 'poli_id'=>$res[$i]['poli_id']);
			$i++;
		}
		 
		echo json_encode($res);

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
	