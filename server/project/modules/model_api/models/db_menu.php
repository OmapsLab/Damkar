<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Db_menu extends CI_Model {

	public function view() {
		return $this->db->query("SELECT *,
										m.id_menu as id_menus,
										CASE WHEN (p.harga_promo > 0)
											 THEN p.harga_promo
											 ELSE m.harga
											 END as harga_akhir,
										DATE_FORMAT(p.tgl_promo, '%Y-%m-%d') as date_promo 
							     FROM menu m 
							     LEFT JOIN restoran r ON r.id_restoran = m.id_restoran
							     LEFT JOIN promo p ON p.id_menu = m.id_menu
							     ORDER BY r.nama");	
	}

	public function view_by_search($key) {
		return $this->db->query("SELECT *,
										m.id_menu as id_menus,
										CASE WHEN (p.harga_promo > 0)
											 THEN p.harga_promo
											 ELSE m.harga
											 END as harga_akhir,
										DATE_FORMAT(p.tgl_promo, '%Y-%m-%d') as date_promo 
							     FROM menu m 
							     LEFT JOIN restoran r ON r.id_restoran = m.id_restoran
							     LEFT JOIN promo p ON p.id_menu = m.id_menu
							     WHERE m.nama_menu LIKE '%".$key."%'
							     OR m.paket LIKE '%".$key."%'
							     OR m.harga LIKE '%".$key."%'
							     OR m.jenis_makanan LIKE '%".$key."%'
							     OR m.gambar LIKE '%".$key."%'
							     OR m.detail_menu LIKE '%".$key."%'
							     OR r.nama LIKE '%".$key."%'
							     ORDER BY r.nama");	
	}


	public function view_by_limit($start, $end) {
		return $this->db->query("SELECT *,
										m.id_menu as id_menus,
										CASE WHEN (p.harga_promo > 0)
											 THEN p.harga_promo
											 ELSE m.harga
											 END as harga_akhir,
										DATE_FORMAT(p.tgl_promo, '%Y-%m-%d') as date_promo 
							     FROM menu m 
							     LEFT JOIN restoran r ON r.id_restoran = m.id_restoran
							     LEFT JOIN promo p ON p.id_menu = m.id_menu
							     ORDER BY r.nama
							     LIMIT " . $start.",". $end);	
	}

	public function view_filter_by_id_restoran($id_restoran) {
		return $this->db->query("SELECT *,
										m.id_menu as id_menus,
										CASE WHEN (p.harga_promo > 0)
											 THEN p.harga_promo
											 ELSE m.harga
											 END as harga_akhir,
										DATE_FORMAT(p.tgl_promo, '%Y-%m-%d') as date_promo 
							     FROM menu m 
							     LEFT JOIN restoran r ON r.id_restoran = m.id_restoran
							     LEFT JOIN promo p ON p.id_menu = m.id_menu
							     WHERE m.id_restoran = '".$id_restoran."'");	
	}

	public function view_by_id_restoran($id_restoran) {
		return $this->db->query("SELECT	m.id_menu,
										p.id_menu as id_menu_promosi, 
										m.id_restoran, 
										m.nama_menu, 
										m.paket, 
										m.harga, 
										m.jenis_makanan, 
										m.gambar, 
										m.menu_favorit, 
										m.menu_rekomendasi, 
										m.menu_promosi, 
										m.detail_menu, 
										m.tgl_masuk,
								        p.id_menu as id_menu_promosi,
										CASE WHEN (p.harga_promo > 0)
											 THEN p.harga_promo
											 ELSE m.harga
											 END as harga_akhir,
										DATE_FORMAT(p.tgl_promo, '%Y-%m-%d') as date_promo 
							     FROM menu m
							     LEFT JOIN promo p ON p.id_menu = m.id_menu
							     WHERE m.id_restoran = '".$id_restoran."'
							     ORDER BY m.menu_favorit, m.menu_rekomendasi, p.tgl_promo DESC");	
	}

	public function view_promo_by_id_restoran($id_restoran) {
		return $this->db->query("SELECT	m.id_menu,
										p.id_menu as id_menu_promosi, 
										m.id_restoran, 
										m.nama_menu, 
										m.paket, 
										m.harga, 
										m.jenis_makanan, 
										m.gambar, 
										m.menu_favorit, 
										m.menu_rekomendasi, 
										m.menu_promosi, 
										m.detail_menu, 
										m.tgl_masuk,
								        p.id_menu as id_menu_promosi,
										CASE WHEN (p.harga_promo > 0)
											 THEN p.harga_promo
											 ELSE m.harga
											 END as harga_akhir,
										DATE_FORMAT(p.tgl_promo, '%Y-%m-%d') as date_promo 
							     FROM menu m
							     LEFT JOIN promo p ON p.id_menu = m.id_menu
							     WHERE m.id_restoran = '".$id_restoran."'
							     AND m.menu_promosi = 'YES' 
							     ORDER BY p.tgl_promo DESC");	
	}

	public function view_by_id($id) {
		return $this->db->query("SELECT *,
										m.id_menu as id_menus,
										CASE WHEN (p.harga_promo > 0)
											 THEN p.harga_promo
											 ELSE m.harga
											 END as harga_akhir,
										DATE_FORMAT(p.tgl_promo, '%Y-%m-%d') as date_promo
							     FROM menu m 
							     LEFT JOIN restoran r ON r.id_restoran = m.id_restoran
							     LEFT JOIN promo p ON p.id_menu = m.id_menu
							     WHERE m.id_menu = '".$id."' ");	
	}

	public function view_by_promo() {
		return $this->db->query("SELECT *,
										m.id_menu as id_menus,
										CASE WHEN (p.harga_promo > 0)
											 THEN p.harga_promo
											 ELSE m.harga
											 END as harga_akhir,
										DATE_FORMAT(p.tgl_promo, '%Y-%m-%d') as date_promo,
										DATE_FORMAT(m.tgl_masuk, '%Y-%m-%d') as date_input 
							     FROM menu m 
							     LEFT JOIN restoran r ON r.id_restoran = m.id_restoran
							     LEFT JOIN promo p ON p.id_menu = m.id_menu
							     WHERE m.menu_promosi = 'YES' 
							     AND NOT p.tgl_promo = ''");
	}

	public function view_by_promo_and_search($key) {
		return $this->db->query("SELECT *,
										m.id_menu as id_menus,
										CASE WHEN (p.harga_promo > 0)
											 THEN p.harga_promo
											 ELSE m.harga
											 END as harga_akhir,
										DATE_FORMAT(p.tgl_promo, '%Y-%m-%d') as date_promo,
										DATE_FORMAT(m.tgl_masuk, '%Y-%m-%d') as date_input 
							     FROM menu m 
							     LEFT JOIN restoran r ON r.id_restoran = m.id_restoran   
							     LEFT JOIN promo p ON p.id_menu = m.id_menu
							     WHERE p.harga_promo LIKE '%".$key."%'
							     AND m.menu_promosi = 'YES'
							     OR m.nama_menu LIKE '%".$key."%'
							     OR m.paket LIKE '%".$key."%'
							     OR m.jenis_makanan LIKE '%".$key."%'
							     OR m.gambar LIKE '%".$key."%'
							     OR m.detail_menu LIKE '%".$key."%'
							     OR r.nama LIKE '%".$key."%' 
							     GROUP BY p.id_promo");
	}

	public function view_by_promo_and_limit($start, $end) {
		return $this->db->query("SELECT *,
										m.id_menu as id_menus,
										CASE WHEN (p.harga_promo > 0)
											 THEN p.harga_promo
											 ELSE m.harga
											 END as harga_akhir,
										DATE_FORMAT(p.tgl_promo, '%Y-%m-%d') as date_promo,
										DATE_FORMAT(m.tgl_masuk, '%Y-%m-%d') as date_input 
							     FROM menu m 
							     LEFT JOIN restoran r ON r.id_restoran = m.id_restoran
							     LEFT JOIN promo p ON p.id_menu = m.id_menu
							     WHERE m.menu_promosi = 'YES' 
							     AND NOT p.tgl_promo = ''
							     LIMIT ". $start.",". $end);
	}

	public function view_by_promo_and_id_restoran($id_restoran) {
		return $this->db->query("SELECT *,
										m.id_menu as id_menus,
										CASE WHEN (p.harga_promo > 0)
											 THEN p.harga_promo
											 ELSE m.harga
											 END as harga_akhir,
										DATE_FORMAT(p.tgl_promo, '%Y-%m-%d') as date_promo,
										DATE_FORMAT(m.tgl_masuk, '%Y-%m-%d') as date_input  
							     FROM menu m 
							     LEFT JOIN restoran r ON r.id_restoran = m.id_restoran
							     LEFT JOIN promo p ON p.id_menu = m.id_menu
							     WHERE m.menu_promosi = 'YES' 
							     AND m.id_restoran = '".$id_restoran."'
							     AND NOT p.tgl_promo = ''");
	}

	public function view_promo_by_id_menu($id_menu) {
		return $this->db->query("SELECT *
								 FROM promo 
								 WHERE id_menu = '".$id_menu."'");
	}

	public function view_avg_price_by_id_restoran($id_restoran) {
		return $this->db->query("SELECT AVG(harga) as kisaran_harga
								 FROM menu 
								 WHERE id_restoran = '".$id_restoran."'
								 GROUP BY id_restoran");
	}

	public function view_min_price_by_id_restoran($id_restoran) {
		return $this->db->query("SELECT MIN(harga) as min_harga
								 FROM menu 
								 WHERE id_restoran = '".$id_restoran."'
								 GROUP BY id_restoran");
	}

	public function view_max_price_by_id_restoran($id_restoran) {
		return $this->db->query("SELECT MAX(harga) as max_harga
								 FROM menu 
								 WHERE id_restoran = '".$id_restoran."'
								 GROUP BY id_restoran");
	}

	public function view_favorit_menu_by_id_restoran($id_restoran) {
		return $this->db->query("SELECT *
								 FROM menu 
								 WHERE id_restoran = '".$id_restoran."'
								 AND menu_favorit = 'YES'
								 GROUP BY id_restoran");
	}

	public function view_rekomendasi_menu_by_id_restoran($id_restoran) {
		return $this->db->query("SELECT *
								 FROM menu 
								 WHERE id_restoran = '".$id_restoran."'
								 AND menu_rekomendasi = 'YES'
								 GROUP BY id_restoran");
	}

	public function view_promosi_menu_by_id_restoran($id_restoran) {
		return $this->db->query("SELECT *
								 FROM menu 
								 WHERE id_restoran = '".$id_restoran."'
								 AND menu_promosi = 'YES'
								 GROUP BY id_restoran");
	}

	public function add($id_restoran, $nama_menu, $paket, $harga, $jenis_makanan, $detail_menu, $menu_favorit, $menu_rekomendasi, $promosi, $gambar) {
		$this->db->query("INSERT INTO menu ( id_restoran,
													nama_menu,
													paket,
													harga,
													jenis_makanan,
													menu_favorit,
													menu_rekomendasi,
													menu_promosi,
													detail_menu,
													gambar,
													tgl_masuk )
								 VALUES ( '".$id_restoran."',
								 		  '".$nama_menu."',
								 		  '".$paket."',
								 		  '".$harga."',
								 		  '".$jenis_makanan."',
								 		  '".$menu_favorit."',
								 		  '".$menu_rekomendasi."',
								 		  '".$promosi."',
								 		  '".$detail_menu."',
								 		  '".$gambar."',
								 		  NOW())");
		return $this->db->insert_id();
	}

	public function add_promo($id_menu, $harga_promo, $keterangan_promo, $tgl) {
		return $this->db->query("INSERT INTO promo ( id_menu,
													 harga_promo,
													 keterangan_promo,
													 tgl_promo )
								 VALUES ( '".$id_menu."',
								 		  '".$harga_promo."',
								 		  '".$keterangan_promo."',
								 		  '".$tgl."')");	
	}

	public function update_promo($id, $id_menu, $harga_promo, $tgl) {
		return $this->db->query("UPDATE promo SET id_menu = '".$id_menu."',
												  harga_promo = '".$harga_promo."',		 
												  tgl_promo = '".$tgl."'
								 WHERE id_promo = '".$id."'");	
	}

	public function update($id, $id_restoran, $nama_menu, $paket, $harga, $jenis_makanan, $detail_menu, $menu_favorit, $menu_rekomendasi, $promosi, $gambar) {
		return $this->db->query("UPDATE menu SET id_restoran = '".$id_restoran."',
												 nama_menu = '".$nama_menu."',
												 paket = '".$paket."',
												 harga = '".$harga."',
												 jenis_makanan = '".$jenis_makanan."',
												 menu_favorit = '".$menu_favorit."',
												 menu_rekomendasi = '".$menu_rekomendasi."',
												 menu_promosi = '".$promosi."',
												 detail_menu = '".$detail_menu."',
												 gambar = '".$gambar."',
												 tgl_masuk = NOW()
								 WHERE id_menu = '".$id."'");	
	}

	public function delete($id) {
		return $this->db->query("DELETE
							     FROM menu
								 WHERE id_menu = '".$id."'");	
	}

	public function delete_promo($id) {
		return $this->db->query("DELETE
							     FROM promo
								 WHERE id_promo = '".$id."'");	
	}
}
