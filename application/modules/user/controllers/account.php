<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: User for cloud
 *  Controller			: Account 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {
	private $c = 'account';

	public function __construct(){
		parent::__construct();	
	}
	
	/* login form */
	public function login(){
		// load model
		$this->load->config('drsiaga');

		$url	= $this->input->get('url');
		
		if(empty($url)){
			$url	= 'auth/index';
		} else {
			$url	= $_GET['url'];
		}
						
		// prepare data
		$data['file'] 		= 'user/account/login_form';
		$data['title'] 		= $this->config->item('title');
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		$data['results'] 	= null;
		$data['url'] 		= $url;
		$data['title'] 		= 'Login doktersiaga';
		$data['subtitle'] 	= 'Login';
		
		//$this->page($data);
		$this->load->view($data['file'],$data);
	}	
	
	public function customer_form_register(){
		
		$this->load->model('paket/PaketModel');
				
		$paket_id 	= $this->uri->segment(4);
		$durasi		= $this->uri->segment(5);
		
		$paket = $this->PaketModel->get_by_id($paket_id);
		
		// prepare data
		$data['title'] 			= 'Pendaftaran Paket Doktersiaga';
		$data['subtitle'] 		= 'Pendaftaran Paket Doktersiaga';
		$data['version'] 		= $this->config->item('version');
		$data['keyword'] 		= null;
		$data['desc'] 			= null;
		$data['results'] 		= null;
		$data['paket'] 			= $paket;
		$data['durasi'] 		= $durasi;	
		$data['captcha'] 		= $this->recaptcha->getWidget(); // menampilkan recaptcha
		$data['script_captcha'] = $this->recaptcha->getScriptTag(); // javascript recaptcha ditaruh di head
		
		//print_r($data);
		$this->load->view('user/account/register_customer',$data);		
		
	}
	
	public function customer_register(){
		
		$input = $this->input->post('data');
        
		$recaptcha = $this->input->post('g-recaptcha-response');
        $response = $this->recaptcha->verifyResponse($recaptcha);
		
		//if($response['success'] == TRUE){
			// recaptcha success
			// load model
			$this->load->model('UserModel');
			$this->load->model('UserGroupModel');
			$this->load->model('customer/CustomerModel');
			$this->load->model('CustomerUserModel');
			$this->load->model('paket/CustomerPaketModel');
			$this->load->model('paket/CustomerPaketRulesModel');
			$this->load->model('paket/PaketRulesModel');
			
			$this->load->helper('waktu');
			
			$input = $this->input->post('data');
					
			$data['name']			= $input['name'];
			$data['email']			= $input['email'];
			$data['username']		= $input['email'];
			$data['password']		= md5($input['password1']);
			$data['hp']				= $input['hp'];
			$data['block']			= 'N';
			$data['tgl_register']	= date('Y-m-d H:i:s');
			$data['vcode']			= rand(10000,1000000);
			$data['status']			= '0';
						
			//print_r($data); exit;
			
			// regis user to table kaio_users
			if($this->UserModel->saveData($data)=='1062'){
				// duplikat entry email 
				$text = 'Email sudah terdaftar';
				$this->session->set_flashdata('msg',$text);
				redirect('errors/err/index');	/*-- redirect not working **/
			}
			
			if(filter_var($data['username'], FILTER_SANITIZE_EMAIL)){
				// email
				$user_id 	= array(0=>$this->UserModel->get_user_id($data['email']));
			} 
			
			$groups		= array(0=>'11890091'); // admin faskes
			
			// create akses level user
			// jika user baru buat hak akses level dengan meggunakan library acl
			if(!$this->acl->buat_akses_level($user_id[0][0]['user_id'],$groups)){
				// gagal membuat user karena rule group belum di definisikan
				// hapus user
				$this->UserModel->hapus($user_id[0]['user_id']);
				
				$this->config->load('drsiaga');
				
				$text =  $this->config->item('err_group_rule_not_defiened');
				$this->session->set_flashdata('msg',$text);
				redirect('errors/err/index');
			}
			
			// maping group for user
			$usergroup['group_id']		= $groups;
			$usergroup['user_id']		= $user_id[0][0]['user_id'];
			
			// save user group
			$this->UserGroupModel->saveData($usergroup); 
			
			$dataCustomer['nama_customer']	= $input['name'];
			$dataCustomer['contact_person']	= $input['name'];
			
			// save customer 
			$this->CustomerModel->saveData($dataCustomer);
			
			$customer_id = $this->CustomerModel->customer_id_max();
			
			$customerUser['customer_id']	= $customer_id;
			$customerUser['user_id']		= $user_id[0][0]['user_id'];
			
			// save customer user 
			$this->CustomerUserModel->saveData($customerUser);
			
			$paketCustomer['customer_id']	= $customer_id;
			$paketCustomer['paket_id']		= $input['paket_id'];
			$paketCustomer['tgl_daftar']	= date('Y-m-d H:i:s');		
			$paketCustomer['tgl_expired']	= tambah_tgl(date('Y-m-d H:i:s'),'30');
			$paketCustomer['status']		= 'E';
			
			// save customer paket
			$this->CustomerPaketModel->saveData($paketCustomer);
			
			/*$customerPaketRules['customer_id']	= $customer_id;
			$customerPaketRules['paket_id']		= $input['paket_id'];
			
			$filter['paket_id']		= $input['paket_id'];	
			
			// get rule id from paket 
			$paket = $this->PaketRulesModel->getlist(0,0,$filter);
			
			for($i=0; $i < count($paket); $i++){
				$customerPaketRules['rule_id']		= $paket[$i]['rule_id'];
				
				// save customer paket rules 
				$this->CustomerPaketRulesModel->saveData($customerPaketRules);
			}*/
			
			// send email notif ke user
			$this->load->library('email');
					
			$this->email->from('noreply@doktersiaga.com', 'Doktersiaga');
			$this->email->to($input['email']);
			//$this->email->cc('kaiosoftware@gmail.com');
			//$this->email->bcc($this->input->post('email'));
			$this->email->subject('Aktifasi account doktersiaga ID ');
			$this->email->mailtype = 'html';
					
			$temp['member_name'] 	= $input['name'];
			$temp['username'] 		= $input['email'];
			$temp['link'] 			= base_url().'user/account/aktifasi/'.$data['vcode'];
			
			$body = $this->load->view('htmlmail/default/aktifasi_account.php',$temp,TRUE);
			
			$this->email->message($body);
			
			// send email member
			if ($this->email->send()){
				echo "Mail Sent!";
			} else {
				echo $this->email->_set_error_message();
			}
			
			redirect('pages/price');
			echo "<script>window.alert('Terima kasih telah menghubungi kami, selanjutnya team kami akan menghubungi anda');window.location.replace('https://doktersiaga.id/pages/contact');</script>";
			
		//} else {
			//echo "gagal";
		//}
		
	}
	
	public function success_register(){
		$this->load->config('drsiaga');

		// prepare data
		$data['file'] 		= 'user/account/success_register';
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc']		= null;
		$data['results'] 	= null;
		$data['title'] 		= 'Registration member '.$this->config->item('title');
		$data['subtitle'] 	= null;
		
		$this->load->view('account/success_register',TRUE);
		
	}
	
	/* aktifasi pasien */
	public function aktifasi(){
		
		$this->load->model('UserModel');
		$this->config->load('drsiaga');
		
		$vercode = $this->uri->segment(4);
		
		// get user id by vercode
		$res = $this->UserModel->get_by_vercode($vercode);
		
		if(count($res) > 0){
			
			// update  aktifasi
			$data['user_id']		= $res[0]['user_id'];
			$data['status']			= '1'; 
			$data['vcode']			= 0;
			$data['tgl_aktifasi']	= date('Y-m-d H:i:s');
			
			$this->UserModel->saveData($data);
						
			redirect('user/account/login');
			
			echo "<script>window.alert('Sukses Aktifasi');window.location.replace('https://doktersiaga.id/pages/contact');</script>";
			
		} else {
			
			$text = $this->config->item('err_vercode');
			$this->session->set_flashdata('msg',$text);	
			redirect('error');	
		}
	}
	
	public function page($data){
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