<?php
	 
	session_start();
	$error = "";
	if(array_key_exists("logout",$_GET)){
		unset($_SESSION);
		session_destroy();
		setcookie("user_id","",time() - 60*60);
		$_COOKIE["user_id"]="";
	}else if((array_key_exists("user_id",$_SESSION) AND $_SESSION['user_id']) OR (array_key_exists("user_id",$_COOKIE) AND $_COOKIE['user_id'])){
		header("Location: ourgame.php");
	}
	if(array_key_exists("submit",$_POST)){
	
		include("regandsignconnection.php");
		
			$varusername = $_POST['username'];
			$varemail = $_POST['email'];
			$varpassword = $_POST['password'];
			$hashedPassword = md5(md5($varpassword));
			$varconfirm_password = $_POST['confirm_password'];
			$varbackupemail = $_POST['backupemail'];
			$varquestion = $_POST['question'];
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
			if(!$varbackupemail){
				$error .= "Backup email is required.<br>";
			}
			if(!$varquestion){
				$error .= "Answer is required.<br>";
			}
			if($error != ""){
				$error = "<p>There are error(s) in your form:</p>".$error;
			}else{
				$escusername=mysqli_real_escape_string($link,$varusername);
				$escemail=mysqli_real_escape_string($link,$varemail);
				$escpassword=mysqli_real_escape_string($link,$varpassword);
				$escconfirm_password=mysqli_real_escape_string($link,$varconfirm_password);
				
				$query = "SELECT * FROM `registration` WHERE email='".$escemail."'LIMIT 1";
				$result = mysqli_query($link,$query);
				$userquery = "SELECT username FROM `registration` WHERE username='".$escusername."'";
				$userresult = mysqli_query($link,$userquery);
				$backupquery = "SELECT username FROM `registration` WHERE backupemail='".$varbackupemail."'";
				$backupresult = mysqli_query($link,$backupquery);
				if(mysqli_num_rows($result) > 0){
					$error = "Email address is taken<br>";
				}
				elseif(mysqli_num_rows($userresult) > 0){
					$error .="Username is taken<br>";
				}
				elseif($varpassword != $varconfirm_password){
					$error .= "Passwords doesnot match";
				}elseif(mysqli_num_rows($backupresult) > 0){
					$error .= "Backup email already exits,enter another one";
				}elseif($varbackupemail == $varemail){
					$error .= "Your backup email address must be different from your main email address";
				}else {
					$queryins= "INSERT INTO registration VALUES ('','{$escusername}','{$escemail}','{$hashedPassword}','{$varbackupemail}','{$varquestion}')";
					$addquery=mysqli_query($link,$queryins);
					if(!$addquery){
						$error = "<p>Could not sign up</p>";
						die("query failed".mysqli_error($link));
					}else{
						$subid = mysqli_insert_id($link);
						$proquery = "INSERT INTO `profile`(`pro_id`, `user_id`, `fname`, `lname`, `nationality`) VALUES ('','$subid','First Name','Last Name','Country Name')";
						$proadd = mysqli_query($link,$proquery);
						$statquery = "INSERT INTO `game_stats`(`stat_id`, `user_id`, `rapid_reaction`) VALUES ('','$subid','0')";
						$statadd = mysqli_query($link,$statquery);
						$_SESSION['user_id'] = $subid;
						if($_POST['stayLoggedIn']=='1'){
							setcookie("user_id",mysqli_insert_id($link),time() + 60*60*24*365);
						}
						header("Location: ourgame.php");
					}
				}
			}
	}

?>



<?php include("regandsignformheader.php"); ?>
		<p class="font  font-heading" id="p-spacing">You need to login to access our website games.</p>
		<div class="sign-form-container">
			<p class="font font-heading">SIGN-UP</p>
			<div id="error"><?php if($error != ""){
			echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';} ?></div>
			<form method="post">
				<div class="form-group">
					<label class="font">Username</label>
					<input type="text" class="form-control" name="username">
				</div>
				<div class="form-group">
					<label class="font">Email address</label>
					<input type="email" class="form-control" name="email">
				</div>
				<div class="form-group">
					<label class="font">Password</label>
					<input type="password" class="form-control" name="password">
				</div>
				<div class="form-group">
					<label class="font">Confirm Password</label>
					<input type="password" class="form-control" name="confirm_password">
				</div>
				<div class="form-group">
					<label class="font">Backup Email address(in case you forget login details)</label>
					<input type="email" class="form-control" name="backupemail">
				</div>
				<div class="form-group">
					<label class="font">Write your favourite fruit</label>
					<input type="text" class="form-control" name="question">
				</div>
				<div class="form-group form-check">
					<input type="checkbox" class="form-check-input" name="stayLoggedIn">
					<label class="form-check-label font" >Keep me signed in</label>
				</div>
				<button type="submit" class="btn btn-primary" name="submit">Sign-up</button>
			</form>
		</div>
		<p class="font">Have an account already?<a class="toggle-link" href="signinform.php">Sign in here</a></p>
		<p class="font">Admin access<a class="toggle-link" href="admin.php">Admin Sign in here</a></p>
	
<?php include("regandsignformfooter.php"); ?>