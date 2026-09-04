<?php
	require_once '../connect.php';
	if(ISSET($_POST['update_company'])){
		$username = $_POST['userName'];
		$password = $_POST['password'];
		$url = $_POST['URL'];
		$name = $_POST['name'];
        $email= $_POST['userEmail'];
        $desc= $_POST['desc'];
		$q_admin = $conn->query("SELECT * FROM `company` WHERE `username` = '$username' and company_id != '$_REQUEST[company_id]' ") or die($conn->error);
		$v_admin = $q_admin->num_rows;
		if($v_admin > 0){
			echo '<script>alert("Username already taken");</script>';
			echo '<script>window.location = "edit_company.php?company_id=" +'.$_REQUEST['company_id'].'</script>';
		}else{
			$conn->query("UPDATE `company` SET `username` = '$username', `password` = '$password', `URL` = '$url', `name` = '$name' ,`email`='$email',`desc`='$desc' WHERE `company_id` = '$_REQUEST[company_id]'") or die($conn->error);
			echo '<script>console.log("Updated");</script>';
			header('location:edit_company.php');
		}
	}
?>