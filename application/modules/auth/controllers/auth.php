<?php  

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Auth for cloud
 *  Controller			: Auth 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
*	Controller untuk Authentikasi
*/

class Auth extends CI_Controller {
 
	public function __construct(){
		parent::__construct();	
	}
	 
    function index(){ 
		if ($this->session->userdata('logged_in')){
			
			$group_id 	= $this->session->userdata('group_id');
			
			if($group_id=='11890083'){
				// superadmin
				redirect('dashboard/superadmin');
			} else if($group_id=='11890091'){
				// admin
				redirect('dashboard/admin');
			} else if($group_id=='11890085'){
				// staff
				redirect('dashboard/staff');			
			} else {
				// jika group tidak di definisikan
				
			}
        } else {
           redirect('auth/login/'); 
        }	
    }
	 
	 /* login with konvensional */
    function login(){ 
		$this->load->model('AuthModel');
		//$this->load->config('drsiaga');

		$form_data 	= $this->input->post('data');
		
		$url	= $this->input->post('url');

		if(empty($url)){
			$url	= 'auth/index';
		}
		//echo $url;
        if (!empty($form_data)){ 
			$res = $this->AuthModel->login($form_data['email'], $form_data['password']);
			
			// check user login
			if(count($res) > 0){
				
				if($this->acl->is_active($form_data['email'], $form_data['password'])){
					
					// user adalah member & aktif lalu create $session
					$session = array(
						'logged_in' => true,
						'group_id' => $res[0]['group_id'],
						'user_id' => $res[0]['user_id'],
						'username' => $res[0]['username'],
						'name' => $res[0]['name'],
						'blocked' => $res[0]['block']
					);

					//data dari $session dimasukkan ke dalam session (menggunakan library CI)
					$this->session->set_userdata($session);
					
					// apakah user di blok?
					if($this->acl->is_block($this->session->userdata('user_id')) ){
						// jika di blok -> logout
						$this->logout();
						echo "<script>alert('Akun anda di blok oleh admin !');</script>";
					} else {
						// update login time & jlmh kunjungan
						$data['last_login'] = date('Y:m:d H:i:s');
						
						$this->acl->update_login($this->session->userdata('user_id'),$data);
						
						// welcome message
						
												
						if($res[0]['group_id'] != '11890083'){
							// set customer_id for user
							$this->load->model('user/CustomerUserModel');
							
							$filter['user_id']	= $res[0]['user_id'];
							
							$customer 			= $this->CustomerUserModel->getlist(0,0,$filter);
							
							$this->load->helper('array_object');
							
							$customer = object_to_array($customer);
							
							$this->session->set_userdata(array('customer_id'=>$customer[0]['customer_id']));
						} else {
							$this->session->set_userdata(array('customer_id'=>0));
						}
						
						redirect($url);
					}
					
				} else {
					echo $text = 'User belum aktif, harap aktifasikan akun anda';
					$this->session->set_flashdata('msg',$text);	
				}
			} else {
				$text = 'User & Password tidak cocok / akun ada belum aktif';
				$this->session->set_flashdata('msg',$text);
			}	

		} else {
			$text = 'User / Password anda kosong';
			$this->session->set_flashdata('msg',$text);
		} 
	
		redirect('user/account/login');
		
    }
 	
    function logout(){
		$this->load->model('AuthModel');
        $this->AuthModel->logout();
        redirect();
    } 
}

?>