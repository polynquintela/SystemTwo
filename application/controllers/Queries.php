<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Queries extends CI_Controller {

	public function index(){
        $data = array();
        $this->load->model('subject_model');
        $results = $this->subject_model->getSubjects();
        $data['result'] = $results;
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($data));
        return $data;
	}
}
