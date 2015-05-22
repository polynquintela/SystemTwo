<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class employee_model extends CI_Model 
    {
        public function __construct()
        {
            parent::__construct();
        }
        
        function getAdvisers()
        {
            $this->load->database();
            return $this->db->query("SELECT * FROM employee WHERE Adviser_flag = '1'")->result_array();
        }
        
        function getTeachers()
        {
            $this->load->database();
            return $this->db->query("SELECT * FROM employee WHERE Subj_teacher_flag = '1'")->result_array();
        }
        
        function getAdmins()
        {
            $this->load->database();
            return $this->db->query("SELECT * FROM employee WHERE Admin_flag = '1'")->result_array();
        }

        function addEmployee($employee_data) //FROM POST
        {
            $this->load->database();
            return $this->db->insert('employee', $employee_data);
        }//end of ADD employee

        function editEmployee($employee_data, $employee_num) //FROM POST
        {
            $this->load->database();
            $this->db->where('Emp_num', $employee_num);
            return $this->db->update('employee', $employee_data);
        }//end of ADD employee
        
        function deleteEmployee($id)
        {
            $this->load->database();
            $query = "DELETE FROM employee WHERE Emp_num = '".$id."'"; 
            return $this->db->query($query);
        }

        function getEmployeeData($employee_num)
        {
            $this->load->database();
            $query = "SELECT * FROM employee WHERE Emp_num = '".$employee_num."'";
            return $this->db->query($query)->result_array();
        }
        
        function getEmployeeID($name)
        {
            $this->load->database();
            $query = "SELECT Emp_num FROM employee WHERE name LIKE '".$name."'";
            return $this->db->query($query)->result_array()[0]["Emp_num"];
        }
        
        function getEmployeeName($id)
        {
            $this->load->database();
            $query = "SELECT name FROM employee WHERE Emp_num = '".$id."'";
            return $this->db->query($query)->result_array()[0]["name"];
        }
    }
?>