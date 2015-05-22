<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student_model extends CI_Model
{
    function getStudents()
    {
        $this->load->database();
        return $this->db->query("SELECT * FROM student")->result_array();
    }
    
    function getStudentData($id)
    {
        $this->load->database();
        $query = "SELECT * FROM student WHERE Student_id = '".$id."'";
        $queryresults =  $this->db->query($query)->result_array();
        return $queryresults;
    }
    
    function getStudentID($name)
    {
        $this->load->database();
        $query = "SELECT Student_id FROM student WHERE Student_name LIKE '".$name."'";
        return $this->db->query($query)->result_array()[0]["Student_id"];
    }
    
    function addStudent($student_data)
    {
     	$this->load->database();
        return $this->db->insert('student', $student_data);
    }
	
    function deleteStudent($id)
    {
     	$this->load->database();
        $query = "DELETE FROM student WHERE Student_id = '".$id."'"; 
        return $this->db->query($query);
    }
    
    function editStudent($student_data, $student_id) //FROM POST
    {
        $this->load->database();
        $this->db->where('Student_id', $student_id);
        return $this->db->update('student', $student_data);
    }
}
