<?php  

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Medsos for cloud
 *  Controller			: Facebook 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Facebook extends CI_Controller {
	private $c = 'facebook';
 
	public function __construct(){
		parent::__construct();	
	}
	
	public function index(){
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
		$user_id 		= $this->session->userdata('user_id');
		$customer_id 	= $this->session->userdata('customer_id');
		
		// cek acl

		
		$this->load->config('drsiaga');
		$this->load->config('facebook');
		
		// page ds
		$page_access_token 	= 'EAABeGsztYLoBAI52gjdYH5UKIoYXCyWDzJeRZCPCrSRVoNHaTmxzSb34Jznpe0WglqrA37NZCRCt7PkCImqPOnt7fIVIXmqcobtXVHO47PHvlAbCzzwZB6UyMVOCIMyC5wSItBXtVJZA6oQd3IMtMD4OKSRQZBMOqFQ6CRJYFNsAcx8AeZBht5ZB8IXDrqWI8MZD';

		$fb_page_id 			= '877864705584378';
		
		
		$profile_photo_src = "https://graph.facebook.com/".$fb_page_id."/picture?type=square";

		$fields 	= "id,message,picture,link,name,description,type,icon,created_time,from,object_id";
		$limit 		= 30;

		$json_link 	= "https://graph.facebook.com/".$fb_page_id."/feed?access_token=".$page_access_token."&expires=5180130&fields=".$fields."&limit=".$limit;
		$json 		= file_get_contents($json_link);
			
		$feed 				= json_decode($json, true);
		
		// prepare data		
		$data['file'] 		= 'facebook/list_feed';
		$data['title'] 		= $this->config->item('app_name');
		$data['subtitle'] 	= "Feed";
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		$data['results'] 	= $feed;
		//print_r($data); 
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
	