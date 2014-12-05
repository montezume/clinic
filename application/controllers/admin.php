<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller
{    	
    function __construct() {
        parent::__construct();
		$this->load->library('form_validation');
    }

	function index() {
		// if user is not logged in or does not have admin privileges.
        if (!$this->session->userdata('logged_in')) {
		    redirect('login', 'refresh');
		}
		else {
		
			if (!$this->session->userdata('logged_in')['ADMIN']) {
				redirect('dashboard', 'refresh');
			}
			
			 // user hasn't submitted the form.
			 if (!($this->input->server('REQUEST_METHOD') === 'POST')) {	
					$this->showAdmin(false);	
				} else {
					// load model.
					$this->load->model('visit');
					// get post info - needs to be sent to view to make it sticky
					$triageQueryTime = htmlentities($_POST['toBeTriaged']);
					$codeQueryTime = htmlentities($_POST['timeForCode']);
					$totalPatientsQueryTime = htmlentities($_POST['totalPatientsQueryTime']);
					$triageResults = $this->visit->getAverageTimeBeforeTriage($triageQueryTime);
					
					$codeResults = array();
					$totalAverageTime = 0.0;
					$totalPatientsPerCode = array();
					$totalPatients = 0;
					// get average time spent in each queue, and put into an array
					// as well as total patients examined in each queue.
					for ($code = 1; $code < 6; $code ++) {
						$codeResults[$code] = number_format($this->visit->getAverageTimeSpentInEachCode($code, $codeQueryTime), 1);
						$totalPatientsPerCode[$code] = $this->visit->getTotalPatientsExaminedInCode($code, $totalPatientsQueryTime);
						$totalAverageTime = $totalAverageTime + $codeResults[$code];
						$totalPatients = $totalPatients + $totalPatientsPerCode[$code];

					}
										
					$totalAverageTime = $totalAverageTime / 5.0;
					
					// form is submitted, display results...
					$results = array(
					'triageTimeSelected' => $triageQueryTime,
					'triageResults' => number_format($triageResults, 1), 
					'codeTimeSelected' => $codeQueryTime,
					'codeResults' => $codeResults,
					'totalAverageTime' => number_format($totalAverageTime, 1),
					'totalPatientsPerCode' => $totalPatientsPerCode,
					'totalPatients' => $totalPatients,
					'totalPatientsTimeSelected' => $totalPatientsQueryTime
					);
					
					$this->showAdmin($results);	

				
				}
			

		}

	} 
	
	function showAdmin($results) {
			
			$headerData = array(
						'title' => 'CQS - Admin'
					);
			$this->load->view('header', $headerData);
			$this->load->view('admin_view', $results);
			$this->load->view('footer');
	}

} 
?>
