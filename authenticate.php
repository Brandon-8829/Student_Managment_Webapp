<?php
session_start();

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

//prepare our SQL to prevent SQL injection.
if( $stmt = $con->prepare('SELECT email, password FROM student_accounts WHERE email = ?')){
	//bind the parameters to the string (username)
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	$stmt->store_result();
	
	if($stmt->num_rows>0){
			$stmt->bind_result($id, $password);
			$stmt->fetch();
			//account exists, verify passowrd
		if(password_verify($_POST['password'], $password)){
			//user is verified --- SUCCESS ---
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['email'] = $_POST['email'];
			
			header("Location: student_page.html");
		} else {
			echo 'Incorroect Password';
		}
	} else {
		echo 'Incorrect username';
	}
	$stmt->close();
}
?>