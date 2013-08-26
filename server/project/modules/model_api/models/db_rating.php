<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Db_rating extends CI_Model {

	public function add($id_restoran, $user, $harga, $makanan, $pelayanan) {
		return $this->db->query("INSERT INTO rating (id_restoran,
													 user,
													 harga,
													 makanan,
													 pelayanan,
													 tgl_rating)
							 	VALUES ('".$id_restoran."',
							 			'".$user."',
							 			'".$harga."',
							 			'".$makanan."',
							 			'".$pelayanan."',
							 			NOW())");	
	}

	public function add_rating_harga($id_restoran, $user, $harga) {
		return $this->db->query("INSERT INTO rating (id_restoran,
													 user,
													 harga,
													 tgl_rating)
							 	VALUES ('".$id_restoran."',
							 			'".$user."',
							 			'".$harga."',
							 			NOW())");	
	}

	public function add_rating_makanan($id_restoran, $user, $makanan) {
		return $this->db->query("INSERT INTO rating (id_restoran,
													 user,
													 makanan,
													 tgl_rating)
							 	VALUES ('".$id_restoran."',
							 			'".$user."',
							 			'".$makanan."',
							 			NOW())");	
	}

	public function add_rating_pelayanan($id_restoran, $user, $pelayanan) {
		return $this->db->query("INSERT INTO rating (id_restoran,
													 user,
													 pelayanan,
													 tgl_rating)
							 	VALUES ('".$id_restoran."',
							 			'".$user."',
							 			'".$pelayanan."',
							 			NOW())");	
	}

	public function update_rating_harga($id, $id_restoran, $user, $harga) {
		return $this->db->query("UPDATE rating SET id_restoran = '".$id_restoran."',
													 user = '".$user."',
													 harga = '".$harga."',
													 tgl_rating = NOW()
													 
							 	WHERE id_rating = '".$id."'");	
	}

	public function update_rating_makanan($id, $id_restoran, $user, $makanan) {
		return $this->db->query("UPDATE rating SET id_restoran = '".$id_restoran."',
													 user = '".$user."',
													 makanan = '".$makanan."',
													 tgl_rating = NOW()
													 
							 	WHERE id_rating = '".$id."'");	
	}

	public function update_rating_pelayanan($id, $id_restoran, $user, $pelayanan) {
		return $this->db->query("UPDATE rating SET id_restoran = '".$id_restoran."',
													 user = '".$user."',
													 pelayanan = '".$pelayanan."',
													 tgl_rating = NOW()
													 
							 	WHERE id_rating = '".$id."'");	
	}

	public function update($id, $id_restoran, $user, $harga, $makanan, $pelayanan) {
		return $this->db->query("UPDATE rating SET id_restoran = '".$id_restoran."',
													 user = '".$user."',
													 harga = '".$harga."',
													 makanan = '".$makanan."',
													 pelayanan = '".$pelayanan."',
													 tgl_rating = NOW()
													 
							 	WHERE id_rating = '".$id."'");	
	}

	public function view () {
		return $this->db->query("SELECT * FROM rating");
	}

	public function view_by_user($user) {
		return $this->db->query("SELECT *
								 FROM rating 
								 WHERE user = '".$user."'");
	}

	public function view_by_user_and_id_restoran($user, $id_restoran) {
		return $this->db->query("SELECT *
								 FROM rating 
								 WHERE user = '".$user."'
								 AND id_restoran = '".$id_restoran."'");
	}

	public function view_by_id_restoran($id_restoran) {
		return $this->db->query("SELECT *
								 FROM rating 
								 WHERE id_restoran = '".$id_restoran."'");
	}

	public function view_count_rating() {
		return $this->db->query("SELECT r.tgl_rating as tgl,
										rt.nama,
										r.id_restoran,
										SUM(r.harga) as like_harga,
										SUM(r.makanan) as like_makanan,
										SUM(r.pelayanan) as like_pelayanan
								 FROM rating r 
								 INNER JOIN restoran rt ON r.id_restoran = rt.id_restoran
								 GROUP BY r.id_restoran");
	}

	public function view_count_rating_likes_harga() {
		return $this->db->query("SELECT r.tgl_rating as tgl,
										rt.nama,
										r.id_restoran,
										SUM(r.harga) as like_harga,
										SUM(r.makanan) as like_makanan,
										SUM(r.pelayanan) as like_pelayanan
								 FROM rating r
								 INNER JOIN restoran rt ON r.id_restoran = rt.id_restoran
								 GROUP BY r.id_restoran 
								 ORDER BY like_harga DESC");
	}

	public function view_count_rating_likes_pelayanan() {
		return $this->db->query("SELECT r.tgl_rating as tgl,
										rt.nama,
										r.id_restoran,
										SUM(r.harga) as like_harga,
										SUM(r.makanan) as like_makanan,
										SUM(r.pelayanan) as like_pelayanan
								 FROM rating r
								 INNER JOIN restoran rt ON r.id_restoran = rt.id_restoran
								 GROUP BY r.id_restoran 
								 ORDER BY like_pelayanan DESC");
	}

	public function view_count_rating_likes_makanan() {
		return $this->db->query("SELECT r.tgl_rating as tgl,
										rt.nama,
										r.id_restoran,
										SUM(r.harga) as like_harga,
										SUM(r.makanan) as like_makanan,
										SUM(r.pelayanan) as like_pelayanan
								 FROM rating r
								 INNER JOIN restoran rt ON r.id_restoran = rt.id_restoran
								 GROUP BY r.id_restoran 
								 ORDER BY like_makanan DESC");
	}

	public function view_count_rating_unlikes_harga() {
		return $this->db->query("SELECT r.tgl_rating as tgl,
										rt.nama,
										r.id_restoran,
										SUM(r.harga) as like_harga,
										SUM(r.makanan) as like_makanan,
										SUM(r.pelayanan) as like_pelayanan
								 FROM rating r
								 INNER JOIN restoran rt ON r.id_restoran = rt.id_restoran
								 GROUP BY r.id_restoran 
								 ORDER BY like_harga");
	}

	public function view_count_rating_unlikes_pelayanan() {
		return $this->db->query("SELECT r.tgl_rating as tgl,
										rt.nama,
										r.id_restoran,
										SUM(r.harga) as like_harga,
										SUM(r.makanan) as like_makanan,
										SUM(r.pelayanan) as like_pelayanan
								 FROM rating r
								 INNER JOIN restoran rt ON r.id_restoran = rt.id_restoran
								 GROUP BY r.id_restoran 
								 ORDER BY like_pelayanan");
	}

	public function view_count_rating_unlikes_makanan() {
		return $this->db->query("SELECT r.tgl_rating as tgl,
										rt.nama,
										r.id_restoran,
										SUM(r.harga) as like_harga,
										SUM(r.makanan) as like_makanan,
										SUM(r.pelayanan) as like_pelayanan
								 FROM rating r
								 INNER JOIN restoran rt ON r.id_restoran = rt.id_restoran
								 GROUP BY r.id_restoran 
								 ORDER BY like_makanan");
	}

	public function view_restoran_rating() {
		return $this->db->query("SELECT *
								 FROM rating r 
								 INNER JOIN restoran rt ON r.id_restoran = rt.id_restoran
								 GROUP BY r.id_restoran");
	}

}
