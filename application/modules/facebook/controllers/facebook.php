<?php 

/**
 *	Copyright (C)		: Doktersiaga
 *	Developer			: Fatah Iskandar Akbar
 *  Email				: fatah@doktersiaga.com
 *	Date				: Februari 2019
 *  Module Name			: Facebook
 *  Controller			: Facebook 
**/

if(!defined('BASEPATH')) exit('No direct script access allowed.');

class Facebook extends CI_Controller {

    function __construct() {
        parent::__construct();
        // ====== facebok option setting -==========
        $this->load->config('facebook');
        $this->load->library('facebook',$this->config->item('facebook'));
        $fbConfig = $this->config->item('facebook');
   
        // ==========================================
    }

    function index() {
        echo "ini indexnya bro";
    }
 
    function register_facebook() {
        $fbConfig = $this->config->item('facebook');  
        $scope = "email,read_stream,user_birthday,user_photos,photo_upload,publish_stream,manage_pages,status_update,offline_access,user_likes";
        $url = 'https://graph.facebook.com/oauth/authorize?client_id='.$fbConfig['appId'].'&redirect_uri='.site_url('facebookdemo/do_register_facebook_ext/').'&scope='.$scope.'&display=popup';
        redirect($url);
    }
 
    function do_register_facebook_ext() {
        $fbConfig = $this->config->item('facebook');
        if(isset($_GET['code'])) {
            $token_url = "https://graph.facebook.com/oauth/access_token?client_id=".$fbConfig['appId']."&redirect_uri=".site_url('facebookdemo/do_register_facebook_ext/')."&client_secret=".$fbConfig['secret'].'&code='.$_GET['code'];
            $token_data = file_get_contents($token_url); // grab data token
            // echo "<pre>";

            // print_r($token_data);
            preg_match("/access_token=([^&]+)/",$token_data,$token); // filter grap data untuk dapatkan token
            $access_token = $token[1]; // ambil token FB
            # biasanya saya simpan access_token ke database bila perlu untuk melakukan proses API lainnya
           
            $url = 'https://graph.facebook.com/me?access_token='.$access_token; # url untuk ambil data user Login FB
            $fb  =json_decode(file_get_contents($url),true); // ambil data user login FB
           
            // print_r($fb);
            $id_fb = $fb['id']; # ambil ID User FB
            $name_fb = $fb['name']; # ambil Name User FB
            $image_fb = 'https://graph.facebook.com/'.$fb['name'].'/picture'; # ambil gambar User FB
            $email_fb = $fb['email']; # ambil email jika email tidak disembunyikan
         
            # array ini untuk kirim ke wall user FB
            $attachment = array(
                    'userid'=> $id_fb,
                    'access_token' => $access_token,
                    'message' => 'Testing API Facebook dengan Codeigniter..',
                    'name' => "API Facebook dengan Codeigniter",
                    'link' => "http://www.adiputra.web.id/instalasi-facebook-api-pada-codeigniter/", // Link URL sisip disini
                    'description' => 'ini deskripsi..biasanya sih panjang..tapi belum tau sepanjang apa nih..', // Penjelasan lebih lengkap sisip di sini juga
                    'picture'=>'http://www.adiputra.web.id/wp-content/uploads/2012/04/config-300x133.jpg', // gambar dari path local
            );
            $post = $this->facebook->api('/me/feed', 'POST', $attachment);
           
            # biasanya sy buat session untuk menyimpan data di halaman lain nya
            $this->session->set_userdata('id_fb',$id_fb);
            $this->session->set_userdata('name_fb',$name_fb);
            $this->session->set_userdata('image_fb',$image_fb);
            $this->session->set_userdata('email_fb',$email_fb);
           
            # panggil halaman selesai login
            redirect('facebookdemo/register_fb_finish');
        }else{
            # jika gagal dapatkan kode atau user FB tidak menyetujui aplikasi kita
            echo "gagal registrasi";
        }
    }
 
    function register_fb_finish(){
      echo "hai..selesai login dengan fb";
    }
}

?>