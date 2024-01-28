<?php

session_start();
include("koneksi.php");

if(isset($_POST["login"])){
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        $message = '<label>ALL fields are required</label>';
    } else {
        $query = "SELECT * FROM user WHERE nama = :username AND password = :password";
        $statement = $conn->prepare($query);
        $statement->execute(
            array(
                'username' => $_POST["username"],
                'password' => $_POST["password"]
            )
        );
        $count = $statement->rowCount();
        if($count > 0){
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["level"] = $user["level"];
    
            if ($user["level"] == 'ADMIN') {
                header("location: admin.php");
            } else {
                header("location: listkelas.php");
            }
        } else {
            $message = '<label>Wrong Username or Password</label>';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>
<body>
	<img class="wave" src="img/wave.png">
	<div class="container">
		<div class="img">
			<img src="img/bg.svg">
		</div>
		<div class="login-content">
			<form method="POST">
				<div class="logo">
				<img src="img/pnjlogo.png">
				</div>
                <div>
                <h3 class="title-main">POLITEKNIK NEGERI JAKARTA</h3>
                </div>
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" name="username" class="input">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" name="password" class="input">
            	   </div>
            	</div>
            	<a href="#">Forgot Password?</a>
            	<input type="submit" class="btn" name="login" value="Login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
