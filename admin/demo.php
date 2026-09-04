<?php
	require_once 'session.php';
	require_once '../connect.php';

	$s_query = $conn->query("SELECT * FROM `fill_details`") or die($conn->error);
		while($s_fetch = $s_query->fetch_array()){
			 echo $s_fetch['first_name']
									echo $s_fetch['last_name']
									echo $s_fetch['company_name']
									echo $s_fetch['email']
									echo $s_fetch['gender']
                                    
									echo $s_fetch['file']}
												

?>