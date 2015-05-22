<?php 

ini_set("display_errors", 1);
error_reporting(E_ALL);

if (!defined('BASEPATH')) 
    exit('No direct script access allowed.');

class Post extends CI_Controller 
{
    public function index()
    {
        $query = $this->input->post("query");
        
        switch($query)
        {
            case "postuser":
            {
                $status = 0;
                
                $this->load->model("account");
                $this->load->model("logs_model");
                $this->load->model("employee_model");
                
                if($this->input->post("posttype") === "add")
                {
                    $data = array
                    (
                        "Emp_num" => $this->input->post("id"),
                        "name" => $this->input->post("name"),
                        "Admin_flag" => $this->input->post("admin"),
                        "Adviser_flag" => $this->input->post("adviser"),
                        "Subj_teacher_flag" => $this->input->post("teacher")
                    );


                    $status = $this->employee_model->addEmployee($data);

                    //auto-construct account
                    $password = rand(0,30);
                    $password .= $this->input->post("id");
                    $password .= rand(0,30);

                    $account_data = array
                    (
                        "account_password" => $password, 
                        "account_username" => $this->input->post("id"),
                        "emp_num" => $this->input->post("id") 
                    );	

                    $status = $this->account->addAccount($account_data);

                    if($status) //update log
                    {
                        $this->load->helper('date');
                        $this->load->library('session');
                        
                        $log_data = array
                        (
                            "date"  => standard_date("DATE_ATOM", time()),
                            "emp_num"  => $this->session->userdata("emp_num"),
                            "activity" => "ADD EMPLOYEE",
                            "remarks" => 'Employee: '.$this->input->post("id")
                        );

                        $this->logs_model->addLogs($log_data);
                    }
                }
                else if($this->input->post("posttype") === "edit")
                {
                    $data = array
                    (
                        "name" => $this->input->post("name"),
                        "Admin_flag" => $this->input->post("admin"),
                        "Adviser_flag" => $this->input->post("adviser"),
                        "Subj_teacher_flag" => $this->input->post("teacher")
                    );
                    
                    $status = $this->employee_model->editEmployee($data, $this->input->post("id"));

                    if($status) //update log
                    {
                        $this->load->helper('date');
                        $this->load->library('session');
                        
                        $log_data = array
                        (
                            "date"  => standard_date("DATE_ATOM", time()),
                            "emp_num"  => $this->session->userdata("emp_num"),
                            "activity" => "EDIT EMPLOYEE",
                            "remarks" => "Employee: ".$this->input->post("id")
                        );

                        $this->logs_model->addLogs($log_data);
                    }
                }
                
                echo '{"status" : "'.$status.'"}';
                
                break;
            }
            case "postbatch":
            {
                $this->load->model("logs_model");
                $this->load->model("batch_model");
                
                $status = 0;

                $data = array
                (
                    "student_year" => $this->input->post("yearlevel"),
                    "section" => $this->input->post("section"),
                    "adviser" => $this->input->post("adviser"),
                    "start_of_academic_year" => $this->input->post("startacadyear"),
                    "end_of_academic_year" => $this->input->post("endacadyear")
                );
                
                if($this->input->post("posttype") === "add")
                    $status = $this->batch_model->addBatch($data);
                else if($this->input->post("posttype") === "edit")
                    $status = $this->batch_model->editBatch($data, $this->input->post("id"));
                
                if($status) //update log
                {
                    $activity = " ";
                    
                    $this->load->helper("date");
                    $this->load->library("session");
                    
                    if($this->input->post("posttype") === "add")
                        $activity = "ADD BATCH";
                    else if($this->input->post("posttype") === "edit")
                        $activity = "EDIT BATCH";

                    $log_data = array
                    (
                        "date"  => standard_date("DATE_ATOM", time()),
                        "emp_num"  => $this->session->userdata("emp_num"),
                        "activity" => $activity,
                        "remarks" => "Batch : ".$this->input->post("startacadyear")."-".$this->input->post("endacadyear")." ".$this->input->post("section")
                    );

                    $this->logs_model->addLogs($log_data);
                }
                
                echo '{"status" : "'.$status.'"}';
                
                break;
            }
            case "poststudent":
            {
                $this->load->model('logs_model');
                $this->load->model("student_model");
            
                $status = 0;
                
                $data = array
                (
                    "Student_name" => $this->input->post("name"),
                    "Student_sex" => $this->input->post("sex"),
                    "status" => $this->input->post("status"),
                    "address" => $this->input->post("address"),
                    "nationality" => $this->input->post("nationality"),
                    "curriculum" => $this->input->post("curriculum"),
                    "birthdate" => $this->input->post("birthMonth")." ".$this->input->post("birthDay")." ".$this->input->post("birthYear")
                );

                if($this->input->post("posttype") === "add")
                    $status = $this->student_model->addStudent($data);
                else if($this->input->post("posttype") === "edit")
                    $status = $this->student_model->editStudent($data, $this->input->post("id"));
                
                if($status) //update log
                {
                    $activity = " ";
                    
                    $this->load->helper('date');
                    $this->load->library('session');
                    
                    if($this->input->post("posttype") === "add")
                        $activity = "ADD STUDENT";
                    else if($this->input->post("posttype") === "edit")
                        $activity = "EDIT STUDENT";

                    $log_data = array
                    (
                        "date"  => standard_date("DATE_ATOM", time()),
                        "emp_num"  => $this->session->userdata("emp_num"),
                        "activity" => $activity,
                        "remarks" => "Student: ".$this->input->post("name")
                    );

                    $this->logs_model->addLogs($log_data);
                }
                
                echo '{"status" : "'.$status.'"}';
                
                break;
            }
            case "postsubject":
            {
                $this->load->model('logs_model');
                $this->load->model("subject_model");
                $this->load->model("employee_model");
                
                $status = 0;
                
                $data = array
                (
                    "Subject_name" => $this->input->post("name"),
                    "Subject_type" => $this->input->post("type"),
                    "Subject_unit" => $this->input->post("units"),
                    "Description" => $this->input->post("desc"),
                    "Emp_num" => $this->employee_model->getEmployeeID($this->input->post("teacher")),
                    "Time_slot_start" => $this->input->post("startHour")." ".$this->input->post("startMin")." ".$this->input->post("startAMPM"),
                    "Time_slot_end" => $this->input->post("endHour")." ".$this->input->post("endMin")." ".$this->input->post("endAMPM")
                );
                
                if($this->input->post("posttype") === "add")
                    $status = $this->subject_model->addSubject($data);
                else if($this->input->post("posttype") === "edit")
                    $status = $this->subject_model->editSubject($data, $this->input->post("id"));
                
                if($status) //update log
                {
                    $activity = " ";
                    
                    $this->load->helper("date");
                    $this->load->library("session");
                    
                    if($this->input->post("posttype") === "add")
                        $activity = "ADD SUBJECT";
                    else if($this->input->post("posttype") === "edit")
                        $activity = "EDIT SUBJECT";

                    $log_data = array
                    (
                        "date"  => standard_date("DATE_ATOM", time()),
                        "emp_num"  => $this->session->userdata("emp_num"),
                        "activity" => $activity,
                        "remarks" => 'Subject: '.$this->input->post("name")
                    );

                    $this->logs_model->addLogs($log_data);
                }
                
                echo '{"status" : "'.$status.'"}';
                
                break;
            }
            case "poststudentbatch":
            {
                $this->load->model("logs_model");
                $this->load->model("batch_model");
                
                $status = 0;
                
                $data = array
                (
                    "batch_id" => $this->input->post("batchid"),
                    "student_id" => $this->input->post("studentid"),
                    "total_school_days" => "",
                    "total_days_present" => "",
                    "total_days_tardy" => ""
                );
                
                if($this->input->post("posttype") === "add")
                    $status = $this->batch_model->addStudent($data);
                else if($this->input->post("posttype") === "edit")
                    $status = $this->batch_model->addStudent($this->input->post("batchid"), $this->input->post("studentid"));
                
                if($status) //update log
                {
                    $activity = " ";
                    
                    $this->load->helper('date');
                    $this->load->library('session');
                    
                    if($this->input->post("posttype") === "add")
                        $activity = "SET STUDENT BATCH";
                    else if($this->input->post("posttype") === "edit")
                        $activity = "EDIT STUDENT BATCH";

                    $log_data = array
                    (
                        'date'  => standard_date('DATE_ATOM', time()),
                        'emp_num'  => $this->session->userdata('emp_num'),
                        'activity' => $activity,
                        'remarks' => 'Student: '.$this->input->post("studentid")." Batch: ".$this->input->post("batchid")
                    );

                    $this->logs_model->addLogs($log_data);
                }
                
                echo '{"status" : "'.$status.'"}';
                
                break;
            }
            case "poststudentsubject":
            {
                $this->load->model("logs_model");
                $this->load->model("subject_student");
                
                $status = 0;
                
                $data = array
                (
                    "subject_id" => $this->input->post("subjectid"),
                    "student_id" => $this->input->post("studentid"),
                    "Final_grade" => "",
                    "Subject_action" => ""
                );
                
                if($this->input->post("posttype") === "add")
                    $status = $this->subject_student->addStudent($data);
                else if($this->input->post("posttype") === "edit")
                    $status = $this->subject_student->addStudent($this->input->post("subjectid"), $this->input->post("studentid"));
                
                if($status) //update log
                {
                    $activity = " ";
                    
                    $this->load->helper('date');
                    $this->load->library('session');
                    
                    if($this->input->post("posttype") === "add")
                        $activity = "SET STUDENT SUBJECT";
                    else if($this->input->post("posttype") === "edit")
                        $activity = "EDIT STUDENT SUBJECT";

                    $log_data = array
                    (
                        'date'  => standard_date('DATE_ATOM', time()),
                        'emp_num'  => $this->session->userdata('emp_num'),
                        'activity' => $activity,
                        'remarks' => 'Student: '.$this->input->post("studentid")." Subject: ".$this->input->post("subjectid")
                    );

                    $this->logs_model->addLogs($log_data);
                }
                
                echo '{"status" : "'.$status.'"}';
                
                break;
            }
            case "postsubjectgrade":
            {
                $this->load->model("logs_model");
                $this->load->model("subject_grade");
                
                $status = 0;
                
                $data = array
                (
                    "Subject_id" => $this->input->post("subjectid"),
                    "student_id" => $this->input->post("studentid"),
                    "grading_period" => $this->input->post("period"),
                    "grade" => $this->input->post("grade")
                );

                if($this->input->post("posttype") === "add")
                    $status = $this->subject_grade->addSubjectGrade($data);
                else if($this->input->post("posttype") === "edit")
                    $status = $this->subject_grade->editSubjectGrade($this->input->post("studentid"), $this->input->post("subjectid"), $this->input->post("period"), $this->input->post("grade"));
                
                if($status) //update log
                {
                    $activity = " ";
                    
                    $this->load->helper('date');
                    $this->load->library('session');
                    
                    if($this->input->post("posttype") === "add")
                        $activity = "SET STUDENT SUBJECT GRADE";
                    else if($this->input->post("posttype") === "edit")
                        $activity = "EDIT STUDENT SUBJECT GRADE";

                    $log_data = array
                    (
                        'date'  => standard_date('DATE_ATOM', time()),
                        'emp_num'  => $this->session->userdata('emp_num'),
                        'activity' => $activity,
                        'remarks' => "Subject: ".$this->input->post("subjectid")
                    );

                    $this->logs_model->addLogs($log_data);
                }
                
                echo '{"status" : "'.$status.'"}';
                
                break;
            }
            case "postattendance":
            {
                $this->load->model("logs_model");
                $this->load->model("attendance_model");
                
                $status = 0;
                
                $data = array
                (
                    "batch_id" => $this->input->post("batchid"),
                    "student_id" => $this->input->post("studentid"),
                    "grading_period" => $this->input->post("period"),
                    "student_days_tardy" => $this->input->post("daystardy"),
                    "student_days_present" => $this->input->post("dayspresent"),
                    "school_days" => $this->input->post("schooldays"),
                );

                if($this->input->post("posttype") === "add")
                    $status = $this->attendance_model->addAttendance($data);
                else if($this->input->post("posttype") === "edit")
                    $status = $this->attendance_model->editAttendance($this->input->post("studentid"), $this->input->post("batchid"), $this->input->post("period"), $this->input->post("grade"));
                
                if($status) //update log
                {
                    $activity = " ";
                    
                    $this->load->helper('date');
                    $this->load->library('session');
                    
                    if($this->input->post("posttype") === "add")
                        $activity = "SET STUDENT ATTENDANCE";
                    else if($this->input->post("posttype") === "edit")
                        $activity = "EDIT STUDENT ATTENDANCE";

                    $log_data = array
                    (
                        'date'  => standard_date('DATE_ATOM', time()),
                        'emp_num'  => $this->session->userdata('emp_num'),
                        'activity' => $activity,
                        'remarks' => "Student: ".$this->input->post("studentid")
                    );

                    $this->logs_model->addLogs($log_data);
                }
                
                echo '{"status" : "'.$status.'"}';
                
                break;
            }
            case "deleteentity":
            {
                $id = $this->input->post("id");
                $entitytype = $this->input->post("entitytype");
                
                switch($entitytype)
                {
                    case "subject":
                    {
                        $this->load->model("logs_model");
                        $this->load->model("subject_model");
                        
                        $status = $this->subject_model->deleteSubject($id);
                        
                        if($status) //update log
                        {
                            $this->load->helper('date');
                            $this->load->library('session');

                            $log_data = array
                            (
                                'date'  => standard_date('DATE_ATOM', time()),
                                'emp_num'  => $this->session->userdata('emp_num'),
                                'activity' => 'DELETE SUBJECT',
                                'remarks' => 'Subject: '.$id
                            );

                            $this->logs_model->addLogs($log_data);
                        }
                        
                        echo '{"status" : "'.$status.'"}';
                        break;
                    }
                    case "student":
                    {
                        $this->load->model("logs_model");
                        $this->load->model("student_model");
                        
                        $status = $this->student_model->deleteStudent($id);
                        
                        if($status) //update log
                        {
                            $this->load->helper('date');
                            $this->load->library('session');

                            $log_data = array
                            (
                                'date'  => standard_date('DATE_ATOM', time()),
                                'emp_num'  => $this->session->userdata('emp_num'),
                                'activity' => 'DELETE STUDENT',
                                'remarks' => 'Student: '.$id
                            );

                            $this->logs_model->addLogs($log_data);
                        }
                        
                        echo '{"status" : "'.$status.'"}';
                        break;
                    }
                    case "batch":
                    {
                        $this->load->model("logs_model");
                        $this->load->model("batch_model");
                        
                        $status = $this->batch_model->deleteBatch($id);
                        
                        if($status) //update log
                        {
                            $this->load->helper('date');
                            $this->load->library('session');

                            $log_data = array
                            (
                                'date'  => standard_date('DATE_ATOM', time()),
                                'emp_num'  => $this->session->userdata('emp_num'),
                                'activity' => 'DELETE BATCH',
                                'remarks' => 'Batch: '.$id
                            );

                            $this->logs_model->addLogs($log_data);
                        }
                        
                        echo '{"status" : "'.$status.'"}';
                        break;
                    }
                    case "teacher":
                    {
                    }
                    case "adviser":
                    {
                    }
                    case "admin":
                    {
                        $this->load->model("account");
                        $this->load->model("logs_model");
                        $this->load->model("employee_model");
                        
                        $status = $this->employee_model->deleteEmployee($id);

                        if($status) //delete account
                            $this->account->deleteAccount($this->input->post("id"));
                        
                        if($status) //update log
                        {
                            $this->load->helper('date');
                            $this->load->library('session');

                            $log_data = array
                            (
                                'date'  => standard_date('DATE_ATOM', time()),
                                'emp_num'  => $this->session->userdata('emp_num'),
                                'activity' => 'DELETE EMPLOYEE',
                                'remarks' => 'Employee: '.$this->input->post("id")
                            );

                            $this->logs_model->addLogs($log_data);
                        }
                        
                        echo '{"status" : "'.$status.'"}';
                        break;
                    }
                }
                
                break;
            }
            case "sendmessage":
            {
                $to = $this->input->post("to");
                $content = $this->input->post("content");
                
                echo '{"status" : "success"}';
                
                break;
            }
        }
    }
}