<?php

class employee extends CI_Controller 
{
	function index()
	{
	}
	
	function ViewHistory()
        {
            $this->load->helper('date');
            $this->load->library('session');
            $this->load->model('logs_model');

            //--------------------------for logs---------------------------------/
            $data2 = array
            (
                'date'  => standard_date('DATE_ATOM', time()),
                'emp_num'  => $this->session->userdata('emp_num'),
                'activity' => 'View Edit History',
                'remarks' => 'View Edit History'
            );

            $this->logs_model->AddLogs($data2);
            //-----------view edit history of current user----------//
            $this->load->model('edit_history');

            $emp_num = $this->session->userdata('emp_num');
            $result['result'] = $this->edit_history->ViewData($emp_num);
            $this->load->view('listOfEdit',$result);
	}
	
	function ViewHistoryOfEmp()
        {
            $this->load->helper('date');
            $this->load->library('session');
            $this->load->model('logs_model');

            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

            //FORM VALIDATION
            $this->form_validation->set_rules('employee_num', 'Employee Number', 'required');

            //--------------------------for logs---------------------------------/
            $data2 = array(
               'date'  => standard_date('DATE_ATOM', time()),
               'emp_num'  => $this->session->userdata('emp_num'),
               'activity' => 'View Edit History',
                               'remarks' => 'View Edit History'
            );
            $this->logs_model->AddLogs($data2);
            //-----------view edit history of current user----------//
            $this->load->model('edit_history');

            $emp_num = $this->input->post('emp_num');
            $result['result'] = $this->edit_history->ViewData($emp_num);
            $this->load->view('listOfEdit',$result);
	}
        
	//------------------------------------ADD EMPLOYEE--------------------------//
	function addEmployee()
        {
            //LOAD LIBRARIES AND MODEL
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->model('employee_model');
            $this->load->model('account');
            $this->load->model('logs_model');

            //FORM VALIDATION
            $this->form_validation->set_rules('employee_num', 'Employee Number', 'required');
            $this->form_validation->set_rules('employee_name', 'Employee Name', 'required');
            $this->form_validation->set_rules('employee_designation', 'Employee Designation', 'required');

            if ($this->form_validation->run() == TRUE)
            {
                $employee_data = array
                (
                    "Emp_num" => $this->input->post("id"),
                    "name" => $this->input->post("name"),
                    "Admin_flag" => $this->input->post("admin"),
                    "Adviser_flag" => $this->input->post("adviser"),
                    "Subj_teacher_flag" => $this->input->post("teacher")
                );
                
                $this->employee_model->AddEmployeeModel($employee_data);

                $password = rand(0,30);
                $password .= $this->input->post('employee_num');
                $password .= rand(0,30);
                    
                //GET USER INPUT
                $data = array
                (
                    'account_username' => $this->input->post('employee_num'),
                    'account_password' => $password, 
                    'emp_num' => $this->input->post('employee_num') 
                );	
                    
                //CALL ADD SUBJECT FUNCTION
                $result = $this->account->AddAccount($data);
                    
                //IF SUCCESSFUL ADDING SUBJECT GO TO HOME
                if($result)
                {
                    $this->load->helper('date');
                    $this->load->library('session');

                    //--------------------------for logs---------------------------------/
                    $data2 = array
                    (
                        'date'  => standard_date('DATE_ATOM', time()),
                        'emp_num'  => $this->session->userdata('emp_num'),
                        'activity' => 'Added Employee',
                        'remarks' => 'Added '.$employee_data['Emp_num']
                    );
                    
                    $this->logs_model->AddLogs($data2);
                }
            }
	}//end of add employee function
	
	//------------------------------------EDIT EMPLOYEE--------------------------//
	function EditEmployee()
        {
            //LOAD LIBRARIES AND MODEL
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->model('employee_model');

            $this->load->helper('date');
            $this->load->library('session');
            $this->load->model('logs_model');

            $this->load->model('edit_history');
            $this->load->helper('date');
            $this->load->library('session');
            $this->load->model('logs_model');
            //FORM VALIDATION
            $this->form_validation->set_rules('emp_num', 'Employee Number', 'required');
            $this->form_validation->set_rules('emp_name', 'Employee Name', 'required');
            $this->form_validation->set_rules('emp_desig', 'Employee Designation', 'required');

            //NOT SUCCESSFUL FILLING UP GO TO ADDSUBJECT PAGE
            if ($this->form_validation->run() == FALSE)
            {
                    $this->load->view('editUser');
            }
            //SUCCESSFUL FILLING UP
            else
            {
                    $AdmFlag = 0;
                    $SFlag = 0;
                    $AdvFlag = 0;

                    if(strcmp($this->input->post('emp_desig'),"admin") == 0){
                            $AdmFlag = 1;
                    }else if(strcmp($this->input->post('emp_desig'), "subject") == 0){
                            $SFlag = 1;
                    }else if(strcmp($this->input->post('emp_desig'), 'adviser') == 0){
                            $AdvFlag = 1;
                    }else{

                    }
                    $Emp_num = $this->input->post('emp_num');
                    //GET USER INPUT
                    $employee_data = array(
                                                    'name' => $this->input->post('emp_name'),
                                                    'designation' => $this->input->post('emp_desig'),
                                                    'Admin_flag' => $AdmFlag, 
                                                    'Subj_teacher_flag' => $SFlag, 
                                                    'Adviser_flag' => $AdvFlag
                    );	
                    $result = $this->employee_model->getData($Emp_num);
                    foreach($result as $row): 
                    //query per student
                            $content = $row->name;
                            $content .= "   ";
                            $content .= $row->designation;
                            $content .= "   ";
                    endforeach;
                    //ADD TO EDIT HISTORY TABLE 
                    $data2 = array(
               'date'  => standard_date('DATE_ATOM', time()),
               'emp_num'  => $this->session->userdata('emp_num'),
               'page' => 'edit user',
                               'remarks' => $content

                            );
                    $this->edit_history->AddData($data2);
                    //-------------------------CHECK IF  EMPLOYEE EXISTS-------------------//
                    $table = "employee";
                    $attribute = "emp_num";
                    $this->load->model('account');
                    $result2 = $this->account->exist($table,$Emp_num, $attribute);

                    if($result2){
                    //CALL EDIT EMPLOYEE FUNCTION
                    $result = $this->employee_model->EditEmployeeModel($employee_data, $Emp_num);

                    if($result){


                            //--------------------------for logs---------------------------------/
                            $data2 = array(
               'date'  => standard_date('DATE_ATOM', time()),
               'emp_num'  => $this->session->userdata('emp_num'),
               'activity' => 'Edited Employee',
                               'remarks' => 'Edited '.$Emp_num

                            );
                            $this->logs_model->AddLogs($data2);
                            $this->load->view('formsuccess');
                    }
                    }
                    //end of exist
                    else{
                            $this->load->view('formsuccess'); //go back to home
                    }
            }
	}//end of edit employee function
	
	
}

?>