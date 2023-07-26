<?php
session_start();
require_once(__DIR__ .'/include/connection.php');

if(isset($_POST['login'])){
	$email = $_POST['email'];
	$password = $_POST['password'];

	$errors = '';
	$query = "SELECT * FROM USERS WHERE email = '$email' AND password = '$password' ";
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result) === 1 ){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['firstname'] = $row['firstname'];
        $_SESSION['lastname'] = $row['lastname'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['userID'] = $row['userID'];
        echo <<<EOD
            <script>
            setTimeout(function(){
                window.location.href = 'dashboard.php';
            }, 3000)
            </script>
        EOD;

    }else{
        echo "Incorrect email or password";
    }

}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
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
				<h2>Welcome Back</h2>
				<div class="form-row">
					<label for="full-name">Email</label>
					<input type="text" name="email" id="full-name" class="input-text" placeholder="Your Name" required>
					<i class="fas fa-user"></i>
				</div>
				<div class="form-row">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" class="input-text" placeholder="Your Password" required>
					<i class="fas fa-lock"></i>
				</div>
				<div class="form-row-last">
					<input type="submit" name="login" class="register" value="Login">
				</div>
			</form>
		</div>
	</div>
</body>
</html>