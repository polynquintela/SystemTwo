<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class batch extends CI_Model {
	//GET ADVISER OF THAT BATCH
	
	//GET STUDENTS OF THAT BATCH
	
     public function __construct()
    {
        parent::__construct();
        //$this->load->helper('url');     
    }   

	 function getBatchID($studentyear, $section){
		$this->load->database();
		$query = "SELECT batch_id FROM batch WHERE student_year LIKE '".$studentyear."' AND section LIKE '".$section."'";
        $queryresults =  $this->db->query($query)->result();
        return $queryresults; 
     }

	function AddBatchModel($batch_data){//FROM POST
		$this->load->database();
		$this->db->insert('batch', $batch_data);
		return TRUE;
	}
	   
	//DELETE SUBJECT BY ADMIN FROM DATABASE
	function DeleteBatchModel($batchId){
		$this->load->database();
		$query = "DELETE FROM batch WHERE batch_id LIKE '".$batchId."'"; 
		$this->db->query($query);
		return TRUE;
	}
	//ADD STUDENT
	function AddStudentToBatch($batch_id, $student_id){
		$this->load->database();	
		$query = "INSERT INTO batch_student reference(batch_id, Student_id)VALUES('".$batch_id."','".$student_id."')"; 
		$queryresults = $this->db->query($query)->result();
	}

	function DeleteStudentFromBatch($batch_id, $student_id){
		$this->load->database();
		$query = "DELETE FROM batch_student_reference WHERE batch_name LIKE '".$batch_id."' AND Student_id LIKE '".$student_id."'"; 
		$this->db->query($query);
		return TRUE;
	}
	 
}
