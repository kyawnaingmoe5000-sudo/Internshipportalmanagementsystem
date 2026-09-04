<?php
	require_once '../connect.php';
	if(ISSET($_POST['save_activity'])){
		$title = $_POST['title'];
		$description = $_POST['description'];
		$companyName = $_POST['company_name'];
		$quantity = $_POST['quantity'];
		$start = $_POST['start'];
		$end = $_POST['end'];
		$month = date("M", strtotime($_POST['start']));
		$year = date("Y", strtotime($_POST['start']));
		$conn->query("INSERT INTO `activity` VALUES('', '$title', '$description','$companyName','$quantity', '$start', '$end', '$month', '$year')") or die($conn->error);
		header('location: activity.php');
	}
?>