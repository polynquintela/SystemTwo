<?php 

    // This controller is for the login
    class L extends CI_Controller 
    {
	function index()
        {
            $this->session->sess_destroy();
            $this->load->view('login_page');
	}

	public function login()
        {
            // Gets the user inputs
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // Checks if the username and password is in the database.
            $this->load->model(array('logs_model', 'account', 'employee', 'employee_model'));

            $result = $this->account->login($username, $password);

            // Successful login
            if(count($result) != 0)
            {
                $role = $this->employee->getEmployeeRole($result[0]->emp_num);
                $name = $this->employee_model->getEmployeeName($result[0]->emp_num);
                
                $user_data = array
                (
                    'name' => $name,
                    'role' => $role,
                    'username'  => $username,
                    'state' => 0,
                    'emp_num' => $result[0]->emp_num,
                    'logged_in' => TRUE
                );

                $this->session->set_userdata($user_data);

                    // Adding logs that the user has logged in
                $log_data = array
                (
                    'date'  => standard_date('DATE_ATOM', time()),
                    'emp_num'  => $result[0]->emp_num,
                    'activity' => 'LOG-IN',
                    'remarks' => 'None'
                );

                $this->logs_model->addLogs($log_data);

                redirect("U/home"); 
            }
            // Unsuccessful login: returns to the login page
            else{
                redirect('L');
            }
	}

	public function logout()
        {
            $this->load->model('logs_model');
            $emp_num = $this->session->userdata('emp_num');

            // Logs the logged-out event in the database
            $log_data = array
            (
                'date'  => standard_date('DATE_ATOM', time()),
                'emp_num'  => $emp_num,
                'activity' => 'LOG-OUT',
                'remarks' => 'None'
            );
            
            $this->logs_model->addLogs($log_data);
            redirect('L');
        }
    }
?>