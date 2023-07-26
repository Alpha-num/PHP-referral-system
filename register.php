<?php
require_once(__DIR__ .'/include/connection.php');

if(isset($_POST['register'])){
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	//generate random user ID. Unique usernames can be used as well.

	function generateRandomID($length = 5) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomID = '';
		$maxIndex = strlen($characters) - 1;
	
		for ($i = 0; $i < $length; $i++) {
			$randomID .= $characters[rand(0, $maxIndex)];
		}
	
		return $randomID;
	}
	$errors = '';
	
	$userID = generateRandomID();

	$query = "INSERT INTO users(userID, firstname, lastname,email, password) VALUES('$userID', '$firstname','$lastname', '$email', '$password')";
	$result = mysqli_query($connection, $query);
	if(!$result){
		echo("OOps!! could not register user" . mysqli_error($connection));
	}else{
		echo "registration successful";
	}
}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Registration</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="css/roboto-font.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-5/css/fontawesome-all.min.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body class="form-v5">
	<div class="page-content" id="wrapper">
		<div class="form-v5-content">
			<form class="form-detail" action="#" method="post">
				<h2>Create your Account</h2>
				<div class="form-row">
					<label for="full-name">First Name</label>
					<input type="text" name="firstname" id="full-name" class="input-text" placeholder="Your Name" required>
					<i class="fas fa-user"></i>
				</div>
				<div class="form-row">
					<label for="full-name">Last Name</label>
					<input type="text" name="lastname" id="full-name" class="input-text" placeholder="Your Name" required>
					<i class="fas fa-user"></i>
				</div>
				<div class="form-row">
					<label for="your-email">Your Email</label>
					<input type="text" name="email" id="your-email" class="input-text" placeholder="Your Email" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
					<i class="fas fa-envelope"></i>
				</div>
				<div class="form-row">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" class="input-text" placeholder="Your Password" required>
					<i class="fas fa-lock"></i>
				</div>
				<div class="form-row-last">
					<input type="submit" name="register" class="register" value="Register">
				</div>
			</form>
		</div>
	</div>
</body>
</html>