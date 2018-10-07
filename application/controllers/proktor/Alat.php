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
}