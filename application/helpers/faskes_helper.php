<?php  

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *	Copyright (C) Kaio Piranti Lunak
 *	Developer: Fatah Iskandar Akbar
 *  Email : kaiosoftware@gmail.com
 *	Date: Juni 2013
**/
 
if ( ! function_exists('faskes')){
	
	function faskes($faskes){
		switch($faskes){
			case "KL":
				$res = "Klinik";
				break;
			case "RS":
				$res = "Rumah Sakit";
				break;
			case "RSIA":
				$res = "Rumah Sakit Ibu Anak";
				break;	
			case "RSI":
				$res = "Rumah Sakit Islam";
				break;
			case "RSUD":
				$res = "Rumah Sakit Umum Daerah";
				break;					
			case "PS":
				$res = "Puskesmas";
				break;	
			case "APT":
				$res = "Apotek";
				break;
			case "DLL":
				$res = "Lainya";
				break;		
			case "DR":
				$res = "Praktek Pribadi";
				break;					
		}
		
		return $res;
	}
}


/* End of file array_helper.php */
/* Location: ./system/helpers/array_helper.php */