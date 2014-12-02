<div class="header"><h3 class="text-muted">Triage Patient<small class='pull-right' style='margin-right:10px;'>Signed in as <?php echo $this->session->userdata('logged_in')['USER_NAME']; ?></small></h3>
<!-- end header -->				
</div>

<div class ="well">

	

	<?php echo form_open('triagepatient'); ?>
	<div class='form' role='form'>
	<?php echo validation_errors(); ?>		
		
		<div class='form-group'>
			<div class='row'>
				<label for='ramq' class='col-sm-2 control-label'>RAMQ</label>
				<div class='col-sm-10'>
					<input type='text' readonly='readonly' class='form-control' name='ramq' placeholder='Ramq' value="<?php echo isset($patient['RAMQ_ID']) ? $patient['RAMQ_ID'] : "" ;?>">
				</div>
			</div>
		</div>
		
		<div class='form-group'>
			<div class='row'>
				<label for='firstName' class='col-sm-2 control-label'>First name</label>
				<div class='col-sm-4'>
					<input type='text' readonly='readonly' class='form-control' name='firstName' placeholder='First Name' value="<?php echo (isset($patient['FIRST_NAME'])) ? $patient['FIRST_NAME'] : "";?>">
				</div>
					<label for='lastName' class='col-sm-2 control-label'>Last name</label>
					<div class='col-sm-4'>
					<input type='text' readonly='readonly' class='form-control' name='lastName' placeholder='Last Name' value="<?php echo (isset($patient['LAST_NAME'])) ? $patient['LAST_NAME'] : "";?>">
					</div>	
			</div>
		</div>
		
		<div class='form-group'>
			<div class='row'>
				<label for='homePhone' class='col-sm-2 control-label'>Home</label>
				<div class='col-sm-4'>
					<input type='text' readonly='readonly' class='form-control' name='homePhone' placeholder='Home Phone' value="<?php echo (isset($patient['HOME_PHONE'])) ? $patient['HOME_PHONE'] : "";?>">
				</div>
				
				<label for='homePhone' class='col-sm-2 control-label'>Emergency</label>
				<div class='col-sm-4'>
					<input type='text' readonly='readonly' class='form-control' name='emergencyPhone' placeholder='Emergency Phone' value="<?php echo (isset($patient['EMERGENCY_PHONE'])) ? $patient['EMERGENCY_PHONE'] : "";?>">
				</div>
			</div>
		</div>
				
		<div class='form-group'>
			<div class='row'>
				<label for='primaryPhysician' class='col-sm-2 control-label'>Primary Physician</label>
				<div class='col-sm-10'>
					<input type='text' readonly='readonly' class='form-control' name='primaryPhysician' placeholder='Primary Physician' value="<?php echo (isset($patient['PRIMARY_PHYSICIAN'])) ? $patient['PRIMARY_PHYSICIAN'] : "";?>">
				</div>
			</div>
		</div>
		
		<div class='form group'>
			<div class='row'>
				<label for='conditions' class='col-sm-2 control-label'>Existing Conditions</label>
					<div class='col-lg-8 col-md-4 col-sm-10'><textarea class='form-control' readonly='readonly' style='margin-bottom:20px;' name='conditions' placeholder='Existing conditions'><?php echo isset($patient['EXISTING_CONDITIONS']) ? "$patient[EXISTING_CONDITIONS]</textarea>" : "</textarea>"; ?> 
					</div>
			</div>
		</div>

		<div class='form-group'>
			<div class='row'>
				<label for='medication1' class='col-sm-3 control-label'>Medications</label>
				<div class='col-sm-3'>
					<input type='text' readonly='readonly' class='form-control' name='medication1' placeholder='Medication 1' value="<?php echo $patient['MEDICATION_1'];?>">
				</div>

				<div class='col-sm-3' >
					<input type='text' readonly='readonly' class='form-control' name='medication2' placeholder='Medication 2' value="<?php echo $patient['MEDICATION_2'];?>">
				</div>

				<div class='col-sm-3'>
					<input type='text' readonly='readonly' class='form-control' name='medication3' placeholder='Medication 3' value="<?php echo $patient['MEDICATION_3'];?>">
				</div>
			</div>
		</div>
			
		<div class='form group'>
			<div class='row'>
				<label for='conditions' class='col-sm-2 control-label'>Primary Complaint</label>
					<div class='col-lg-8 col-md-4 col-sm-10'><textarea class='form-control' style='margin-bottom:20px;' name='primaryComplaint' placeholder='Primary Complaint'></textarea>
					</div>
			</div>
		</div>
		
		<div class='form-group'>
			<div class='row'>
				<label for='inputFirstSympton' class='col-sm-2 control-label'>First Symptom</label>
					<div class='col-sm-10'>
						<input type='text' class='form-control' name='firstSymptom' placeholder='First Symptom'>
					</div>
				</div>
		</div>
		<div class='form-group'>
			<div class='row'>
				<label for='inputFirstSympton' class='col-sm-2 control-label'>Second Symptom</label>
					<div class='col-sm-10'>
						<input type='text' class='form-control' name='secondSymptom' placeholder='Second Symptom'>
					</div>
				</div>
		</div>
	
	
	<div class='form-group'>

		<div class="row">
			<label for='inputQueue' class='col-sm-2 control-label'>Queue</label>
		<div class='col-sm-10'>
			<div class="btn-group btn-group-justified" role="group" aria-label="Justified button group">
			  <a href="#" onClick=" $('#queue').val('1');" class="btn btn-default label-danger" role="button">1</a>
			  <a href="#" onClick=" $('#queue').val('2');" class="btn btn-default label-warning" role="button">2</a>
			  <a href="#" onClick=" $('#queue').val('3');" class="btn btn-default label-info" role="button">3</a>
			  <a href="#" onClick=" $('#queue').val('4');" class="btn btn-default label-success" role="button">4</a>
			  <a href="#" onClick=" $('#queue').val('5');" class="btn btn-default label-default" role="button">5</a>
			</div>
		</div>
			
		</div>
	</div>
			<input type='hidden' class='form-control' name='queue' id='queue' value=''>

			<div class='form-group'>
				<button type="submit" class="btn btn-default" aria-label="Left Align"><span class='text-muted'>Submit</span>
					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				</button>
			</div>
		</div>

<!-- end well -->	
</div>
