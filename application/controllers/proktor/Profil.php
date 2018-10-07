<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

require_once APPPATH . 'controllers/proktor/Home_proktor.php';

class Profil extends Home_proktor{
	function edit(){
		$this->load->view('proktor/edit_profil.php');
	}

}