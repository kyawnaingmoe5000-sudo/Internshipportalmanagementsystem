<!DOCTYPE html>
<?php
	require_once 'session.php';
	require_once '../connect.php';
?>
<html lang = "eng">
	<head>
		<title>Internship portal management system</title>
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
				<div class = "alert alert-info">Accounts/company/Update</div>
				<a class = "btn btn-success" href = "company_details.php"><span class = "glyphicon glyphicon-hand-right"></span> Back</a>
				<br />
				<br />
				<div class = "panel panel-default">
					<div  class = " panel-heading" >	
						<div style = "width:40%; margin-left:32%;">	
						<?php
							$q_admin = $conn->query("SELECT * FROM `company` WHERE `company_id` = '$_REQUEST[company_id]'") or die($conn->error);
							$f_admin = $q_admin->fetch_array();
						?>
							<form method = "POST" action = "edit_company_query.php?company_id=<?php echo $f_admin['company_id']?>">	
								<div>
                                    <label>Username</label>
										<input type = "text" class = "form-control"  name = "userName" value="<?php echo $f_admin['username'] ?>" />
									</div>
									<div class = "form-group">
										<label>Password</label>
										<input type = "password" class = "form-control"  name = "password" value="<?php echo $f_admin['password'] ?>" />
									</div>
									<div class = "form-group">
										<label>URL</label>
										<input type = "text" class = "form-control"  name = "URL" value="<?php echo $f_admin['URL'] ?>" />
									</div>
                                    <div class = "form-group">
										<label>Name</label>
										<input type = "text" class = "form-control"  name = "name" value="<?php echo $f_admin['name'] ?>" />
									</div>
                                    <div class = "form-group">
										<label>Email</label>
										<input type = "text" class = "form-control"  name = "userEmail" value="<?php echo $f_admin['email'] ?>" />
									</div>
									<div class = "form-group">
										<label>Description</label>
										<input type = "text" class = "form-control"  name = "desc" value="<?php echo $f_admin['desc'] ?>" />
									</div>
								
								<div class = "form-group">
									<button class = "btn btn-warning form-control" name = "update_company"><span class = "glyphicon glyphicon-edit"></span> Save Changes</button>
								</div>
							</form>	
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
		<label class = "navbar-brand pull-right">&copy; INTERN MSU <?php echo date('Y', strtotime('+8 HOURS'))?></label>
		<label class = "navbar-brand ">tremendous chatikobo</label>
	</nav>
</body>	
<script src = "../js/jquery-3.1.1.js"></script>
<script src = "../js/sidebar.js"></script>
<script src = "../js/script.js"></script>
</html>