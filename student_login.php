_<?php
if (isset($_POST['submit'])) { 
    $dbconn = mysqli_connect('localhost','root','','db_issm');    
    session_start();
    $activity_id = $_REQUEST['activity_id'];
    $username = $_POST['user_name'];
    $password = $_POST['password'];
    $_SESSION['user_name']=$username;
    
    $stmt = $dbconn->prepare("SELECT first_name FROM registered_users WHERE user_name = ?");
    $stmt->bind_param("s", $username); 
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($first_name);
    $stmt->fetch();
    $stmt->close();

    
    $query_internship = mysqli_query($dbconn, "SELECT * FROM student WHERE first_name='$first_name'");
    if (mysqli_num_rows($query_internship) != 0) {
        echo "<script type='text/javascript'>alert('You already have an internship!')</script>";
    } else {
        
        $query_login = mysqli_query($dbconn, "SELECT * FROM registered_users WHERE user_name='$username' and password='$password'");
        if (mysqli_num_rows($query_login) != 0) {
            echo "<script language='javascript' type='text/javascript'> location.href='fill_details.php?activity_id=$activity_id&name=$username' </script>";     
        } else {
            echo "<script type='text/javascript'>alert('User Name Or Password Invalid!')</script>";
        }
    }
}
?>

<html>
<head>
<title>Internship UCSM</title>
<link rel="stylesheet" type="text/css" href="css/login.css">
 <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/jquery.dataTables.css">
  <link rel ="stylesheet" type="text/css" href ="css/bootstrap.min.css">
  <link rel ="stylesheet" type="text/css" href ="css/style1.css">
<script type="text/javascript" src="js/script1.js"></script>
</head>
<?php include("head.php");?>
<div class = "row" style = "margin-top:-120px;">	

			
				<ul class="nav nav-tabs navbar-fixed-top" style = "display: flex; justify-content: flex-end;margin-top:10px;">
					<li><a href="index.php"style="color: white;"> Home </a></li>
					<li><a href="user_registration/index.php"style="color: white;">Register</a></li>
				</ul>
		</div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
<div class="container">
  
  <div class="row" id="pwd-container" >

    <div class="col-md-8" >
      <section class="login-form" style="width: 100%;height: 100%; padding-left:250px;padding-top:50px;">
        <form method="post" action="#" role="login" style="width: 66.66%;background-color: #063458;">
          <div class = "panel-heading">
						<h4 style="color:white;font-weight:bold;">Student Login</h4>
					</div>
          <input type="text" name="user_name" placeholder="Enter username " required class="form-control input-lg" value="" />
          
          <input type="password"  name="password" class="form-control input-lg" id="password" placeholder="Password" required="" />
          
          
          <div class="pwstrength_viewport_progress"></div>
          
          
          <button type="submit" name="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
          
          
        </form>
      </section>  
      </div>
  
      </div>
      
    
      
</div>

</html>