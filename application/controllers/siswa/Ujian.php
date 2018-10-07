<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

require_once APPPATH . 'controllers/siswa/Home_siswa.php';

class Ujian extends Home_siswa{

	function index(){
		// cek status ujian siswa 
		$this->db->where('ujian_id', $this->session->ujian_id);
		$this->db->where('nis', $this->session->nis);
		$this->db->where('login', $this->session->login);
		$this->db->select('status');
		$r = $this->db->get('peserta')->row();

		$data = $this->__detail_ujian();
		$data['status_peserta'] = $r->status;

		// jika hanya login saja dan belum memasukkan token
		if($r->status == '1'){
			$this->load->view('siswa/dashboard_peserta', $data);
		}
		// jika sudah memasukkan token
		elseif($r->status == '2'){
			$data['soal'] = $this->__get_soal($data['ujian_acak']);
			$this->load->view('siswa/kerjakan_soal', $data);
		}
		// jika sudah mengerjakan soal
		elseif($r->status == '3'){
			$this->load->view('siswa/nilai_siswa', $data);
		}

	}

	function start(){
		$token = $this->input->post('token');
		$this->db->where('konfig_id', 'TOKEN');
		$this->db->where('nilai_konfig', $token);
		$jml = $this->db->count_all_results('konfig');
		if($jml == 0){
			// atur pesan
			$this->session->pesan = 'token_gagal';
			$this->session->mark_as_flash('pesan');
		}else{		
			// update data peserta, ubah status menjadi sedang ujian (2)
			$this->db->where('ujian_id', $this->session->ujian_id);
			$this->db->where('nis', $this->session->nis);
			$this->db->where('login', $this->session->login);
			$this->db->set('status', '2');
			$this->db->update('peserta');
		}
		redirect('?d=siswa&c=ujian');
	}

	function submit_jawaban(){
		$data = $this->input->post();
		$ujian_id = $this->session->ujian_id;
		$nis = $this->session->nis;
		$login = $this->session->login;

		// baca kunci jawaban, sekalian hitung skor
		$this->db->where('ujian_id', $ujian_id);
		$this->db->where('no_soal', $data['no_soal']);
		$this->db->where('jawaban', $data['pilihan']);
		$this->db->select('skor');
		$q = $this->db->get('soal');
		if($q->num_rows() > 0){
			$pilihan_skor = $q->row()->skor;
		}else{
			$pilihan_skor = 0;
		}

		// simpan jawaban
		$sql = "REPLACE INTO peserta_jawaban 
				(ujian_id, nis, login, no_soal, pilihan, pilihan_skor) VALUES 
				('$ujian_id', '$nis', '$login', $data[no_soal], '$data[pilihan]', $pilihan_skor)";
		if($this->db->query($sql)){
			echo 'ok';
		}

	}

	function jawaban_ragu(){
		$no_soal = $this->input->post('no_soal');
		$ragu = ($this->input->post('ragu') == 'true') ? '1' : '0';
		
		$this->db->where('ujian_id', $this->session->ujian_id);
		$this->db->where('nis', $this->session->nis);
		$this->db->where('login', $this->session->login);
		$this->db->where('no_soal', $no_soal);
		$this->db->set('ragu', $ragu);
		$this->db->update('peserta_jawaban');
		echo 'ok';
	}

	private function __detail_ujian(){
		$this->db->where('ujian_id', $this->session->ujian_id);
		$r = $this->db->get('ujian')->row();
		$data['ujian_nama'] = $r->judul;
		$data['ujian_jenis'] = $r->jenis_ujian;
		$data['ujian_mulai'] = $r->mulai;
		$data['ujian_selesai'] = $r->selesai;
		$data['ujian_alokasi'] = $r->alokasi;
		$data['ujian_acak'] = $r->acak;
		$skrg = getdate();
		$data['skrg'] = $skrg['year'] . '-' . $skrg['mon'] . '-' . $skrg['mday'] . ' ' .
						$skrg['hours'] . ':' .$skrg['minutes'] . ':' . $skrg['seconds'] ;

		return $data;
	}

	private function __get_soal($pilihan_acak){
		// $this->db->where('ujian_id', $this->session->ujian_id);
		// $this->db->order_by('no_soal');
		// $soal = $this->db->get('soal')->result();

		$login = $this->session->login;
		$nis = $this->session->nis;
		$ujian_id = $this->session->ujian_id;
		$sql = "SELECT a.*, b.pilihan, b.ragu
				FROM soal a
				LEFT JOIN peserta_jawaban b ON 
				a.ujian_id = b.ujian_id AND a.no_soal = b.no_soal AND b.nis = '$nis' AND b.login = '$login'
				WHERE a.ujian_id = '$ujian_id'";
		$soal = $this->db->query($sql)->result();

		$this->db->where('ujian_id', $this->session->ujian_id);
		$pilihan_jawaban = $this->db->get('pilihan_jawaban')->result();
		$data = array();
		foreach($soal as $r){
			$tmp = $r;
			$tmp2 = array_filter(
				$pilihan_jawaban,
				function($val) use ($r){
					return ($val->no_soal == $r->no_soal);
				}
			);

			// jika pilihan jawaban diacak
			if($pilihan_acak == '2'){
				shuffle($tmp2);
			}

			$tmp->pilihan_jawaban = $tmp2;
			$data[] = $tmp;
		}

		// jika soal diacak
		if($pilihan_acak != '0'){
			shuffle($data);
		}

		return $data;
	}

}