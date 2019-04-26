<?php  

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Faskes for cloud
 *  Controller			: Faskes 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faskes extends CI_Controller {
	private $c = 'faskes';
 
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
		
		// only super admin can access this page 
		if($group_id != '11890083'){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		$this->load->library('pagination');
		//$this->load->helper('array_object');
		
		$this->load->model('FaskesModel');
		
		$filter['tipe'] = null;
				
		// configuration paging
		$config['base_url'] 	= site_url()."faskes/index/";
		$config['total_rows'] 	= $this->FaskesModel->jmlhdata($filter);
		$config['per_page'] 	=  20;
		$config['first_link'] 	= '<<';
		$config['last_link'] 	= '>>';
		$config['next_link'] 	= 'Next';
		$config['prev_link'] 	= 'Prev';
		
		$this->pagination->initialize($config);
		
		$faskes = $this->FaskesModel->getlist($config['per_page'],$page,$filter);
		//object_to_array($faskes);
		
		// prepare data
		$data['jmlh_data']	= $this->FaskesModel->jmlhdata($filter);
		$data['per_page']	= 20;
		$data['action'] 	= site_url().'faskes/add';
		$data['results'] 	= $faskes;
		$data['file'] 		= 'faskes/faskes/list';
		$data['title'] 		= $this->config->item('app_name');
		$data['version'] 	= $this->config->item('version');
		$data['page'] 		= $page;
		$data['c'] 			= $this->c;
		$data['subtitle'] 	= "Master Data Fasilitas Kesehatan";
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
		
		$user_id 	= $this->session->userdata('user_id');
		$group_id 	= $this->session->userdata('group_id');
		
		// only super admin can access this page 
		if($group_id != '11890083'){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
			
		// prepare data
		$data['results'] 	= null;
		$data['file'] 		= 'faskes/faskes/form';
		$data['action'] 	= site_url('faskes/update');
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
		
		$user_id 	= $this->session->userdata('user_id');
		$group_id 	= $this->session->userdata('group_id');
		
		// only super admin can access this page 
		if($group_id != '11890083'){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		$this->load->model('FaskesModel');
		
		$filter['faskes_id']	= $this->uri->segment(3);
		
		$faskes = $this->FaskesModel->getlist(20,0,$filter);
			
		// prepare data
		$data['results'] 	= $faskes;
		$data['file'] 		= 'faskes/faskes/form_edit';
		$data['action'] 	= site_url('faskes/update');
		$data['title'] 		= $this->config->item('app_name');
		$data['subtitle'] 	= "Add/Edit Faskes";
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
		
		$group_id = $this->session->userdata('group_id');
		
		if($group_id=='11890083'){
			$url = 'faskes';
		} else {
			$url = 'customer/customerfaskes';
		}
		
		redirect($url);	
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
		$this->load->model('FaskesModel');
		
		$data['faskes_id'] 			= $this->input->post('faskes_id');
		$data['nama_faskes'] 		= $this->input->post('nama_faskes');
		$data['desc'] 				= $this->input->post('desc');
		$data['alamat'] 			= $this->input->post('alamat');
		$data['id_kabkot'] 			= $this->input->post('id_kabkot');
		$data['id_prov'] 			= $this->input->post('id_prov');
		$data['tlp'] 				= $this->input->post('tlp');
		$data['tlp_ugd'] 			= $this->input->post('tlp_ugd');		
		$data['email'] 				= $this->input->post('email');
		$data['website'] 			= $this->input->post('website');
		$data['fb'] 				= $this->input->post('fb');
		$data['twitter'] 			= $this->input->post('twitter');		
		$data['bpjs'] 				= $this->input->post('bpjs');
		$data['latitude'] 			= $this->input->post('latitude');
		$data['longitude'] 			= $this->input->post('longitude');
		$data['tipe'] 				= $this->input->post('tipe');		
		
		
		$res = $this->FaskesModel->saveData($data);
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
		$this->load->model('RuleModel');
		
		$id = $this->input->post('id');

		for($i=0; $i < count($id); $i++){
			$this->RuleModel->hapus($id[$i]);
		}

		$text = 'Data berhasil di hapus';
		$this->session->set_flashdata('msg',$text);
	}
	
	public function get_faskes(){
		$this->load->model('FaskesModel');
		$this->load->helper('array_object');
		
		$tipe_faskes 	= $this->input->get('tipe_faskes');
		
		$filter['tipe']		= $tipe_faskes;
		
		$res = $this->FaskesModel->getlist(0,0,$filter);
		
		$res = object_to_array($res);
		
		for($i=0; $i < count($res); $i++){
			$data[$i]		= array('label'=>ucwords(strtolower($res[$i]['nama_faskes'])), 'faskes_id'=>$res[$i]['faskes_id'], 'kota'=>ucwords(strtolower($res[$i]['nama_kabkot'])).", ".ucwords(strtolower($res[$i]['nama_prov'])));
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
	