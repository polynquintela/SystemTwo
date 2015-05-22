<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class subject_student_model extends CI_Model {
	//ADD SUBJECT TO STUDENT
	function AddSubjectToStudent($subject_data){
		$this->load->database();
		$this->db->insert('student_subject_reference', $subject_data);
		return TRUE;
	}
	
	function DeleteSubjectFromStudent($student_id,$subject_id){
		$this->load->database();
		$query = "DELETE FROM student_subject_reference WHERE student_id = '".$student_id."' AND subject_id = '".$subject_id."'";
		$this->db->query($query);
		return TRUE;
	}
}
