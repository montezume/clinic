<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    function index()
    {
        $this->load->helper(array(
            'form',
            'url'
        ));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_login_user');
		$this->form_validation->set_error_delimiters("<div class='alert alert-danger' role='alert'>
		<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
		<span class='sr-only'>Error:</span>", '</div>');
        
		if ($this->form_validation->run() == FALSE) {
            $headerData = array(
                'title' => 'CQS - Login'
            );
            $loginData  = array(
                'pageTitle' => 'Client Queuing System'
            );
            $this->load->view('header', $headerData);
            $this->load->view('login_view', $loginData);
            $this->load->view('footer');
        } else // login was successful, redirect
            {
			$headerData = array(
                'title' => 'CQS - Patient Registration'
            );

			//$this->load->view('header', $headerData);
			//$this->load->view('patient_registration_view');
			//$this->load->view('footer');
            redirect('ramqregistration', 'refresh');
        }
    }
    function login_user($password)
    {
        // create instance of user model
        $this->load->model('user');
        $user = $this->input->post('username');
        if (count(trim($user)) == 0) {
            return false;
        }
		
		$invalidCount = ($this->user->getInvalidCount($user));
		if ($invalidCount >= 5) {
			$this->form_validation->set_message('login_user', 'Too many attempts - contact admin to reset password');
            return false;

		}
		
        $result = ($this->user->login($user, $password));
        if ($result) {
            
			// successful login - set session data.
            $session_array = array();
            foreach ($result as $key => $value) {
                if ($key === 'HASHED_PASSWORD') {
                    continue;
                }
                $session_array[$key] = $value;
            }
            // dump it into session
            $this->session->set_userdata('logged_in', $session_array);
            return true;
        } else {
            
			$this->form_validation->set_message('login_user', 'Incorrect username or password');
            return false;
		}
      
    }
}
?>