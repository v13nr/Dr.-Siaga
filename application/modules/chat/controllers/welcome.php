<?php  

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Chat for cloud
 *  Controller			: Welcome 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	private $c = 'welcome';
 
	public function __construct(){
		parent::__construct();	
	}
	
	public function index($page=0){
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		

	}
		
	public function edit($id=0){
	
		$user_id = $this->session->userdata('user_id');
		
		// cek acl
		/*if(!$this->acl->cek_acl($this->c,'edit',$user_id)){
			$text = '<div class="notification warning no-margin"> <span class="strong">Warning!</span> You dont have authorizate to access RULE page. </div><p></p>';
			$this->session->set_flashdata('msg',$text);
			redirect('dashboard/index');
		}*/
		
		// load model
		$this->load->config('drsiaga');
				
		// prepare data	
		$data['file'] 		= 'chat/bot/welcome_message';
		$data['title'] 		= 'Struktur Bot';
		$data['subtitle'] 	= "Struktur Bot";
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		$data['results'] 	= null;
		
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
		// load model
		$this->load->model('PoliModel');
		
		$data['id'] 		= $this->input->post('id');
		$data['faskes_id'] 	= $this->input->post('faskes_id');
		$data['nama_poli'] 	= $this->input->post('nama_poli');
		$data['alias'] 		= str_replace(' ','-',strtolower($this->input->post('nama_poli'))); 
		$data['status']		= 'C';
		
		$res = $this->PoliModel->saveData($data);
		
		if($res){
			$text = '<div class="box"><strong>Data telah berhasil di simpan. </strong></div>';
		} else {
			$text = $res;
		}

		$this->session->set_flashdata('msg',$text);
	}  
	
	/*
	*	Next version data tdk bisa di hapus jika sdng di gunakan di tabel lain
	*/
	private function hapus($id=0){
		// load model
		$this->load->model('PoliModel');
		
		$id = $this->input->post('id');

		for($i=0; $i < count($id); $i++){
			$this->PoliModel->hapus($id[$i]);
		}

		$text = '<div class="box">Data telah berhasil di hapus. </div>';
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
	