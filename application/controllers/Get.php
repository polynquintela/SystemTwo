<?php 

ini_set("display_errors", 1);
error_reporting(E_ALL);

if (!defined('BASEPATH')) 
    exit('No direct script access allowed.');

class Get extends CI_Controller 
{
    public function index()
    {
        $query = $this->input->get("query");
        
        switch($query)
        {
            case "search":
            {
                $this->load->model("search_model");
                
                $j = 0;
                $data = array();
                $students = $this->search_model->searchStudent($this->input->get("key"));
                $employees = $this->search_model->searchEmployee($this->input->get("key"));
                $subjects = $this->search_model->searchSubject($this->input->get("key"));
                $batch = $this->search_model->searchBatch($this->input->get("key"));
                
                for($i = 0; $i < sizeof($students); $i++)
                {
                    $data[$j] = array
                    (
                        "id" => $students[$i]["Student_id"],
                        "name" => $students[$i]["Student_name"],
                        "type" => "Student"
                    );
                    
                    $j++;
                }
                
                for($i = 0; $i < sizeof($employees); $i++)
                {
                    $data[$j] = array
                    (
                        "id" => $employees[$i]["Emp_num"],
                        "name" => $employees[$i]["name"],
                        "type" => "Employee"
                    );
                    
                    $j++;
                }
                
                for($i = 0; $i < sizeof($subjects); $i++)
                {
                    $data[$j] = array
                    (
                        "id" => $subjects[$i]["Subject_id"],
                        "name" => $subjects[$i]["Subject_name"],
                        "type" => "Subject"
                    );
                    
                    $j++;
                }
                
                for($i = 0; $i < sizeof($batch); $i++)
                {
                    $data[$j] = array
                    (
                        "id" => $batch[$i]["batch_id"],
                        "name" => $batch[$i]["section"],
                        "type" => "Batch/Section"
                    );
                    
                    $j++;
                }
                
                echo json_encode($data);
                    
                break;
            }
            case "getsubjects":
            {
                $this->load->model("subject_model");
                $this->load->model("employee_model");
                
                $data = array();
                $subjects = $this->subject_model->getSubjects();

                for($i = 0; $i < sizeof($subjects); $i++)
                {
                    $data[$i] = array
                    (
                        "id" => $subjects[$i]["Subject_id"],
                        "name" => $subjects[$i]["Subject_name"],
                        "units" => $subjects[$i]["Subject_unit"],
                        "type" => $subjects[$i]["Subject_type"],   
                        "desc" => $subjects[$i]["Description"],
                        "teacher" => $this->employee_model->getEmployeeName($subjects[$i]["Emp_num"]),
                        "startHour" => strtok($subjects[$i]["Time_slot_start"], " "),
                        "startMin" => strtok(" "),
                        "startAMPM" => strtok(" "),
                        "endHour" => strtok($subjects[$i]["Time_slot_end"], " "),
                        "endMin" => strtok(" "),
                        "endAMPM" => strtok(" ")
                    );
                }
                
                echo json_encode($data);
                
                break;
            }
            case "getsubjectsperteacher":
            {
                $this->load->model("subject_teacher");
                $this->load->model("employee_model");
                
                $data = array();
                $subjects = $this->subject_teacher->getSubjectsPerTeacher($this->input->get("id"));

                for($i = 0; $i < sizeof($subjects); $i++)
                {
                    $data[$i] = array
                    (
                        "id" => $subjects[$i]["Subject_id"],
                        "name" => $subjects[$i]["Subject_name"],
                        "units" => $subjects[$i]["Subject_unit"],
                        "type" => $subjects[$i]["Subject_type"],   
                        "desc" => $subjects[$i]["Description"],
                        "teacher" => $this->employee_model->getEmployeeName($subjects[$i]["Emp_num"]),
                        "startHour" => strtok($subjects[$i]["Time_slot_start"], " "),
                        "startMin" => strtok(" "),
                        "startAMPM" => strtok(" "),
                        "endHour" => strtok($subjects[$i]["Time_slot_end"], " "),
                        "endMin" => strtok(" "),
                        "endAMPM" => strtok(" ")
                    );
                }
                
                echo json_encode($data);
                
                break;
            }
            case "getteachers":
            {
                $this->load->model("employee_model");
                
                $data = array();
                $teachers = $this->employee_model->getTeachers();
                
                for($i = 0; $i < sizeof($teachers); $i++)
                {
                    $data[$i] = array
                    (
                        "id" => $teachers[$i]["Emp_num"],
                        "name" => $teachers[$i]["name"],
                        "admin" => $teachers[$i]["Admin_flag"],
                        "adviser" => $teachers[$i]["Adviser_flag"],
                        "teacher" => $teachers[$i]["Subj_teacher_flag"]
                    );
                }
                
                echo json_encode($data);
                
                break;
            }
            case "getadvisers":
            {
                $this->load->model("employee_model");
                
                $data = array();
                $advisers = $this->employee_model->getAdvisers();
                
                for($i = 0; $i < sizeof($advisers); $i++)
                {
                    $data[$i] = array
                    (
                        "id" => $advisers[$i]["Emp_num"],
                        "name" => $advisers[$i]["name"],
                        "admin" => $advisers[$i]["Admin_flag"],
                        "adviser" => $advisers[$i]["Adviser_flag"],
                        "teacher" => $advisers[$i]["Subj_teacher_flag"]
                    );
                }
                
                echo json_encode($data);
                
                break;
            }
            case "getadmins":
            {
                $this->load->model("employee_model");
                
                $data = array();
                $batches = $this->employee_model->getAdmins();
                
                for($i = 0; $i < sizeof($batches); $i++)
                {
                    $data[$i] = array
                    (
                        "id" => $batches[$i]["Emp_num"],
                        "name" => $batches[$i]["name"],
                        "admin" => $batches[$i]["Admin_flag"],
                        "adviser" => $batches[$i]["Adviser_flag"],
                        "teacher" => $batches[$i]["Subj_teacher_flag"]
                    );
                }
                
                echo json_encode($data);
                
                break;
            }
            case "getbatches":
            {
                $this->load->model("batch_model");
                
                $data = array();
                $batches = $this->batch_model->getBatches();
                
                for($i = 0; $i < sizeof($batches); $i++)
                {
                    $data[$i] = array
                    (
                        "id" => $batches[$i]["batch_id"],
                        "yearlevel" => $batches[$i]["student_year"],
                        "section" => $batches[$i]["section"],
                        "adviser" => $batches[$i]["adviser"],
                        "startacadyear" => $batches[$i]["start_of_academic_year"],
                        "endacadyear" => $batches[$i]["end_of_academic_year"],
                        "name" => "Batch ".$batches[$i]["start_of_academic_year"]."-".$batches[$i]["end_of_academic_year"]." ".$batches[$i]["section"]
                    );
                }
                
                echo json_encode($data);
                
                break;
            }
            case "getstudents":
            {
                $this->load->model("student_model");
                
                $data = array();
                $students = $this->student_model->getStudents();

                for($i = 0; $i < sizeof($students); $i++)
                {
                    $data[$i] = array
                    (
                        "id" => $students[$i]["Student_id"],
                        "name" => $students[$i]["Student_name"],
                        "sex" => $students[$i]["Student_sex"],
                        "status" => $students[$i]["status"],
                        "address" => $students[$i]["address"],
                        "nationality" => $students[$i]["nationality"],
                        "curriculum" => $students[$i]["curriculum"],
                        "birthMonth" => strtok($students[$i]["birthdate"]," "),
                        "birthDay" => strtok(" "),
                        "birthYear" => strtok(" ")
                    );
                }
                
                echo json_encode($data);
                
                break;
            }
            case "getadvisees":
            {
                $this->load->model("advisees");
                
                $data = array();
                $students = $this->advisees->getAdvisees($this->input->get("name"));

                for($i = 0; $i < sizeof($students); $i++)
                {
                    $data[$i] = array
                    (
                        "id" => $students[$i]["Student_id"],
                        "name" => $students[$i]["Student_name"],
                        "sex" => $students[$i]["Student_sex"],
                        "status" => $students[$i]["status"],
                        "address" => $students[$i]["address"],
                        "nationality" => $students[$i]["nationality"],
                        "curriculum" => $students[$i]["curriculum"],
                        "birthMonth" => strtok($students[$i]["birthdate"]," "),
                        "birthDay" => strtok(" "),
                        "birthYear" => strtok(" ")
                    );
                }
                
                echo json_encode($data);
                
                break;
            }
            case "getstudentsperbatch":
            {
                $this->load->model("batch_model");
                
                $data = array();
                $students = $this->batch_model->getStudents($this->input->get("id"));

                for($i = 0; $i < sizeof($students); $i++)
                {
                    $data[$i] = array
                    (
                        "id" => $students[$i]["Student_id"],
                        "name" => $students[$i]["Student_name"],
                        "sex" => $students[$i]["Student_sex"],
                        "status" => $students[$i]["status"],
                        "address" => $students[$i]["address"],
                        "nationality" => $students[$i]["nationality"],
                        "curriculum" => $students[$i]["curriculum"],
                        "birthMonth" => strtok($students[$i]["birthdate"]," "),
                        "birthDay" => strtok(" "),
                        "birthYear" => strtok(" ")
                    );
                }
                
                echo json_encode($data);
                
                break;
            }
            case "getstudentspersubject":
            {
                $this->load->model("subject_student");
                
                $data = array();
                $students = $this->subject_student->getStudentsPerSubject($this->input->get("id"));

                for($i = 0; $i < sizeof($students); $i++)
                {
                    $data[$i] = array
                    (
                        "id" => $students[$i]["Student_id"],
                        "name" => $students[$i]["Student_name"],
                        "sex" => $students[$i]["Student_sex"],
                        "status" => $students[$i]["status"],
                        "address" => $students[$i]["address"],
                        "nationality" => $students[$i]["nationality"],
                        "curriculum" => $students[$i]["curriculum"],
                        "birthMonth" => strtok($students[$i]["birthdate"]," "),
                        "birthDay" => strtok(" "),
                        "birthYear" => strtok(" ")
                    );
                }
                
                echo json_encode($data);
                
                break;
            }
            case "getsubjectsperstudent":
            {
                $this->load->model("subject_student");
                
                $data = array();
                $subjects = $this->subject_student->getSubjectsPerStudent($this->input->get("studentid"));
                
                for($i = 0; $i < sizeof($subjects); $i++)
                {
                    $data[$i] = array
                    (
                        "subject" => $subjects[$i]["Subject_name"],
                        "subjectid" => $subjects[$i]["Subject_id"]
                    );
                }
                
                echo json_encode($data);
                
                break;
            }
            case "getsubjectgrade":
            {
                $this->load->model("subject_grade");
                
                $data = array();
                $grades = $this->subject_grade->getSubjectGrade($this->input->get("studentid"), $this->input->get("subjectid"), $this->input->get("period"));
                
                for($i = 0; $i < sizeof($grades); $i++)
                {
                    $data[$i] = array
                    (
                        "subject" => $grades[$i]["Subject_id"],
                        "student" => $grades[$i]["student_id"],
                        "period" => $grades[$i]["grading_period"],
                        "grade" => $grades[$i]["grade"]
                    );
                }
                
                echo json_encode($data);
                
                break;
            }
            case "getattendance":
            {
                $this->load->model("attendance_model");
                
                $data = array();
                $attendance = $this->attendance_model->getAttendance($this->input->get("studentid"), $this->input->get("batchid"), $this->input->get("period"));
                
                for($i = 0; $i < sizeof($attendance); $i++)
                {
                    $data[$i] = array
                    (
                        "batchid" => $attendance[$i]["batch_id"],
                        "studentid" => $attendance[$i]["student_id"],
                        "period" => $attendance[$i]["grading_period"],
                        "daystardy" => $attendance[$i]["student_days_tardy"],
                        "dayspresent" => $attendance[$i]["student_days_present"],
                        "schooldays" => $attendance[$i]["school_days"],
                    );
                }
                
                echo json_encode($data);
                
                break;
            }
            case "getlogs":
            {
                $this->load->model("logs_model");
                
                $data = array();
                $logs = $this->logs_model->getLogs();

                for($i = 0; $i < sizeof($logs); $i++)
                {
                    $data[$i] = array
                    (
                        "id" => $logs[$i]["logs_id"],
                        "date" => $logs[$i]["date"],
                        "employee" => $logs[$i]["emp_num"],
                        "activity" => $logs[$i]["activity"],
                        "remarks" => $logs[$i]["remarks"]
                    );
                }
                
                echo json_encode($data);
                
                break;
            }
        }
    }
}