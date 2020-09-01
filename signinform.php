<?php
	 
	session_start();
	$error = "";
	if(array_key_exists("logout",$_GET)){
		unset($_SESSION);
		session_destroy();
		setcookie("user_id","",time() - 60*60);
		$_COOKIE["user_id"]="";
	}else if((array_key_exists("user_id",$_SESSION) AND $_SESSION['user_id']) OR (array_key_exists("user_id",$_COOKIE) AND $_COOKIE['user_id'])){
		header("Location:ourgame.php");
	}
	if(array_key_exists("submit",$_POST)){
	
		include("regandsignconnection.php");
		
			$varemail = $_POST['email'];
			$varpassword = $_POST['password'];
			if(!$varemail){
				$error .= "Email is required.<br>";
			}
			if(!$varpassword){
				$error .= "Password is required.<br>";
			}
			if($error != ""){
				$error = "<p>There are error(s) in your form:</p>".$error;
			}else{
				$escemail=mysqli_real_escape_string($link,$varemail);
				$escpassword=mysqli_real_escape_string($link,$varpassword);
				$hashedPassword = md5(md5($varpassword));
				$query = "SELECT * FROM `registration` WHERE email='".$escemail."'";
				$result = mysqli_query($link,$query);
				$row = mysqli_fetch_array($result);
				if(isset($row)){
					if($hashedPassword == $row['password']){
						$_SESSION['user_id'] = $row['user_id'];
						if($_POST['stayLoggedIn']=='1'){
							setcookie("user_id",$row['user_id'],time() + 60*60*24*365);
						}
						header("Location: ourgame.php");
					}else{
						$error = "Email id or password is incorrect";
					}
				}else{
					$error = "Email id or password is incorrect";
				}
			}
	}

?>



<?php include("regandsignformheader.php"); ?>
		<p class="font  font-heading" id="p-spacing">You need to login to access our website games.</p>
		<div class="sign-form-container">
			<p class="font font-heading">SIGN-IN</p>
			<div id="error"><?php if($error != ""){
			echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';} ?></div>
			<form method="post">
				<div class="form-group">
					<label class="font">Email address</label>
					<input type="email" class="form-control" name="email">
				</div>
				<div class="form-group">
					<label class="font">Password</label>
					<input type="password" class="form-control" name="password">
				</div>
				<div class="form-group form-check">
					<input type="checkbox" class="form-check-input" name="stayLoggedIn">
					<label class="form-check-label font" >Keep me signed in</label>
				</div>
				<button type="submit" class="btn btn-primary" name="submit">Sign-in</button>
			</form>
		</div>
		<p class="font">No account yet?<a class="toggle-link" href="signupform.php">Register here</a></p>
		<p class="font">Forgot your password?<a class="toggle-link" href="forgotpassword.php">Click here</a></p>
		
<?php include("regandsignformfooter.php"); ?>
		