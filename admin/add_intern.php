<?php
	require_once '../connect.php';
	if(ISSET($_POST['add_student'])){	
		$s_query = $conn->query("SELECT * FROM `fill_details` WHERE id = '$_REQUEST[id]'") or die($conn->error);
		while($act_fetch = $s_query->fetch_array()){
			$firstName=$act_fetch['first_name'];
			$lastName=$act_fetch['last_name'];
			$companyName=$act_fetch['company_name'];
			$email=$act_fetch['email'];
			$gender=$act_fetch['gender'];
			
		}
		$conn->query("INSERT INTO `student` VALUES('', '$firstName', '$lastName', '$companyName', '$email', '$gender')") or die($conn->error);
		header('location:student.php'); 
	}	
?>