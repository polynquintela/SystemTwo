<?php

class subject extends CI_Controller {
	

	function index()
	{
	}
	function LoadAddSubject(){
			$this->load->helper(array('form', 'url'));
			$this->load->view('addsubject');
	}//end of LoadAddSubject function
	function LoadDeleteSubject(){
			$this->load->helper(array('form', 'url'));
			$this->load->view('deletesubject');
	}//end of LoadAddSubject function
	function LoadAddSubjectToStudent(){
			$this->load->helper(array('form', 'url'));
			$this->load->view('addStudentToSubject');
	}//end of LoadAddSubject function
	function LoadDeleteSubjectFromStudent(){
			$this->load->helper(array('form', 'url'));
			$this->load->view('deleteStudentFromSubject');
	}//end of LoadAddSubject function
	
	function AddSubject(){
		//LOAD LIBRARIES AND MODEL
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('subject_model');
		
		//FORM VALIDATION
		$this->form_validation->set_rules('subject_name', 'Subject Name', 'required');
		$this->form_validation->set_rules('subject_desc', 'Subject Description', 'required');
		$this->form_validation->set_rules('subject_unit', 'Subject Unit', 'required');
		$this->form_validation->set_rules('subject_type', 'Subject Type', 'required');
		$this->form_validation->set_rules('subject_teacher', 'Subject Teacher', 'required');
		$this->form_validation->set_rules('time_start', 'Time Start', 'required');
		$this->form_validation->set_rules('time_end', 'Time End', 'required');
		
		//NOT SUCCESSFUL FILLING UP GO TO ADDSUBJECT PAGE
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('addsubject');
		}
		//SUCCESSFUL FILLING UP
		else
		{
			//GET USER INPUT
			$subject_data = array(
							'Subject_type' => $this->input->post('subject_type'),
							'Subject_unit' => $this->input->post('subject_unit'),
							'Subject_name' => $this->input->post('subject_name'),
							'Time_slot_start' => $this->input->post('time_start'),
							'Description' => $this->input->post('subject_desc'),
							'Emp_num' => $this->input->post('subject_teacher'),
							'Time_slot_end' => $this->input->post('time_end')
			);	
			//CALL ADD SUBJECT FUNCTION
			$result = $this->subject_model->AddSubjectModel($subject_data);
			//IF SUCCESSFUL ADDING SUBJECT GO TO HOME
			if($result){
				$this->load->helper('date');
				$this->load->library('session');
				$this->load->model('logs_model');
				
				//--------------------------for logs---------------------------------/
				$data2 = array(
                   'date'  => standard_date('DATE_ATOM', time()),
                   'emp_num'  => $this->session->userdata('emp_num'),
                   'activity' => 'Added Subject',
				   'remarks' => $this->input->post('subject_name')
				);
				$this->logs_model->AddLogs($data2);

			
				$this->load->view('formsuccess');
			}
		}
			
				
	}//end of add subject function
	
	function DeleteSubject(){
		//LOAD LIBRARIES AND MODEL
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('subject_model');
		
		//FORM VALIDATION
		$this->form_validation->set_rules('name', 'Subject Name', 'required');
		
		//NOT SUCCESSFUL FILLING UP GO TO ADDSUBJECT PAGE
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('deletesubject');
		}
		//SUCCESSFUL FILLING UP
		else
		{
			
			$subject_name = $this->input->post('name');
			//CALL ADD SUBJECT FUNCTION
			$result = $this->subject_model->DeleteSubjectModel($subject_name);
			//IF SUCCESSFUL DELETING SUBJECT GO TO HOME
			if($result){
				$this->load->helper('date');
				$this->load->library('session');
				$this->load->model('logs_model');
				
				//--------------------------for logs---------------------------------/
				$data2 = array(
                   'date'  => standard_date('DATE_ATOM', time()),
                   'emp_num'  => $this->session->userdata('emp_num'),
                   'activity' => 'Deleted Subject',
				   'remarks' => $subject_name
				);
				$this->logs_model->AddLogs($data2);
			
				$this->load->view('formsuccess');
			}
		}
			
				
	}//end of delete subject function

	function AddSubjecttoStudent(){
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('subject_student_model');
		
		//FORM VALIDATION
		$this->form_validation->set_rules('subject_id', 'Subject ID', 'required');
		$this->form_validation->set_rules('student_id', 'Student ID', 'required');
		//NOT SUCCESSFUL FILLING UP GO TO ADDSUBJECT PAGE
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('addStudentToSubject');
		}
		//SUCCESSFUL FILLING UP
		else
		{
			//GET USER INPUT
			$subject_data = array(
							'student_id' => $this->input->post('student_id'),
							'subject_id' => $this->input->post('subject_id'),
							'Final_grade' =>0,
							'Subject_action'=>'F'
			);	
			//CALL ADD SUBJECT FUNCTION
			$result = $this->subject_student_model->AddSubjectToStudent($subject_data);
			//IF SUCCESSFUL ADDING SUBJECT GO TO HOME
			if($result){
				$this->load->helper('date');
				$this->load->library('session');
				$this->load->model('logs_model');
				
				//--------------------------for logs---------------------------------/
				$data2 = array(
                   'date'  => standard_date('DATE_ATOM', time()),
                   'emp_num'  => $this->session->userdata('emp_num'),
                   'activity' => 'Added Subject To Student',
				   'remarks' => $this->input->post('subject_id')
				);
				$this->logs_model->AddLogs($data2);

				$this->load->view('formsuccess');
			}
		}
			
	}//end of function
	
	function DeleteSubjectFromStudent(){
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('subject_student_model');
		
		//FORM VALIDATION
		$this->form_validation->set_rules('subject_id', 'Subject ID', 'required');
		$this->form_validation->set_rules('student_id', 'Student ID', 'required');
		//NOT SUCCESSFUL FILLING UP GO TO ADDSUBJECT PAGE
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('addStudentToSubject');
		}
		//SUCCESSFUL FILLING UP
		else
		{
			//GET USER INPUT
			$student_id = $this->input->post('student_id');
			$subject_id = $this->input->post('subject_id');
			//CALL ADD SUBJECT FUNCTION
			$result = $this->subject_student_model->DeleteSubjectFromStudent($student_id,$subject_id);
			//IF SUCCESSFUL ADDING SUBJECT GO TO HOME
			if($result){
				$this->load->helper('date');
				$this->load->library('session');
				$this->load->model('logs_model');
				
				//--------------------------for logs---------------------------------/
				$data2 = array(
                   'date'  => standard_date('DATE_ATOM', time()),
                   'emp_num'  => $this->session->userdata('emp_num'),
                   'activity' => 'Deleted Subject from Student',
				   'remarks' => $this->input->post('student_id')
				);
				$this->logs_model->AddLogs($data2);

				$this->load->view('formsuccess');
			}
		}
			
	}//end of function
}

?>