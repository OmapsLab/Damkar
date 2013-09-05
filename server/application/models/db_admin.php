<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Db_admin extends CI_Model {

	public function login_admin_with_user($user) {
		return $this->db->query("SELECT *
							 	 FROM admin 
							     WHERE user = '".$user."'");	
	}
}
