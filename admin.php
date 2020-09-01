<?php
	 
	session_start();
	$error = "";
	/*if(array_key_exists("logout",$_GET)){
		unset($_SESSION);
		session_destroy();
		setcookie("srno","",time() - 60*60);
		$_COOKIE["srno"]="";
	}else if((array_key_exists("srno",$_SESSION) AND $_SESSION['srno']) OR (array_key_exists("srno",$_COOKIE) AND $_COOKIE['srno'])){
		header("Location:ourgame.php");
	}*/
	if(array_key_exists("submit",$_POST)){
	
		$link = mysqli_connect("localhost","root","","project_website");
		
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
				$query = "SELECT * FROM `adminaccess` WHERE a_email='".$escemail."'";
				$result = mysqli_query($link,$query);
				$row = mysqli_fetch_array($result);
				if(isset($row)){
					if($escpassword == $row['a_pass']){
						$_SESSION['a_id'] = $row['a_id'];
						/*if($_POST['stayLoggedIn']=='1'){
							setcookie("srno",$row['srno'],time() + 60*60*24*365);
						}*/
						header("Location:adminwork.php");
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

		<div class="sign-form-container">
			<p class="font font-heading">Administrator SIGN-IN</p>
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
		
<?php include("regandsignformfooter.php"); ?>
		