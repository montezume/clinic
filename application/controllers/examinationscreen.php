<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ExaminationScreen extends CI_Controller
{    	
    function __construct() {
        parent::__construct();
    }

	function index() {
	// read visit id from flash data.
	$this->session->keep_flashdata('visit_id');
	$visit_id = $this->session->flashdata('visit_id');

	var_dump($visit_id);
	}
}

?>