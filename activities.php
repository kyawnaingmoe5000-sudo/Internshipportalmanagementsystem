<div id = "activities" class = "tab-pane fade">
	<img src = "images/calendar.png" class = "pull-left" height = "100" width = "100"/>
	<h2 class = "text-success pull-left" style="color:black;">Offers </h2>
	<br style = "clear:both;"/>
	<hr style = "border-top:1px solid #000;"/>
	<h3 class = "text-primary" style="color:black;"><?php echo date("M Y", strtotime("+8 HOURS"))?></h3>
		<div id = "act_table" class = "panel panel-default">
				<div  class = " panel-heading">	
					<table id = "table" class = "table table-bordered">
						<thead>
							<tr>
								<th>Job_name</th>
								<th>Job_Description</th>
								<th>Company</th>
								<th>Available</th>
								<th>Start</th>
								<th>End</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$a_query = $conn->query("SELECT `URL` FROM `company`;") or die($conn->error);
							while($a_fetch = $a_query->fetch_array()){
								$url=$a_fetch['URL'];
							}
							$act_query = $conn->query("SELECT * FROM `activity`") or die($conn->error);
							while($act_fetch = $act_query->fetch_array()){
							?>
							<tr>
								<td><?php echo $act_fetch['title']?></td>
								<td><?php echo $act_fetch['description']?></td>
								<td><a href=<?php echo $url ?>><?php echo $act_fetch['company_name']?></a></td>
								<td><?php echo $act_fetch['quantity']?></td>
								<td><?php echo "<label class = 'text-info'>".date("M d, Y", strtotime($act_fetch['start']))."</label>"?></td>
								<td><?php echo "<label class = 'text-info'>".date("M d, Y", strtotime($act_fetch['end']))."</label>"?></td>
								<td><center><a href = "student_login.php?activity_id=<?php echo $act_fetch['activity_id']?>" class = "btn btn-warning"><span class=  "glyphicon glyphicon-edit"></span> Apply</a> </center></td>
							</tr>
							<?php
							}
							
							?>
						</tbody>
					</table>
				</div>	
		
	</div>
</div>