<?php include 'header.php';?>
<br>
<br>
<br>
<br>
<?php

if(!empty($_POST["register-user"])) {
    /* Form Required Field Validation */
    foreach($_POST as $key=>$value) {
        if(empty($_POST[$key])) {
            $error_message = "All Fields are required";
            break;
        }
    }
    /* Password Matching Validation */
    if($_POST['password'] != $_POST['confirm_password']){ 
        $error_message = 'Passwords should be same as above'; 
    }

    /* Email Validation */
    if(!isset($error_message)) {
        if (!filter_var($_POST["userEmail"], FILTER_VALIDATE_EMAIL)) {
            $error_message = "Invalid Email Address";
        }
    }
    /* */
    if (!isset($error_message)) {
        $username = $_POST["userName"]; // Assuming the form field for username is named "username"
        
        // Check if the username is not empty
        if (empty($username)) {
            $error_message = "Username is required";
        } 
        // Check if the username contains only letters, numbers, underscores, and hyphens
        elseif (!preg_match('/^(mkpt-\d{4}|MKPT-\d{4})$/', $username)) {
            $error_message = "Username can only contain 'mkpt-' or 'MKPT-' followed by four digits";
        }
        // Check if the username is between 3 and 20 characters long
        elseif (strlen($username) < 3 || strlen($username) > 20) {
            $error_message = "Username must be between 3 and 20 characters long";
        }
    }

    /* Validation to check if gender is selected */
    if(!isset($error_message)) {
        if(!isset($_POST["gender"])) {
            $error_message = "All Fields are required";
        }
    }

    /* Validation to check if Terms and Conditions are accepted */
    if(!isset($error_message)) {
        if(!isset($_POST["terms"])) {
            $error_message = "Accept Terms and Conditions to Register";
        }
    }

    /* Check if the username already exists */
    if(!isset($error_message)) {
        require_once("dbcontroller.php");
        $db_handle = new DBController();
        $query = "SELECT user_name FROM registered_users WHERE user_name = '" . $_POST["userName"] . "'";
        $result = $db_handle->runQuery($query);
        if (!empty($result)) {
            $error_message = "Username already exists. Please choose a different username.";
        }
    }

    /* If all validations pass, proceed with user registration */
    if(!isset($error_message)) {
        require_once("dbcontroller.php");
        $db_handle = new DBController();
        $query = "INSERT INTO registered_users (user_name, first_name, last_name, academic_year, password, email, gender) VALUES
        ('" . $_POST["userName"] . "', '" . $_POST["firstName"] . "', '" . $_POST["lastName"] . "', '" . $_POST["academic_year"] . "', '" . ($_POST["password"]) . "', '" . $_POST["userEmail"] . "', '" . $_POST["gender"] . "')";
        $result = $db_handle->insertQuery($query);
        if(!empty($result)) {
            $error_message = "";
            $success_message = "You have registered successfully!"; 
            unset($_POST);
        } else {
            $error_message = "Problem in registration. Try Again!"; 
        }
    }
}
?>
<html>
<head>
<title>PHP User Registration Form</title>
<style>
body{
	width:100%;
	font-family:calibri;
	background-color: #D3D3D3;
}
.form-container {
            display: flex;
            justify-content: center; /* Horizontally center the form */
            align-items: center; /* Vertically center the form */
            height: 100vh; /* Set height to viewport height */
			border-radius: 15px;
        }
        form {
            text-align: center; /* Horizontally center the form content */
        }
        table {
            margin: auto; /* Center the table horizontally */
            border-collapse: collapse; /* Collapse table borders */
			
		}
        th, td {
            padding: 5px; /* Example padding */
           
        }
.error-message {
	padding: 7px 10px;
	background: #fff1f2;
	border: #ffd5da 1px solid;
	color: #d6001c;
	border-radius: 4px;
}
.success-message {
	padding: 7px 10px;
	background: #cae0c4;
	border: #c3d0b5 1px solid;
	color: #027506;
	border-radius: 4px;
}
.demo-table {
	background:white;
	width: 100%;
	border-spacing: initial;
	margin: 2px 0px;
	word-break: break-word;
	table-layout: auto;
	line-height: 1.8em;
	color: #333;
	border-radius: 4px;
	padding: 20px 40px;
    filter: alpha(opacity=80); /* For IE8 and earlier */
    text-align: center;
}
.demo-table td {
	padding: 15px 0px;
}
.demoInputBox {
	padding: 10px 30px;
	border: #a9a9a9 1px solid;
	border-radius: 4px;
}
.btnRegister {
	padding: 10px 30px;
	background-color: #3367b2;
	border: 0;
	color: #FFF;
	cursor: pointer;
	border-radius: 4px;
	margin-left: 10px;
}
input{color:black;}
</style>
</head>
<body>
<div class="form-container">
<form name="frmRegistration" method="post" action="" style="width:50%;">
<table border="0" width="100" align="center" class="demo-table" style="background-color:#063458;color:white;">
<caption style="color:black; font-weight:bold; font-size: 25px;text-align:center;">Fill  your details</caption>
<?php
// Check if there's a success or error message to display
if(!empty($success_message)) {
    // If there's a success message, generate JavaScript to display it as an alert
    echo '<script>alert("' . $success_message . '");</script>';
} elseif (!empty($error_message)) {
    // If there's an error message, generate JavaScript to display it as an alert
    echo '<script>alert("' . $error_message . '");</script>';
}
?>
<tr>
<td>User Name</td>
<td><input type="text" class="demoInputBox" name="userName" value="<?php if(isset($_POST['userName'])) echo $_POST['userName']; ?>"></td>
</tr>
<tr>
<td>First Name</td>
<td><input type="text" class="demoInputBox" name="firstName" value="<?php if(isset($_POST['firstName'])) echo $_POST['firstName']; ?>"></td>
</tr>
<tr>
<td>Last Name</td>
<td><input type="text" class="demoInputBox" name="lastName" value="<?php if(isset($_POST['lastName'])) echo $_POST['lastName']; ?>"></td>
</tr>
<td>Academic year</td>
<td><input type="number" class="demoInputBox" name="academic_year" value="<?php if(isset($_POST['academic_year'])) echo $_POST['academic_year']; ?>"></td>
</tr>
<tr>
<td>Password</td>
<td><input type="password" class="demoInputBox" name="password" value="" minlength="6"></td>
</tr>
<tr>
<td>Confirm Password</td>
<td><input type="password" class="demoInputBox" name="confirm_password" value=""></td>
</tr>
<tr>
<td>Email</td>
<td><input type="text" class="demoInputBox" name="userEmail" value="<?php if(isset($_POST['userEmail'])) echo $_POST['userEmail']; ?>"></td>
</tr>
<tr>
<td>Gender</td>
<td><input type="radio" name="gender" value="Male" <?php if(isset($_POST['gender']) && $_POST['gender']=="Male") { ?>checked<?php  } ?>> Male
<input type="radio" name="gender" value="Female" <?php if(isset($_POST['gender']) && $_POST['gender']=="Female") { ?>checked<?php  } ?>> Female
</td>
</tr>
<tr>
<td colspan=2>
<input type="checkbox" name="terms"> I accept Terms and Conditions <input type="submit" name="register-user" value="Register" class="btnRegister"></td>
</tr>
</table>
</form>
</div>
</body></html>