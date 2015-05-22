<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class batch_model extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
    }   

        function getAdviser($batchID)
        {

        }
        
        function getStudents($batchID)
        {
            
        }
    
        function getBatchID($studentyear, $section)
        {
            $this->load->database();
            $query = "SELECT batch_id FROM batch WHERE student_year LIKE '".$studentyear."' AND section LIKE '".$section."'";
            return $this->db->query($query)->result_array()[0]["batch_id"];
        }
	
	function addBatch($batch_data)
        {
            $this->load->database();
            return $this->db->insert('batch', $batch_data);
	}
	   
	function deleteBatch($batchId)
        {
            $this->load->database();
            $query = "DELETE FROM batch WHERE batch_id = '".$batchId."'"; 
            return $this->db->query($query);
	}
	//EDIT BATCH
	function editBatch($batch_data, $batch_id)
        {
            $this->load->database();
            $this->db->where('batch_id', $batch_id);
            return $this->db->update('batch', $batch_data);
	}

	function getBatch($batch_id)
        {
            $this->load->database();
            $query = "SELECT * FROM batch WHERE batch_id = '".$batch_id."'";
            return $this->db->query($query)->result_array();
	}
        
        function getBatches()
        {
            $this->load->database();
            $query = "SELECT * FROM batch";
            return $this->db->query($query)->result_array();
	}

	function addStudent($batch_data)
        {
            $this->load->database();
            return $this->db->insert('batch_student_reference', $batch_data);
	}
	
	function deleteStudent($batch_id, $student_id)
        {
            $this->load->database();
            $query = "DELETE FROM batch_student_reference WHERE batch_id LIKE '".$batch_id."' AND student_id LIKE '".$student_id."'"; 
            return $this->db->query($query);
	}
	 
}
