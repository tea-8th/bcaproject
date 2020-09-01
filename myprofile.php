<?php
	session_start();
	if(array_key_exists("user_id",$_SESSION)){
		include("regandsignconnection.php");
		$retreg = "SELECT * FROM `registration` WHERE user_id='".$_SESSION['user_id']."'";
		$retregquery = mysqli_query($link,$retreg);
		$retregdata = mysqli_fetch_array($retregquery);
		
		$retpro = "SELECT * FROM `profile` WHERE user_id='".$_SESSION['user_id']."'";
		$retproquery = mysqli_query($link,$retpro);
		$retprodata = mysqli_fetch_array($retproquery);
	}
	
	if(array_key_exists("submit",$_POST)){
		include("regandsignconnection.php");

		$varfname = $_POST['fname'];
		$varlname = $_POST['lname'];
		$varcountry = $_POST['country'];
		/*if($_POST['gender'] == "male"){
			$vargender = male;
		}
		if($_POST['gender'] == "female"){
			$vargender = female;
		}*/
		
		$changes = "UPDATE `profile` SET `fname` = '$varfname',`lname` = '$varlname',`nationality` = '$varcountry' WHERE user_id='".$_SESSION['user_id']."'";
		$changequery = mysqli_query($link,$changes);
		$changepro = "SELECT * FROM `profile` WHERE user_id='".$_SESSION['user_id']."'";
		$changeproquery = mysqli_query($link,$changepro);
		$retprodata = mysqli_fetch_array($changeproquery);
	}
?>

<?php include("profileheader.php"); ?>
			<form method="post">
				<div class="form-group form-float">
					<label class="font">Username</label>
					<input class="form-control" type="text" placeholder="<?php echo $retregdata['username']; ?>" readonly>
				</div>
				<div class="form-group form-float">
					<label class="font">Email address</label>
					<input class="form-control" type="text" placeholder="<?php echo $retregdata['email']; ?>" readonly>
				</div>
				<div class="clear"></div>
				<div class="form-group form-float">
					<label class="font">First name</label>
					<input type="text" class="form-control" name="fname" value="<?php echo $retprodata['fname']; ?>">
				</div>
				<div class="form-group form-float">
					<label class="font">Last name</label>
					<input type="text" class="form-control" name="lname" value="<?php echo $retprodata['lname']; ?>">
				</div>
				<div class="clear"></div>
				<div class="form-group form-float">
					<label class="font">Nationality</label>
					<input type="text" class="form-control" name="country" value="<?php echo $retprodata['nationality']; ?>">
				</div>
				<!--
				<select class="custom-select form-float select-edit" name="gender" value = "wtf">
				  <option selected>Select Gender</option>
				  <option value="male">Male</option>
				  <option value="female">Female</option>
				</select>
				-->
				<div class="clear"></div>
				<button type="submit" class="btn btn-primary btnedit" name="submit">Save Changes</button>
				<p class="font">Change email,password or username<a class="toggle-link" href="changedata.php">Click here</a></p>
				<p class="font">Delete account<a class="toggle-link" href="deletedata.php">Click here</a></p>
			</form>
<?php include("profilefooter.php"); ?>