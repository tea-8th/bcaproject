<?php

	session_start();
	
	if(array_key_exists("user_id",$_COOKIE)){
		$_SESSION['user_id'] = $_COOKIE['user_id'];
	}
	if(array_key_exists ("user_id",$_SESSION)){
		include("regandsignconnection.php");
		$welcomenamequery = "SELECT `username` FROM `registration` WHERE user_id='".$_SESSION['user_id']."'";
		$welcomename = mysqli_query($link,$welcomenamequery);
		$welcome = mysqli_fetch_array($welcomename);
	}else{
		header("Location: signupform.php");
	}
?>


<?php include("ourgameheader.php"); ?>
			<div id="contentspace">
				<div id="welcome-container"><div class="alert alert-danger wclgout" role="alert">Welcome <b><?php echo $welcome['username'];?>.</b> You are logged in
											</div>
											<button type="submit" class="btn btn-primary" id="btnprofile" name="submit">
											<a id="lgout" href='myprofile.php'>MY PROFILE</a></button>
											<button type="submit" class="btn btn-primary" id="btnlgout" name="submit">
											<a id="lgout" href='signupform.php?logout=1'>LOGOUT</a></button>
											
				</div>
				<div class="clear"></div>
				<div id="maincontent-container">
					<div class="games-container"><a href="game1.php"><img class="gamelog-size" src="game1.jpg"></a>
					</div>
				</div>
			</div>
		
<?php include("ourgamefooter.php"); ?>