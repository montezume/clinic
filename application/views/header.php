<!DOCTYPE html>
<html lang="en">

<head>
    <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">

	<title><?php echo $title ?></title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>

</head>

<body>
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
      <a class="navbar-brand" href="#">CQS</a>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
	  	 <li><?php echo (!$this->session->userdata('logged_in')) ? anchor('login', 'Login') : "" ?></li>

	    <li><?php echo ($this->session->userdata('logged_in')) ? anchor('dashboard', 'Dashboard') : "" ?></li>
        <li><?php echo ($this->session->userdata('logged_in')['RECEPTION']) ? anchor('ramqregistration', 'Reception') : "" ?></li>
        <li><?php echo ($this->session->userdata('logged_in')['TRIAGE']) ? anchor('triageoverview', 'Triage') : "" ?></li>
        <li><?php echo ($this->session->userdata('logged_in')['NURSE']) ? anchor('examinationoverview', 'Examination') : "" ?></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
        <li><?php echo anchor('about', 'About') ?></li>

	    <li><?php echo ($this->session->userdata('logged_in')) ? anchor('logout', 'Logout') : "" ?></li>
	  </ul>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container">

