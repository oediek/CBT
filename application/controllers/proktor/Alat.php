<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

require_once APPPATH . 'controllers/proktor/Home_proktor.php';

class Alat extends Home_proktor{
	function backup(){
		$this->load->view('proktor/alat/backup.php');
	}

	function restore(){
		$this->load->view('proktor/alat/restore.php');
	}

	function reset(){
		$this->load->view('proktor/alat/reset.php');
	}

	function do_backup(){
		// buat direktori backup
		$token = string_acak(5);
		$backup_dir = FCPATH . 'backup-' . $token;
		mkdir($backup_dir);

		// buat json yg berisi db 
		$data['ujian'] = $this->db->get('ujian')->result();
		$data['soal'] = $this->db->get('soal')->result();
		$data['pilihan_jawaban'] = $this->db->get('pilihan_jawaban')->result();
		$data['peserta'] = $this->db->get('peserta')->result();
		$data['peserta_jawaban'] = $this->db->get('peserta_jawaban')->result();

		// backup db json ke file
		$fp = fopen($backup_dir . '/data.json', 'w');
		fwrite($fp, json_encode($data));
		fclose($fp);

		// copy keseluruhan gambar 
		salin_folder(FCPATH . 'images', $backup_dir . '/images');

		// arsipkan folder backup
		$zip_file = 'backup_CBT_' . date('d-m-Y') . '_' . $token . '.zip';
		arsipkan_folder($backup_dir, $zip_file);
		hapus_folder($backup_dir);
		unlink($zip_file);
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.basename($zip_file));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($zip_file));
		readfile($zip_file);

		// header('Content-disposition: attachment; filename=backup.json');
		json_output(200, $data);
	}

	function do_reset(){
		// hapus data peserta dan ujian
		$this->db->query('DELETE FROM peserta_jawaban');
		$this->db->query('DELETE FROM peserta');
		$this->db->query('DELETE FROM pilihan_jawaban');
		$this->db->query('DELETE FROM soal');
		$this->db->query('DELETE FROM ujian');
		// hapus folder gambar
		hapus_folder('images');
		mkdir('images');
		json_output(200, array('pesan'=> 'ok'));
	} 


}