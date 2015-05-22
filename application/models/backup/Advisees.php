<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class advisees extends CI_Model {
	
	 //GET ALL ADVISEES OF AN ADVISER
	 function getAdvisees($adviser){
        $this->load->database();
		//advisee->teacher
		$query = "SELECT Student_name FROM student WHERE Student_id IN (SELECT Student_ID FROM batch_student_reference WHERE batch_id IN (SELECT batch_id FROM batch WHERE adviser = '".$adviser."'))";
        $queryresults =  $this->db->query($query)->result();
        return $queryresults; 
     }
}
