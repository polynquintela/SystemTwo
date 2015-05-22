<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* This controller displaying the interface in which    */
/*      the user wants to go to.                        */
class U extends CI_Controller {
	
	function index(){
        redirect('L');
	}

	function home(){
        if($this->session->userdata("logged_in")){
            $ad = $this->session->userdata("role")[0]->Admin_flag;
            $st = $this->session->userdata("role")[0]->Subj_teacher_flag;
            $av = $this->session->userdata("role")[0]->Adviser_flag;

            if($ad == 1 && $st == 1 && $av == 1){
                $this->session->set_userdata('state', 1);
                redirect("A");

            }
            else if($ad == 1 && $st == 1){
                $this->session->set_userdata('state', 2);
                redirect("A");
            }
            else if($av == 1 && $st == 1){
                $this->session->set_userdata('state', 3);
                redirect("A");
            }
            else if($av == 1 && $ad == 1){
                $this->session->set_userdata('state', 4
                    );
                redirect("A");
            }
            else if($st == 1){
                $this->load->view("subject_teacher/home_page", array("name" => $this->session->userdata("name")));
            }
            else if($ad == 1){
                $this->load->view("admin/home_page", array("name" => $this->session->userdata("name")));
            }
            else if($av == 1){
                $this->load->view("adviser/home_page", array("name" => $this->session->userdata("name")));
            }
            else{
                
            }
        }	
        else
            redirect('L');
	}
}

?>