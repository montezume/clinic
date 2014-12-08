<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AddToQueue extends CI_Controller
{    
    function __construct()
    {
        parent::__construct();
		$this->load->library('form_validation');

    }
	
    function index()
    {
	
		var_dump($_POST);
	}
}

?>