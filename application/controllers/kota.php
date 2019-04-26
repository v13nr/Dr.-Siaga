<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Kota extends CI_Controller {


	public function __construct(){

		parent::__construct();
	}

	public function index(){

		redirect('timeline');
	}

    public function get_kota(){

		$this->load->model('KabkotModel');
		$this->load->helper('array_object');

		//get search term
		$searchTerm = $_GET['term'];

		// get list kota
		$list_kota = $this->KabkotModel->search($searchTerm);

		for($i=0; $i < count($list_kota); $i++){
			$data[$i]		= array('label'=>ucwords(strtolower($list_kota[$i]['nama_kabkot']))." - ".ucwords(strtolower($list_kota[$i]['nama_prov'])), 'id_kabkot'=>$list_kota[$i]['id_kabkot'],'id_prov'=>$list_kota[$i]['id_prov']);
		}

		//return json data
		echo json_encode($data);
    }

}



