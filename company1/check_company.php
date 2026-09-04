<?php
	require_once '../connect.php';
	$username = $_POST['username'];
	$password = $_POST['password'];
	$query = $conn->query("SELECT * FROM `company` WHERE `username` = '$username' && `password` = '$password'") or die($conn->error);
	$valid = $query->num_rows;
	$fetch = $query->fetch_array();
	if($valid > 0){
		echo 'Success';
		session_start();
		$_SESSION['company_id'] = $fetch['company_id'];
	}else{
		echo 'Error';
	}