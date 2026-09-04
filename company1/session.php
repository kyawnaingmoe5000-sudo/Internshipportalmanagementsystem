<?php
	session_start();
	if(!ISSET($_SESSION['company_id'])){
		header("location:index.php");
	}
?>