		<div class="header"><h3 class="text-muted">Dashboard<small class='pull-right' style='margin-right:10px;'>Signed in as <?php echo $this->session->userdata('logged_in')['USER_NAME']; ?></small></h3>
		<!-- end header -->				
		</div>
		

		<div class ="well">
				
		<div class="list-group">
		<h3 class="text-muted">News</h3>
		  <a href="#" class="list-group-item" >
			<h4 class="list-group-item-heading">Coffee Machine <span class="glyphicon glyphicon-heart-empty text-muted" aria-hidden="true"></span></h4>
			<p class="list-group-item-text">The coffee machine in the break room was been fixed</p>
		  </a>
		  <a href="#" class="list-group-item" >
			<h4 class="list-group-item-heading">Time off requests <span class="glyphicon glyphicon-globe text-muted" aria-hidden="true"></span></h4>
			<p class="list-group-item-text">Be sure to send in your time off requests as soon as possible with the holidays approaching <span class="glyphicon glyphicon-tree-conifer text-muted" aria-hidden="true"></span></p>
		  </a>
		   <a href="#" class="list-group-item" >
			<h4 class="list-group-item-heading">Employee of the month <span class="glyphicon glyphicon-star text-muted" aria-hidden="true"></span></h4>
			<p class="list-group-item-text">Please send your congradulations to John Smith, employee of the month!</p>
		  </a>
		</div>
		<h3 class="text-muted">What do you want to do today?</h3>
				<div class="well">
				<div class="row">
					
						<?php echo ($reception) ? anchor('ramqregistration', 'Reception', array('class' => 'btn btn-info col-sm-4')) : "" ?>
					
						<?php echo ($triage) ? anchor('triageoverview', 'Triage', array('class' => 'btn btn-primary col-sm-4')) : "" ?>
					
						<?php echo ($nurse) ? anchor('examinationoverview', 'Examination', array('class' => 'btn btn-success col-sm-4')) : "" ?>
					</div>
				</div>
				
		<p>Be sure  to punch out before you leave!</p>
				</div>
			<!-- end well -->	
			
			
