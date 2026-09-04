<!DOCTYPE html>
<?php
	require 'connect.php';
?>
<html lang = "en">
	<head>
		<title>Internship UCSM</title>
		<meta charset = "UTF-8" />
		<meta name = "viewport" content = "width=device-width, initial-scale=1" />
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/style1.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/jquery-ui.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/jquery.dataTables.css" />
		<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
		<style>
			li{color: black;
			   font-weight: bold;}
		</style>
	</head>
<body>
<!--------------------HEAD---------------------->
<?php include'head.php'?>
<!--------------------HEAD---------------------->
<br />
<br />
<br />
<div class = "row" style = "margin-top:-120px;">	

			
				<ul class="nav nav-tabs navbar-fixed-top" style = "display: flex; justify-content: flex-end;margin-top:10px;">
					<li><a href="index.php" style="color: white;font-weight: bold;"> Home </a></li>
					<li><a href="fill_details.php" style="color: white;font-weight: bold;"> Back </a></li>
				</ul>
		</div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
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
									<th>Firstname</th>
									<th>Lastname</th>
									<th>Company Name</th>
									<th>Job Name</th>
									<th>Email</th>
									<th>Gender</th>
									<th>CV</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
                                     session_start();
                                     //$username = $_SESSION['user_name'];
                                     $stmt = $conn->prepare("SELECT first_name FROM `registered_users` WHERE user_name = ?");
                                     $stmt->bind_param("s", $_SESSION['user_name']); 
                                     $stmt->execute();
                                     $stmt->store_result();
                                     $stmt->bind_result($first_name);
                                     $stmt->fetch();
                                     $stmt->close();
									$s_query = $conn->query("SELECT * FROM `fill_details` WHERE `first_name`='$first_name'") or die($conn->error);
									while($s_fetch = $s_query->fetch_array()){	
								?>
								<tr>
									
									<td><?php echo $s_fetch['first_name']?></td>
									<td><?php echo $s_fetch['last_name']?></td>
									<td><?php echo $s_fetch['company_name']?></td>
									<td><?php echo $s_fetch['job_name']?></td>
									<td><?php echo $s_fetch['email']?></td>
									<td><?php echo $s_fetch['gender']?></td>
                                    
									<td><a href="../upload/<?php echo $s_fetch['file']?>" targe="_blank" download><?php echo $s_fetch['file']?></a></td>
									<td>
										<a href = "#" name = "<?php echo $s_fetch['id']?>" data-toggle = "modal" data-target = "#delete_student" class = "btn btn-danger id"><span class=  "glyphicon glyphicon-trash"></span> Cancel </a>
										</td>
								</tr>
								<?php
									}
								?>
							</tbody>
					</table>
				</div>	
                <div class = "modal fade" id = "delete_student" tabindex = "-1" role = "dialog" aria-labelledby = "myModallabel">
					<div class = "modal-dialog" role = "document">
						<div class = "modal-content ">
							<div class = "modal-body">
								<center><label class = "text-danger">Are you sure you want to cancel?</label></center>
								<br />
								<center><a class = "btn btn-danger delete_student" ><span class = "glyphicon glyphicon-trash"></span> Yes</a> <button type = "button" class = "btn btn-warning" data-dismiss = "modal" aria-label = "No"><span class = "glyphicon glyphicon-remove"></span> No</button></center>
							</div>
						</div>
					</div>
				</div>
	</div>
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<nav class = "navbar-default" id = "footer">
		<label class = "navbar-brand pull-right">Internship portal management system<?php echo date('Y', strtotime('+8 HOURS'))?></label>
		<label class = "navbar-brand ">UCSM@GMAIL.COM</label>
	</nav>
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<script>
		AOS.init();
	</script>
</body>	
<script src = "js/jquery-3.1.1.js"></script>
<script src = "js/script.js"></script>
<script src = "js/bootstrap.js"></script>
<script src = "js/jquery.dataTables.min.js"></script>
<script type = "text/javascript">
	$(document).ready(function(){
		$('.id').on('click', function(){
			$id = $(this).attr('name');
			$('.delete_student').on('click', function(){
				window.location = 'cancel_student.php?id=' + $id;
			});
		});
	});
</script>
</html>