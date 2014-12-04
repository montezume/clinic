		<div class="header"><h3 class="text-muted">Dashboard<small class='pull-right' style='margin-right:10px;'>Signed in as <?php echo $this->session->userdata('logged_in')['USER_NAME']; ?></small></h3>
		<!-- end header -->				
		</div>
		

		<div class ="well">
		
		<h2>What do you want to do today?</h2>
		
					
					<div class="row">
					
						<?php echo ($reception) ? anchor('ramqregistration', 'Reception', array('class' => 'btn btn-info col-sm-4')) : "" ?>
					
						<?php echo ($triage) ? anchor('triageoverview', 'Triage', array('class' => 'btn btn-primary col-sm-4')) : "" ?>
					
						<?php echo ($nurse) ? anchor('examinationoverview', 'Examination', array('class' => 'btn btn-success col-sm-4')) : "" ?>
					</div>
			</div>
			
			
		<!-- end well -->	
