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

		$id_pengaduan = $this->db_pengaduan->add_pengaduan($id_masyarakat, $id_peta, $img_name);
		$distance = $this->db_pengaduan->view_pengaduan_by_id_and_distance($id_pengaduan,'-6.917467','107.633333','20','>')->num_rows();
		$q_distance = $this->db_pengaduan->view_pengaduan_by_id_and_distance($id_pengaduan,'-6.917467','107.633333','20','>')->result();
		$get_distance = ($distance != 0) ? $q_distance[0]->distance : 0;
		if ($get_distance == 0) {
			echo '{"n":"ss_add","status":"AVAILABLE", "id_pengaduan": '.$id_pengaduan.', "distance" : '.$get_distance.'}';	
		} else {
			$this->db_pengaduan->update_status_pengaduan($id_pengaduan, 'OUT-OF-COVERAGE');
			echo '{"n":"ss_add","status":"OUT-OF-COVERAGE", "id_pengaduan": '.$id_pengaduan.', "distance" : '.$get_distance.'}';
		}
		
	}

	public function update_status_pengaduan($id, $status) {
		$this->db_pengaduan->update_status_pengaduan($id, $status);
		echo '{"n":"ss_add","status":"ON-CALL"}';
	}
}