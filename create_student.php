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

if(!($fname = $_POST['fname'])){
	echo 'please enter your name';
}

if(!($email = $_POST['email'])){
	echo 'please enter your student email';
}

if(!($password = password_hash($_POST['password'], PASSWORD_DEFAULT))){
	echo 'please enter a passowrd';
}




//prepare our SQL to prevent SQL injection.
if( $stmt = ("INSERT INTO student_accounts (email, password) VALUES ('${email}','${password}')")){
	if($con->query($stmt) === TRUE){
		echo 'student account created';
	}else{
		echo 'student account creation failed'.$con->error;
	}

	header("Location: login.html");
	
	



// if($stmt->num_rows>0){
// 		$stmt->bind_result($id, $password);
// 		$stmt->fetch();
// 		//account exists, verify passowrd
// 	if(password_verify($_POST['password'], $password)){
// 		//user is verified --- SUCCESS ---
// 		session_regenerate_id();
// 		$_SESSION['loggedin'] = TRUE;
// 		$_SESSION['name'] = $_POST['email'];
// 		$_SESSION['id'] = $id;
// 		echo 'WELCOME' . $_SESSION['name'] . '!';
// 	} else {
// 		echo 'Incorroect Password';
// 	}
// } else {
// 	echo 'Incorrect username';
// }
	
}
	
?>