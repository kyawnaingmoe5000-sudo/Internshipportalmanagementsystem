<div id = "internship_student" class = "tab-pane fade">
	<img src = "images/calendar.png" class = "pull-left" height = "100" width = "100"/>
	<h2 class = "text-success pull-left" style="color:black;">Internship Students Lists</h2>
	<br style = "clear:both;"/>
	<hr style = "border-top:1px solid #000;"/>
	<h3 class = "text-primary" style="color:black;"><?php echo date("M Y", strtotime("+8 HOURS"))?></h3>
	<br />
	<div id = "act_table" class = "panel panel-default">
				<div  class = " panel-heading">	
					<table id = "table" class = "table table-bordered">
						<thead>
							<tr>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Company Name</th>
								<th>Job Name</th>
								<th>Email</th>
								<th>Gender</th>
								<th>Academic year</th>
							</tr>
						</thead>
						<tbody>
                            <tr>
							<?php
							$act_query = $conn->query("SELECT * FROM `student`") or die($conn->error);
							while($act_fetch = $act_query->fetch_array()){
							?>
							<tr>
								<td><?php echo $act_fetch['first_name']?></td>
								<td><?php echo $act_fetch['last_name']?></td>
								<td><?php echo $act_fetch['company_name']?></td>
								<td><?php echo $act_fetch['job_name']?></td>
                                <td><?php echo $act_fetch['email']?></td>
                                <td><?php echo $act_fetch['gender']?></td>
							
							<?php
								$first_name = $act_fetch['first_name']; 
								$a_query = $conn->query("SELECT * FROM `registered_users` WHERE `first_name`='$first_name'") or die($conn->error);
								while($a_fetch = $a_query->fetch_array()){
									$academicyear=$a_fetch['academic_year']; 
								}
								echo "<td>" . $academicyear . "</td>";
							}
							?>
                            </tr>
                            
						</tbody>
					</table>
				</div>	
			</div>
			<script src = "js/jquery.dataTables.min.js"></script>
			<script type = "text/javascript">
	$(document).ready(function(){
		$('#table').DataTable();
	})
</script>
</div>