<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PatientRegistration extends CI_Controller
{    	
    function __construct()
    {
        parent::__construct();
		$this->load->library('form_validation');
    }
    function index()
    {		
		// set form rules
		$this->form_validation->set_rules('ramq', 'RAMQ', 'trim|required|htmlentities');
		$this->form_validation->set_rules('firstName', 'first name', 'trim|required|htmlentities');
		$this->form_validation->set_rules('lastName', 'last name', 'trim|required|htmlentities');
		$this->form_validation->set_rules('homePhone', 'home phone', 'trim|required|htmlentities');
		$this->form_validation->set_rules('emergencyPhone', 'emergency contact', 'trim|required|htmlentities');
		$this->form_validation->set_rules('conditions', 'existing conditions', 'trim|required|htmlentities');
		$this->form_validation->set_rules('primaryPhysician', 'primary physician', 'trim|required|htmlentities');

		$this->form_validation->set_error_delimiters("<div class='alert alert-danger' role='alert'>
		<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
		<span class='sr-only'>Error:</span>", '</div>');

	
		// read ramq id from flash data.
		$this->session->keep_flashdata('ramq');
		$ramq = $this->session->flashdata('ramq');
			
		// if user is not logged in or does not have receptionist privileges.
        if (!$this->session->userdata('logged_in') || !$this->session->userdata('logged_in')['RECEPTION']) {
            redirect('login', 'refresh');
			
        } else {
			
				$patient = $this->get_patient($ramq);
				if (isset($patient['PATIENT_ID'])) {
					$patient_id = $patient['PATIENT_ID'];
				}
			
				// user made an error submitting form.
			    if ($this->form_validation->run() == FALSE ) {	
					$this->show_registration($patient);
					}
				else {
					// form has been successfully submitted, add to queue and redirect.
					$patient = $_POST;
		
					// Patient id exists, patient is already in DB, therefore update.
					if (isset($patient_id)) {
						$this->updatePatient($patient, $patient_id);
					}
					// Patient is not yet in db, insert.
					else {
						$patient_id = $this->addPatient($patient);
					}
					
					// Add to visit table.
					
					$visit_id = $this->addVisit($patient_id);
					
					// Add to triage queue.
					$test = $this->addToTriage($visit_id);
					
					$message = $patient['firstName'] . " " . $patient['lastName'] . " was added to the triage queue";
					
					// send flash data to confirm that patient was added or updated to triage.
					$this->session->set_flashdata('change', $message);
					redirect("ramqregistration", 'refresh');
				}
		}
	}
    /* Returns an associative array of all the patient's info from DB
     */
    function get_patient($ramq)
    {
        // create instance of patient model
        $this->load->model('patient');
		
        $patient = ($this->patient->findPatient($ramq));
				
		// if there's no patient in db.
		if (!$patient) {
			return array(
			'RAMQ_ID' => $ramq
			);
		}
		// if he's in the db, return the patient.
		else {
			return array_merge($patient);
		}
		// here we can show the other fields and populate them.
    }
    /* Show the registration form with patient's info if present.
     */
    function show_registration($patient)
    {   $this->load->helper(array(
            'form',
            'url'
        ));

        $headerData = array(
            'title' => 'CQS - Patient Registration'
        );
        
		$this->load->view('header', $headerData);   
				
			$medications = array (
				'1' => 'Benzamycin',
				'2' => 'Accutane',
				'3' => 'Tamiflu',
				'4' => 'Acetaminophen',
				'5' => 'Advil',
				'6' => 'Levaquin',
				'7' => 'Vioxx',
				'8' => 'Celebrex',
				'9' => 'Zyprexa',
				'11' => 'Paxil',
				'12' => 'Nicoderm',
				'13' => 'Lorazepam',
				'14' => 'Elidel',
				'15' => 'Pegasys',
				'16' => 'Clikstar',
				'17' => 'Levaquin',
				'18' => 'Advair Diskus',
				'19' => 'Nexium',
				'20' => 'Kenalog'
			);
			
			$data['medications'] = $medications;
			$data['patient'] = $patient;

			$this->load->view('patient_registration_view', $data);
		
        $this->load->view('footer');
    }
	/* Add visit id to triage queue.
	 */
	function addToTriage($visit_id) {
		// create instance of the queue model
		$this->load->model('queue');
		$inserted = $this->queue->addToQueue($visit_id, '0');
		return $inserted;
	}
    /* Create entry in visit table.
     */
	function addVisit($patient_id) {
		// create instance of visit model
		$this->load->model('visit');
		$visit_id = ($this->visit->addVisit($patient_id));
		return $visit_id;
	}
	/* If RAMQ id not in db, add the patient to db.
	 */
	 	function addPatient($patient) {
	    // create instance of user model
        
		$this->load->model('patient');
		// add the patient to the db using the model, returning the patient id.
        $patient_id = ($this->patient->addPatient($patient));
		if ($patient_id) {
			return $patient_id;				
		}
		else {
			return false;
		}

	}
	/* If ramq id is in db, update the entry.
	 */
	function updatePatient($patient, $patient_id) {
	    // create instance of user model
        $this->load->model('patient');
        $updated = ($this->patient->updatePatient($patient, $patient_id));
		if ($updated) {
			return $updated;				
		}
		else {
			return false;
		}
	}
    
}



?>