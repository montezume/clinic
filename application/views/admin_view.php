		<div class="header"><h3 class="text-muted">Admin<small class='pull-right' style='margin-right:10px;'>Signed in as <?php echo (isset($this->session->userdata('logged_in')['USER_NAME'])) ? $this->session->userdata('logged_in')['USER_NAME'] : "anonymous" ;?></small></h3>
		<!-- end header -->				
		</div>
		

		<div class ="well">
		
				<?php echo validation_errors(); ?>				
				<?php echo form_open('admin'); ?>
				<h2>Average time spent... <h class="pull-right"><span class="glyphicon glyphicon-time pull-right" aria-hidden="true"></span> </h2>
				<div class="form-horizontal" role="form">
					<div class="form-group">
						
						<label for="avgTriageTime" class="control-label col-sm-4">To be triaged</label>
						<div class="col-sm-4">
							<select class="form-control">
								<option value="1">1 hour</option>
								<option value="2">2 hours</option>
								<option value="4">4 hours</option>
								<option value="12">12 hours</option>
								<option value="24">24 hours</option>
							</select>	
						</div>
					</div>

					<div class="form-group">
						<label for="avgTimeSpentInEachCode" class="control-label col-sm-4">Spent in each code.</label>
								<div class="col-sm-4">
									<select class="form-control" name='test'>
										<option value="1">1 hour</option>
										<option value="2">2 hours</option>
										<option value="4">4 hours</option>
										<option value="12">12 hours</option>
										<option value="24">24 hours</option>
									</select>	
								</div>

					</div>
					
					<div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-primary col-sm-2" id="connectButton" value="Submit"></input>
                        </div>
                    </div>							
				</div>
				
				</form>
		
		</div>
			
			
		<!-- end jumbo -->	
