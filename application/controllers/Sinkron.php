<?php 
if (!defined('BASEPATH')) {	exit('No direct script access allowed'); }

class Sinkron extends CI_Controller {    
	
    function tarik(){
		$this->__cek_token();

		$token = string_acak(5);
		$backup_dir = FCPATH . 'backup-' . $token;
		mkdir($backup_dir);

		$id_server = $this->input->post('id_server');
        $data['ujian'] = $this->db->get('ujian')->result();
		$data['soal'] = $this->db->get('soal')->result();
		$data['pilihan_jawaban'] = $this->db->get('pilihan_jawaban')->result();
		$data['peserta'] = $this->db->get_where('peserta', array('server' => $id_server))->result();
		// $data['peserta_jawaban'] = $this->db->get('peserta_jawaban')->result();
		// json_output(200, array('pesan'=> 'ok', 'data' => $data));
		
		// backup db json ke file
		$fp = fopen($backup_dir . '/data.json', 'w');
		fwrite($fp, json_encode($data));
		fclose($fp);


		// copy keseluruhan gambar 
		salin_folder(FCPATH . 'images', $backup_dir . '/images');
		
		// arsipkan folder backup
		$zip_file = './public/backup_CBT_' . date('d-m-Y') . '_' . $token . '.zip';
		arsipkan_folder($backup_dir, $zip_file);
		rrmdir($backup_dir);
		json_output(200, array('pesan'=>'ok', 'nama_zip' => 'backup_CBT_' . date('d-m-Y') . '_' . $token . '.zip'));
	}
	
	function tarik_zip(){
		$zip_file = FCPATH . 'public/' . $this->input->get('zip');
		header('Content-Description: File Transfer');
		header('Content-Type: application/zip');
		header('Content-Disposition: attachment; filename='.basename($zip_file));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($zip_file));
		readfile($zip_file);
		unlink($zip_file);
	}

	function terima_nilai(){
		$this->__cek_token();		
		$data = (empty($this->input->post('data'))) ? '' : json_decode($this->input->post('data'), TRUE);
		// $data = $this->input->post('data');

		if(is_array($data)){
			// Hapus jawaban peserta yang lama
			$this->db->query('DELETE FROM peserta_jawaban');
			
			// Masukan jawaban baru
			$aff_rows = $this->db->insert_batch($data);
		}else{
			$aff_rows = 0;
		}

		json_output(200, array('aff_rows' => $aff_rows, 'data' => gettype($data)));
	}

	private function __cek_token(){
		$token = $this->input->post('token');
		if($token != 'kEXCZ9KjumHxTO8dsVyg'){
			json_output(200, array('pesan' => 'token_gagal', 'post'=> $_POST));
			die();
		}
	}
    
}