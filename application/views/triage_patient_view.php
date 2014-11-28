<div class="header"><h3 class="text-muted">Triage Patient<small class='pull-right' style='margin-right:10px;'>Signed in as <?php echo $this->session->userdata('logged_in')['USER_NAME']; ?></small></h3>
<!-- end header -->				
</div>

<div class ="well">

	

	<?php echo form_open('triageoverview'); ?>
	<div class='form' role='form'>
	<?php echo validation_errors(); ?>		

		<?php var_dump( $patient )?>
		<?php var_dump( $visit_id)?>
		
		<div class='form-group'>
			<div class='row'>
				<label for='ramq' class='col-sm-2 control-label'>RAMQ</label>
				<div class='col-sm-4'>
					<input type='text' readonly='readonly' class='form-control' name='ramq' placeholder='Ramq' value="<?php echo $patient['RAMQ_ID'];?>">
				</div>
			</div>
		</div>
		
		<div class='form-group'>
			<div class='row'>
				<label for='firstName' class='col-sm-2 control-label'>First Name</label>
				<div class='col-sm-4'>
					<input type='text' readonly='readonly' class='form-control' name='firstName' placeholder='First Name' value="<?php echo $patient['FIRST_NAME'];?>">
				</div>
			</div>
		</div>
		<div class='form-group'>
			<div class='row'>
				<label for='lastName' class='col-sm-2 control-label'>Last Name</label>
				<div class='col-sm-4'>
					<input type='text' readonly='readonly' class='form-control' name='lastName' placeholder='Last Name' value="<?php echo $patient['LAST_NAME'];?>">
				</div>
			</div>
		</div>
		<div class='form-group'>
			<div class='row'>
				<label for='homePhone' class='col-sm-2 control-label'>Primary Physician</label>
				<div class='col-sm-4'>
					<input type='text' readonly='readonly' class='form-control' name='primaryPhysician' placeholder='Primary Physician' value="<?php echo $patient['PRIMARY_PHYSICIAN'];?>">
				</div>
			</div>
		</div>
			
		<div class='form group'>
			<div class='row'>
				<label for='conditions' class='col-sm-2 control-label'>Primary Complaint</label>
					<div class='col-lg-8 col-md-4 col-sm-4'><textarea class='form-control' style='margin-bottom:20px;' name='primaryComplaint' placeholder='Primary Complaint'></textarea>
					</div>
			</div>
		</div>
		<div class='form-group'>
			<div class='row'>
				<label for='inputFirstSympton' class='col-sm-2 control-label'>First Symptom</label>
					<div class='col-sm-4'>
						<input type='text' class='form-control' name='firstSympton' placeholder='First Symptom'>
					</div>
				</div>
		</div>
		<div class='form-group'>
			<div class='row'>
				<label for='inputFirstSympton' class='col-sm-2 control-label'>Second Symptom</label>
					<div class='col-sm-4'>
						<input type='text' class='form-control' name='secondSympton' placeholder='Second Symptom'>
					</div>
				</div>
		</div>


			<span id="helpBlock" class="help-block">Triage level</span>		
			<div class='form-group'>
			<label class="radio-inline">
				<input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> 1
			</label>
			<label class="radio-inline">
				<input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> 2
			</label>
			
			<label class="radio-inline">
				<input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"> 3
			</label>
			
			<label class="radio-inline">
				<input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option4"> 4
			</label>
			
			<label class="radio-inline">
				<input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option5"> 5
			</label>
						</div>

			
			<div class='form-group'>
				<button type="submit" class="btn btn-default" aria-label="Left Align"><span class='text-muted'>Submit</span>
					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				</button>
			</div>
		</div>

<!-- end well -->	
</div>
