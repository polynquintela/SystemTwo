<?php

class attendance extends CI_Controller {
	
	function index()
	{
	}

	function LoadAttendance(){
		$this->load->helper(array('form', 'url'));
			$this->load->view('attendance_view');
	}
	function LoadDeleteAttendance(){
		$this->load->helper(array('form', 'url'));
			$this->load->view('attendance_view2');
	}
	function LoadEditAttendance(){
		$this->load->helper(array('form', 'url'));
		$this->load->view('editAttendance');
	}
	function AddAttendance()
	{
		//load helper and libraries
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('attendance_model');
		
		$this->form_validation->set_rules('stud_id', 'Student ID', 'required' || "^[0-9]*$");
		$this->form_validation->set_rules('grading_period', 'Grading Period', 'required' || "/(1|2|3|4)/");
		$this->form_validation->set_rules('batch_id', 'Batch ID', 'required' || "^[0-9]*$");
		$this->form_validation->set_rules('days_tardy', 'Days Tardy', 'required' || "^[0-9]*$");
		$this->form_validation->set_rules('days_present', 'Days Present', 'required' || "^[0-9]*$");
		$this->form_validation->set_rules('days_total', 'Total Number of Days', 'required' || "^[0-9]*$");
		//NOT SUCCESSFUL
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('attendance_view');
		}
		//SUCCESSFUL
		else
		{
			//GET USER INPUT
			$data = array(
							'grading_period' => $this->input->post('grading_period'),
							'batch_id' => $this->input->post('batch_id'),
							'student_days_tardy' => $this->input->post('days_tardy'),
							'student_days_present' => $this->input->post('days_present'),
							'school_days' => $this->input->post('days_total'),
							'student_id' => $this->input->post('stud_id')
			);	
			//CALL ADD STUDENT FUNCTION
			$result = $this->attendance_model->addAttendance($data);
			//IF SUCCESSFUL ADDING SUBJECT GO TO HOME
			if($result){
				$this->load->helper('date');
				$this->load->library('session');
				$this->load->model('logs_model');
				
				//--------------------------for logs---------------------------------/
				$data2 = array(
                   'date'  => standard_date('DATE_ATOM', time()),
                   'emp_num'  => $this->session->userdata('emp_num'),
                   'activity' => 'Added Attendance',
				   'remarks' => 'Added to '.$data['student_id'].': '.$data['grading_period']
				  
				);
				$this->logs_model->AddLogs($data2);
			
			
				$this->load->view('formsuccess');
			}
		}
			
	}//end of Add Attendance function

	function DeleteAttendance(){
		//LOAD LIBRARIES AND MODEL
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('attendance_model');
		
		//FORM VALIDATION
		$this->form_validation->set_rules('stud_id', 'Student ID', 'required' || "^[0-9]*$");
		$this->form_validation->set_rules('period', 'Grading Period', 'required' || "/(1|2|3|4)/");
		//NOT SUCCESSFUL FILLING UP GO TO ADDSUBJECT PAGE
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('attendance_view2');
		}
		//SUCCESSFUL FILLING UP
		else
		{
			$student_id = $this->input->post('stud_id');
			$period = $this->input->post('period');
			//CALL ADD STUDENT FUNCTION
			$result = $this->attendance_model->DeleteAttendance($student_id, $period);
			//IF SUCCESSFUL ADDING STUDENT GO TO HOME
			if($result){
				$this->load->helper('date');
				$this->load->library('session');
				$this->load->model('logs_model');
				
				//--------------------------for logs---------------------------------/
				$data2 = array(
                   'date'  => standard_date('DATE_ATOM', time()),
                   'emp_num'  => $this->session->userdata('emp_num'),
                   'activity' => 'Delted Attendance',
				   'remarks' => 'Deleted from '.$student_id.': '.$period
				  
				);
				$this->logs_model->AddLogs($data2);
					
			
				$this->load->view('formsuccess');
			}
		}
			
				
	}//end of delete student function
	
	function EditAttendance()
	{
		//load helper and libraries
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$this->load->model('attendance_model');
		$this->load->model('edit_history');
		$this->load->helper('date');
		$this->load->library('session');
		$this->load->model('logs_model');
		
		$this->form_validation->set_rules('stud_id', 'Student ID', 'required' || "^[0-9]*$");
		$this->form_validation->set_rules('grading_period', 'Grading Period', 'required' || "/(1|2|3|4)/");
		$this->form_validation->set_rules('batch_id', 'Batch ID', 'required' || "^[0-9]*$");
		$this->form_validation->set_rules('days_tardy', 'Days Tardy', 'required' || "^[0-9]*$");
		$this->form_validation->set_rules('days_present', 'Days Present', 'required' || "^[0-9]*$");
		$this->form_validation->set_rules('days_total', 'Total Number of Days', 'required' || "^[0-9]*$");
		//NOT SUCCESSFUL
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('editAttendance');
		}
		//SUCCESSFUL
		else
		{
			$grading_period = $this->input->post('grading_period');
			$batch_id = $this->input->post('batch_id');
			$student_id = $this->input->post('stud_id');
			
			//GET USER INPUT
			$data = array(
							'student_days_tardy' => $this->input->post('days_tardy'),
							'student_days_present' => $this->input->post('days_present'),
							'school_days' => $this->input->post('days_total'),
			);	
			//GET PREVIOUS DATA FROM DB
			$result = $this->attendance_model->getData($grading_period, $batch_id, $student_id);
			foreach($result as $row): 
			//query per student
				$content = $row->grading_period;
				$content .= "   ";
				$content .= $row->batch_id;
				$content .= "   ";
				$content .= $row->student_days_tardy;
				$content .= "   ";
				$content .= "   ";
				$content .= $row->student_days_present;
				$content .= "   ";
				$content .= $row->school_days;
				$content .= $row->student_id;
				
			endforeach;
			
			//ADD TO EDIT HISTORY TABLE 
			$data2 = array(
                   'date'  => standard_date('DATE_ATOM', time()),
                   'emp_num'  => $this->session->userdata('emp_num'),
                   'page' => 'edit attendance',
				   'remarks' => $content
				  
				);
			$this->edit_history->AddData($data2);
			
	
			//CALL EDIT STUDENT FUNCTION
			$result = $this->attendance_model->editAttendance($data, $grading_period, $batch_id, $student_id);
			//IF SUCCESSFUL ADDING SUBJECT GO TO HOME
			if($result){
				
				
				//--------------------------for logs---------------------------------/
				$data2 = array(
                   'date'  => standard_date('DATE_ATOM', time()),
                   'emp_num'  => $this->session->userdata('emp_num'),
                   'activity' => 'Edited Attendance',
				   'remarks' => 'Edited '.$student_id.': '.$grading_period.'with batch '. $batch_id
				  
				);
				$this->logs_model->AddLogs($data2);
			
				$this->load->view('formsuccess');
			}
		}
			
	}//end of Edit Attendance function

}

?>