<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->omap->type('pages');
		$this->omap->title('DASBOR');
		$this->omap->label('dasbor');
		$this->omap->display('home');
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