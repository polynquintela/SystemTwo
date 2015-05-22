<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* This controller is for Error 404 - Page not found! */
class E extends CI_Controller {
	
	function index(){
        $this->load->view("error_page");
	}
}

?>