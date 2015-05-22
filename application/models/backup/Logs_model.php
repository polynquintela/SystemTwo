<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class logs_model extends CI_Model 
{
    function addLogs($data)
    {
        $this->load->database();
        return $this->db->insert('logs', $data);
    }//end of addLogs
	
    function viewLogsByDate($data)
    {
        $this->load->database();
        $this->db->select('*');
        $this->db->like('date',$data);
        $query=$this->db->get("logs");
        return $query->result();
        /*$this->load->database();
        $query = "SELECT*from logs WHERE date = '"?%$data%?"'";
        return $this->db->query($query)->result();*/
    }//end of View Logs By Date
	
    function getLogs()
    {
        $this->load->database();
        $query = "SELECT * FROM logs";
        return $this->db->query($query)->result_array();
    }//end of View Logs By Employee
}//end of class
?>