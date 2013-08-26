<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {


	public function __construct() {
		parent::__construct();
		$this->load->model('db_restoran');
		$this->load->model('db_menu');
	}

	public function restoran() {
		$restoran = $this->db_restoran->view();
		foreach ($restoran->result() as $row) {
			$col['id_restoran'] = $row->id_restoran;
			$col['telp'] = $row->telp;
			$col['nama'] = $row->nama;
			$col['alamat'] = $row->alamat;
			$col['latitude'] = $row->latitude;
			$col['longitude'] = $row->longitude;
			$restoran_list[] = $col;
		}

		$restoran_data = ($restoran_list) ? $restoran_list : array();
		header('Content-Type: application/json');
		echo json_encode($restoran_data);
	}

	public function all_data() {
		$get_id_restoran = $this->input->get("id_restoran");
		if ($get_id_restoran != NULL) {
			$restoran = $this->db_restoran->view_by_id($get_id_restoran);
		} else {
			$restoran = $this->db_restoran->view();
		}

		foreach ($restoran->result() as $row) {
			$id_restoran = $row->id_restoran;
			$menu = $this->db_menu->view_by_id_restoran($id_restoran);
			$menu_promo = $this->db_menu->view_promo_by_id_restoran($id_restoran);

			@$kisaran_harga = $this->db_menu->view_avg_price_by_id_restoran($id_restoran);
			@$min_harga = $this->db_menu->view_min_price_by_id_restoran($id_restoran);
			@$max_harga = $this->db_menu->view_max_price_by_id_restoran($id_restoran);
			@$menu_favorit = $this->db_menu->view_favorit_menu_by_id_restoran($id_restoran);
			@$menu_rekomendasi = $this->db_menu->view_rekomendasi_menu_by_id_restoran($id_restoran);
			@$menu_promosi = $this->db_menu->view_promosi_menu_by_id_restoran($id_restoran);

			$col['id_restoran'] = $row->id_restoran;
			$col['telp'] = $row->telp;
			$col['nama'] = htmlspecialchars_decode($row->nama);
			$col['alamat'] = htmlspecialchars_decode($row->alamat);
			$col['foto'] = $row->foto;
			$col['latitude'] = $row->latitude;
			$col['longitude'] = $row->longitude;
			$col['kisaran_harga'] = ($kisaran_harga->num_rows() != 0 ) ? $kisaran_harga->row()->kisaran_harga : '';
			$col['min_harga'] = ($min_harga->num_rows() != 0 ) ? $min_harga->row()->min_harga : '';
			$col['max_harga'] = ($max_harga->num_rows() != 0 ) ? $max_harga->row()->max_harga : '';
			$col['menu_favorit'] = ($menu_favorit->num_rows() != 0 ) ? $menu_favorit->row()->nama_menu : '';
			$col['menu_rekomendasi'] = ($menu_rekomendasi->num_rows() != 0 ) ? $menu_rekomendasi->row()->nama_menu : '';
			$col['menu_promosi'] = ($menu_promosi->num_rows() != 0 ) ? $menu_promosi->row()->nama_menu : '';

			if (@$menu->row()->id_restoran == $id_restoran) {
				$col['menu'] = $menu->result();
			} else {
				$col['menu'] = array();
			}

			if (@$menu_promo->row()->id_restoran == $id_restoran) {
				$col['promo'] = $menu_promo->result();
			} else {
				$col['promo'] = array();
			}

			$restoran_list[] = $col;
		}

		$restoran_data = (@$restoran_list) ? $restoran_list : array();
		header('Content-Type: application/json');
		echo json_encode($restoran_data);
	}

	public function restoran_nearby($lat, $long) {
		$restoran = $this->db_restoran->restoran_nearby($lat, $long);

		foreach ($restoran->result() as $row) {
			$id_restoran = $row->id_restoran;
			$menu = $this->db_menu->view_by_id_restoran($id_restoran);
			$menu_promo = $this->db_menu->view_promo_by_id_restoran($id_restoran);

			@$kisaran_harga = $this->db_menu->view_avg_price_by_id_restoran($id_restoran);
			@$min_harga = $this->db_menu->view_min_price_by_id_restoran($id_restoran);
			@$max_harga = $this->db_menu->view_max_price_by_id_restoran($id_restoran);
			@$menu_favorit = $this->db_menu->view_favorit_menu_by_id_restoran($id_restoran);
			@$menu_rekomendasi = $this->db_menu->view_rekomendasi_menu_by_id_restoran($id_restoran);
			@$menu_promosi = $this->db_menu->view_promosi_menu_by_id_restoran($id_restoran);

			$col['id_restoran'] = $row->id_restoran;
			$col['telp'] = $row->telp;
			$col['nama'] = htmlspecialchars_decode($row->nama);
			$col['alamat'] = htmlspecialchars_decode($row->alamat);
			$col['foto'] = $row->foto;
			$col['distance'] = $row->distance;
			$col['km'] = $row->km;
			$col['latitude'] = $row->latitude;
			$col['longitude'] = $row->longitude;
			$col['kisaran_harga'] = ($kisaran_harga->num_rows() != 0 ) ? $kisaran_harga->row()->kisaran_harga : '';
			$col['min_harga'] = ($min_harga->num_rows() != 0 ) ? $min_harga->row()->min_harga : '';
			$col['max_harga'] = ($max_harga->num_rows() != 0 ) ? $max_harga->row()->max_harga : '';
			$col['menu_favorit'] = ($menu_favorit->num_rows() != 0 ) ? $menu_favorit->row()->nama_menu : '';
			$col['menu_rekomendasi'] = ($menu_rekomendasi->num_rows() != 0 ) ? $menu_rekomendasi->row()->nama_menu : '';
			$col['menu_promosi'] = ($menu_promosi->num_rows() != 0 ) ? $menu_promosi->row()->nama_menu : '';

			if (@$menu->row()->id_restoran == $id_restoran) {
				$col['menu'] = $menu->result();
			} else {
				$col['menu'] = array();
			}

			if (@$menu_promo->row()->id_restoran == $id_restoran) {
				$col['promo'] = $menu->result();
			} else {
				$col['promo'] = array();
			}

			$restoran_list[] = $col;
		}

		$restoran_data = (@$restoran_list) ? $restoran_list : array();
		header('Content-Type: application/json');
		echo json_encode($restoran_data);
	}

	public function restoran_nearby_by_likes_harga() {
		$restoran = $this->db_restoran->view_by_likes_harga();

		foreach ($restoran->result() as $row) {
			$id_restoran = $row->id_restoran;
			$menu = $this->db_menu->view_by_id_restoran($id_restoran);
			$menu_promo = $this->db_menu->view_promo_by_id_restoran($id_restoran);

			@$kisaran_harga = $this->db_menu->view_avg_price_by_id_restoran($id_restoran);
			@$min_harga = $this->db_menu->view_min_price_by_id_restoran($id_restoran);
			@$max_harga = $this->db_menu->view_max_price_by_id_restoran($id_restoran);
			@$menu_favorit = $this->db_menu->view_favorit_menu_by_id_restoran($id_restoran);
			@$menu_rekomendasi = $this->db_menu->view_rekomendasi_menu_by_id_restoran($id_restoran);
			@$menu_promosi = $this->db_menu->view_promosi_menu_by_id_restoran($id_restoran);

			$col['id_restoran'] = $row->id_restoran;
			$col['telp'] = $row->telp;
			$col['nama'] = htmlspecialchars_decode($row->nama);
			$col['alamat'] = htmlspecialchars_decode($row->alamat);
			$col['foto'] = $row->foto;
			$col['likes'] = $row->likes;
			$col['latitude'] = $row->latitude;
			$col['longitude'] = $row->longitude;
			$col['kisaran_harga'] = ($kisaran_harga->num_rows() != 0 ) ? $kisaran_harga->row()->kisaran_harga : '';
			$col['min_harga'] = ($min_harga->num_rows() != 0 ) ? $min_harga->row()->min_harga : '';
			$col['max_harga'] = ($max_harga->num_rows() != 0 ) ? $max_harga->row()->max_harga : '';
			$col['menu_favorit'] = ($menu_favorit->num_rows() != 0 ) ? $menu_favorit->row()->nama_menu : '';
			$col['menu_rekomendasi'] = ($menu_rekomendasi->num_rows() != 0 ) ? $menu_rekomendasi->row()->nama_menu : '';
			$col['menu_promosi'] = ($menu_promosi->num_rows() != 0 ) ? $menu_promosi->row()->nama_menu : '';

			if (@$menu->row()->id_restoran == $id_restoran) {
				$col['menu'] = $menu->result();
			} else {
				$col['menu'] = array();
			}

			if (@$menu_promo->row()->id_restoran == $id_restoran) {
				$col['promo'] = $menu->result();
			} else {
				$col['promo'] = array();
			}

			$restoran_list[] = $col;
		}

		$restoran_data = (@$restoran_list) ? $restoran_list : array();
		header('Content-Type: application/json');
		echo json_encode($restoran_data);

	}

	public function restoran_nearby_by_likes_makanan() {
		$restoran = $this->db_restoran->view_by_likes_makanan();

		foreach ($restoran->result() as $row) {
			$id_restoran = $row->id_restoran;
			$menu = $this->db_menu->view_by_id_restoran($id_restoran);
			$menu_promo = $this->db_menu->view_promo_by_id_restoran($id_restoran);

			@$kisaran_harga = $this->db_menu->view_avg_price_by_id_restoran($id_restoran);
			@$min_harga = $this->db_menu->view_min_price_by_id_restoran($id_restoran);
			@$max_harga = $this->db_menu->view_max_price_by_id_restoran($id_restoran);
			@$menu_favorit = $this->db_menu->view_favorit_menu_by_id_restoran($id_restoran);
			@$menu_rekomendasi = $this->db_menu->view_rekomendasi_menu_by_id_restoran($id_restoran);
			@$menu_promosi = $this->db_menu->view_promosi_menu_by_id_restoran($id_restoran);

			$col['id_restoran'] = $row->id_restoran;
			$col['telp'] = $row->telp;
			$col['nama'] = htmlspecialchars_decode($row->nama);
			$col['alamat'] = htmlspecialchars_decode($row->alamat);
			$col['foto'] = $row->foto;
			$col['likes'] = $row->likes;
			$col['latitude'] = $row->latitude;
			$col['longitude'] = $row->longitude;
			$col['kisaran_harga'] = ($kisaran_harga->num_rows() != 0 ) ? $kisaran_harga->row()->kisaran_harga : '';
			$col['min_harga'] = ($min_harga->num_rows() != 0 ) ? $min_harga->row()->min_harga : '';
			$col['max_harga'] = ($max_harga->num_rows() != 0 ) ? $max_harga->row()->max_harga : '';
			$col['menu_favorit'] = ($menu_favorit->num_rows() != 0 ) ? $menu_favorit->row()->nama_menu : '';
			$col['menu_rekomendasi'] = ($menu_rekomendasi->num_rows() != 0 ) ? $menu_rekomendasi->row()->nama_menu : '';
			$col['menu_promosi'] = ($menu_promosi->num_rows() != 0 ) ? $menu_promosi->row()->nama_menu : '';

			if (@$menu->row()->id_restoran == $id_restoran) {
				$col['menu'] = $menu->result();
			} else {
				$col['menu'] = array();
			}

			if (@$menu_promo->row()->id_restoran == $id_restoran) {
				$col['promo'] = $menu->result();
			} else {
				$col['promo'] = array();
			}

			$restoran_list[] = $col;
		}

		$restoran_data = (@$restoran_list) ? $restoran_list : array();
		header('Content-Type: application/json');
		echo json_encode($restoran_data);

	}

	public function restoran_nearby_by_likes_pelayanan() {
		$restoran = $this->db_restoran->view_by_likes_pelayanan();

		foreach ($restoran->result() as $row) {
			$id_restoran = $row->id_restoran;
			$menu = $this->db_menu->view_by_id_restoran($id_restoran);
			$menu_promo = $this->db_menu->view_promo_by_id_restoran($id_restoran);

			@$kisaran_harga = $this->db_menu->view_avg_price_by_id_restoran($id_restoran);
			@$min_harga = $this->db_menu->view_min_price_by_id_restoran($id_restoran);
			@$max_harga = $this->db_menu->view_max_price_by_id_restoran($id_restoran);
			@$menu_favorit = $this->db_menu->view_favorit_menu_by_id_restoran($id_restoran);
			@$menu_rekomendasi = $this->db_menu->view_rekomendasi_menu_by_id_restoran($id_restoran);
			@$menu_promosi = $this->db_menu->view_promosi_menu_by_id_restoran($id_restoran);

			$col['id_restoran'] = $row->id_restoran;
			$col['telp'] = $row->telp;
			$col['nama'] = htmlspecialchars_decode($row->nama);
			$col['alamat'] = htmlspecialchars_decode($row->alamat);
			$col['foto'] = $row->foto;
			$col['likes'] = $row->likes;
			$col['latitude'] = $row->latitude;
			$col['longitude'] = $row->longitude;
			$col['kisaran_harga'] = ($kisaran_harga->num_rows() != 0 ) ? $kisaran_harga->row()->kisaran_harga : '';
			$col['min_harga'] = ($min_harga->num_rows() != 0 ) ? $min_harga->row()->min_harga : '';
			$col['max_harga'] = ($max_harga->num_rows() != 0 ) ? $max_harga->row()->max_harga : '';
			$col['menu_favorit'] = ($menu_favorit->num_rows() != 0 ) ? $menu_favorit->row()->nama_menu : '';
			$col['menu_rekomendasi'] = ($menu_rekomendasi->num_rows() != 0 ) ? $menu_rekomendasi->row()->nama_menu : '';
			$col['menu_promosi'] = ($menu_promosi->num_rows() != 0 ) ? $menu_promosi->row()->nama_menu : '';

			if (@$menu->row()->id_restoran == $id_restoran) {
				$col['menu'] = $menu->result();
			} else {
				$col['menu'] = array();
			}

			if (@$menu_promo->row()->id_restoran == $id_restoran) {
				$col['promo'] = $menu->result();
			} else {
				$col['promo'] = array();
			}

			$restoran_list[] = $col;
		}

		$restoran_data = (@$restoran_list) ? $restoran_list : array();
		header('Content-Type: application/json');
		echo json_encode($restoran_data);

	}

}