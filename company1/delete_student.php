<?php
	require_once '../connect.php';
	$name=$conn->query("SELECT * FROM `fill_details` WHERE id = '$_REQUEST[id]'") or die($conn->error);
	while($name_fetch = $name->fetch_array()){
        
        //mail
        $receiver = "$name_fetch[email]";
        $subject = "You have been selected";
        $body = "Dear $name_fetch[first_name] $name_fetch[last_name]\nSorry you have been rejecteted by $name_fetch[company_name] for the $name_fetch[job_name] position.";
        $sender = "From:haxz2392003@gmail.com";
        if(mail($receiver, $subject, $body, $sender)){
            echo "Email sent successfully to $receiver";
        }else{
            echo "Sorry, failed while sending mail!";
        }
	}
	$conn->query("DELETE FROM `fill_details` WHERE id = '$_REQUEST[id]'") or die($conn->error);
	header('location:student.php');
?>