<?php  

/**
 *	Copyright (C)	: Kaio Piranti Lunak
 *	Developer		: Fatah Iskandar Akbar
 *  Email			: kaiosoftware@gmail.com
 *	Date			: Juni 2015
 *	Module version	: 1.0.0
**/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['app_name']		= 'Patient Relationship Management';
$config['version']		= '2.25';
$config['keyword']		= 'Jadwal Praktek Dokter,direktori dokter,chatbot kesehatan,artikel kesehatan';
$config['desc']			= 'Doktersiaga adalah asisten kesehatan virtual yang menggunakan chatbot untuk memberikan informasi layanan rumah sakit seperti jadwal dokter, lokasi faskes dll';

/* ERROR CODE  */
$config['err_wrong_paswd']				= 'Your username and password incorrect';
$config['err_page_not_found']			= '404 Page Not Found';
$config['err_group_rule_not_defiened']	= 'Can not create user access level, group rule not defined';
$config['err_vercode']					= 'Code verifikasi anda tidak di temukan';
$config['err_user_diactive']			= 'Mohon aktifasikan account anda agar bisa login';
$config['err_resend_vercode']			= 'Email anda tidak terdaftar sebagai member dokter siaga, silahkan buat account anda';
$config['registered_member']			= 'Akun anda sudah pernah di aktifkan';


$config['not_found_email']				= 'Email anda tidak di temukan';
$config['forbiden']						= 'Anda tidak di izinkan untuk mengakses halaman ';

/* MSG */
$config['succes_reg_patient']			= 'Thanks for your registration, silahkan cek inbox email anda atau di spam folder';
$config['succes_vercode']				= 'Selamat';
$config['succes_resend_vercode']		= 'Kode verifikasi account anda telah di kirim ke email anda';

/* SYSTEM  */
$config['welcome_message']			= TRUE;

/* MODULE USER  */
$config['paket_forb']				= 'Your username and password incorrect';



/* End of file config.php */
/* Location: ./application/config/config.php */
