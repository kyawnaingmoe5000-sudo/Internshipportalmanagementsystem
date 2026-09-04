<?php
	require_once '../connect.php';
	if(ISSET($_POST['update_activity'])){
		$title = $_POST['title'];
		$description = $_POST['description'];
		$companyName = $_POST['company_name'];
		$quantity = $_POST['quantity'];
		$start = $_POST['start'];
		$end = $_POST['end'];
		$month = date("M", strtotime($_POST['start']));
		$year = date("Y", strtotime($_POST['start']));
		$conn->query("UPDATE `activity` SET `title` = '$title', `description` = '$description',`company_name` = '$companyName',`quantity` = '$quantity', `start` = '$start', `end` = '$end', `month` = '$month', `year` = '$year' WHERE `activity_id` = '$_REQUEST[activity_id]'") or die($conn->error);
		header('location:activity.php');
	}
?>