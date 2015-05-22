<?php

class subject_grade extends CI_Controller {
	
	function index()
	{
	}

	function LoadAddSubject_Grade(){
		$this->load->helper(array('form', 'url'));
		$this->load->view('add_subject_grade');
	}
	function LoadDeleteSubject_Grade(){
		$this->load->helper(array('form', 'url'));
		$this->load->view('delete_subject_grade');
	}
	function LoadEditSubject_Grade(){
		$this->load->helper(array('form', 'url'));
		$this->load->view('edit_subject_grade');
	}
	function AddSubject_Grade()
	{
		//load helper and libraries
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('subject_grade');
		
		$this->form_validation->set_rules('stud_id', 'Student ID', 'required');
		$this->form_validation->set_rules('grading_period', 'Grading Period', 'required');
		$this->form_validation->set_rules('subject_id', 'Subject ID', 'required');
		$this->form_validation->set_rules('grade', 'Grade', 'required');

		//NOT SUCCESSFUL
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('add_subject_grade');
		}
		//SUCCESSFUL
		else
		{
			//GET USER INPUT
			$data = array(
							'grading_period' => $this->input->post('grading_period'),
							'subject_id' => $this->input->post('subject_id'),
							'student_id' => $this->input->post('stud_id'),
							'grade' => $this->input->post('grade')
			);	
			//CALL ADD SUBJECT GRADE FUNCTION
			$result = $this->subject_grade->addSubjectGrade($data);
			//IF SUCCESSFUL ADDING SUBJECT GRADE GO TO HOME
			if($result){
				$this->load->view('formsuccess');
			}
		}
			
	}//end of add student grade function

	function DeleteSubject_Grade(){
		//LOAD LIBRARIES AND MODEL
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('subject_grade');
		
		//FORM VALIDATION
		$this->form_validation->set_rules('stud_id', 'Student ID', 'required');
		$this->form_validation->set_rules('grading_period', 'Grading Period', 'required');
		$this->form_validation->set_rules('subject_id', 'Subject ID', 'required');
		
		//NOT SUCCESSFUL FILLING UP GO TO DELETE SUBJECT GRADE PAGE
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('delete_subject_grade');
		}
		//SUCCESSFUL FILLING UP
		else
		{
			$data = array(
							'grading_period' => $this->input->post('grading_period'),
							'subject_id' => $this->input->post('subject_id'),
							'student_id' => $this->input->post('stud_id')
			);
			//CALL DELETE SUBJECT GRADE FUNCTION
			$result = $this->attendance_model->deleteSubjectGrade($data);
			//IF SUCCESSFUL DELETING STUDENT GRADE GO TO HOME
			if($result){
				$this->load->view('formsuccess');
			}
		}

	function EditSubject_Grade(){
		//LOAD LIBRARIES AND MODEL
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('subject_grade');
		
		//FORM VALIDATION
		$this->form_validation->set_rules('stud_id', 'Student ID', 'required');
		$this->form_validation->set_rules('grading_period', 'Grading Period', 'required');
		$this->form_validation->set_rules('subject_id', 'Subject ID', 'required');
		
		//NOT SUCCESSFUL FILLING UP GO TO EDIT SUBJECT GRADE PAGE
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('edit_subject_grade');
		}
		//SUCCESSFUL FILLING UP
		else
		{
			$data = array(
							'grading_period' => $this->input->post('grading_period'),
							'subject_id' => $this->input->post('subject_id'),
							'student_id' => $this->input->post('stud_id')
			);
			//CALL EDIT SUBJECT GRADE FUNCTION
			$result = $this->attendance_model->editSubjectGrade($data);
			//IF SUCCESSFUL EDITING STUDENT GRADE GO TO HOME
			if($result){
				$this->load->view('formsuccess');
			}
		}
			
				
	}//end of delete student grade function
}

?>