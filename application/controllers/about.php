<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class About extends CI_Controller
{    	
    function __construct() {
        parent::__construct();
    }

	function index() {
	
		$this->showAbout();	
	} 
	
	function showAbout() {
			
			
			$headerData = array(
						'title' => 'CQS - About'
					);
					
			$this->load->view('header', $headerData);
			$this->load->view('about_view');
			$this->load->view('footer');

	
	}

} 
?>