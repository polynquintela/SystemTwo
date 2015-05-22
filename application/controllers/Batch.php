<?php

class batch extends CI_Controller {
	

	function index()
	{
	}
	function LoadAddBatch(){
			$this->load->helper(array('form', 'url'));
			$this->load->view('addBatch');
	}//end of LoadAddSubject function
	function LoadDeleteBatch(){
			$this->load->helper(array('form', 'url'));
			$this->load->view('deleteBatch');
	}//end of LoadAddSubject function
	function LoadEditBatch(){
			$this->load->helper(array('form', 'url'));
			$this->load->view('editBatch');
	}//end of LoadAddSubject function
	
	function LoadAddStudentToBatch(){
			$this->load->helper(array('form', 'url'));
			$this->load->view('addStudentToBatch');
	}//end of LoadAddSubject function
	
	function LoadDeleteStudentFromBatch(){
			$this->load->helper(array('form', 'url'));
			$this->load->view('deleteStudentFromBatch');
	}//end of LoadAddSubject function
	
	//---------------------ADD BATCH-----------------------//
	function AddBatch(){
		//LOAD LIBRARIES AND MODEL
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('batch_model');
		
		//FORM VALIDATION
		$this->form_validation->set_rules('student_year', 'Student Year', 'required' || "^Grade /(7|8|9|10|11|12)/$");
		$this->form_validation->set_rules('section', 'Class Section', 'required' || "^[a-zA-Z]*$");
		$this->form_validation->set_rules('adviser', 'Class Adviser', 'required' || "^[a-zA-Z .-]*$");
		$this->form_validation->set_rules('start_of_academic_year', 'Start Of Academic Year', 'required' || "^[0-9]*$");
		$this->form_validation->set_rules('end_of_academic_year', 'End Of Academic Year', 'required' || "^[0-9]*$");
		
		//NOT SUCCESSFUL FILLING UP GO TO ADDSUBJECT PAGE
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('addBatch');
		}
		//SUCCESSFUL FILLING UP
		else
		{
			//GET USER INPUT
			$batch_data = array(
							'student_year' => $this->input->post('student_year'),
							'section' => $this->input->post('section'),
							'adviser' => $this->input->post('adviser'),
							'start_of_academic_year' => $this->input->post('start_of_academic_year'),
							'end_of_academic_year' => $this->input->post('end_of_academic_year')
						
			);	
			//CALL ADD BATCH FUNCTION
			$result = $this->batch_model->AddBatchModel($batch_data);
			//IF SUCCESSFUL ADDING SUBJECT GO TO HOME
			if($result){
				$this->load->helper('date');
				$this->load->library('session');
				$this->load->model('logs_model');
				
				//--------------------------for logs---------------------------------/
				$data2 = array(
                   'date'  => standard_date('DATE_ATOM', time()),
                   'emp_num'  => $this->session->userdata('emp_num'),
                   'activity' => 'Added Batch',
				   'remarks' => 'Added '.$batch_data['student_year'].'-'.$batch_data['section'].': '.$batch_data['adviser']
				  
				);
				$this->logs_model->AddLogs($data2);
				$this->load->view('formsuccess');
			}
		}
	}//end of add subject function
	//---------------------DELETE BATCH-----------------------//
	function deleteBatch(){
		//LOAD LIBRARIES AND MODEL
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('batch_model');
		
		//FORM VALIDATION
		$this->form_validation->set_rules('batch_id', 'Batch ID', 'required' || "^[0-9]*$");
		
		//NOT SUCCESSFUL FILLING UP GO TO ADDSUBJECT PAGE
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('deleteBatch');
		}
		//SUCCESSFUL FILLING UP
		else
		{
			
			$batch_id = $this->input->post('batch_id');
			//CALL ADD SUBJECT FUNCTION
			$result = $this->batch_model->DeleteBatchModel($batch_id);
			//IF SUCCESSFUL ADDING SUBJECT GO TO HOME
			if($result){
				$this->load->view('formsuccess');
			}
		}
			
				
	}//end of delete subject function
	
	//---------------------EDIT BATCH-----------------------//
	function EditBatch()
        {
		//LOAD LIBRARIES AND MODEL
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('batch_model');
		$this->load->model('edit_history');
		
		$this->load->helper('date');
		$this->load->library('session');
		$this->load->model('logs_model');
		
		//FORM VALIDATION
		$this->form_validation->set_rules('batch_id', 'Batch ID', 'required' || "^[0-9]*$");
		$this->form_validation->set_rules('student_year', 'Student Year', 'required' || "^Grade /(7|8|9|10|11|12)/$");
		$this->form_validation->set_rules('section', 'Class Section', 'required' || "^[a-zA-Z]*$");
		$this->form_validation->set_rules('adviser', 'Class Adviser', 'required' || "^[a-zA-Z .-]*$");
		$this->form_validation->set_rules('start_of_academic_year', 'Start Of Academic Year', 'required' || "^[0-9]*$");
		$this->form_validation->set_rules('end_of_academic_year', 'End Of Academic Year', 'required' || "^[0-9]*$");
		
		//NOT SUCCESSFUL FILLING UP GO TO ADDSUBJECT PAGE
		if ($this->form_validation->run() == FALSE)
		{
                    $this->load->view('editBatch');
		}
		//SUCCESSFUL FILLING UP
		else
		{
			$batch_id = $this->input->post('batch_id');
			//GET USER INPUT
			$batch_data = array(
							'student_year' => $this->input->post('student_year'),
							'section' => $this->input->post('section'),
							'adviser' => $this->input->post('adviser'),
							'start_of_academic_year' => $this->input->post('start_of_academic_year'),
							'end_of_academic_year' => $this->input->post('end_of_academic_year')
						
			);	
			$result = $this->batch_model->getData($batch_id);
			foreach($result as $row): 
			//query per student
				$content = $row->student_year;
				$content .= "   ";
				$content .= $row->section;
				$content .= "   ";
				$content .= $row->adviser;
				$content .= "   ";
				$content .= "   ";
				$content .= $row->start_of_academic_year;
				$content .= "   ";
				$content .= $row->end_of_academic_year;
			endforeach;
			
			//ADD TO EDIT HISTORY TABLE 
			$data2 = array(
                   'date'  => standard_date('DATE_ATOM', time()),
                   'emp_num'  => $this->session->userdata('emp_num'),
                   'page' => 'edit batch',
				   'remarks' => $content
				  
				);
			$this->edit_history->AddData($data2);
			
			
			//CALL EDIT BATCH FUNCTION
			$result = $this->batch_model->EditBatchModel($batch_data,$batch_id);
			//IF SUCCESSFUL ADDING SUBJECT GO TO HOME
			if($result){
			
				
				//--------------------------for logs---------------------------------/
				$data2 = array(
                   'date'  => standard_date('DATE_ATOM', time()),
                   'emp_num'  => $this->session->userdata('emp_num'),
                   'activity' => 'Edited Batch',
				   'remarks' => 'Edited '.$batch_data['student_year'].'-'.$batch_data['section'].':  '.$batch_data['adviser']
				  
				);
				$this->logs_model->AddLogs($data2);
			
				$this->load->view('formsuccess');
			}
		}
	}//end of add subject function
	
	
	function addStudentToBatch(){
		//LOAD LIBRARIES AND MODEL
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('batch_model');
		
		//FORM VALIDATION
		$this->form_validation->set_rules('batch_id', 'Batch ID', 'required');
		$this->form_validation->set_rules('student_id', 'Student ID', 'required');
		
		
		//NOT SUCCESSFUL FILLING UP GO TO ADDSUBJECT PAGE
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('addStudentToBatch');
		}
		//SUCCESSFUL FILLING UP
		else
		{
			
			$batch_data = array(
							'batch_id' => $this->input->post('batch_id'),
							'student_id' => $this->input->post('student_id'),
							'total_school_days' => '0',
							'total_days_present' =>'0',
							'total_days_tardy' => '0'
						
			);	
			//CALL ADD SUBJECT FUNCTION
			$result = $this->batch_model->addStudentToBatch($batch_data);
			//IF SUCCESSFUL ADDING SUBJECT GO TO HOME
			if($result){
				$this->load->helper('date');
				$this->load->library('session');
				$this->load->model('logs_model');
				
				//--------------------------for logs---------------------------------/
				$data2 = array(
                   'date'  => standard_date('DATE_ATOM', time()),
                   'emp_num'  => $this->session->userdata('emp_num'),
                   'activity' => 'Added Student to Batch',
				   'remarks' => 'Added '.$batch_data['student_id'].'to '.$batch_data['batch_id']
				  
				);
				$this->logs_model->AddLogs($data2);
			
				$this->load->view('formsuccess');
			}
		}
			
				
	}//end of delete subject function
	
	
	function deleteStudentFromBatch(){
		//LOAD LIBRARIES AND MODEL
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('batch_model');
		
		//FORM VALIDATION
		$this->form_validation->set_rules('batch_id', 'Batch ID', 'required');
		$this->form_validation->set_rules('student_id', 'Student ID', 'required');
		
		
		//NOT SUCCESSFUL FILLING UP GO TO ADDSUBJECT PAGE
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('deleteStudentFromBatch');
		}
		//SUCCESSFUL FILLING UP
		else
		{
			
			$batch_id = $this->input->post('batch_id');
			$student_id = $this->input->post('student_id');
			
			//CALL ADD SUBJECT FUNCTION
			$result = $this->batch_model->deleteStudentFromBatch($batch_id, $student_id);
			//IF SUCCESSFUL ADDING SUBJECT GO TO HOME
			if($result){
			
				$this->load->helper('date');
				$this->load->library('session');
				$this->load->model('logs_model');
				
				//--------------------------for logs---------------------------------/
				$data2 = array(
                   'date'  => standard_date('DATE_ATOM', time()),
                   'emp_num'  => $this->session->userdata('emp_num'),
                   'activity' => 'Deleted Student from Batch',
				   'remarks' => 'Deleted '.$student_id.'from '.$batch_id
				  
				);
				$this->logs_model->AddLogs($data2);
			
				$this->load->view('formsuccess');
			}
		}
			
				
	}//end of delete subject function
	
	
	
}

?>
