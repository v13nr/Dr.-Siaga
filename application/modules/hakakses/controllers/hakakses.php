<?php 

/*
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Hakakses for cloud
 *  Controller			: Hakakses 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hakakses extends CI_Controller {
	private $c = 'hakakses';

	public function _construct(){
		parent::_construct();	
	}

	public function index($page=0)
	{
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}

		$user_id 	= $this->session->userdata('user_id');
		$group_id 	= $this->session->userdata('group_id');
	
		// only super admin can access this page 
		if($group_id != '11890083'){
			$msg	= 'Anda tidak dapat mengakses halaman '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		$this->load->library('pagination');
		
		// load model
		$this->load->config('drsiaga');
		$this->load->model('HakaksesModel');
		
		if(empty($this->input->post('search'))){
			$search = null;
		} else {
			$search['search'] = $this->input->post('search');
		}
		
		// configuration paging
		$config['base_url'] 	= site_url()."hakakses/index/";
		$config['total_rows'] 	= $this->HakaksesModel->jmlhdata($search);
		$config['per_page'] 	=  20;
		$config['first_link'] 	= '<<';
		$config['last_link'] 	= '>>';
		$config['next_link'] 	= 'Next';
		$config['prev_link'] 	= 'Prev';
		
		$this->pagination->initialize($config); 
						
		$hakakses = $this->HakaksesModel->getlist($config['per_page'],$page,$search);

		// prepare data
		$data['jmlh_data'] 	= $this->HakaksesModel->jmlhdata($search);
		$data['jmlh_item'] 	= $this->config->item('jmlh_item');
		$data['action'] 	= site_url().'hakakses/edit';
		$data['results'] 	= $hakakses;
		$data['file'] 		= 'hakakses/list';
		$data['title'] 		= $this->config->item('app_name');
		$data['version'] 	= $this->config->item('version');
		$data['page'] 		= $page;
		$data['subtitle'] 	= "Hak Akses";
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		$data['c'] 			= $this->c;
		
		$this->page($data);
	}
		
	public function edit($id=0){
		
		if(!$this->session->userdata('logged_in')){
			redirect('auth/login');
		}
				
		$user_id 	= $this->session->userdata('user_id');
		$group_id 	= $this->session->userdata('group_id');
	
		// only super admin can access this page 
		if($group_id != '11890083'){
			$msg	= 'Anda tidak dapat mengakses halaman '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model
		$this->load->model('user/UserModel');
		$this->load->model('rule/RuleModel');
		$this->load->model('HakaksesModel');
		
		$user_info	= $this->UserModel->get_by_id($id);
		
		$data['results'] 	= null;
		$data['action'] 	= site_url().'/hakakses/update';
		$data['file'] 		= 'form';
		$data['listuser'] 	= $this->UserModel->getlist(0,0,null);
		$data['listrule'] 	= $this->RuleModel->getlist(0,0);
		$data['title'] 		= $this->config->item('app_name');
		$data['version'] 	= $this->config->item('version');
		$data['subtitle'] 	= "Hak Akses";
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		$data['user_info'] 	= $user_info;
		
		$result 			= $this->HakaksesModel->listakseslevel('index');
		$data['canread'] 	= $this->HakaksesModel->getrulemethod($id,'index');
		$data['canadd'] 	= $this->HakaksesModel->getrulemethod($id,'add');
		$data['canedit'] 	= $this->HakaksesModel->getrulemethod($id,'edit');
		$data['candelete'] 	= $this->HakaksesModel->getrulemethod($id,'hapus');

		for($i=0; $i < count($result); $i++){
			$rsindex = array('rsindex'=>$result[$i]['rule_id']);

			//echo "Rule id : ".$result[$i]['rule_id']."<br>";
			//echo "Rule class : ".$result[$i]['rule_class']."<br>";

			// cek apakah rule class tsb dpt add
			$isadd = $this->HakaksesModel->canadd($result[$i]['rule_class']);
			// cek apakah rule class tsb dpt edit
			$isedit = $this->HakaksesModel->canedit($result[$i]['rule_class']);
			// cek apakah rule class tsb dpt delete
			$isdelete = $this->HakaksesModel->candelete($result[$i]['rule_class']);

			//print_r($isadd);
			if(count($isadd) > 0){
				// jika dpt add
				$rsadd = array('rsadd'=>$isadd[0]['rule_id']);
			} else {
				$rsadd = array('rsadd'=>0);
			}

			if(count($isedit) > 0){
				// jika dpt edit
				$rsedit = array('rsedit'=>$isedit[0]['rule_id']);
			} else {
				$rsedit = array('rsedit'=>0);
			}

			if(count($isdelete) > 0){
				// jika dpt edit
				$rsdelete = array('rsdelete'=>$isdelete[0]['rule_id']);
			} else {
				$rsdelete = array('rsdelete'=>0);
			}

			$aksesleveladd 	= $this->HakaksesModel->getrulemethod($id,'add');
			$add 			= array('add'=>4);
			$edit 			= array('edit'=>5);
			$hapus 			= array('hapus'=>6);
			$data['listakseslevel'][]= array_merge($result[$i],$rsindex,$rsadd,$rsedit,$rsdelete);
		}		

		if($id){ 
			$data['results'] = $this->HakaksesModel->get_by_id($id); 
		} 
		
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
		//print_r($this->session->userdata);
		redirect('hakakses');	
    }
	
    public function save(){ 	
		$user_id 	= $this->session->userdata('user_id');
		$group_id 	= $this->session->userdata('group_id');
	
		// only super admin can access this page 
		if($group_id != '11890083'){
			$msg	= 'Anda tidak dapat mengakses halaman '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		$this->load->model('HakaksesModel');
		
		$data['user_id'] 	= $this->input->post('user_id');
		$data['rule_id'] 	= $this->input->post('rule_id');

		$this->HakaksesModel->saveData($data);
		
		$text = 'Data berhasil di simpan';
		
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