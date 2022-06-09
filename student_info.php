<?php
	session_start();
	$email = $_SESSION['email'];
	//database info
	$DATABASE_HOST = 'localhost';
	$DATABASE_USER = 'root';
	$DATABASE_PASS = '';
	$DATABASE_NAME = 'student_managment_system';

	$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS,
							$DATABASE_NAME);
	//check to see if database connection is working
	if(!$con ){
		die ('failed to connect to MySQL: ');
	}

	$result = mysqli_query($con, "SELECT * FROM student_information WHERE StudentEmail = '${email}' ");

	if($result){
		$row = mysqli_fetch_array($result);
		echo "<h1>".$row['StudenEmail']. "</h1>";
	}else{
		echo 'Error getting data'.$con->error;
	}

	
?>