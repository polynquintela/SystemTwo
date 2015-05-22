<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee extends CI_Model 
{	
    //GET EMPLOYEE_ID OF AN EMPLOYEE
    function getEmployeeID($emp_name)
    {
        $this->load->database();
        $query = "SELECT Studet_id FROM students WHERE name LIKE '".$emp_name."'";
        $queryresults =  $this->db->query($query)->result();
        return $queryresults; 
    }
 
	 // This function gets the three flags of the role to determine
	 // 	which page should be opened.
     function getEmployeeRole($emp_id)
     {
     	$this->load->database();

     	$query = "SELECT Admin_flag, Adviser_flag, Subj_teacher_flag FROM employee WHERE Emp_num LIKE '".$emp_id."'";
     	$queryresults = $this->db->query($query)->result();
     	return $queryresults;
     }
}
