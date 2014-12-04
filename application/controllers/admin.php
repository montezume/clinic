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
					$results = array ();
					
					// form is submitted, display results...
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