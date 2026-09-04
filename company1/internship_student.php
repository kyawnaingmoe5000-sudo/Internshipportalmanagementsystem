<!DOCTYPE html>
<?php
	require_once 'session.php';
	require_once '../connect.php';
?>
<html lang = "eng">
	<head>
		<title>Internship UCSM</title>
		<meta charset = "UTF-8" />
		<meta name = "viewport" content = "width=device-width, initial-scale=1" />
		<link rel = "stylesheet" type = "text/css" href = "../css/bootstrap.css" />
		<link rel = "stylesheet" type = "text/css" href = "../css/style1.css" />
		<link rel = "stylesheet" type = "text/css" href = "../css/jquery-ui.css" />
		<link rel = "stylesheet" type = "text/css" href = "../css/jquery.dataTables.css" />
	</head>
<body>
<!--------------------HEAD---------------------->
<?php include'head.php'?>
<!--------------------HEAD---------------------->

<!-------------------SIDEBAR0------------------>
<?php include 'sidebar.php'?>
<!-------------------SIDEBAR0------------------>

		<div id = "sidecontent" class = "well pull-right">
				<div class = "alert alert-info">students profile</div>
				
				<button style = "display:none;" type = "button" id = "cancel_student" class = "btn btn-warning"><span class = "glyphicon glyphicon-hand-right"></span> Cancel</button>
				<br />
				<br />
				<div id = "s_table" class = "panel panel-default">
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
                                    <th>Year</th>
									
								</tr>
							</thead>
							<tbody>
								<?php
                                    $company_id = $_SESSION['company_id'];
                                    $stmt = $conn->prepare("SELECT name FROM `company` WHERE company_id = ?");
                                    $stmt->bind_param("s", $_SESSION['company_id']); 
                                    $stmt->execute();
                                    $stmt->store_result();
                                    $stmt->bind_result($name);
                                    $stmt->fetch();
                                    $stmt->close();
                                    echo "<script>console.log('afjl;ds');</script>";
									$s_query = $conn->query("SELECT * FROM `student` WHERE company_name='$name'") or die($conn->error);
									while($act_fetch = $s_query->fetch_array()){	
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
							</tbody>
						</table>
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
		<label class = "navbar-brand pull-right">&copy; Internship portal system  <?php echo date('Y', strtotime('+8 HOURS'))?></label>
		<label class = "navbar-brand ">UCSM@gmail.com</label>
	</nav>
</body>	
<script src = "../js/jquery-3.1.1.js"></script>
<script src = "../js/sidebar.js"></script>
<script src = "../js/bootstrap.js"></script>
<script src = "../js/jquery.dataTables.min.js"></script>
<script src = "../js/script.js"></script>
<script type = "text/javascript">
	$(document).ready(function(){
		$('#table').DataTable();
	});
</script>

</html>