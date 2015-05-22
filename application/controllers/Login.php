<?php

class Login extends CI_Controller 
{
    function index()
    {
        //load helper and libraries
        $this->load->helper(array('form', 'url', 'date'));
        $this->load->library('form_validation');
        $this->load->library('session');

        $loginVerify = $this->session->userdata('logged_in');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) //NOT SUCCESSFUL
        {
            $this->load->view('loginpage');
        }
        else //SUCCESSFUL
        {
            //LOAD MODEL FOR DATABASE
            $this->load->model('account');
            $this->load->model('logs_model');

            //GET USER INPUT
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            //CALL LOGIN FUNCTION
            $result = $this->account->login($username, $password);

            if($result) //SUCCESSFUL LOG-IN
            {
                //START SESSION
                $temp = $this->account->getEmp_num($username, $password);

                $data = array
                (
                    'username'  => $username,
                    'password'  => $password,
                    'emp_num' => $temp,
                    'logged_in' => TRUE
                );

                $this->session->set_userdata($data);
                $emp_num = $this->session->userdata('emp_num');
                
                redirect('admin/home');

                //--------------------------for logs---------------------------------//
                $format = 'DATE_ATOM';
                $time = time();
                $data2 = array
                (
                    'date'  => standard_date($format, $time),
                    'emp_num'  => $emp_num,
                    'activity' => 'LOG-IN',
                    'remarks' => ''
                );

                $this->logs_model->AddLogs($data2);
            }
            else //NOT SUCCESSFUL: RETURN TO LOG-IN
            {
                $this->load->view('loginpage');
            }
        }
    }//end of index function

    public function logout()
    {
        $this->load->library('session');
        $this->load->helper('date');
        $this->load->model('logs_model');

        $emp_num = $this->session->userdata('emp_num');

        //--------------------------for logs---------------------------------//
        $format = 'DATE_ATOM';
        $time = time();
        $data2 = array
        (
            'date'  => standard_date($format, $time),
            'emp_num'  => $emp_num,
            'activity' => 'LOGGED-OUT',
            'remarks' => ''
        );

        $this->logs_model->AddLogs($data2);
        $this->session->sess_destroy();
        $this->load->helper(array('form', 'url'));
        $this->load->view('loginpage');
    }//end of log-out function
}

?>