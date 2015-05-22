<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class search_model extends CI_Model 
{
    //GET DATA
    function searchStudent($student_name)
    {
        $this->load->database();
        $query = "SELECT * FROM student WHERE student_name LIKE '%$student_name%'";
        return $this->db->query($query)->result_array();
    }

    function searchEmployee($emp_name)
    {
        $this->load->database();
        $query = "SELECT * FROM employee WHERE name LIKE '%$emp_name%'";
        return $this->db->query($query)->result_array();
    }

    function searchSubject($Subject_name)
    {
        $this->load->database();
        $query = "SELECT * FROM subject WHERE Subject_name LIKE '%$Subject_name%'";
        return $this->db->query($query)->result_array();
    }
    
    function searchBatch($section)
    {
        $this->load->database();
        $query = "SELECT * FROM batch WHERE section LIKE '%$section%'";
        return $this->db->query($query)->result_array();
    }
}
