		<div class="header"><h3 class="text-muted">About<small class='pull-right' style='margin-right:10px;'>Signed in as <?php echo (isset($this->session->userdata('logged_in')['USER_NAME'])) ? $this->session->userdata('logged_in')['USER_NAME'] : "anonymous" ;?></small></h3>
		<!-- end header -->				
		</div>
		

		<div class ="jumbotron">
		
		<h1><small class="text-muted"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
 </small> Hi Jaya</h1> 
		<h2 class='text-muted'>Welcome to our clinic.</h2>
		
		<hr>
		<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><p>Users</p></div>
  <div class="panel-body">
    <p><small class="text-muted">Below you can find the login information for built in users with various privileges.</small></p></div>

  <!-- Table -->
  <table class="table">
    <tr>
		<th><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
Username</th> <th><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Password</th> <th><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Privileges</th>
 	</tr>
	<tr>
		<td>John</td><td>John</td><td>Receptionist</td>
	</tr>
	<tr>
		<td>Nurse</td> <td>Nurse</td> <td>Nurse</td>
	</tr>
	<tr>
		<td>Triage</td> <td>Triage</td> <td>Triage</td>
	</tr>
	<tr>
		<td>Everything</td> <td>Everything</td> <td>Everything</td>
	</tr>
  </table>
</div>
		
		</div>
			
			
		<!-- end jumbo -->	
