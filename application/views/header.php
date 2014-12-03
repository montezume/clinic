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
      <ul class="nav navbar-nav">
	  	<li class=<?php echo ($this->router->fetch_class() === 'login') ? 'active' : ''?> ><?php echo (!$this->session->userdata('logged_in')) ? anchor('login', 'Login') : "" ?></li>
	    <li class=<?php echo ($this->router->fetch_class() === 'dashboard') ? 'active' : ''?> ><?php echo ($this->session->userdata('logged_in')) ? anchor('dashboard', '<span class="glyphicon glyphicon-home" aria-hidden="true"> Dashboard') : "" ?></li>
        <li class=<?php echo ($this->router->fetch_class() === 'ramqregistration') ? 'active' : ''?> ><?php echo ($this->session->userdata('logged_in')['RECEPTION']) ? anchor('ramqregistration', 'Reception') : "" ?></li>
        <li class=<?php echo ($this->router->fetch_class() === 'triageoverview') ? 'active' : ''?> ><?php echo ($this->session->userdata('logged_in')['TRIAGE']) ? anchor('triageoverview', 'Triage') : "" ?></li>
		<li class=<?php echo ($this->router->fetch_class() === 'examinationoverview') ? 'active' : ''?> ><?php echo ($this->session->userdata('logged_in')['NURSE']) ? anchor('examinationoverview', 'Examination') : "" ?></li>
		<li class=<?php echo ($this->router->fetch_class() === 'admin') ? 'active' : ''?> ><?php echo ($this->session->userdata('logged_in')['ADMIN']) ? anchor('admin', 'Admin') : "" ?></li>

		</ul>
		
		<ul class="nav navbar-nav navbar-right">
        <li class=<?php echo ($this->router->fetch_class() === 'about') ? 'active' : ''?> ><?php echo anchor('about', 'About') ?></li>

	    <li><?php echo ($this->session->userdata('logged_in')) ? anchor('logout', '<span class="glyphicon glyphicon-off" aria-hidden="true"> Logout') : "" ?></li>
	  </ul>
      
  </div><!-- /.container-fluid -->
</nav>

<div class="container">

