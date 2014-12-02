<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ExaminationScreen extends CI_Controller
{    	
    function __construct() {
        parent::__construct();
		$this->load->library('form_validation');

    }

	/* Page is loaded with the visit id of the patient to be examined..
	 */
	function index() {
	// read visit id from flash data.
	$this->session->keep_flashdata('visit_id');
	$visit_id = $this->session->flashdata('visit_id');

	if (!$this->session->userdata('logged_in') || !$this->session->userdata('logged_in')['NURSE']) {
        redirect('login', 'refresh');
		} else {
			 // user hasn't submitted the form.
			 if (!($this->input->server('REQUEST_METHOD') === 'POST')) {	
					$this->showExaminationScreen($visit_id);
				} else {
				// form is submitted, bring them back to triage overview.
				redirect('examinationoverview', 'refresh');
				}
			}
	}
	
	function showExaminationScreen($visit_id) {
		
		// load models
		$this->load->model('visit');
		$this->load->model('patient');
		
		$visit = $this->visit->findVisit($visit_id);
		$patient_id = $this->visit->getPatientId($visit_id);
		$patient = $this->patient->getPatientById($patient_id);
		
		// make array of necessary patient info to pass to view.
		$data = array();
		$data['visit'] = $visit;
		$data['patient'] = $patient;
		
		$headerData = array(
						'title' => 'CQS - Examination'
					);
		$this->load->view('header', $headerData);
		
		$this->load->view('examination_view', $data);
		$this->load->view('footer');
	}
}

?>