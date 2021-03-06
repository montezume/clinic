<style>

.queue5 {

	background-color: grey;
}
</style>

<div class="header"><h3 class="text-muted">Examination Overview<small class='pull-right' style='margin-right:10px;'>Signed in as <?php echo $this->session->userdata('logged_in')['USER_NAME']; ?></small></h3>
<!-- end header -->				
</div>

<div class ="well">


	<?php echo form_open('examinationoverview'); ?>
	<div class='form' role='form'>

	<?php echo ($totalQueueLength == 0) ? "<div class='alert alert-danger' role='alert'>
		<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> No patients in queue, why not have a coffee?
		<span class='sr-only'>Error:</span></div>" : "" ; ?> 
	
	<?php echo ($concurrencyIssue) ? "<div class='alert alert-danger' role='alert'>
		<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> There was a problem retrieving patient. Please try again.
		<span class='sr-only'>Error:</span></div>" : "" ; ?> 
		
		
	<span id="helpBlock" class="help-block">First Queue</span>			

	<div class="progress">
		
		<div class="progress-bar progress-bar-danger <?php echo ($lengthOfQueue1 != 0) ? "progress-bar-striped active" : "" ?>" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ($lengthOfQueue1 != 0) ? (($lengthOfQueue1 / $totalQueueLength) * 100) : 5; ?>%;"><?php echo "$lengthOfQueue1" ?>
				<span class="sr-only"><?php echo "$lengthOfQueue1 patients in queue 1" ?></span>
		</div>
	</div>
	
	<span id="helpBlock" class="help-block">Second Queue</span>			
	<div class="progress">

		<div class="progress-bar progress-bar-warning <?php echo ($lengthOfQueue2 != 0) ? "progress-bar-striped active" : "" ?>" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ($lengthOfQueue2 != 0) ? (($lengthOfQueue2 / $totalQueueLength) * 100) : 5 ; ?>%;"><?php echo "$lengthOfQueue2" ?>
				<span class="sr-only"><?php echo "$lengthOfQueue2 patients in queue 2" ?></span>
		</div>

	</div>
	
	<span id="helpBlock" class="help-block">Third Queue</span>			
	<div class="progress">

		<div class="progress-bar progress-bar-info <?php echo ($lengthOfQueue3 != 0) ? "progress-bar-striped active" : "" ?>" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ($lengthOfQueue3 != 0) ? (($lengthOfQueue3 / $totalQueueLength) * 100) : 5; ?>%;"><?php echo "$lengthOfQueue3" ?>
				<span class="sr-only"><?php echo "$lengthOfQueue3 patients in queue 3" ?></span>
		</div>

	</div>
	
	<span id="helpBlock" class="help-block">Fourth Queue</span>			
	<div class="progress">

		<div class="progress-bar progress-bar-success <?php echo ($lengthOfQueue4 != 0) ? "progress-bar-striped active" : "" ?>" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ($lengthOfQueue4 != 0) ? (($lengthOfQueue4 / $totalQueueLength) * 100) : 5; ?>%;"><?php echo "$lengthOfQueue4" ?>
				<span class="sr-only"><?php echo "$lengthOfQueue4 patients in queue 4" ?></span>
		</div>

	</div>

		<span id="helpBlock" class="help-block">Fifth Queue</span>			
	<div class="progress">

		<div class="progress-bar queue5 <?php echo ($lengthOfQueue5 != 0) ? "progress-bar-striped active" : "" ?>"" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ($lengthOfQueue5 != 0) ? (($lengthOfQueue5 / $totalQueueLength) * 100) : 5; ?>%;"><?php echo "$lengthOfQueue5" ?>
				<span class="sr-only"><?php echo "$lengthOfQueue5 patients in queue 5" ?></span>
		</div>

	</div>


	<div class='form-group'>
	<button type="submit" class="btn btn-default" aria-label="Left Align" style="margin-top:20px"><span class='text-muted'>Get Next Patient</span>
		<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
	</button>
	</div>
	
	<input type='hidden' class='form-control' name='queue' id='queue' value=''>

	
	<!-- end form -->
	</div>
<!-- end well -->	

</div>
