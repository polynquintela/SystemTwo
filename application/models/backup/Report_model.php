<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class report_model extends CI_Model 
{
	function listOfSectionWithGrade($section,$subject_id, $grading_period){
		$this->load->database();
		$query = "(SELECT grade, student_id from subject_grade WHERE student_id IN (SELECT student_id from batch_student_reference WHERE batch_id IN (SELECT batch_id from batch WHERE section = '".$section."')))";
		//$query = "SELECT student_id from batch_student_reference WHERE batch_id =  ";
       $queryresults =  $this->db->query($query)->result();
       return $queryresults; 
		
	}//end of fucntion
	
	function listOfYearWithGrade($year,$subject_id, $grading_period){
		$this->load->database();
		$query = "(SELECT grade, student_id from subject_grade WHERE student_id IN (SELECT student_id from batch_student_reference WHERE batch_id IN (SELECT batch_id from batch WHERE student_year = '".$year."')))";
		//$query = "SELECT student_id from batch_student_reference WHERE batch_id =  ";
       $queryresults =  $this->db->query($query)->result();
       return $queryresults; 
		
	}//end of fucntion
	
	
	
	
	 //GET ALL STUDENT DATA OF A CERTAIN STUDENT
    function getStudentData($data1, $data2){
        $this->load->database();
        $query = "SELECT b.`Student_name` from `batch_student_reference` a, `student` b where a.`student_id` = b.`Student_id` and a.`batch_id` = ".$data2." and b.`student_id` = ".$data1;
        $queryresults =  $this->db->query($query)->result();
        return $queryresults; 
     }

    function getAcademicYear($data1, $data2){
        $this->load->database();
        $query = "SELECT a.`start_of_academic_year`, a.`end_of_academic_year` FROM `batch` a, `batch_student_reference` b, `student` c WHERE a.`batch_id` = b.`batch_id` AND b.`student_id` = c.`Student_id` AND c.`Student_id` = ".$data1." AND b.`batch_id` = ".$data2;
        $queryresults =  $this->db->query($query)->result();
        return $queryresults; 
    }

    function getYearAndSection($data1, $data2){
        $this->load->database();
        $query = "SELECT a.`student_year`, a.`section` FROM `batch` a, `batch_student_reference` b, `student` c WHERE a.`batch_id` = b.`batch_id` AND b.`student_id` = c.`Student_id` AND c.`Student_id` = ".$data1." AND b.batch_id = ".$data2;
        $queryresults =  $this->db->query($query)->result();
        return $queryresults; 
     }

     function getNationality($data1){
        $this->load->database();
        $query = "SELECT nationality FROM student WHERE Student_id = ".$data1;
        $queryresults =  $this->db->query($query)->result();
        return $queryresults;
     }

    function getGender($data1)
    {
        $this->load->database();
        $query = "SELECT Student_sex FROM student WHERE Student_id = ".$data1;
        $queryresults =  $this->db->query($query)->result();
        return $queryresults;
    }

    function getAge($data1)
    {
        $this->load->database();
        $query = "SELECT DATEDIFF(CURDATE(), birthdate)/365.25 AS age FROM student WHERE Student_id = ".$data1;
        $queryresults =  $this->db->query($query)->result();
        return $queryresults;
    }

     function getStudent_Subject($data1, $data2){
        $this->load->database();
        $query = "SELECT DISTINCT a.`Subject_id`, a.`Subject_name`, a.`description`, a.`Subject_unit`, b.`Final_grade`, b.`Subject_action` FROM `subject` a, `student_subject_reference` b, `student` c, `batch_student_reference` d WHERE a.`Subject_id` = b.`subject_id` AND b.`student_id` = c.`Student_id` AND c.`Student_id` = ".$data1." and d.`batch_id` = ".$data2." ORDER BY a.`Subject_id`";
        $queryresults =  $this->db->query($query)->result();
        return $queryresults;
     }

     function getSubject_Grade($data1, $data2, $subject_id){
        $this->load->database();
        $query = "SELECT a.`student_id`, a.`grading_period`, a.`grade` FROM `subject_grade` a, `subject` b, `student` c, `batch_student_reference` d WHERE a.`Subject_id` = ".$subject_id." AND a.`student_id` = c.`Student_id` AND c.`Student_id` = ".$data1." AND d.`batch_id` = ".$data2." group by a.`grading_period`, a.`grade` order by a.`grading_period` asc";
        $queryresults =  $this->db->query($query)->result();
        return $queryresults;
     }

    function getAttendance($data1, $data2)
    {
        $this->load->database();
        $query = "SELECT `total_school_days`, `total_days_present`, `total_days_tardy` from `batch_student_reference` where `student_id` = ".$data1." and `batch_id` = ".$data2;
        $queryresults =  $this->db->query($query)->result();
        return $queryresults;
    }
}
