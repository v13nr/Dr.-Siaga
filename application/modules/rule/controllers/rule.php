<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Rule for cloud
 *  Controller			: Rule 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rule extends CI_Controller {
	private $c = 'rule';

	public function __construct(){
		parent::__construct();	
	}

	public function index($page=0)
	{
		if( (!$this->session->userdata('logged_in')) ){
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
			
		// load model
		$this->load->model('RuleModel');
		$this->load->library('pagination');
				
		// configuration paging
		$config['base_url'] 	= site_url()."rule/index/";
		$config['total_rows'] 	= $this->RuleModel->jmlhdata();
		$config['per_page'] 	=  20;
		$config['first_link'] 	= '<<';
		$config['last_link'] 	= '>>';
		$config['next_link'] 	= 'Next';
		$config['prev_link'] 	= 'Prev';
		
		$this->pagination->initialize($config);
				
		$rules = $this->RuleModel->getlist($config['per_page'],$page);
		
		// prepare data
		$data['jmlh_data'] 	= $this->RuleModel->jmlhdata();
		$data['jmlh_item'] 	= 20;
		$data['action'] 	= site_url().'rule/add';
		$data['results'] 	= $rules;
		$data['file'] 		= 'rule/list';
		$data['title'] 		= $this->config->item('app_name');
		$data['version'] 	= $this->config->item('version');
		$data['page'] 		= $page;
		$data['subtitle'] 	= "Rule";
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		$data['c'] 			= $this->c;
		
		$this->page($data);
	}
	
	public function add(){
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
		$data['file'] 		= 'rule/form';
		$data['action'] 	= site_url().'rule/update';
		$data['title'] 		= $this->config->item('app_name');
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= $this->config->item('keyword');
		$data['desc'] 		= $this->config->item('desc');;
		$data['results'] 	= null;
		$data['subtitle'] 	= "Add / Edit Rule";
	
		$this->page($data); 		
		
	}
	
	public function edit($id=0){
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
		
		// load model
		$this->load->model('RuleModel');
		
		$rules = $this->RuleModel->get_by_id($id);
		
		// prepare data
		$data['action'] 	= site_url().'/rule/update';
		$data['results'] 	= $rules;
		$data['file'] 		= 'rule/form';
		$data['title'] 		= $this->config->item('app_name');
		$data['version'] 	= $this->config->item('version');
		$data['subtitle'] 	= "Add / Edit Rule";
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		$data['id'] 		= $id;
		
		$this->page($data); 
	}
	
    public function update(){
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
		
		if($this->input->post('button')=='Save'){
			if($this->input->post('id')){
				$data['updatetype'] = "edit";
			} else {
				$data['updatetype'] = "new";
			}
			$this->save();
		} else {
			$this->hapus();
		}
		
		redirect('rule');	
    }
	
    private function save(){ 
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
		
		$data['rule_id'] 	= $this->input->post('rule_id');
		$data['rule_class'] = $this->input->post('rule_class');
		$rule_method 		= $this->input->post('rule_method');
		$menu 				= $this->input->post('menu');
		
		for($i=0; $i < count($rule_method); $i++){
			$data['rule_method'] = $rule_method[$i];
			$data['menu'] = $menu[$i];
			$this->RuleModel->saveData($data); 
		}
		
		$text = 'Data berhasil di simpan';
					 
		$this->session->set_flashdata('msg',$text);
	}  
	
	/*
	*	Next version data tdk bisa di hapus jika sdng di gunakan di tabel lain
	*/
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

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */