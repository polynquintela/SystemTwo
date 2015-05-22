<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class edit_history extends CI_Model {
	function AddData($data){
			$this->load->database();
			$this->db->insert('edit_history', $data);
	}
}