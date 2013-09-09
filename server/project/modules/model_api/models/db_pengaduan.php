<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Db_pengaduan extends CI_Model {

	public function add_pengaduan_masyarakat($hp) {
		$this->db->query("INSERT INTO masyarakat(hp)
								 VALUES ( '".$hp."')");
		return $this->db->insert_id();
	}

	public function update_masyarakat($id, $nama, $alamat) {
		$this->db->query("UPDATE masyarakat SET nama = '".$nama."',
											    alamat = '".$alamat."'
						  WHERE id_masyarakat = '".$id."'");
		return $this->db->insert_id();
	}

	public function add_pengaduan_peta($lat, $long) {
		$this->db->query("INSERT INTO peta(latitude,
										   longitude)
								 VALUES ('".$lat."',
								 		 '".$long."'
								 		 )");
		return $this->db->insert_id();
	}

	public function add_pengaduan($id_masyarakat, $id_peta, $foto = "") {
		$this->db->query("INSERT INTO pengaduan(id_masyarakat_f,
										   id_peta_f,
										   foto,
										   tgl_pengaduan)
								 VALUES ('".$id_masyarakat."',
								 		 '".$id_peta."',
								 		 '".$foto."',
								 		 NOW()
								 		 )");
		return $this->db->insert_id();
	}

	public function view_pengaduan() {
		return $this->db->query("SELECT *,
										DATE_FORMAT(p.tgl_pengaduan, '%Y-%m-%d') as date_pengaduan
							     FROM pengaduan p 
							     LEFT JOIN masyarakat m ON m.id_masyarakat = p.id_masyarakat_f
							     LEFT JOIN peta pt ON pt.id_peta = p.id_peta_f
							     ORDER BY p.tgl_pengaduan DESC");	
	}

	public function view_pengaduan_by_search($key, $lat, $long) {
		return $this->db->query("SELECT *,
										DATE_FORMAT(p.tgl_pengaduan, '%Y-%m-%d') as date_pengaduan,
										ROUND(( 6371 * acos( cos( radians(".$lat.") ) * cos( radians( pt.latitude ) ) * cos( radians( pt.longitude ) - radians(".$long.") ) + sin( radians(".$lat.") ) * sin( radians( pt.latitude ) ) ) ), 2) AS distance,
										(((acos(sin((".$lat."*pi()/180)) * sin((pt.latitude * pi()/180)) + cos((".$lat." * pi()/180)) * cos((latitude * pi()/180)) * cos(((".$long."- longitude) * pi()/180))))*180/pi())*60*1.1515*1.609344) as km
							     FROM pengaduan p 
							     LEFT JOIN masyarakat m ON m.id_masyarakat = p.id_masyarakat_f
							     LEFT JOIN peta pt ON pt.id_peta = p.id_peta_f
							     WHERE p.status LIKE '%".$key."%' 
							     OR m.nama LIKE '%".$key."%'
							     OR m.alamat LIKE '%".$key."%'
							     OR m.hp LIKE '%".$key."%'
							     OR pt.latitude LIKE '%".$key."%'
							     OR pt.longitude LIKE '%".$key."%'
							     ORDER BY p.tgl_pengaduan DESC");	
	}

	public function view_pengaduan_by_nearby($lat, $long, $dist, $val = "<") {
		return $this->db->query("SELECT *,
										DATE_FORMAT(p.tgl_pengaduan, '%Y-%m-%d') as date_pengaduan, 
										ROUND(( 6371 * acos( cos( radians(".$lat.") ) * cos( radians( pt.latitude ) ) * cos( radians( pt.longitude ) - radians(".$long.") ) + sin( radians(".$lat.") ) * sin( radians( pt.latitude ) ) ) ), 2) AS distance,
										(((acos(sin((".$lat."*pi()/180)) * sin((pt.latitude * pi()/180)) + cos((".$lat." * pi()/180)) * cos((latitude * pi()/180)) * cos(((".$long."- longitude) * pi()/180))))*180/pi())*60*1.1515*1.609344) as km
							     FROM pengaduan p 
							     LEFT JOIN masyarakat m ON m.id_masyarakat = p.id_masyarakat_f
							     LEFT JOIN peta pt ON pt.id_peta = p.id_peta_f
							     HAVING distance ".$val.$dist."
							     ORDER BY p.tgl_pengaduan DESC");	
	}

	public function view_pengaduan_by_distance($lat, $long) {
		return $this->db->query("SELECT *,
										DATE_FORMAT(p.tgl_pengaduan, '%Y-%m-%d') as date_pengaduan, 
										ROUND(( 6371 * acos( cos( radians(".$lat.") ) * cos( radians( pt.latitude ) ) * cos( radians( pt.longitude ) - radians(".$long.") ) + sin( radians(".$lat.") ) * sin( radians( pt.latitude ) ) ) ), 2) AS distance,
										(((acos(sin((".$lat."*pi()/180)) * sin((pt.latitude * pi()/180)) + cos((".$lat." * pi()/180)) * cos((latitude * pi()/180)) * cos(((".$long."- longitude) * pi()/180))))*180/pi())*60*1.1515*1.609344) as km
							     FROM pengaduan p 
							     LEFT JOIN masyarakat m ON m.id_masyarakat = p.id_masyarakat_f
							     LEFT JOIN peta pt ON pt.id_peta = p.id_peta_f
							     ORDER BY p.tgl_pengaduan DESC");	
	}

	public function view_pengaduan_by_distance_and_now($lat, $long) {
		return $this->db->query("SELECT *,
										DATE_FORMAT(p.tgl_pengaduan, '%Y-%m-%d') as date_pengaduan, 
										ROUND(( 6371 * acos( cos( radians(".$lat.") ) * cos( radians( pt.latitude ) ) * cos( radians( pt.longitude ) - radians(".$long.") ) + sin( radians(".$lat.") ) * sin( radians( pt.latitude ) ) ) ), 2) AS distance,
										(((acos(sin((".$lat."*pi()/180)) * sin((pt.latitude * pi()/180)) + cos((".$lat." * pi()/180)) * cos((latitude * pi()/180)) * cos(((".$long."- longitude) * pi()/180))))*180/pi())*60*1.1515*1.609344) as km
							     FROM pengaduan p 
							     LEFT JOIN masyarakat m ON m.id_masyarakat = p.id_masyarakat_f
							     LEFT JOIN peta pt ON pt.id_peta = p.id_peta_f
							     WHERE DATE(p.tgl_pengaduan) = DATE(NOW()) 
							     ORDER BY p.tgl_pengaduan DESC");	
	}

	public function view_pengaduan_by_distance_and_status($lat, $long, $status) {
		return $this->db->query("SELECT *,
										DATE_FORMAT(p.tgl_pengaduan, '%Y-%m-%d') as date_pengaduan, 
										ROUND(( 6371 * acos( cos( radians(".$lat.") ) * cos( radians( pt.latitude ) ) * cos( radians( pt.longitude ) - radians(".$long.") ) + sin( radians(".$lat.") ) * sin( radians( pt.latitude ) ) ) ), 2) AS distance,
										(((acos(sin((".$lat."*pi()/180)) * sin((pt.latitude * pi()/180)) + cos((".$lat." * pi()/180)) * cos((latitude * pi()/180)) * cos(((".$long."- longitude) * pi()/180))))*180/pi())*60*1.1515*1.609344) as km
							     FROM pengaduan p 
							     LEFT JOIN masyarakat m ON m.id_masyarakat = p.id_masyarakat_f
							     LEFT JOIN peta pt ON pt.id_peta = p.id_peta_f
							     WHERE p.status = '".$status."' 
							     ORDER BY p.tgl_pengaduan DESC");	
	}

	public function view_pengaduan_by_nearby_and_between($lat, $long, $dist) {
		$dist = explode("-", $dist);
		return $this->db->query("SELECT *,
										DATE_FORMAT(p.tgl_pengaduan, '%Y-%m-%d') as date_pengaduan, 
										ROUND(( 6371 * acos( cos( radians(".$lat.") ) * cos( radians( pt.latitude ) ) * cos( radians( pt.longitude ) - radians(".$long.") ) + sin( radians(".$lat.") ) * sin( radians( pt.latitude ) ) ) ), 2) AS distance,
										(((acos(sin((".$lat."*pi()/180)) * sin((pt.latitude * pi()/180)) + cos((".$lat." * pi()/180)) * cos((latitude * pi()/180)) * cos(((".$long."- longitude) * pi()/180))))*180/pi())*60*1.1515*1.609344) as km
							     FROM pengaduan p 
							     LEFT JOIN masyarakat m ON m.id_masyarakat = p.id_masyarakat_f
							     LEFT JOIN peta pt ON pt.id_peta = p.id_peta_f
							     HAVING distance BETWEEN ".$dist[0]." AND ".$dist[1]." 
							     ORDER BY distance");	
	}

	public function view_pengaduan_by_nearby_and_status($lat, $long, $dist, $val = "<", $status = 'AVAILABLE') {
		return $this->db->query("SELECT *,
										DATE_FORMAT(p.tgl_pengaduan, '%Y-%m-%d') as date_pengaduan, 
										ROUND(( 6371 * acos( cos( radians(".$lat.") ) * cos( radians( pt.latitude ) ) * cos( radians( pt.longitude ) - radians(".$long.") ) + sin( radians(".$lat.") ) * sin( radians( pt.latitude ) ) ) ), 2) AS distance,
										(((acos(sin((".$lat."*pi()/180)) * sin((pt.latitude * pi()/180)) + cos((".$lat." * pi()/180)) * cos((latitude * pi()/180)) * cos(((".$long."- longitude) * pi()/180))))*180/pi())*60*1.1515*1.609344) as km
							     FROM pengaduan p 
							     LEFT JOIN masyarakat m ON m.id_masyarakat = p.id_masyarakat_f
							     LEFT JOIN peta pt ON pt.id_peta = p.id_peta_f
							     WHERE p.status = '".$status."'
							     HAVING distance ".$val.$dist."
							     ORDER BY p.tgl_pengaduan DESC");	
	}

	public function view_pengaduan_by_id($id_pengaduan) {
		return $this->db->query("SELECT *,
										DATE_FORMAT(p.tgl_pengaduan, '%Y-%m-%d') as date_pengaduan
							     FROM pengaduan p 
							     LEFT JOIN masyarakat m ON m.id_masyarakat = p.id_masyarakat_f
							     LEFT JOIN peta pt ON pt.id_peta = p.id_peta_f
							     WHERE p.id_pengaduan = '".$id_pengaduan."'
							     ORDER BY p.tgl_pengaduan DESC");	
	}

	public function view_pengaduan_by_id_and_distance($id_pengaduan, $lat, $long, $dist, $val = "<") {
		return $this->db->query("SELECT *,
										DATE_FORMAT(p.tgl_pengaduan, '%Y-%m-%d') as date_pengaduan,
										ROUND(( 6371 * acos( cos( radians(".$lat.") ) * cos( radians( pt.latitude ) ) * cos( radians( pt.longitude ) - radians(".$long.") ) + sin( radians(".$lat.") ) * sin( radians( pt.latitude ) ) ) ), 2) AS distance
							     FROM pengaduan p 
							     LEFT JOIN masyarakat m ON m.id_masyarakat = p.id_masyarakat_f
							     LEFT JOIN peta pt ON pt.id_peta = p.id_peta_f
							     WHERE p.id_pengaduan = '".$id_pengaduan."' 
							     HAVING distance ".$val.$dist."
							     ORDER BY p.tgl_pengaduan DESC");	
	}


	public function update_status_pengaduan($id, $status) {
		$this->db->query("UPDATE pengaduan SET status = '".$status."'
						  WHERE id_pengaduan = '".$id."'");
	}
}
