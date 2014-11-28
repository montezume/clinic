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

		$this->form_validation->set_rules('primaryComplaint', 'RAMQ', 'trim|required');
		$this->form_validation->set_rules('firstSymptom', 'first sympton', 'trim|required');
		$this->form_validation->set_rules('secondSymptom', 'second sympton', 'trim|required');
		$this->form_validation->set_rules('queue', 'queue', 'trim|required');

		// read visit id from flash data.
		$this->session->keep_flashdata('visit_id');
		$visit_id = $this->session->flashdata('visit_id');

		// TODO: will need form validation rules...
		
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
				
				// if there are form errors.
				if ($this->form_validation->run() == FALSE) {
					$this->showTriageForm($visit_id);
				}

				else {
				// need to add him to appropriate Queue based on TRIAGE level.
				
				var_dump($_POST);
				//redirect("triageoverview", 'refresh');
					}
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
					'patient' => $patient
				);
		$this->load->view('header', $headerData);
		$this->load->view('triage_patient_view', $formData);
		$this->load->view('footer');

	}
		
} // end class
?>