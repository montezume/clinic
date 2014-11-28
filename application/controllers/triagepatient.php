<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class TriagePatient extends CI_Controller
{    	
    function __construct()
    {
        parent::__construct();
		$this->load->library('form_validation');
    }
    function index()
    {		
	
		$this->form_validation->set_error_delimiters("<div class='alert alert-danger' role='alert'>
		<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
		<span class='sr-only'>Error:</span>", '</div>');

		// read visit id from flash data.
		$this->session->keep_flashdata('visit_id');
		$visit_id = $this->session->flashdata('visit_id');

		// will need form validation rules...
		
		// if user is not logged in or does not have receptionist privileges.
        if (!$this->session->userdata('logged_in') || !$this->session->userdata('logged_in')['NURSE']) {
            redirect('login', 'refresh');
		} else {
			 // user hasn't submitted the form.
			 if (!($this->input->server('REQUEST_METHOD') === 'POST')) {	
					$this->showTriageForm($visit_id);
				}
			// redirect to triage screen.
			else {
				// form is submitted 
				
				// make sure it's valid.
				
				// need to add him to appropriate Queue based on TRIAGE level.
				
				redirect("triageoverview", 'refresh');
				}
			}
		
	}
	
	function showTriageForm($visit_id) {
		
		// get patient / registration information.
				
		// load  model.
		$this->load->model('visit');
		$patient_id = $this->visit->getPatientId($visit_id);
		$this->load->model('patient');
		$patient = $this->patient->getPatientById($patient_id);

		
		$headerData = array(
						'title' => 'CQS - Triage Patient'
					);
		$formData = array(
					'visit_id' => $visit_id,
					'patient' => $patient
				);
		$this->load->view('header', $headerData);
		$this->load->view('triage_patient_view', $formData);
		$this->load->view('footer');

	}
		
	
} // end class
?>