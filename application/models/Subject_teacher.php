<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subject_Teacher extends CI_Model 
{
    function getSubjectsPerTeacher($teacher)
    {
        $this->load->database();
        return $this->db->query("SELECT * from subject WHERE Emp_num = '".$teacher."'")->result_array();
    }
}
