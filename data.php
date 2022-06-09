<?php
sessoin_start();

//database info
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'student_managment_system';

$con = mysqil_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS,
						$DATABASE_NAME);
//check to see if database connection is working
if(mysqil_connect_errno() ){
	die ('failed to connect to MySQL: ' .mysqil_connect_errno());
}

//now check to see if the data from the login was submitted
if(!isset($_POST['username'], $_POST['password']){
	//could not get the data being sent
	die ('please fill both fields!');
}

//prepare our SQL to prevent SQL injection.
if( $stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')){
	//bind the parameters to the string (username)
	$stmt->bind_param('s', $_POST['username']);
	$smtm->execute();
	$smtm->store_result();
	
if($stmt->num_rows>0){
		$stmt->bind_result($id, $password);
		$stmt->fetch();
		//account exists, verify passowrd
	if(password_verify($_POST['password'], $password)){
		//user is verified --- SUCCESS ---
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $_POST['username'];
		$_SESSION['id'] = $id;
		echo 'WELCOME' . $_SESSION['name'] . '!';
	} else {
		echo 'Incorroect Password';
	}
} else {
	echo 'Incorrect username';
}
	
	
	
	$stmt->close();
}
?>