<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Home_siswa extends CI_Controller{
	function __construct() {
		parent::__construct();
		if((empty($this->session->login)) || ($this->session->akses != 'siswa')){
			redirect(site_url('?c=login'));
		}
	}
}