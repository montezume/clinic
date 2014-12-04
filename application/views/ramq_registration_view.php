<div class="header"><h3 class="text-muted">Enter RAMQ<small class='pull-right' style='margin-right:10px;'>Signed in as <?php echo $this->session->userdata('logged_in')['USER_NAME']; ?></small></h3>
<!-- end header -->				
</div>

<div class ="well">


<?php echo form_open('ramqregistration'); ?>
<div class='form' role='form'>
<?php echo validation_errors(); ?>				
	
	
	<?php if ($added) {

	echo "<div class='alert alert-success' role='alert'> 
	<span class='glyphicon glyphicon-user' aria-hidden='true'></span>
		<span class='sr-only'>Error:</span>";
	echo " $added </div>";
	}
	?>
	
	<div class='form-group'>
		<label for='inputRAMQ'><span class="glyphicon glyphicon-search" aria-hidden="true"></span> 
Please enter patient's RAMQ number</label>
		<input type='text' class='form-control' name='ramq' id='ramq' placeholder="Enter Patient's RAMQ Number">
	</div>

	<div class='form-group'>
		<button type='submit' class='btn btn-primary' value='Submit'>Submit</button>
	</div>

<!-- end form-->
</div>

<!-- end well -->	
</div>
