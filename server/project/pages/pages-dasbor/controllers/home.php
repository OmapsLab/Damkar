<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('db_pengaduan');
	}

	public function index() {
		if ($this->session->userdata('logged_damkar_user_id')) {
			$data['q_pengaduan'] = $this->db_pengaduan->view_pengaduan_by_distance_and_now('-6.917467','107.633333')->result();

			$this->omap->type('pages');
			$this->omap->title('DASBOR');
			$this->omap->label('dasbor');
			$this->omap->display('home_now', $data);
		} else {
			redirect('mod_login');
		}
	}

	public function now() {
		if ($this->session->userdata('logged_damkar_user_id')) {
			$data['q_pengaduan'] = $this->db_pengaduan->view_pengaduan_by_distance_and_now('-6.917467','107.633333')->result();

			$this->omap->type('pages');
			$this->omap->title('DASBOR');
			$this->omap->label('dasbor');
			$this->omap->display('home_now', $data);
		} else {
			redirect('mod_login');
		}
	}

	public function lasted() {
		if ($this->session->userdata('logged_damkar_user_id')) {
			$data['q_pengaduan'] = $this->db_pengaduan->view_pengaduan_by_distance_and_status('-6.917467','107.633333', 'AVAILABLE')->result();

			$this->omap->type('pages');
			$this->omap->title('DASBOR');
			$this->omap->label('dasbor');
			$this->omap->display('home_lasted', $data);
		} else {
			redirect('mod_login');
		}
	}

	public function search() {
		if ($this->session->userdata('logged_damkar_user_id')) {
				
			$key = $this->input->get('search');
			$data['q_pengaduan'] = $this->db_pengaduan->view_pengaduan_by_search($key,'-6.917467','107.633333')->result();

			$this->omap->type('pages');
			$this->omap->title('DASBOR');
			$this->omap->label('dasbor');
			$this->omap->display('home_lasted', $data);
		} else {
			redirect('mod_login');
		}
	}

	public function nearby() {
		if ($this->session->userdata('logged_damkar_user_id')) {
			$data['q_pengaduan_5'] = $this->db_pengaduan->view_pengaduan_by_nearby('-6.917467','107.633333','5')->result();
			$data['q_pengaduan_10'] = $this->db_pengaduan->view_pengaduan_by_nearby_and_between('-6.917467','107.633333','5-10')->result();
			$data['q_pengaduan_15'] = $this->db_pengaduan->view_pengaduan_by_nearby_and_between('-6.917467','107.633333','10-15')->result();
			$data['q_pengaduan_20'] = $this->db_pengaduan->view_pengaduan_by_nearby_and_between('-6.917467','107.633333','15-20')->result();
			$data['q_pengaduan__'] = $this->db_pengaduan->view_pengaduan_by_nearby('-6.917467','107.633333','20', '>')->result();

			$this->omap->type('pages');
			$this->omap->title('DASBOR');
			$this->omap->label('dasbor');
			$this->omap->display('home', $data);
		} else {
			redirect('mod_login');
		}
	}


	public function update_masyarakat() {
		if ($this->session->userdata('logged_damkar_user_id')) {
			$id = $this->input->post('id_masyarakat');
			$nama = htmlspecialchars($this->input->post('nama'), ENT_QUOTES);
			$alamat = htmlspecialchars($this->input->post('alamat'), ENT_QUOTES);

			if ($nama == "" || $alamat == "") {
				echo '{"n":"err_null"}';
			} else {
				$this->db_pengaduan->update_masyarakat($id, $nama, $alamat);
				echo '{"n":"ss_udt"}';
			}
		} else {
			redirect('mod_login');
		}
	}

	public function update_status() {
		if ($this->session->userdata('logged_damkar_user_id')) {
			$status = $this->input->post('status');
			$id = $this->input->post('id_pengaduan');
			$page_from = $this->input->post('page-from');

			if ($status == "") {
				echo '{"n":"err_null"}';
			} else {
				$this->db_pengaduan->update_status_pengaduan($id, $status);
				echo '{"n":"ss_udt", "page_from":"'.$page_from.'"}';
			}
		} else {
			redirect('mod_login');
		}
	}

	public function maps_masyarakat() {
		$head[] = js('http://maps.googleapis.com/maps/api/js?sensor=false');
		$head[] = js(JS.'gmap3.js');
		$this->omap->head(build_head($head));

		if ($this->session->userdata('logged_damkar_user_id')) {
			$data['q_pengaduan'] = $this->db_pengaduan->view_pengaduan()->result();
			$this->omap->type('pages');
			$this->omap->title('VIEW MAPS');
			$this->omap->label('dasbor');
			$this->omap->view('modules');
			$this->omap->display('maps_masyarakat', $data);

		} else {
			redirect('mod_login');
		}
	}

	public function foto_masyarakat($id_pengaduan) {
		if ($this->session->userdata('logged_damkar_user_id')) {
			$data['q_pengaduan'] = $this->db_pengaduan->view_pengaduan_by_id($id_pengaduan)->result();
			$this->omap->type('pages');
			$this->omap->title('FOTO');
			$this->omap->label('dasbor');
			$this->omap->view('modules');
			$this->omap->display('foto_masyarakat', $data);

		} else {
			redirect('mod_login');
		}
	}

	public function detail_pengaduan($id_pengaduan) {
		$head[] = js('http://maps.googleapis.com/maps/api/js?sensor=false');
		$head[] = js(JS.'gmap3.js');
		$this->omap->head(build_head($head));

		if ($this->session->userdata('logged_damkar_user_id')) {
			$data['q_pengaduan'] = $this->db_pengaduan->view_pengaduan_by_id($id_pengaduan)->result();
			$this->omap->type('pages');
			$this->omap->title('DETAIL PENGADUAN');
			$this->omap->label('dasbor');
			$this->omap->view('modules');
			$this->omap->display('detail_pengaduan', $data);

		} else {
			redirect('mod_login');
		}
	}

	private function paging_config($url_page, $per_page_view, $total_item) {
		// Paging
		$config["base_url"] = SITE_INDEX . $url_page;
		$config['page_query_string'] = TRUE;
		$config["total_rows"] = $total_item;
		$config["per_page"] = $per_page_view;
		$config["uri_segment"] = 3;
		$config['full_tag_open'] = '<div class="pagination"><ul>';
		$config['full_tag_close'] = '</ul></div>';
		$config['cur_tag_open'] = '<li class="active"><a href="javascript:;">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		return $config;
	}
}