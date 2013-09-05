<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {


	public function __construct() {
		parent::__construct();
		$this->load->model('db_pengaduan');
	}

	public function create_pengaduan($hp, $lat, $long) {
		@$get_img_from_android = $_REQUEST['image'];
		$img_path = "damkar/foto_kebakaran/";

		$id_masyarakat = $this->db_pengaduan->add_pengaduan_masyarakat($hp);
		$id_peta = $this->db_pengaduan->add_pengaduan_peta($lat, $long);

		if (isset($get_img_from_android)) {
			// base64 encoded utf-8 string
			$img_file = base64_decode($get_img_from_android);
			$img_name = $img_path.$id_masyarakat.".jpg";
			$open = fopen($img_name, 'wb');
			fwrite($open, $img_file);
			fclose($open);
		} else {
			$img_name = "";
		}

		$this->db_pengaduan->add_pengaduan($id_masyarakat, $id_peta, $img_name);
		echo '{"n":"ss_add","status":"AVAILABLE"}';
	}
}