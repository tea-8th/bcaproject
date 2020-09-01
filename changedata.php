
<?php

session_start();
$error = "";
$success = "";
if(array_key_exists("submit",$_POST)){
	
		include("regandsignconnection.php");
		
			$varusername = $_POST['username'];
			$varemail = $_POST['email'];
			$varpassword = $_POST['password'];
			$hashedPassword = md5(md5($varpassword));
			$varconfirm_password = $_POST['confirm_password'];
			if(!$varusername){
				$error .= "Username is required.<br>";
			}
			if(!$varemail){
				$error .= "Email is required.<br>";
			}
			if(!$varpassword){
				$error .= "Password is required.<br>";
			}
			if(!$varconfirm_password){
				$error .= "Field is required.<br>";
			}
			if($error != ""){
				$error = '<div class="alert alert-danger" role="alert">
						 <p><strong>There were error(s):</strong></p>'.$error.
						'</div>';
			}else{
				$escusername=mysqli_real_escape_string($link,$varusername);
				$escemail=mysqli_real_escape_string($link,$varemail);
				$escpassword=mysqli_real_escape_string($link,$varpassword);
				$escconfirm_password=mysqli_real_escape_string($link,$varconfirm_password);
				
				$query = "SELECT * FROM `registration` WHERE email='".$escemail."'LIMIT 1";
				$result = mysqli_query($link,$query);
				$userquery = "SELECT username FROM `registration` WHERE username='".$escusername."'";
				$userresult = mysqli_query($link,$userquery);
				if(mysqli_num_rows($result) > 0){
					$error = "Email address is taken<br>";
				}
				elseif(mysqli_num_rows($userresult) > 0){
					$error .="Username is taken<br>";
				}
				elseif($varpassword != $varconfirm_password){
					$error .= "Passwords doesnot match";
				}else{
					$changes = "UPDATE `registration` SET `username` = '$escusername',`email` = '$escemail',`password` = '$hashedPassword' WHERE user_id='".$_SESSION['user_id']."'";
					$changequery = mysqli_query($link,$changes);
					
				}
				$success = '<div class="alert alert-success" role="alert">
						 <p><strong>Success!</strong></p></div>';
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
		<p class="font  font-heading" id="p-spacing">Account changes</p>
		<div id="profilecontainer" class="sign-form-container">
		<div id="error"><?php if($error){echo '<div class="alert alert-danger" role="alert">
						 <p><strong>There were error(s):</strong></p>'.$error.'</div>';}else{echo $success;} ?></div>
		<form method="post">
			<div class="form-group">
					<label class="font">Username</label>
					<input class="form-control" type="text" name="username">
				</div>
				<div class="form-group">
					<label class="font">Email address</label>
					<input class="form-control" type="text" name="email">
				</div>
				<div class="form-group">
					<label class="font">Password</label>
					<input type="password" class="form-control" name="password">
				</div>
				<div class="form-group">
					<label class="font">Confirm Password</label>
					<input type="password" class="form-control" name="confirm_password">
				</div>
				<button type="submit" class="btn btn-primary btnedit" name="submit">Save Changes</button>
		</form>



<?php include("profilefooter.php"); ?>