<?php  

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Facebook for cloud
 *  Controller			: Fanpage 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fanpage extends CI_Controller {
	private $c = 'fanpage';
 
	public function __construct(){
		parent::__construct();	
	}
	
	public function index($page=0){
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
		// load model & config
		$this->load->config('drsiaga');
		//$this->load->config('facebook');
		
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
		$this->load->model('FbPageCustomerModel');
		
		$search['customer_id']	= $customer_id ;
		
		$fb_page = $this->FbPageCustomerModel->getlist(0,0,$search);
		
		if(count($fb_page) > 0){
			$profile_photo_src = "https://graph.facebook.com/".$fb_page[0]->page_id."/picture?type=square";

			$fields 	= "id,message,picture,link,name,description,type,icon,created_time,from,object_id";
			$limit 		= 20;

			$json_link 	= "https://graph.facebook.com/".$fb_page[0]->page_id."/feed?access_token=".$fb_page[0]->token."&fields=".$fields."&limit=".$limit;
			$json 		= file_get_contents($json_link);
					
			$feed 				= json_decode($json, true);
		} else {
			
			$feed 		= null;
		}
		
		// prepare data		
		$data['file'] 		= 'facebook/list_feed';
		$data['title'] 		= $this->config->item('app_name');
		$data['subtitle'] 	= "News Feed";
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		$data['results'] 	= $feed;
		$data['page'] 		= $page;
		$data['fb'] 		= $fb_page;
		
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
	