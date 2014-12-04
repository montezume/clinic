		<script src="<?php echo base_url('assets/js/Chart.js'); ?>"></script>

		<div class="header"><h3 class="text-muted">Admin<small class='pull-right' style='margin-right:10px;'>Signed in as <?php echo (isset($this->session->userdata('logged_in')['USER_NAME'])) ? $this->session->userdata('logged_in')['USER_NAME'] : "anonymous" ;?></small></h3>
		<!-- end header -->				
		</div>
		
		<div class ="well">
		
				<?php echo validation_errors(); ?>				
				<?php echo form_open('admin'); ?>
				<h2>Statistics:<h class="pull-right"><span class="glyphicon glyphicon-time pull-right" aria-hidden="true"></span> </h2>
				<div class="form-horizontal" role="form">
					<div class="row">
					<div class="col-sm-4">
					<h3>Query</h3>
					</div>
					<div class="col-sm-4">
					<h3>Time period</h3>
					</div>
					</div>
					<div class="form-group">
						
						<label for="avgTriageTime" class="control-label col-sm-4" style="text-align:left">Average time spent to be triaged.</label>
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
						<label for="avgTimeSpentInEachCode" class="control-label col-sm-4" style="text-align:left;">Average time spent in each code.</label>
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
						<label for="totalPatientsQueryTime" class="control-label col-sm-4" style="text-align:left;">Total patients examined in each code.</label>
								<div class="col-sm-4">
									<select class="form-control" name='totalPatientsQueryTime'>
										<option value="1" <?php echo (isset($totalPatientsTimeSelected) && $totalPatientsTimeSelected == 1) ? "selected" : "" ?> >1 hour</option>
										<option value="2" <?php echo (isset($totalPatientsTimeSelected) && $totalPatientsTimeSelected == 2) ? "selected" : "" ?>>2 hours</option>
										<option value="4" <?php echo (isset($totalPatientsTimeSelected) && $totalPatientsTimeSelected == 4) ? "selected" : "" ?>>4 hours</option>
										<option value="12" <?php echo (isset($totalPatientsTimeSelected) && $totalPatientsTimeSelected == 12) ? "selected" : "" ?>>12 hours</option>
										<option value="24" <?php echo (isset($totalPatientsTimeSelected) && $totalPatientsTimeSelected == 24) ? "selected" : "" ?>>24 hours</option>
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
				
				if (isset($triageResults)) {
				$codeTimeFrame = ($codeTimeSelected > 1) ? "hours" : "hour";
				$triageTimeFrame = ($triageTimeSelected > 1) ? "hours" : "hour";
				$totalPatientsTimeFrame = ($totalPatientsTimeSelected > 1) ? "hours" : "hour";
				}
				
				if (isset($triageResults)) { 
				
				echo "
			
				<hr>
				
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
						<div class='col-sm-6 col-md-4'>
							<div class='thumbnail'>
								<canvas id='myBarChart' width='290' height='290'></canvas>
								<div class='caption'>
									<h4>Total patients examined in each code</h4>
									<p>The total patients examined over the last $totalPatientsTimeSelected $totalPatientsTimeFrame was $totalPatients</p>
								</div>
							</div>
						</div>
					<!-- end row -->
					</div>
				";
				}
				?>
				</form>
				</div>
	
				<script>
				
				var ctx = document.getElementById("myChart").getContext("2d");
				var data = [
					{
						value: <?php echo $codeResults[1] ?>,
						color:"#d9534f",
						label: "Queue 1"
					},
					{
						value: <?php echo $codeResults[2] ?>,
						color: "#f0ad4e",
						label: "Queue 2"
					},
					{
						value: <?php echo $codeResults[3] ?>,
						color: "#428BCA",
						label: "Queue 3"
					},
					{
						value: <?php echo $codeResults[4] ?>,
						color: "#5cb85c",
						label: "Queue 4"
					},
					{
						value: <?php echo $codeResults[5] ?>,
						color: "grey",
						label: "Queue 5"
					},
				]
				new Chart(ctx).Doughnut(data, {
					animateScale: false
					});
					
				// Get context with jQuery - using jQuery's .get() method.
				var ctx2 = $("#myBarChart").get(0).getContext("2d");
				// This will get the first returned node in the jQuery collection.

				var data2 = {
    labels: ["Queue 1", "Queue 2", "Queue 3", "Queue 4", "Queue 5"],
    datasets: [
        {
            label: "My First dataset",
            fillColor: "rgba(220,220,220,0.5)",
            strokeColor: "rgba(220,220,220,0.8)",
            highlightFill: "rgba(220,220,220,0.75)",
            highlightStroke: "rgba(220,220,220,1)",
            data: [<?php echo $totalPatientsPerCode[1] ?>, 
			<?php echo $totalPatientsPerCode[2] ?>, 
			<?php echo $totalPatientsPerCode[3] ?>,
			<?php echo $totalPatientsPerCode[4] ?>, <?php echo $totalPatientsPerCode[5] ?>]
        }
    ]
};
				window.barGraph = new Chart(ctx2).Bar(data2, {
					animateScale: false
					});

	barGraph.datasets[0].bars[0].fillColor = "#d9534f"; //bar 1
    barGraph.datasets[0].bars[1].fillColor = "#f0ad4e"; //bar 2
    barGraph.datasets[0].bars[2].fillColor = "#428BCA"; //bar 3
	barGraph.datasets[0].bars[3].fillColor = "#5cb85c"; //bar 4
	barGraph.datasets[0].bars[4].fillColor = "grey"; //bar 5

    barGraph.update();
				</script>
			
		
		</div>
		
			
		<!-- end jumbo -->	
