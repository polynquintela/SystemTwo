<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subject_grade extends CI_Model 
{
    //ADD subject grade to student
    function addSubjectGrade($data)
    {
        $this->load->database();
        return $this->db->insert('subject_grade', $data);
    }
    
    //DELETE subject grade from student
    function deleteSubjectGrade($student_id, $period, $subject_id)
    {
        $this->load->database();
        $query = "DELETE FROM subject_grade WHERE grading_period = '".$period."' AND Subject_id = '".$subject_id."' AND student_id = '".$student_id."'"; //query for i
        return $this->db->query($query);
    }
    
    //EDIT subject grade from student
    function editSubjectGrade($student_id, $subject_id, $grading_period, $grade) 
    {
        $this->load->database();
        return $this->db->query("UPDATE subject_grade SET grade = '".$grade."' WHERE student_id = '".$student_id."' AND grading_period = '".$grading_period."' AND Subject_id = '".$subject_id."'");
    }
    
    function getSubjectGrade($student, $subject, $period)
    {
        $this->load->database();
        $query = "SELECT * FROM subject_grade WHERE student_id = '".$student."' AND Subject_id = '".$subject."' AND grading_period = '".$period."'";
        return $this->db->query($query)->result_array();
    }
    
    function getSubjectsPerStudent($student)
    {
        $this->load->database();
        $query = "SELECT * FROM subject_grade WHERE student_id = '".$student."'";
        return $this->db->query($query)->result_array();
    }
}
