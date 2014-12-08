<div class="header"><h3 class="text-muted">Triage Overview<small class='pull-right' style='margin-right:10px;'>Signed in as <?php echo $this->session->userdata('logged_in')['USER_NAME']; ?></small></h3>
<!-- end header -->				
</div>

<div class ="well">

	<?php echo form_open('triageoverview'); ?>
	
	
	<div class='form' role='form'>
	<?php echo validation_errors(); ?>			
		
	<?php echo ($concurrencyIssue) ? "<div class='alert alert-danger' role='alert'>
		<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> There was a problem retrieving patient. Please try again.
		<span class='sr-only'>Error:</span></div>" : "" ; ?> 
		

	<span id="helpBlock" class="help-block">Number of patients in triage queue</span>			

	<div class="progress">
		
	<div class="progress-bar <?php echo ($lengthOfQueue != 0) ? 'progress-bar-striped active' : ''?>" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><?php echo "$lengthOfQueue" ?>
			<span class="sr-only"><?php echo "$lengthOfQueue patients in triage queue" ?></span>
		</div>
	</div>
		
	<div class='form-group'>
	<button type="submit" class="btn btn-default" aria-label="Left Align"><span class='text-muted'>Get Next Patient</span>
		<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
	</button>
	</div>

<!-- end well -->	
</div>
