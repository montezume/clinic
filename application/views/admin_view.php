		<script src="<?php echo base_url('assets/js/Chart.js'); ?>"></script>

		<div class="header"><h3 class="text-muted">Admin<small class='pull-right' style='margin-right:10px;'>Signed in as <?php echo (isset($this->session->userdata('logged_in')['USER_NAME'])) ? $this->session->userdata('logged_in')['USER_NAME'] : "anonymous" ;?></small></h3>
		<!-- end header -->				
		</div>
		
		<div class ="well">
		
				<?php echo validation_errors(); ?>				
				<?php echo form_open('admin'); ?>
				<h2>Average time spent... <h class="pull-right"><span class="glyphicon glyphicon-time pull-right" aria-hidden="true"></span> </h2>
				<div class="form-horizontal" role="form">
					<div class="form-group">
						
						<label for="avgTriageTime" class="control-label col-sm-4">To be triaged in the last </label>
						<div class="col-sm-4">
							<select class="form-control" name="toBeTriaged">
								<option value="1" <?php echo (isset($triageTimeSelected) && $triageTimeSelected == 1) ? "selected" : "" ?> >1 hour</option>
								<option value="2" <?php echo (isset($triageTimeSelected) && $triageTimeSelected == 2) ? "selected" : "" ?> >2 hours</option>
								<option value="4" <?php echo (isset($triageTimeSelected) && $triageTimeSelected == 4) ? "selected" : "" ?> >4 hours</option>
								<option value="12" <?php echo (isset($triageTimeSelected) && $triageTimeSelected == 12) ? "selected" : "" ?> >12 hours</option>
								<option value="24" <?php echo (isset($triageTimeSelected) && $triageTimeSelected == 24) ? "selected" : "" ?> >24 hours</option>
							</select>	
						</div>
					</div>

					<div class="form-group">
						<label for="avgTimeSpentInEachCode" class="control-label col-sm-4">Spent in each code.</label>
								<div class="col-sm-4">
									<select class="form-control" name='timeForCode'>
										<option value="1" <?php echo (isset($codeTimeSelected) && $codeTimeSelected == 1) ? "selected" : "" ?> >1 hour</option>
										<option value="2" <?php echo (isset($codeTimeSelected) && $codeTimeSelected == 2) ? "selected" : "" ?>>2 hours</option>
										<option value="4" <?php echo (isset($codeTimeSelected) && $codeTimeSelected == 4) ? "selected" : "" ?>>4 hours</option>
										<option value="12" <?php echo (isset($codeTimeSelected) && $codeTimeSelected == 12) ? "selected" : "" ?>>12 hours</option>
										<option value="24" <?php echo (isset($codeTimeSelected) && $codeTimeSelected == 24) ? "selected" : "" ?>>24 hours</option>
									</select>	
								</div>


					</div>
					
					<div class="form-group">
                        <div class="col-sm-offset-0 col-sm-12">
                            <input type="submit" class="btn btn-primary col-sm-2" id="connectButton" value="Submit"></input>
                        </div>
                    </div>							

				<?php 
				
				// It's nice to pluralize properly.
				$codeTimeFrame = ($codeTimeSelected > 1) ? "hours" : "hour";
				$triageTimeFrame = ($triageTimeSelected > 1) ? "hours" : "hour";
				
				if (isset($triageResults)) { echo "
			
				<hr>
				<div class='well'>
				<div class='row'>
					<div class='col-sm-6 col-md-4'>
						<div class='thumbnail'>
						<canvas id='myChart' width='290' height='290'></canvas>
						<div class='caption'>
						<h4>Average time spent in each code</h4>
						<p>The total average waiting time over the last $codeTimeSelected $codeTimeFrame was $totalAverageTime minutes</p>
					  </div>
					</div>
					</div>
					
						<div class='col-sm-6 col-md-4'>
						<div class='thumbnail'><img src=";
						
						echo base_url('assets/images/triage.jpg');
						echo ">
						<div class='caption'>
						<h4>Average time spent to be triaged</h4>
						<p>The average triage time over the last $triageTimeSelected $triageTimeFrame was $triageResults minutes</p>
					  </div>
					</div>
					</div>
				</div>
				</div>
				";
				}
				?>
				

				</div>
				</form>
						
				<script>
				var ctx = document.getElementById("myChart").getContext("2d");
				

				var data = [
					{
						value: <?php echo $codeResults[1] ?>,
						color:"red",
						label: "Queue 1"
					},
					{
						value: <?php echo $codeResults[2] ?>,
						color: "yellow",
						label: "Queue 2"
					},
					{
						value: <?php echo $codeResults[3] ?>,
						color: "blue",
						label: "Queue 3"
					},
					{
						value: <?php echo $codeResults[4] ?>,
						color: "green",
						label: "Queue 4"
					},
					{
						value: <?php echo $codeResults[5] ?>,
						color:"grey",
						label: "Queue 5"
					},
				]
				new Chart(ctx).Doughnut(data, {
    animateScale: true
});
				var myPieChart = new Chart(ctx[0]).Pie(data,options);
				
				</script>
			
		
		</div>
			
			
		<!-- end jumbo -->	
