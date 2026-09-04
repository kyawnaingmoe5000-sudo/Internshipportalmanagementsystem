<?php
	require_once '../connect.php';
	if(ISSET($_POST['save_admin'])){
		$username = $_POST['userName'];
		$password = $_POST['password'];
		$url = $_POST['URL'];
        $name = $_POST['name'];
        $email = $_POST['userEmail'];
		$desc = $_POST['desc'];
		$q_admin = $conn->query("SELECT * FROM `company` WHERE `username` = '$username' ") or die($conn->error);
		$v_admin = $q_admin->num_rows;
		if($v_admin > 0){
			echo '<script>alert("Username already taken");</script>';
			echo '<script>window.location = "company_details.php"</script>';
		}else{
			$conn->query("INSERT INTO `company` VALUES('', '$username', '$password','$url', '$name','$email','$desc')") or die($conn->error);
			header('location:company_details.php');
		}
	}
?>