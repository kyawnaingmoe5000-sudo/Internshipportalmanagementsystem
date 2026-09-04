<?php include 'head.php';?>
<br>
<br>
<br>
<br>
<br>
<?php
if(!empty($_POST["insert_button"])) {
  /* Form Required Field Validation */
  foreach($_POST as $key=>$value) {
    if(empty($_POST[$key])) {
    $error_message = "All Fields are required";
    break;
    }
  }
 

  /* Email Validation */
  if(!isset($error_message)) {
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $error_message = "Invalid Email Address";
    }
  }

  /* Validation to check if gender is selected */
  if(!isset($error_message)) {
  if(!isset($_POST["gender"])) {
  $error_message = " All Fields are required";
  }
  }

  /* Validation to check if Terms and Conditions are accepted */
  if(!isset($error_message)) {
    if(!isset($_POST["terms"])) {
    $error_message = "Accept Terms and Conditions to Register";
    }
  }
  }

?>
<html>
<head>

<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<title>Internship UCSM</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel = "stylesheet" type = "text/css" href = "css/jquery-ui.css" />
  <link rel = "stylesheet" type = "text/css" href = "css/jquery.dataTables.css" />
 <style>
  body{
  font-family:calibri;
  background-color: #D3D3D3;
}
.error-message {
  margin-top: 30px;
  padding: 50px 20px;
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
  background: white;
  border-spacing: initial;
  margin-left:auto;
  margin-right: auto;
  word-break: break-word;
  table-layout: auto;
  line-height: 1.8em;
  color: #333;
  border-radius: 4px;
  padding: 20px 40px;
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
<div class = "row" style = "margin-top:-120px;">	

			
<ul class="nav nav-tabs navbar-fixed-top" style = "display: flex; justify-content: flex-end;margin-top:10px;">
  <li><a href="index.php" style="color: white;font-weight: bold;"> Home </a></li>
  <!-- <li><a href="student.php" style="color: black;font-weight: bold;">Edit Profile</a></li> -->
  <li><a href="cancel_intern.php" style="color: white;font-weight: bold;">Cancel Activities</a></li>
</ul>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
  <form name="frmRegistration" method="post" enctype="multipart/form-data" action="inserty.php">
    <table border="0" width="500" class="demo-table" style="background-color:#063458;color:white;">
      <?php if(!empty($success_message)) { ?> 
      <div class="success-message"><?php if(isset($success_message)) echo $success_message; ?></div>
      <?php } ?>
      <?php if(!empty($error_message)) { ?> 
      <div class="error-message"><?php if(isset($error_message)) echo $error_message; ?></div>
      <?php } ?>
      <caption style="color:black; font-weight:bold; font-size: 25px;">Fill details</caption>
      <?php
        $conn = new mysqli('localhost', 'root', '', 'db_issm');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT title, company_name FROM `activity` WHERE activity_id = ?");
        $stmt->bind_param("i", $_GET['activity_id']);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($job_name,$company_name);
        $stmt->fetch();
        $stmt->close();
        session_start();
        $username = $_SESSION['user_name'];
        $stmt = $conn->prepare("SELECT first_name, last_name, email FROM `registered_users` WHERE user_name = ?");
        $stmt->bind_param("s", $_SESSION['user_name']); 
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($first_name, $last_name, $email);
        $stmt->fetch();
        $stmt->close();
        echo "<script>console.log('$username');</script>";
        ?>

      <tr>
      <td>First name</td>
      <td><input type="text" class="demoInputBox" name="first_name"minlength="3" maxlength="16"  value="<?php echo $first_name; ?>" required ></td>
      </tr>
      <tr>
      <td>Last Name</td>
      <td><input type="text" class="demoInputBox" name="last_name" minlength="3" maxlength="16" value="<?php echo $last_name; ?>" required ></td>
      </tr>
      <tr>
      <td>Company Name</td>
      <td><input type="text" class="demoInputBox" name="company_name" minlength="3" maxlength="16" value="<?php echo $company_name; ?>" required ></td>
      </tr>
      <tr>
      <td>Job Name</td>
      <td><input type="text" class="demoInputBox" name="job_name" minlength="3" maxlength="30" value="<?php echo $job_name; ?>" required ></td>
      </tr>
      <tr>
      <td>Email</td>
      <td><input type="email" class="demoInputBox" name="email" value="<?php echo $email; ?>" required ></td></tr>
      </tr>
      <tr>
      <td>Gender</td>
      <td><input type="radio" name="gender" value="Male" <?php if(isset($_POST['gender']) && $_POST['gender']=="Male") { ?>checked<?php  } ?> required > Male
      <input type="radio" name="gender" value="Female" <?php if(isset($_POST['gender']) && $_POST['gender']=="Female") { ?>checked<?php  } ?> required > Female
      </td>
      </tr>
      <tr>
      <td>Upload cv:</td>
      <td>
        <input  style="color:white;"type="file" name="file" required  />
      </td>
      </tr>
      <tr>
      <td colspan=2>
      <input type="checkbox" name="terms"> I accept Terms and Conditions <input type="submit" name="insert_button" value="Apply" class="btnRegister" required ></td>
      </tr>
    </table>
      
    </body>

</html>