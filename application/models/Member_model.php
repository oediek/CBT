<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_model extends CI_Model{

	public $nama;
	public $email;

	public function insert($data){
		$this->nama = $data['nama'];
		$this->email = $data['email'];
		return $this->db->insert('members', $this);
	}

	public function update($data){
		$this->nama = $data['nama'];
		$this->email = $data['email'];
		return $this->db->update('members', $this, array('id' => $data['id']));
	}
	public function delete($id){
		return $this->db->where('id', $id)->delete('members');
	}
	public function get($id){
		 return $this->db->where("id=$id")->get('members')->row_array();
	}
	public function get_all(){
		 return $this->db->get('members')->result_array();
	}
}