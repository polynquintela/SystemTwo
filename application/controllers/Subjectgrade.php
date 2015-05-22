<?php

class subjectgrade extends CI_Controller 
{
    function LoadAddSubjectGrade()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->view('add_subject_grade');
    } //end of load add

    function LoadDeleteSubjectGrade()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->view('delete_subject_grade');
    } //end of load delete

    function LoadEditSubjectGrade()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->view('edit_subject_grade');
    } //end of load edit
    
    function AddSubjectGrade()
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
            $data = array
            (
                'grading_period' => $this->input->post('grading_period'),
                'grade' => $this->input->post('grade'),
                'Subject_id' => $this->input->post('subject_id'),
                'student_id' => $this->input->post('stud_id')
            );	
            //CALL ADD SUBJECT GRADE FUNCTION
            $result = $this->subject_grade->addSubjectGrade($data);
            //IF SUCCESSFUL ADDING SUBJECT GRADE GO TO HOME

            if($result)
            {
                $this->load->helper('date');
                $this->load->library('session');
                $this->load->model('logs_model');

                //--------------------------for logs---------------------------------/
                $data2 = array
                (
                    'date'  => standard_date('DATE_ATOM', time()),
                    'emp_num'  => $this->session->userdata('emp_num'),
                    'activity' => 'Added Subject Grade',
                    'remarks' => 'Added to '.$data['student_id'].': '.$data['grade']. ' '. $data['grading_period'].' '. $data['Subject_id'] 
                );

                $this->logs_model->AddLogs($data2);

                $this->load->view('formsuccess');
            }
        }
    } //end of add student grade function

    function DeleteSubjectGrade()
    {
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
            $period = $this->input->post('grading_period');
            $subject_id = $this->input->post('subject_id');
            $student_id = $this->input->post('stud_id');
            //CALL DELETE SUBJECT GRADE FUNCTION
            $result = $this->subject_grade->deleteSubjectGrade($period,$subject_id, $student_id);
            //IF SUCCESSFUL DELETING STUDENT GRADE GO TO HOME
            if($result)
            {
                $this->load->helper('date');
                $this->load->library('session');
                $this->load->model('logs_model');

                //--------------------------for logs---------------------------------/
                $data2 = array
                (
                    'date'  => standard_date('DATE_ATOM', time()),
                    'emp_num'  => $this->session->userdata('emp_num'),
                    'activity' => 'Deleted Subject Grade',
                    'remarks' => 'Deleted from '.$student_id.': '. $period.' '. $subject_id 
                );

                $this->logs_model->AddLogs($data2);

                $this->load->view('formsuccess');
            }
        }
    }

    function EditSubject_Grade()
    {
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
            $data = array
            (
                'grading_period' => $this->input->post('grading_period'),
                'subject_id' => $this->input->post('subject_id'),
                'student_id' => $this->input->post('stud_id')
            );
            //CALL EDIT SUBJECT GRADE FUNCTION
            $result = $this->attendance_model->editSubjectGrade($data);
            //IF SUCCESSFUL EDITING STUDENT GRADE GO TO HOME
            if($result)
            {
                $this->load->view('formsuccess');
            }
        }
    } //end of edit student grade function
}
?>