<?php  

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Facebook for cloud
 *  Controller			: Inbox 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inbox extends CI_Controller {
	private $c = 'inbox';
 
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
		//$group_id 		= $this->session->userdata('group_id');
		$customer_id 	= $this->session->userdata('customer_id');
		
		// cek acl
		if( (!$this->acl->cek_acl($this->c,'index',$user_id)) ){
			$msg	= $this->config->item('forbiden').' '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model
		$this->load->model('FbPageCustomerModel');
		
		$search['customer_id']	= $customer_id ;
		
		$fb_page = $this->FbPageCustomerModel->getlist(0,0,$search);
		
		if(count($fb_page) > 0){
		
			$fields 	= "id,messages{created_time,sticker,message,attachments{image_data,mime_type,file_url,video_data},shares{description,link,name}},senders";
			$limit 		= 25;

			$json_link 	= "https://graph.facebook.com/".$fb_page[0]->page_id."/conversations?access_token=".$fb_page[0]->token."&fields=".$fields."&limit=".$limit;
			$json 		= file_get_contents($json_link);
					
			$messages 	= json_decode($json, true);
			
		} else {
			
			$messages 	= null;
		}
		
		// save nessages to dbdsid
		
		//print_r($photo); exit;
		// prepare data		
		$data['file'] 		= 'facebook/list_messenger';
		$data['title'] 		= $this->config->item('app_name');
		$data['subtitle'] 	= "Messenger";
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		$data['results'] 	= $messages;
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
	