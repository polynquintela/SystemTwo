<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subject_model extends CI_Model 
{
    function getSubjects()
    {
        $this->load->database();
        return $this->db->query("SELECT * FROM subject")->result_array();
    }
    
    function getSubjectsPerStudent($student)
    {
        $this->load->database();
        return $this->db->query("SELECT Subject_name from subject WHERE subject_id IN (SELECT subject_id FROM student_subject_reference WHERE student_id = '".$student."')")->result_array();
    }

    //Get Subject ID
    function getSubjectID($subname)
    {
        $this->load->database();
        $query = "SELECT Subject_id FROM subject WHERE Subject_name LIKE '".$subname."'";
        return $this->db->query($query)->result()[0]["Subject_id"]; 
    }

    //ADD SUBJECT BY ADMIN TO DATABASE
    function addSubject($subject_data) //FROM POST
    {
        $this->load->database();
        return $this->db->insert('subject', $subject_data);
    }
	   
    //DELETE SUBJECT BY ADMIN FROM DATABASE
    function deleteSubject($id)
    {
        $this->load->database();
        $query = "DELETE FROM subject WHERE Subject_id = '".$id."'"; 
        return $this->db->query($query);
    }
    
    function editSubject($subject_data, $subject_id) //FROM POST
    {
        $this->load->database();
        $this->db->where('Subject_id', $subject_id);
        return $this->db->update('subject', $subject_data);
    }
    
    function getSubjectData($id)
    {
        $this->load->database();
        $query = "SELECT * FROM subject WHERE Subject_id = '".$id."'";
        return $$this->db->query($query)->result_array();
    }
    
    function getSubjectName($id)
    {
        $this->load->database();
        $query = "SELECT Subject_name FROM subject WHERE Subject_id = '".$id."'";
        return $$this->db->query($query)->result_array()[0]["Subject_name"];
    }
}
