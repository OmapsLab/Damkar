<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Db_restoran extends CI_Model {

	public function view() {
		return $this->db->query("SELECT *
							     FROM restoran 
							     ORDER BY id_restoran DESC");	
	}

	public function view_by_likes_harga() {
		return $this->db->query("SELECT *,
								 SUM(rt.harga) as likes
							     FROM restoran r
							     LEFT JOIN rating rt ON rt.id_restoran = r.id_restoran
							     WHERE rt.harga IS NOT NULL
							     AND rt.harga > 0
							     GROUP BY r.id_restoran
							     ORDER BY likes DESC ");	
	}

	public function view_by_likes_makanan() {
		return $this->db->query("SELECT *,
								 SUM(rt.makanan) as likes
							     FROM restoran r
							     LEFT JOIN rating rt ON rt.id_restoran = r.id_restoran
							     WHERE rt.makanan IS NOT NULL
							     AND rt.makanan > 0
							     GROUP BY r.id_restoran
							     ORDER BY likes DESC");	
	}

	public function view_by_likes_pelayanan() {
		return $this->db->query("SELECT *,
								 SUM(rt.pelayanan) as likes
							     FROM restoran r
							     LEFT JOIN rating rt ON rt.id_restoran = r.id_restoran
							     WHERE rt.pelayanan IS NOT NULL
							     AND rt.pelayanan > 0
							     GROUP BY r.id_restoran
							     ORDER BY likes DESC");	
	}

	public function view_by_search($key) {
		return $this->db->query("SELECT *
							     FROM restoran 
							     WHERE nama LIKE '%".$key."%'
							     OR alamat LIKE '%".$key."%'
							     OR telp LIKE '%".$key."%'
							     OR latitude LIKE '%".$key."%'
							     OR longitude LIKE '%".$key."%'
							     ORDER BY id_restoran DESC");
	}

	public function view_by_limit($start, $end) {
		return $this->db->query("SELECT *
							     FROM restoran 
							     ORDER BY id_restoran DESC 
							     LIMIT ". $start .",". $end);	
	}

	public function view_by_id($id) {
		return $this->db->query("SELECT *
							     FROM restoran 
							     WHERE id_restoran = '".$id."' ");	
	}

	public function add($nama, $alamat, $telp, $lat, $long, $foto) {
		return $this->db->query("INSERT INTO restoran ( nama,
														alamat,
														telp,
														latitude,
														longitude,
														foto )
								 VALUES ( '".$nama."',
								 		  '".$alamat."',
								 		  '".$telp."',
								 		  '".$lat."',
								 		  '".$long."',
								 		  '".$foto."')");	
	}

	public function update($id, $nama, $alamat, $telp, $lat, $long, $foto) {
		return $this->db->query("UPDATE restoran SET nama = '".$nama."',
														alamat = '".$alamat."',
														telp = '".$telp."',
														latitude = '".$lat."',
														longitude = '".$long."',
														foto = '".$foto."'
								 WHERE id_restoran = '".$id."'");	
	}

	public function delete($id) {
		return $this->db->query("DELETE
							     FROM restoran 
								 WHERE id_restoran = '".$id."'");	
	}

	public function restoran_nearby($lat, $long) {
		return $this->db->query("SELECT id_restoran,
										latitude, 
									    longitude,
									    ROUND(( 6371 * acos( cos( radians(".$lat.") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(".$long.") ) + sin( radians(".$lat.") ) * sin( radians( latitude ) ) ) )) AS km, 
									    ( 6371 * acos( cos( radians(".$lat.") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(".$long.") ) + sin( radians(".$lat.") ) * sin( radians( latitude ) ) ) ) AS distance,
									    nama,
									    alamat,
									    telp,
									    foto
							     FROM restoran HAVING distance < 25000 ORDER BY distance");
	}
}
