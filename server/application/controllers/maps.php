<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Maps extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('db_pengaduan');
	}

	public function index() {
		$head[] = js('http://maps.googleapis.com/maps/api/js?sensor=false');
		$head[] = js(JS.'gmap3.js');
		$this->omap->head(build_head($head));
		
		if ($this->session->userdata('logged_damkar_user_id')) {
			$data['q_pengaduan_5'] = $this->db_pengaduan->view_pengaduan_by_nearby('-6.917467','107.633333','5')->result();
			$data['q_pengaduan_10'] = $this->db_pengaduan->view_pengaduan_by_nearby_and_between('-6.917467','107.633333','5-10')->result();
			$data['q_pengaduan_15'] = $this->db_pengaduan->view_pengaduan_by_nearby_and_between('-6.917467','107.633333','10-15')->result();
			$data['q_pengaduan_20'] = $this->db_pengaduan->view_pengaduan_by_nearby_and_between('-6.917467','107.633333','15-20')->result();
			$data['q_pengaduan__'] = $this->db_pengaduan->view_pengaduan_by_nearby('-6.917467','107.633333','20', '>')->result();
			
			$this->omap->type('pages');
			$this->omap->title('DASBOR');
			$this->omap->label('dasbor');
			$this->omap->display('maps', $data);
		} else {
			redirect('mod_login');
		}
	}
}