<?php
session_start();
$error = "";
$success = "";
if(array_key_exists("submit",$_POST)){
	
		include("regandsignconnection.php");
		
			$varemail = $_POST['email'];
			$varpassword = $_POST['password'];
			$hashedPassword = md5(md5($varpassword));
			if(!$varemail){
				$error .= "Email is required.<br>";
			}
			if(!$varpassword){
				$error .= "Password is required.<br>";
			}
			if($error != ""){
				$error = '<div class="alert alert-danger" role="alert">
						 <p><strong>There were error(s):</strong></p>'.$error.
						'</div>';
			}else{
				$escemail=mysqli_real_escape_string($link,$varemail);
				$escpassword=mysqli_real_escape_string($link,$varpassword);
				
				$query = "SELECT * FROM `registration` WHERE user_id='".$_SESSION['user_id']."'";
				$result = mysqli_query($link,$query);
				$fetch = mysqli_fetch_array($result);
					if($escemail != $fetch['email']){
						$error = "Email address is wrong<br>";
					}
					elseif($hashedPassword != $fetch['password']){
						$error .= "Passwords doesnot match";
					}else{
						$del = "DELETE FROM `registration` WHERE user_id='".$_SESSION['user_id']."'";
						$delquery = mysqli_query($link,$del);
						
					}
					header("Location:accdeleted.php");
				
			}
}



?>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="myprofile.css">
    <title>Welcome to Gaming Shaman</title>
  </head>
  <body>
	<div id="topbar-container">
			<div id="logo">
				<a href="homepage.html"><img id="topbarlogo" src="logo.png"></a>
			</div>
			<div id="topbarname" id="logoname">
				<a href="homepage.html"><img src="logoname.png"></a>
			</div>
			<div class="topbar"><a class="topbar-link" href="about.html">About</a></div>
			<div class="topbar"><a class="topbar-link" href="support.html">Support</a></div>
		</div>
	<div class="clear"></div>
	<div id="contentspace">
		<p class="font  font-heading" id="p-spacing">Delete Account Confirmation</p>
		<div id="profilecontainer" class="sign-form-container">
		<div id="error"><?php if($error){echo '<div class="alert alert-danger" role="alert">
						 <p><strong>There were error(s):</strong></p>'.$error.'</div>';}else{echo $success;} ?></div>
		<form method="post">
			<div class="form-group">
				<div class="form-group">
					<label class="font">Email address</label>
					<input class="form-control" type="text" name="email">
				</div>
				<div class="form-group">
					<label class="font">Password</label>
					<input type="password" class="form-control" name="password">
				</div>
				<button type="submit" class="btn btn-primary btnedit" name="submit">Delete</button>
		</form>



<?php include("profilefooter.php"); ?>