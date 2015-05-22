<?php

class listofadvisees extends CI_Controller {
	
	function index()
	{
	}

	function LoadListOfAdvisees(){
		$this->load->helper(array('form', 'url'));
		$this->load->view('getadviser');
	}
	function viewAdvisees()
	{
		//load helper and libraries
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('advisees');
		
		$this->form_validation->set_rules('adviser', 'Adviser', 'required');

		//NOT SUCCESSFUL
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('getadviser');
		}
		//SUCCESSFUL
		else
		{
			//GET USER INPUT
			$adviser = $this->input->post('adviser');
			//CALL GET ADVISEES FUNCTION
			$result = $this->advisees->getAdvisees($adviser);
			//GENERATE PDF
			$count =0;
			$content = "<br> ADVISER NAME: </br>";
			$content .= "<b>";
			$content .= $adviser; 
			$content .= "</b>";
			$content .= "<br>";
			$content .= "<center><b>LIST OF ADVISEES</b></center>";
			foreach($result as $row): 
			//query per student
				$content .= "<center>";
				$content.= $row->Student_name;
				$content.= "<br>";
				$count++;
			endforeach;
			$content .= "</center>";
			$content .= "<b>TOTAL NUMBER OF ADVISEES: </b>";
			$content .= $count;
			
			include_once('dompdf/dompdf_config.inc.php');
			$dompdf = new DOMPDF();
			$dompdf->load_html($content);
			$dompdf->render();
			$dompdf->stream('listofadvisees.pdf');
			
			//IF SUCCESSFUL LISTING GO TO HOME
			$this->load->view('formsuccess');
			
		}
			
	}//end of add student grade function
}

?>