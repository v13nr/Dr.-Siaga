<?php  

/**
 *	Copyright (C)		: Doktersiaga.com
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Januari 2019
 *  Module name			: Page
 *	Controller			: Home
 *	Controller version	: 1.0.0
**/

class Home extends CI_Controller {
	
	public function __construct(){
		parent::__construct();	
	}
	
    function index(){
		echo "welcome to new page HMVC";
	}
}
?>