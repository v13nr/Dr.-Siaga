<?php  

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Chat for cloud
 *  Controller			: Bot 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bot extends CI_Controller {
	private $c = 'bot';
 
	public function __construct(){
		parent::__construct();	
	}
	
	public function index($page=0){
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
		
		// load model & config
		$this->load->model('CustomerBotModel');
		$this->load->model('paket/CustomerPaketModel');
		
		$filter['customer_id']= $customer_id;
		
		$bot = $this->CustomerBotModel->getlist(0,0,$filter);
		
		// get paket customer
		$filter_customer['customer_id']	= $customer_id;
		$paket  						= $this->CustomerPaketModel->getlist(0,0,$filter_customer);
		
		// configuration paging
		$config['base_url'] 	= site_url()."chat/bot/index/";
		$config['total_rows'] 	= $this->CustomerBotModel->jmlhdata($filter);
		$config['per_page'] 	=  20;
		$config['first_link'] 	= '<<';
		$config['last_link'] 	= '>>';
		$config['next_link'] 	= 'Next';
		$config['prev_link'] 	= 'Prev';
		
		$this->pagination->initialize($config);
								
		$bot = $this->CustomerBotModel->getlist($config['per_page'],$page,$filter);
		
		// get paket customer
		$filter_customer['customer_id']	= $customer_id;
		$paket  						= $this->CustomerPaketModel->getlist(0,0,$filter_customer);
	
		// prepare data
		$data['jmlh_data']	= $this->CustomerBotModel->jmlhdata($filter);
		$data['jmlh_item']	= $this->config->item('jmlh_item');
		$data['action'] 	= site_url().'/bot/messenger/bot/add';
		$data['results'] 	= $bot;
		$data['paket'] 		= $paket;
		$data['file'] 		= 'bot/list';
		$data['title'] 		= $this->config->item('app_name');
		$data['version'] 	= $this->config->item('version');
		$data['page'] 		= $page;
		$data['c'] 			= $this->c;
		$data['subtitle'] 	= "Daftar Bot";
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		
		$this->page($data);	
	}
	
	public function add (){
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
		$user_id = $this->session->userdata('user_id');
		
		// cek acl
		/*if(!$this->acl->cek_acl($this->c,'add',$user_id)){
			$text = '<div class="row">
						<div class="col-sm-9">
							<div class="alert alert-info alert-dismissible" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  <strong>Warning ! You dont have authorizate to access '.$this->c.' page </strong>
							</div>				
						</div>
					</div>';
			$this->session->set_flashdata('msg',$text);
			redirect('dashboard/index');
		}*/
		
		// load model & config
		$this->load->config('drsiaga');
		$this->load->model('FaskesModel');	
		
		$faskes_id	= $this->session->userdata('faskes_id');
		$faskes		= $faskes_id;
		
		if($this->session->userdata('group_id')=='11890083'){
			// superadmin
			$faskes		= null;
			$poli		= null;
		} else if($this->session->userdata('group_id')=='11890100'){
			// admin faskes
			$faskes		= $this->FaskesModel->get_by_id($faskes_id);
			$poli		= null;			
		}
	
		// prepare data
		$data['results'] 	= null;
		$data['file'] 		= 'poli/form';
		$data['title'] 		= $this->config->item('app_name');
		$data['subtitle'] 	= "Add/Edit Poliklinik";
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		$data['faskes'] 	= $faskes;
		$data['poli'] 		= $poli;
		
		$this->page($data);		
	}
	
	/* edit bot */
	public function edit($id=0){
		
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
	
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
		$data['file'] 		= 'chat/bot/canvas';
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
	
	/* edit welcome message */
	public function edit_welcome(){
		
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
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
		$data['file'] 		= 'bot/welcome_message';
		$data['title'] 		= 'Welcome Message';
		$data['subtitle'] 	= "Welcome Message";
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		$data['results'] 	= null;
		
		$this->page($data);			
	}
	
	/* edit doktewr kami */
	public function edit_dokter(){
		
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
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
		$data['file'] 		= 'bot/dokter';
		$data['title'] 		= 'Dokter Kami';
		$data['subtitle'] 	= "Edit Dokter Kami";
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		$data['results'] 	= null;
		
		$this->page($data);			
	}
	
	/* edit_jadwal */
	public function edit_jadwal(){
		
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
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
		$data['file'] 		= 'bot/jadwal';
		$data['title'] 		= 'Jadwal';
		$data['subtitle'] 	= "Edit Jadwal";
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		$data['results'] 	= null;
		
		$this->page($data);			
	}
	
	/* edit_layanan */
	public function edit_layanan(){
		
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
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
		$data['file'] 		= 'bot/layanan';
		$data['title'] 		= 'Layanan';
		$data['subtitle'] 	= "Edit Layanan";
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		$data['results'] 	= null;
		
		$this->page($data);			
	}
	
	/* edit_fasilitas */
	public function edit_fasilitas(){
		
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
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
		$data['file'] 		= 'bot/fasilitas';
		$data['title'] 		= 'Fasilitas ';
		$data['subtitle'] 	= "Edit Fasilitas";
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		$data['results'] 	= null;
		
		$this->page($data);			
	}
	
	public function test(){
		
		//$text = array([0]=> 'menu',[1]=> 'konsultasi', [2] => 'nama kamu siapa', [3] => 'siapa nama kamu');
		$messageText = 'siapa nama kamu';
		$text = array( 
					array(
						'q'=>'/menu',
						'a'=>'Menu apa nih ?'
					),
					array(
						'q'=>'halo',
						'a'=>'halo juga'					
					),
					array(
						'q'=>'selamat pagi',
						'a'=>'selamat pagi juga'					
					),
					array(
						'q'=>'apa kabarnya?',
						'a'=>'Kabar saya baik, bagaimana dengan kamu?'					
					),			
					array(
						'q'=>'ini siapa?',
						'a'=>'Saya adalah bot'					
					),	
					array(
						'q'=>'siapa nama kamu',
						'a'=>'Saya adalah bot'					
					)					
				);
		
		for($i=0; $i < count($text); $i++){
			if($messageText==$text[$i]['q']){
				$answer		= $text[$i]['a'];
			}
			
		}
		
		echo $answer;
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
	