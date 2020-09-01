<?php

		session_start();
		unset($_SESSION);
		session_destroy();
		setcookie("user_id","",time() - 60*60);
		$_COOKIE["user_id"]="";




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
		<div id="error"><?php echo '<div class="alert alert-success" role="alert">
							 <p><strong>Account successfully deleted</strong></p></div>'; ?></div>
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