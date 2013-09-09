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
			$q_location = $this->db_pengaduan->view_pengaduan_by_nearby_and_status('-6.917467','107.633333','20', '<', 'AVAILABLE')->result();
			foreach ($q_location as $row) {
				$data_locations[] = '{latLng:['.$row->latitude.', '.$row->longitude.'], id:'.$row->id_pengaduan.'}';	
			}
			
			$data['data_location'] = implode(",", $data_locations);
			
			$this->omap->type('pages');
			$this->omap->title('MAPS');
			$this->omap->label('dasbor');
			$this->omap->display('maps', $data);
		} else {
			redirect('mod_login');
		}
	}
}