<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Advisees extends CI_Model 
{	
    //GET ALL ADVISEES OF AN ADVISER
    function getAdvisees($adviser)
    {
        $this->load->database();
        $query = "SELECT * FROM student WHERE Student_id IN (SELECT student_id FROM batch_student_reference WHERE batch_id IN (SELECT batch_id FROM batch WHERE adviser = '".$adviser."'))";
        return $this->db->query($query)->result_array();
    }
}
