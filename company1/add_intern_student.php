<?php
try{
require_once '../connect.php';
$conn->query("INSERT INTO `student` SELECT * FROM `fill_details` WHERE id = '$_REQUEST[id]'") or die($conn->error);
$name=$conn->query("SELECT * FROM `fill_details` WHERE id = '$_REQUEST[id]'") or die($conn->error);
while($name_fetch = $name->fetch_array()){
        
        //mail
        $receiver = "$name_fetch[email]";
        $subject = "You have been selected";
        $body = "Dear $name_fetch[first_name] $name_fetch[last_name]\n You have been selected by the $name_fetch[company_name] for the $name_fetch[job_name] position.Stay tuned for further information.";
        $sender = "From:haxz2392003@gmail.com";
        if(mail($receiver, $subject, $body, $sender)){
            echo "Email sent successfully to $receiver";
        }else{
            echo "Sorry, failed while sending mail!";
        }
        //------------

    
        $updated_quantity = $conn->query("SELECT quantity FROM `activity` WHERE title = '{$name_fetch['job_name']}'")->fetch_assoc()['quantity'];
        if ($updated_quantity == 1) {
            // Delete row from activity table
            $conn->query("DELETE FROM `activity` WHERE title = '{$name_fetch['job_name']}'") or die($conn->error);
            echo "Deleted row from activity table where quantity reached 0 for activity: {$name_fetch['job_name']}";
        } else {
            $conn->query("UPDATE `activity` SET quantity = quantity - 1 WHERE title = '{$name_fetch['job_name']}'") or die($conn->error);
        }
        
    $conn->query("DELETE FROM `fill_details` WHERE first_name = '$name_fetch[first_name]'") or die($conn->error);
}

header('location:student.php');}
catch (mysqli_sql_exception $e) {
    error_log($e->__toString());
}
?>