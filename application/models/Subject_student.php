<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Subject_student extends CI_Model 
    {
        function addStudent($subject_data)
        {
            $this->load->database();
            return $this->db->insert('student_subject_reference', $subject_data);
        }

        function deleteStudent($student_id, $subject_id)
        {
            $this->load->database();
            $query = "DELETE FROM student_subject_reference WHERE student_id = '".$student_id."' AND subject_id = '".$subject_id."'";
            return $this->db->query($query);
        }
        
        function getSubjectsPerStudent($student)
        {
            $this->load->database();
            return $this->db->query("SELECT * from subject WHERE subject_id IN (SELECT subject_id FROM student_subject_reference WHERE student_id = '".$student."')")->result_array();
        }
        
        function getStudentsPerSubject($subject)
        {
            $this->load->database();
            return $this->db->query("SELECT * from student WHERE Student_id IN (SELECT student_id FROM student_subject_reference WHERE subject_id = '".$subject."')")->result_array();
        }
    }
