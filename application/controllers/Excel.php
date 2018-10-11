<?php 
if (!defined('BASEPATH')) {	exit('No direct script access allowed'); }

class Excel extends CI_Controller {

	function terima_kunci_jawaban(){
		$post = $this->input->post();
		if(login_webservice($post['login'], $post['password'])){
			// Sisipkan data ujian;
			$acak = ($post['acak'] == '1') ? '1' : '0';
			$selesai = interval_tgl($post['mulai'], $post['alokasi']);
			if(empty($post['ujian_id'])){
				$ujian_id = string_acak(10);
				$sql = "INSERT INTO ujian (ujian_id, mulai, selesai, alokasi, jml_soal, acak)
						VALUES ('$ujian_id', '$post[mulai]', '$selesai', $post[alokasi], $post[jml_soal], $post[acak])";

			}else{
				$ujian_id = $post['ujian_id'];

				// Periksa apakah soal ujian sudah terkunci
				$this->db->where("ujian_id='$ujian_id' AND status_soal=2");
				if($this->db->count_all_results('ujian') > 0){
					echo json_encode(array('pesan' => 'terkunci'));
					die();
				}

				// Edit data ujian setelah diketahui masih terbuka
				$sql = "UPDATE ujian 
						SET mulai = '$post[mulai]', selesai = '$selesai', alokasi = '$post[alokasi]',
							jml_soal = $post[jml_soal], acak = $acak
						WHERE ujian_id = '$ujian_id'";
			}
			$this->db->query($sql);

			// Cek status soal (untuk nilai kembalian webservice)
			$r = $this->db->query("SELECT status_soal FROM ujian WHERE ujian_id='$ujian_id'")->row();
			$status_soal = $r->status_soal;

			// Reset data peserta ujian
			$this->db->query("DELETE FROM peserta WHERE ujian_id='$ujian_id'");

			// Sisipkan data peserta
			$peserta = json_decode($post['peserta'], TRUE);
			log_message('custom', json_encode($peserta));
			$sql = "INSERT INTO peserta (ujian_id, nis, login, nama, password) VALUES ";
			foreach($peserta as $p){
				$nama = mysqli_real_escape_string($this->db->conn_id, $p['nama']);
				$rows[] = "('$ujian_id', '$p[nis]', '$p[login]', '$nama', '$p[password]')";
			}
			$sql .= implode(',', $rows);
			$this->db->query($sql);
			$hasil = array(
				'pesan' => 'ok',
				'ujian_id' => $ujian_id,
				'status_soal' => $status_soal,
			);
		}else{
			$hasil = array(
				'pesan' => 'gagal'
			);
		}
		json_output($hasil);
	}

	function reset_status_login_siswa(){
		$post = $this->input->post();
		if(login_webservice($post['login'], $post['password'])){
			$username = $post['username'];
			$ujian_id = $post['ujian_id'];
			$sql = "UPDATE peserta SET status = 0 WHERE ujian_id = '$ujian_id' AND login = '$username'";
			$this->db->query($sql);
			$hasil = array(
				'pesan' => 'ok'
			);
		}else{
			$hasil = array(
				'pesan' => 'gagal'
			);
		}
		echo json_encode($hasil);
	}

}