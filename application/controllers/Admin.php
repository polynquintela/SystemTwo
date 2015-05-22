<?php 

if(! defined('BASEPATH')) 
    exit('No direct script access allowed.');

class Admin extends CI_Controller 
{
    public function home()
    {
        $this->load->view("admin");
    }
}