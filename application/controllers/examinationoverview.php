<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ExaminationOverview extends CI_Controller
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

		// if user is not logged in or does not have nurse privileges.
        if (!$this->session->userdata('logged_in') || !$this->session->userdata('logged_in')['NURSE']) {
            redirect('login', 'refresh');
		} else {
			 // user hasn't submitted the form.
			 if (!($this->input->server('REQUEST_METHOD') === 'POST')) {	
					$this->showExaminationOverview(false);
				}
			// redirect to triage screen.
			else {
				// form is submitted, remove a patient from the queue.
				
				$nextVisitId = $this->getNextPatient();
				// there are no patients in queue.
				if ($nextVisitId == -1) {
					// show view again.
					$this->showExaminationOverview();
				}
				// a patient was dequeued from queue.
				else {
					// the next screen requires visit ID 
					$this->session->set_flashdata('visit_id', $nextVisitId);
					
					//var_dump($this->compareTwoPatients('2', '3'));
					redirect("examinationscreen", 'refresh');
				}
			}
		}
	}
	
	function showExaminationOverview() {
		$headerData = array(
						'title' => 'CQS - Examination Overview'
					);
		$this->load->view('header', $headerData);
		
		$queueLengths = array();
		$totalQueueLength = 0;
				
		for ($i = 1; $i < 6; $i++) {
			$currentQueueLength = $this->getLengthOfQueue($i);
			$queueLengths[] = $this->getLengthOfQueue($i);
			$totalQueueLength += $currentQueueLength;
		}
						
		$viewData = 
			array(
				'totalQueueLength' => $totalQueueLength,
				'lengthOfQueue1' => $queueLengths[0],
				'lengthOfQueue2' => $queueLengths[1],
				'lengthOfQueue3' => $queueLengths[2],
				'lengthOfQueue4' => $queueLengths[3],
				'lengthOfQueue5' => $queueLengths[4],
			);
		
		$this->load->view('examination_overview_view', $viewData);
		$this->load->view('footer');
	}
	
	function getNextPatient() {
	
		//load system model.
		$this->load->model('system');
		
		// load queue model.
		$this->load->model('queue');
		
		// Check to see if there are any code 1 patients - they always go first.
		
		if ($this->queue->getLengthOfQueue('1') > 0) {
			return $this->queue->getNextPatient('1');
		}
		
		else {
		
		// There are no code 1 patients, proceed as usual using the current position in system table.

		for ($i = 0; $i < 9; $i++) {
		
			$currentPosition = $this->system->incrementCurrentPosition();

			switch($currentPosition) {
				case 0: 
				case 2:
				case 5:
				case 7:
					$nextVisitId = $this->queue->getNextPatient('2');
					break;
				case 1:
				case 4:
				case 8:
					//$nextVisitId = $this->queue->getNextPatient('3');
					
					$queueToUse = 3;
					// If both queues aren't empty, check registration time of queue 2
					// and determine who came first.
					
					$queueToUse = $this->queue->compareQueues('2', '3');
					if ($queueToUse != -1) {
						$nextVisitId = $this->queue->getNextPatient($queueToUse);
						}
					else {
						$nextVisitId = -1;
					}
					break;		
				case 3:
				case 9:
					$queueToUse = 4;
					
					// TODO peek to check that first code 2/3 patient didn't arrive first.
					$nextVisitId = $this->queue->getNextPatient('4');
					break;
				case 6:
					// TODO peek to check that first code 2/3/4 patient didn't arrive first.
					$nextVisitId = $this->queue->getNextPatient('5');
					break;
					
				} // end switch
				
				if ($nextVisitId != -1) {
					return $nextVisitId;
				}
							
			} // end loop
			
			// queues are empty.
			return -1;
		
		}
				
	}
	
	function getLengthOfQueue($queueName) {
		// load queue model.
		$this->load->model('queue');
		return $this->queue->getLengthOfQueue($queueName);
	}
	
} // end class
?>
