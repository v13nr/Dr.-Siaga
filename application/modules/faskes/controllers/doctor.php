<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Doctor for cloud
 *  Controller			: Doctor 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Doctor extends CI_Controller {
	private $c = 'doctor';

	public function __construct(){
		parent::__construct();	
	}
		
	public function index($page=0){
		if( (!$this->session->userdata('logged_in')) ){
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
		
		// load model
		$this->load->model('faskes/PoliDokterModel');
		$this->load->model('paket/CustomerPaketModel');
		$this->load->model('customer/CustomerFaskesModel');
		
		$this->load->library('pagination');
		
		$filter['customer_id'] = $customer_id;
		
		// get faskes_id for customer
		$faskes = $this->CustomerFaskesModel->getlist(0,0,$filter);
		
		if(empty($faskes)){
			$filter['faskes_id']	= 1000000;	
		} else {
			$filter['faskes_id']	= $faskes[0]->faskes_id;		
		}
		
		// configuration paging
		$config['base_url'] 	= site_url()."doctor/index/";
		$config['total_rows'] 	= $this->PoliDokterModel->jmlhdata($filter);
		$config['per_page'] 	=  20;
		$config['first_link'] 	= '<<';
		$config['last_link'] 	= '>>';
		$config['next_link'] 	= 'Next';
		$config['prev_link'] 	= 'Prev';
		
		$this->pagination->initialize($config);
	
		$dokter = $this->PoliDokterModel->getlist(20,0,$filter);
				
		// get paket customer
		$filter_customer['customer_id']	= $customer_id;
		$paket  						= $this->CustomerPaketModel->getlist(0,0,$filter_customer);
		
		// prepare data
		$data['jmlh_data']		= $this->PoliDokterModel->jmlhdata($filter);
		$data['jmlh_item']		= $this->config->item('jmlh_item');
		$data['action'] 		= site_url()."/doctor";
		$data['file'] 			= 'dokter/list';
		$data['title'] 			= $this->config->item('app_name');
		$data['subtitle'] 		= "Daftar dokter";
		$data['version'] 		= $this->config->item('version');
		$data['keyword'] 		= null;
		$data['desc'] 			= null;
		$data['results'] 		= $dokter;
		$data['paket'] 			= $paket;
		$data['page'] 			= $page;
		
		$this->page($data);
	}
		
	public function edit(){
		$user_id 	= $this->session->userdata('user_id');
		$group_id 	= $this->session->userdata('group_id');
			
		// cek acl
		if(!$this->acl->cek_acl($this->c,'edit',$user_id)){
			$text = '<div class="notification warning no-margin"> <span class="strong">Warning!</span> You dont have authorizate to access USER page. </div><p></p>';
			$this->session->set_flashdata('msg',$text);
			redirect('dashboard/index');
		}		
		
		// load model
		$this->load->model('SpesialisModel');
		$this->load->model('KabkotModel');
		$this->load->model('doctor/DoctorModel');
		
		$id		= $this->uri->segment(3);
		
		// prepare data
		$data['action'] 		= site_url()."/doctor";
		$data['file'] 			= 'dokter/form';
		$data['title'] 			= $this->config->item('app_name');
		$data['version'] 		= $this->config->item('version');
		$data['keyword'] 		= $this->config->item('keyword');
		$data['desc'] 			= $this->config->item('desc');
		$data['list_spesialis'] = $this->SpesialisModel->getlist(0,0);
		$data['list_kabot'] 	= $this->KabkotModel->getlist(0,0);
		$data['results'] 		= $this->DoctorModel->get_by_id($id);
		$data['subtitle'] 		= "User Profile";
		
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
	
		$group_id = $this->session->userdata('group_id');
		
		if($group_id=='11890083'){
			$url = 'doctor';
		} else {
			$url = 'faskes/dokterpoli';
		}
		
		redirect($url);	
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
		$this->load->model('DoctorModel');
		$this->load->helper('waktu');
		
		$data['id']		 			= $this->input->post('dokter_id');
		$data['gelar'] 				= $this->input->post('gelar');
		$data['nama_dokter'] 		= $this->input->post('nama_dokter');
		$data['gelar_depan'] 		= $this->input->post('gelar_depan');
		$data['gelar_belakang'] 	= $this->input->post('gelar_belakang');
		$data['gender'] 			= $this->input->post('gender');	
		$data['npa'] 				= $this->input->post('npa');	
		$data['nmr_str'] 			= $this->input->post('nmr_str');
		$data['tgl_expired_str'] 	= waktu($this->input->post('tgl_expired_str'),'indo','eng');
		$data['spesialis_id'] 		= $this->input->post('spesialis_id');		
		$data['thn_lulus'] 			= $this->input->post('thn_lulus');	
		$data['universitas'] 		= $this->input->post('universitas');		
		
		$res = $this->DoctorModel->saveData($data);
		
		if($res){
			$text = 'Data telah berhasil di simpan';
		} else {
			$text = $res;
		}

		$this->session->set_flashdata('msg',$text);
	}  		
		
	private function hapus(){
		// load model
		$this->load->model('DoctorModel');
		
		$id = $this->input->post('id');

		for($i=0; $i < count($id); $i++){
			$this->DoctorModel->hapus($id[$i]);
		}

		$text = '<div class="notification info nopic">Data telah berhasil di hapus. </div>';
		$this->session->set_flashdata('msg',$text);		
		
	}			
	
	public function list_doctor(){
		$this->load->model('DoctorModel');
		
		//get search term
		$searchTerm = $_GET['term'];

		// get list dokter
		$res = $this->DoctorModel->list_dokter($searchTerm);
		
		for($i=0; $i < count($res); $i++){
			$data[$i]		= array('label'=>$res[$i]['gelar_depan']." ".$res[$i]['gelar']." ".$res[$i]['nama_dokter']." ".$res[$i]['gelar_belakang']." ".$res[$i]['title'], 'id_dokter'=>$res[$i]['id'], 'spesialis_id'=>$res[$i]['spesialis_id']);			
		}
			
		echo json_encode($data);		
		
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

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */