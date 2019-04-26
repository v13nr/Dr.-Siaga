<?php  

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Helper Name			: ACL
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*	
* 	cek hak akses user
*	
*/

if (!function_exists('acl_helper')) 
{
	function acl_helper($c,$m,$user_id,$group_id) {

		if(!$this->acl->cek_acl($c,$m,$user_id)){
			$text = '<div class="row">
						<div class="col-sm-9">
							<div class="alert alert-info alert-dismissible" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  <strong>Warning ! You dont have authorizate to access '.$this->c.' page </strong>
							</div>				
						</div>
					</div>';
			//$this->session->set_flashdata('msg',$text);
			
			if($group_id ==  '11890083'){
				$redirect = 'superadmin';
			} else if($group_id ==  '11890091'){
				$redirect = 'admin';
			} else if($group_id ==  '11890085'){
				$redirect = 'staff';
			}
			
			redirect('dashboard/'.$redirect);			
		}	
		
	}
}

/* End of file array_helper.php */
/* Location: ./system/helpers/array_helper.php */