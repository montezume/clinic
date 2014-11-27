<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class TriageOverview extends CI_Controller
{    	
    function __construct()
    {
        parent::__construct();
		$this->load->library('form_validation');
    }
    function index()
    {		
		// if user is not logged in or does not have receptionist privileges.
        if (!$this->session->userdata('logged_in') || !$this->session->userdata('logged_in')['NURSE']) {
            redirect('login', 'refresh');
		} else {
			$this->showTriageOverview();
		}
		
	}
	
	function showTriageOverview() {
		$headerData = array(
						'title' => 'CQS - Triage Overview'
					);
		$this->load->view('header', $headerData);
		
		$lengthOfQueue = $this->getLengthOfQueue();
		
		$viewData = 
			array(
				'lengthOfQueue' => $lengthOfQueue
			);
		
		$this->load->view('triage_overview_view', $viewData);

	}
	
	function getLengthOfQueue() {
		// load queue model.
		$this->load->model('queue');
		return $this->queue->getLengthOfQueue('TRIAGE');
	}
	
} // end class
?>