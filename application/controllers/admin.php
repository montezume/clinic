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
			// user has correct privileges
			$this->showAdmin();	

		}

	} 
	
	function showAdmin() {
			
			$headerData = array(
						'title' => 'CQS - Admin'
					);
					
			$this->load->view('header', $headerData);
			$this->load->view('admin_view');
			$this->load->view('footer');

	
	}

} 
?>