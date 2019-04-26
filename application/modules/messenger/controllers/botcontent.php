<?php  

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Messenger for cloud
 *  Controller			: BotContent 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BotContent extends CI_Controller {
	private $c = 'botcontent';
 
	public function __construct(){
		parent::__construct();	
	}
	
	public function index($page=0){
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
		// load model & config
		$this->load->config('drsiaga');
		$this->load->config('facebook');
		
		$user_id 		= $this->session->userdata('user_id');
		$customer_id 	= $this->session->userdata('customer_id');
		
		// cek acl
		if( (!$this->acl->cek_acl($this->c,'index',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model & config
		$this->load->model('BotContentModel');
		$this->load->model('CustomerBotModel');
		$this->load->model('paket/CustomerPaketModel');
		
		$customer['customer_id']	= $customer_id;
		
		// get customer bot id 
		$bot = $this->CustomerBotModel->getlist(0,0,$customer);
		
		$filter['customer_id']	= $customer_id;
		$filter['bot_id']		= $bot[0]['bot_id'];
		
		$bot = $this->BotContentModel->getlist(0,0,$filter);
			
		$this->load->library('pagination');
				
		// configuration paging
		$config['base_url'] 	= site_url()."chat/bot/index/";
		$config['total_rows'] 	= $this->CustomerBotModel->jmlhdata($filter);
		$config['per_page'] 	=  20;
		$config['first_link'] 	= '<<';
		$config['last_link'] 	= '>>';
		$config['next_link'] 	= 'Next';
		$config['prev_link'] 	= 'Prev';
		
		$this->pagination->initialize($config);
								
		//print_r($photo); exit;
		// prepare data		
		$data['file'] 		= 'bot/list_bot_content';
		$data['title'] 		= $this->config->item('app_name');
		$data['subtitle'] 	= "Bot Content";
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		$data['results'] 	= $bot;
		$data['page'] 		= $page;
		
		$this->page($data);
		
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
	