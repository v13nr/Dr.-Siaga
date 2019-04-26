<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Grouprule for cloud
 *  Controller			: Grouprule 
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grouprule extends CI_Controller {
	private $c = 'grouprule';

	public function __construct(){
		parent::__construct();	
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
		$this->load->model('GroupruleModel');
		$this->load->model('auth/GroupModel');
		$this->load->config('drsiaga');
		
		// configuration paging
		$config['base_url'] 	= site_url()."/grouprule/index/";
		$config['total_rows'] 	= $this->GroupModel->jmlhdata();
		$config['per_page'] 	= 20;
		$config['first_link'] 	= '<<';
		$config['last_link'] 	= '>>';
		$config['next_link'] 	= 'Next';
		$config['prev_link'] 	= 'Prev';
		$this->pagination->initialize($config); 
		
		$listgroup = $this->GroupModel->getlist(0,0);
		
		// prepare data
		$data['jmlh_data'] 	= $this->GroupModel->jmlhdata();
		$data['jmlh_item'] 	= 20;
		$data['action'] 	= site_url().'/grouprule/edit';
		$data['results'] 	= $listgroup;
		$data['file'] 		= 'list';
		$data['title'] 		= $this->config->item('app_name');
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		$data['page'] 		= $page;
		$data['c'] 			= $this->c;
		$data['subtitle'] 	= "Group Rule";
		
		$this->page($data);
	}
	
	public function edit($id=0){
		
		if( (!$this->session->userdata('logged_in')) ){
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
		$this->load->model('GroupruleModel');
		$this->load->model('auth/GroupModel');
		$this->load->model('rule/RuleModel');
		//$this->load->model('HakaksesModel');
		
		$data['results'] 	= $this->GroupruleModel->get_by_id($id); 
		$data['action'] 	= base_url('grouprule/update');
		$data['listgroup'] 	= $this->GroupModel->getlist(0,0);
		$data['listrule'] 	= $this->RuleModel->getlist(0,0);
		$data['group_id'] 	= $id;
		$data['group_info'] = $this->GroupModel->get_by_id($id);
		$data['file'] 		= 'form';
		$data['subtitle'] 	= "Edit Group Rule";
		$data['title'] 		= $this->config->item('app_name');
		$data['version'] 	= $this->config->item('version');
		$data['keyword'] 	= null;
		$data['desc'] 		= null;
		
		$result 			= $this->GroupruleModel->listakseslevel('index');
		$data['canread'] 	= $this->GroupruleModel->getrulemethod($id,'index');
		$data['canadd'] 	= $this->GroupruleModel->getrulemethod($id,'add');
		$data['canedit'] 	= $this->GroupruleModel->getrulemethod($id,'edit');
		$data['candelete'] 	= $this->GroupruleModel->getrulemethod($id,'hapus');

		for($i=0; $i < count($result); $i++){
			$rsindex = array('rsindex'=>$result[$i]['rule_id']);

			//echo "Rule id : ".$result[$i]['rule_id']."<br>";
			//echo "Rule class : ".$result[$i]['rule_class']."<br>";

			// cek apakah rule class tsb dpt add
			$isadd = $this->GroupruleModel->canadd($result[$i]['rule_class']);
			// cek apakah rule class tsb dpt edit
			$isedit = $this->GroupruleModel->canedit($result[$i]['rule_class']);
			// cek apakah rule class tsb dpt delete
			$isdelete = $this->GroupruleModel->candelete($result[$i]['rule_class']);

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

			$aksesleveladd 	= $this->GroupruleModel->getrulemethod($id,'add');
			$add 			= array('add'=>4);
			$edit 			= array('edit'=>5);
			$hapus 			= array('hapus'=>6);
			$data['listakseslevel'][]= array_merge($result[$i],$rsindex,$rsadd,$rsedit,$rsdelete);
		}		
		
		$this->page($data);
		
	}
	
    public function update(){
		if( (!$this->session->userdata('logged_in')) ){
			redirect('auth/login');
		}
				
		if($this->input->post('button')=='Save'){
			$this->save();
		} else {
			$this->hapus();
		}
		
		redirect(site_url('grouprule'));	
    }
	
    private function save(){ 	
		$user_id 	= $this->session->userdata('user_id');
		$group_id 	= $this->session->userdata('group_id');
	
		// only super admin can access this page 
		if($group_id != '11890083'){
			$msg	= 'Anda tidak dapat mengakses halaman '.$this->c;
			$this->session->set_flashdata('msg',$msg);
			
			redirect('errors/err/index');
		}
		
		// load model
		$this->load->model('GroupruleModel');

		$data['group_id'] 	= $this->input->post('group_id');
		$data['rule_id'] 	= $this->input->post('rule_id');

		$this->GroupruleModel->saveData($data); 
		
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