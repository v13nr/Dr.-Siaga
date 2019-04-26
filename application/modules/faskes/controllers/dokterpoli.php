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
		$this->load->model('PoliDokterModel');
		$this->load->model('customer/CustomerFaskesModel');
		$this->load->model('paket/CustomerPaketModel');
		
		// get faskes_id for customer
		$filter['customer_id']= $customer_id;
		
		$faskes = $this->CustomerFaskesModel->getlist(0,0,$filter);
		
		if(empty($faskes)){
			$search['faskes_id']	= 1000000;	
			$data['faskes_approved']= false;
		} else {
			if($this->session->userdata('group_id')=='11890083'){
				$search['faskes_id']	= null;
			} else {
				$search['faskes_id']	= $faskes[0]->faskes_id;	
			}
			$data['faskes_approved']= true;
		}		
				
		// configuration paging
		$config['base_url'] 	= site_url()."faskes/dokterpoli/index/";
		$config['total_rows'] 	= $this->PoliDokterModel->jmlhdata($filter);
		$config['per_page'] 	=  20;
		$config['first_link'] 	= '<<';
		$config['last_link'] 	= '>>';
		$config['next_link'] 	= 'Next';
		$config['prev_link'] 	= 'Prev';
		
		$this->pagination->initialize($config);
										
		$dokterpoli = $this->PoliDokterModel->getlist($config['per_page'],$page,$search);
		
		// get paket customer
		$filter_customer['customer_id']	= $customer_id;
		$paket  						= $this->CustomerPaketModel->getlist(0,0,$filter_customer);

		// prepare data
		$data['jmlh_data']	= $this->PoliDokterModel->jmlhdata($filter);
		$data['jmlh_item']	= $this->config->item('jmlh_item');
		$data['action'] 	= site_url().'/faskes/dokterpoli/add';
		$data['results'] 	= $dokterpoli;
		$data['file'] 		= 'dokterpoli/list';
		$data['title'] 		= 'Layanan';
		$data['version'] 	= $this->config->item('version');
		$data['page'] 		= $page;
		$data['paket'] 		= $paket;
		$data['c'] 			= $this->c;
		$data['subtitle'] 	= "Daftar Dokter Poliklinik";
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
		$this->load->model('PoliDokterModel');	
		$this->load->model('PoliModel');
		$this->load->model('customer/CustomerFaskesModel');
		$this->load->model('doctor/DoctorModel');
		
		$filter['customer_id']		= $customer_id;
		
		// get faskes id based on customer id
		$faskes = $this->CustomerFaskesModel->getlist(20,0,$filter);
		
		$this->load->helper('array_object');
		
		$faskes = object_to_array($faskes);
		
		$search['faskes_id']	= $faskes[0]['faskes_id'];
		
		$poli 	= $this->PoliModel->getlist(20,0,$search);
		
		$poli 	= object_to_array($poli);
				
		// prepare data
		$data['faskes'] 	= $faskes;
		$data['action'] 	= site_url().'/faskes/dokterpoli/update';
		$data['results'] 	= null;
		$data['file'] 		= 'dokterpoli/form';
		$data['title'] 		= $this->config->item('app_name');
		$data['subtitle'] 	= "Add/Edit Dokter Poliklinik";
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		$data['poli'] 		= $poli;
		
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
		
		$x['customer_id']		= $customer_id;
		
		// get faskes id based on customer id
		$faskes = $this->CustomerFaskesModel->getlist(20,0,$x);
		
		$this->load->helper('array_object');
		
		$faskes = object_to_array($faskes);
		
		$filter['faskes_id'] 	= $this->uri->segment(4);
		$filter['poli_id']		= $this->uri->segment(5);
		$filter['dokter_id']	= $this->uri->segment(6);
				
		$dokterpoli = $this->PoliDokterModel->getlist(0,0,$filter);
		
		$this->load->helper('array_object');
		
		$dokterpoli = object_to_array($dokterpoli);
		
		$search['faskes_id']	= $faskes[0]['faskes_id'];
		
		$poli 	= $this->PoliModel->getlist(20,0,$search);
		
		$poli 	= object_to_array($poli);
		
		// get profile dokter 
		$dokter = $this->DoctorModel->get_by_id($filter['dokter_id']);
		
		// prepare data
		$data['action'] 	= base_url('faskes/dokterpoli/update');		
		$data['file'] 		= 'faskes/dokterpoli/form_edit';
		$data['title'] 		= $this->config->item('app_name');
		$data['subtitle'] 	= "Add/Edit Dokter Poliklinik";
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		$data['results'] 	= $dokterpoli;
		$data['poli'] 		= $poli;
		$data['dokter'] 	= $dokter;
		
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
	
		redirect(site_url('faskes/dokterpoli'));	
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
		$this->load->model('PoliDokterModel');
		$this->load->helper('waktu');
		
		$mode 						= $this->input->post('mode');
		$data['dokter_id'] 			= $this->input->post('dokter_id');
		$data['spesialis_id'] 		= $this->input->post('spesialis_id');
		$data['faskes_id'] 			= $this->input->post('faskes_id');
		$data['poli_id'] 			= $this->input->post('poli_id');
		$data['nmr_sip'] 			= $this->input->post('nmr_sip');		
		$data['tgl_expired_sip'] 	= waktu($this->input->post('tgl_expired_sip'),'indo','eng','-','-','N');		
		
		$res = $this->PoliDokterModel->saveData($data,$mode);
		
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
		$this->load->model('PoliDokterModel');
		
		$data['faskes_id'] 	= $this->input->post('faskes_id');
		$data['poli_id'] 	= $this->input->post('poli_id');
		$data['dokter_id'] 	= $this->input->post('dokter_id');

		$res = $this->PoliDokterModel->hapus($data);

		if($res){
			$text = 'Data telah berhasil di hapus';
		} else {
			$text = $res;
		}
		
		$this->session->set_flashdata('msg',$text);
	}
	
	public function list_dokter_poli(){
		/*if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}*/
		
		$this->load->model('PoliDokterModel');
		
		//get search term
		$searchTerm = $_GET['term'];
		//$searchTerm = 'julia';
		$faskes_id	= $this->uri->segment(4);
		$poli_id 	= $this->uri->segment(5);
		

		// get list dokter
		$res = $this->PoliDokterModel->list_dokter_poli($searchTerm,$faskes_id,$poli_id);
		
		for($i=0; $i < count($res); $i++){
			$data[$i]		= array('label'=>$res[$i]['gelar_depan']." ".$res[$i]['gelar']." ".ucwords(strtolower($res[$i]['nama_dokter']))." ".$res[$i]['gelar_belakang']." ".$res[$i]['title'], 'dokter_id'=>$res[$i]['id'], 'spesialis_id'=>$res[$i]['spesialis_id']);			
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

?>
	