<?php

class student extends CI_Controller {
	

	function index()
	{
	}
	function LoadAddStudent(){
			$this->load->helper(array('form', 'url'));
			$this->load->view('add_student');
	}//end of LoadAddSubject function
	function LoadDeleteStudent(){
			$this->load->helper(array('form', 'url'));
			$this->load->view('delete_student');
	}//end of LoadAddSubject function
	
	function AddStudent(){
		//LOAD LIBRARIES AND MODEL
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('student_model');
		$this->load->helper('date');
		$this->load->library('session');
		$this->load->model('logs_model');
		//FORM VALIDATION
		$this->form_validation->set_rules('stud_name', 'Student Name', 'required');
		$this->form_validation->set_rules('stud_sex', 'Student Sex', 'required');
		$this->form_validation->set_rules('stud_status', 'Student Status', 'required');
		$this->form_validation->set_rules('stud_address', 'Student Address', 'required');
		$this->form_validation->set_rules('stud_nationality', 'Student Nationality', 'required');
		$this->form_validation->set_rules('stud_curri', 'Student Curriculum', 'required');
		$this->form_validation->set_rules('stud_bday', 'Student Birthday', 'required');
		
		//NOT SUCCESSFUL FILLING UP GO TO ADDSUBJECT PAGE
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('add_student');
		}
		//SUCCESSFUL FILLING UP
		else
		{
			//GET USER INPUT
			$student_data = array(
							'Student_name' => $this->input->post('stud_name'),
							'Student_sex' => $this->input->post('stud_sex'),
							'status' => $this->input->post('stud_status'),
							'address' => $this->input->post('stud_address'),
							'nationality' => $this->input->post('stud_nationality'),
							'curriculum' => $this->input->post('stud_curri'),
							//birthdate doesn't work atm
							'birthdate' => $this->input->post('stud_bday')
			);	
			//CALL ADD STUDENT FUNCTION
			$result = $this->student_model->addStudent($student_data);
			//IF SUCCESSFUL ADDING SUBJECT GO TO HOME
			if($result){
				$emp_num = $this->session->userdata('emp_num');
				
				//--------------------------for logs---------------------------------//
				$format = 'DATE_ATOM';
				$time = time();
				$data2 = array(
                   'date'  => standard_date($format, $time),
                   'emp_num'  => $emp_num,
                   'activity' => 'Added Student',
				   'remarks' => $this->input->post('stud_name')
				);
				$this->logs_model->AddLogs($data2);
			
				$this->load->view('formsuccess');
			}
		}
			
				
	}//end of add subject function
	
	function DeleteStudent(){
		//LOAD LIBRARIES AND MODEL
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('student_model');
		
		//FORM VALIDATION
		$this->form_validation->set_rules('name', 'Student Name', 'required');
		
		//NOT SUCCESSFUL FILLING UP GO TO ADDSUBJECT PAGE
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('delete_student');
		}
		//SUCCESSFUL FILLING UP
		else
		{
			
			$student_name = $this->input->post('name');
			//CALL ADD STUDENT FUNCTION
			$result = $this->student_model->deleteStudent($student_name);
			//IF SUCCESSFUL ADDING STUDENT GO TO HOME
			if($result){
				$this->load->helper('date');
				$this->load->library('session');
				$this->load->model('logs_model');
				
				//--------------------------for logs---------------------------------/
				$data2 = array(
                   'date'  => standard_date('DATE_ATOM', time()),
                   'emp_num'  => $this->session->userdata('emp_num'),
                   'activity' => 'Deleted Student',
				   'remarks' => $this->input->post('name')
				);
				$this->logs_model->AddLogs($data2);
			
				$this->load->view('formsuccess');
			}
		}
			
				
	}//end of delete student function
}

?>