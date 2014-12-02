
		<div class="header"><h3 class="text-muted">Client Queuing System</h3>

		<!-- end header -->
		</div>
		<div class="jumbotron">
			
            <h1>CQS. <small class="text-muted">Client Queuing System</small></h1>
			<h2> <small class="text-muted">Please enter your credentials below</small></h2>
				
				<?php echo validation_errors(); ?>				
				<?php echo form_open('login'); ?>
				
				<div class="form-horizontal" role="form">
					
					<?php echo (form_error('username')) ? "<div class='form-group has-error'>" : "<div class='form-group'>"; ?>
						
						<label for="inputUser" class="col-sm-2 control-label">Username</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="username" placeholder="Enter username">
						</div>
					</div> 
					
					<?php echo (form_error('password')) ? "<div class='form-group has-error'>" : "<div class='form-group'>"; ?>
						<label for="inputPass" class="col-sm-2 control-label">Password</label>
						<div class="col-sm-6">
							<input type="password" class="form-control" name="password" placeholder="Password">
						</div>
					</div>

					<div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-primary" id="connectButton" value="Submit"></input>
                        </div>
                    </div>

				<!-- end form -->
				</div>
		<!-- end jumbotron-->

		</div>
