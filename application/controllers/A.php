<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* This controller is for the redirecting multiple access users to  */
/*		specific pages.												*/
class A extends CI_Controller {

	function index(){
		$state = $this->session->userdata('state');

		if($state == 1){
			$this->load->view("redirects/redirect_ad_st_av");
		}
		else if($state == 2){
			$this->load->view("redirects/redirect_ad_st");
		}
		else if($state == 3){
			$this->load->view("redirects/redirect_st_av");
		}
		else if($state == 4){
			$this->load->view("redirects/redirect_ad_av");
		}
	}

	function ad(){
		$role = array('Admin_flag' => '1', 'Subj_teacher_flag' => '0', 'Adviser_flag' => '0');
		$role = array((object) $role);
		$this->session->unset_userdata('role');
		$this->session->set_userdata('role', $role);
		redirect("U/home");
	}

	function st(){
		$role = array('Admin_flag' => '0', 'Subj_teacher_flag' => '1', 'Adviser_flag' => '0');
		$role = array((object) $role);
		$this->session->unset_userdata('role');
		$this->session->set_userdata('role', $role);
		redirect("U/home");
	}

	function av(){
		$role = array('Admin_flag' => '0', 'Subj_teacher_flag' => '0', 'Adviser_flag' => '1');
		$role = array((object) $role);
		$this->session->unset_userdata('role');
		$this->session->set_userdata('role', $role);
		redirect("U/home");
	}

}

?>