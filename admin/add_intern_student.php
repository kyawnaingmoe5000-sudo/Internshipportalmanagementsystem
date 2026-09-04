<?php
	require_once '../connect.php';
    if(isset($_POST['glyphicon-add'])) {
       
    
    // SQL query to select data from table1
    $sql_select = "SELECT * FROM fill_details WHERE id = '$_REQUEST[id]'";
    
    // Execute the query
    $result = $conn->query($sql_select);
    
    // Check if there are rows in the result set
    if ($result->num_rows > 0) {
        // SQL query to insert data into table2
        $sql_insert = "INSERT INTO student (column1, column2, column3,column4,column5,column6,column7) VALUES ";
    
        // Loop through each row in the result set
        while ($row = $result->fetch_assoc()) {
            // Prepare values for insertion into table2
            $value1 = $conn->real_escape_string($row['column1']);
            $value2 = $conn->real_escape_string($row['column2']);
            $value3 = $conn->real_escape_string($row['column3']);
            $value4 = $conn->real_escape_string($row['column4']);
            $value5 = $conn->real_escape_string($row['column5']);
            $value6 = $conn->real_escape_string($row['column6']);
            $value7 = $conn->real_escape_string($row['column7']);
    
            // Append values to the insert query
            $sql_insert .= "('$value1', '$value2', '$value3', '$value4', '$value5', '$value6', '$value7')";
        }
    
        // Remove the trailing comma from the insert query
        $sql_insert = rtrim($sql_insert, ",");
    
        // Execute the insert query
        if ($conn->query($sql_insert) === TRUE) {
            echo "Data copied successfully.";
        } else {
            echo "Error copying data: " . $conn->error;
        }
    } else {
        echo "No data to copy.";
    }
    
    // Close connection
 
    }
    header('location:student.php');
    ?>