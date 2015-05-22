<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class attendance_model extends CI_Model {


	//ADD ATTENDANCE 
	function addAttendance($data){
		$this->load->database();
     	$this->db->insert('attendance', $data);
		return TRUE;
	}
	//DELETE ATTENDANCE
	function deleteAttendance($student_id, $period){
		$this->load->database();
		$query = "DELETE FROM attendance WHERE student_id = '".$student_id."' AND student_id = '".$student_id."'" ; //query for i
		$this->db->query($query);
		return TRUE;
	}
    //EDIT ATTENDANCE 
	 function editAttendance($data,$grading_period, $batch_id, $student_id){
		$this->load->database();
		$cond = array('grading_period' => $grading_period, 'batch_id' => $batch_id,'student_id' => $student_id);
     	$this->db->update('attendance', $data);
		return TRUE;
	}
	//GET DATA
	function getData($grading_period, $batch_id, $student_id){
		$this->load->database();
		$query = "SELECT * FROM attendance WHERE grading_period = '".$grading_period."' AND batch_id = '".$batch_id."' AND student_id = '".$student_id."'";
		return $this->db->query($query)->result();
	}
}
