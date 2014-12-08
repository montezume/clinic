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
		
				$queueLengths = array();
				$totalQueueLength = 0;
				
				for ($i = 1; $i < 6; $i++) {
					$currentQueueLength = $this->getLengthOfQueue($i);
					$queueLengths[] = $this->getLengthOfQueue($i);
					$totalQueueLength += $currentQueueLength;
					}
			

			 // user hasn't submitted the form.
			 if (!($this->input->server('REQUEST_METHOD') === 'POST')) {	
					$this->showExaminationOverview($queueLengths, $totalQueueLength);
				}
			else {
				// form is submitted, remove a patient from the queue
				// if they aren't all empty.
				if ($totalQueueLength != 0) {
					$nextVisitId = $this->getNextPatient();
					}
				else {
					$nextVisitId = -1;
				}
				// there are no patients in queue.
				if ($nextVisitId == -1) {
					// show view again.
					$this->showExaminationOverview($queueLengths, $totalQueueLength);
				}
				
				else {
				    
				    if ($nextVisitId == -2) {
				        // there was a concurrency issue, show view with error.
				        $this->showExaminationOverview($queueLengths, $totalQueueLength, true);
				        }
				    else {
				    
					// the next screen requires visit ID 
					$this->session->set_flashdata('visit_id', $nextVisitId);
					redirect("examinationscreen", 'refresh');
					}
				}
			}
		}
	}
	
	
	function showExaminationOverview($queueLengths, $totalQueueLength, $concurrencyIssue = false) {
		$headerData = array(
						'title' => 'CQS - Examination Overview'
					);
		$this->load->view('header', $headerData);
								
		$viewData = 
			array(
				'totalQueueLength' => $totalQueueLength,
				'lengthOfQueue1' => $queueLengths[0],
				'lengthOfQueue2' => $queueLengths[1],
				'lengthOfQueue3' => $queueLengths[2],
				'lengthOfQueue4' => $queueLengths[3],
				'lengthOfQueue5' => $queueLengths[4],
				'concurrencyIssue' => $concurrencyIssue
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
			return $this->queue->getNextVisitId('1');
		}
		
		else {
		
		// There are no code 1 patients, proceed as usual using the current position in system table.

        //$currentPosition = $this->system->getCurrentPosition();
        
		for ($i = 0; $i < 10; $i++) {
		
		    $currentPosition = $this->system->incrementCurrentPosition();
		    		    
			switch($currentPosition) {
				case 0: 
				case 2:
				case 5:
				case 7:
					$nextVisitId = $this->queue->getNextVisitId('2');
					break;
				case 1:
				case 4:
				case 8:					
					$queueToUse = 3;
					// If both queues aren't empty, check registration time of queue 2
					// and determine who came first.
					
					$queueToUse = $this->queue->compareQueues('2', '3');
					if ($queueToUse != -1) {
						$nextVisitId = $this->queue->getNextVisitId($queueToUse);
						}
					else {
						$nextVisitId = -1;
					}
					break;		
				case 3:
				case 9:
					$queueToUse = 4;
					// check registration time of queue 2, queue 3, queue 4
					// and determine who came first.
					
					$queueToUse = $this->queue->compareQueues('2', '3', '4');
					if ($queueToUse != -1) {
						$nextVisitId = $this->queue->getNextVisitId($queueToUse);
						}
					else {
						$nextVisitId = -1;
					}
					break;		
				case 6:
					$queueToUse = 5;
					// check registration time of queue 2, queue 3, queue 4, queue 5
					// and determine who came first.
					
					$queueToUse = $this->queue->compareQueues('2', '3', '4', '5');
					if ($queueToUse != -1) {
						$nextVisitId = $this->queue->getNextVisitId($queueToUse);
						}
					else {
						$nextVisitId = -1;
					}
					break;		
					
				} // end switch
				
				// concurrency issue.
				
				if ($nextVisitId == -2) {
					return -2;
				}

                // patient found.
				if ($nextVisitId > 0) {
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
