<?php

class logs extends CI_Controller {
	

	function index()
	{
	}
	function LoadLogsByDate(){
			$this->load->helper(array('form', 'url'));
			$this->load->view('view_logs_date');
	}//end of LoadAddSubject function
	function LoadLogsByEmp(){
			$this->load->helper(array('form', 'url'));
			$this->load->view('view_logs_emp');
	}//end of LoadAddSubject function
	
	function viewLogsByDate(){
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('logs_model');
		
		$this->form_validation->set_rules('date', 'Date', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('view_logs_date');
		}
		//SUCCESSFUL FILLING UP
		else
		{
			$data = $this->input->post('date');
			$result['result'] = $this->logs_model->viewLogsByDate($data);
			$this->load->view('listOfLogsDate',$result);
		}	
	}//end of view logs by date
	
	function viewLogsByEmp(){
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('logs_model');
		
		$this->form_validation->set_rules('emp_num', 'Employee Number', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('view_logs_emp');
		}
		//SUCCESSFUL FILLING UP
		else
		{
			$data = $this->input->post('emp_num');
			$result['result'] = $this->logs_model->viewLogsByEmp($data);
			$this->load->view('listOfLogsEmp',$result);
		}	
	}//end of view logs by employee number

}

?>
