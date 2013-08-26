<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('db_admin');
	}

	public function index() {
		$head[] = js(SITE.'bootstrap/js/bootstrap.min.js');
		$head[] = style(SITE.'bootstrap/css/bootstrap.min.css');
		$data['head'] = build_head($head);
		$this->omap->type('modules');
		$this->omap->title('Administration Login');
		$this->omap->display('mod_login', $data);
	}

	public function logout(){
		$this->session->unset_userdata('logged_resto_user_id');
		$this->session->unset_userdata('logged_resto_user_name');	
		redirect('mod_login');
	}

	public function login_attempt() {
		$user = htmlspecialchars($this->input->post('user'));
		$pass = MD5($this->input->post('pass'));
		$query = $this->db_admin->login_admin_with_user($user);
		
		@$db_user_id = $query->row()->id_admin;
		@$db_user = $query->row()->user;
		@$db_pass = $query->row()->pass;

		if ($user == "" || $pass == "") {
			redirect('mod_login?n=err_null&message=Field Masih Kosong');
			//echo '{"status":"err_null", "message":"Field Masih Kosong!!"}';
		} else if ($user != $db_user) {
			redirect('mod_login?n=err_user&message=Email Belum Terdaftar!!');
			//echo '{"status":"err_email", "message":"Email Belum Terdaftar!!"}';
		} else if ($pass != $db_pass) {
			redirect('mod_login?n=err_pass&message=Password Salah!');
			//echo '{"status":"err_pass", "message":"Password Salah!!"}';
		} else {
			$this->session->set_userdata('logged_resto_user_id', $db_user_id);
			$this->session->set_userdata('logged_resto_user_name', $db_user);
			//echo '{"status":"ss", "message":"Suksess"}';
			redirect('home');
		}
	}	
}