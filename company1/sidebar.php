<div id = "sidebar">
	<ul id = "menu" class = "nav menu">
		<li>
			<a>
				<?php 
					require_once '../connect.php';
					$q_admin_side = $conn->query("SELECT * FROM `company` WHERE `company_id` = {$_SESSION['company_id']}") or die($conn->error);
					$f_admin_side = $q_admin_side->fetch_array();
					echo "<center>".$f_admin_side['name']."</center>";
				?>
			</a>
		</li>
		<li><a href = "edit_company.php"><i class = "glyphicon glyphicon-user"></i>Edit Company</a></li>
		<li><a href = "activity.php"><i class = "glyphicon glyphicon-calendar"></i>Upload internships</a></li>
		<li><a href = "internship_student.php"><i class = "glyphicon glyphicon-user"></i> Internship students</a></li>
		<li><a href = "student.php"><i class = "glyphicon glyphicon-ruble"></i> Students partculars</a></li>
		<li><a href = "logout.php"><i class = "glyphicon glyphicon-log-out"></i> Logout</a></li>
	</ul>
</div>