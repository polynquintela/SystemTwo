<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class attendance_model extends CI_Model 
{
    function addAttendance($data)
    {
        $this->load->database();
        $this->db->insert('attendance', $data);
        return TRUE;
    }

    function deleteAttendance($student_id, $period)
    {
        $this->load->database();
        $query = "DELETE FROM attendance WHERE student_id = '".$student_id."' AND student_id = '".$student_id."'" ; //query for i
        $this->db->query($query);
        return TRUE;
    }

    function editAttendance($student_id, $batch_id, $grading_period, $data)
    {
        $this->load->database();
        $this->db->where(array('grading_period' => $grading_period, 'batch_id' => $batch_id,'student_id' => $student_id));
        return $this->db->update('attendance', $data);
    }

    function getAttendance($student_id, $batch_id, $grading_period)
    {
        $this->load->database();
        $query = "SELECT * FROM attendance WHERE grading_period = '".$grading_period."' AND batch_id = '".$batch_id."' AND student_id = '".$student_id."'";
        return $this->db->query($query)->result_array();
    }
}
