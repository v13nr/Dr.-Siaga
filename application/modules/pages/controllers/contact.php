<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Contact for cloud
 *  Controller			: Contact 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {
	private $c = 'contact';

	public function __construct(){
		parent::__construct();	
	}

	public function index(){
						
		$this->load->config('drsiaga');
		
		// prepare data
		$data['title'] 		= $this->config->item('title');
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		$data['results'] 	= null;
		$data['title'] 		= $this->config->item('app_name');
		$data['subtitle'] 	= 'Doktersiaga Bussines';
		
		$this->load->view('form_contact',$data);
	}
		
	/*
	* 
	*	Using smptp server sendgrid
	*/
	public function send_mail(){
		/*$name_contact		= $this->input->post('name_contact');
		$lastname_contact	= $this->input->post('lastname_contact');
		$hp					= $this->input->post('phone_contact');
		$email				= $this->input->post('email_contact');
		$pesan				= $this->input->post('message_contact');
		*/
		
		$name_contact		= 'Joko';
		$hp					= '0812';
		$email				= 'kaiosoftware@gmail.com';
		$pesan				= 'test smtp';
		
		// send email notif ke user
		$this->load->library('email');
				
		$this->email->from('noreply@doktersiaga.com', 'Doktersiaga');
		$this->email->to($email);
		//$this->email->cc('kaiosoftware@gmail.com');
		//$this->email->bcc($this->input->post('email'));
		$this->email->subject('Aktifasi Member Doktersiaga for Business');
		$this->email->mailtype = 'html';
				
		$temp['nama_contact'] 		= $name_contact;
		$temp['hp']					= $hp;
		$temp['email']				= $email;
		$temp['pesan']				= $pesan;
				
		$body = $this->load->view('htmlmail/default/contact.php',$temp,TRUE);
		//$body = $pesan;
		
		$this->email->message($body);
		
		// send email member
		if ($this->email->send()){
			// Success message
			echo "<div id='success_page' style='padding:25px 0'>";
			echo "<strong >Email Sent.</strong><br>";
			echo "Thank you <strong>$name_contact</strong>,<br> your message has been submitted. We will contact you shortly.";
			echo "</div>";
		} else {
			echo $this->email->print_debugger();
		}	
			
		echo "<script>window.alert('Terima kasih telah menghubungi kami, selanjutnya team kami akan menghubungi anda');window.location.replace('https://doktersiaga.id/pages/contact');</script>";
		
	}
		
	private function page($data){
		// Write to $title
		$this->template->write('title', $data['title']);

		// Write to $subtitle
		$this->template->write('subtitle', $data['subtitle']);
		
		// Write to Header
		$this->template->write_view('header', 'templates/default/header.php'); 
		  
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