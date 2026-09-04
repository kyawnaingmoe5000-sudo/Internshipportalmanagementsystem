<?php
	require_once '../connect.php';
	$conn->query("DELETE FROM `company` WHERE company_id = '$_REQUEST[company_id]'") or die($conn->error);
	header('location:company_details.php');
?>
