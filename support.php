<?php
	$error = ""; $successMessage = "";
	if($_POST){
		
		$link = mysqli_connect("localhost","root","","project_website");
		
		$varemail = $_POST['email'];
		$varfbarea = $_POST['fbarea'];
		if(!$varemail){
			$error .= "Email address is required.<br>";
		}
		if(!$varfbarea){
			$error .= "You need to write some content.<br>";
		}
		if ($error != ""){
			$error = '<div class="alert alert-danger" role="alert">
						 <p><strong>There were error(s):</strong></p>'.$error.
						'</div>';
		}else{
			$query = "INSERT INTO `feedback`(`fb_id`, `fb_email`, `content`) VALUES ('','$varemail','$varfbarea')";
			$addquery=mysqli_query($link,$query);
			if(!$addquery){
						$error = "<p>Could not sign up</p>";
						die("query failed".mysqli_error($link));
					}else{
						$successMessage = '<div class="alert alert-success" role="alert">
						 <p><strong>Success! We will get back to you ASAP!</strong></p>'.$error.
						'</div>';
					}
		}
	}




?>

<?php include("f&cheader.php"); ?>

	<div><h3 id="fbhead">You can submit your feedback or query here.</h3></div>
	<div id="maincontent-container">
		
		<div><?php echo $error.$successMessage; ?></div>
		<form method="post">
		  <div class="form-group">
			<label>Email address</label>
			<input type="email" class="form-control" name="email">
		  </div>
		  <div class="form-group">
			<label>Write your query or feedback</label>
			<textarea class="form-control" rows="3" name="fbarea"></textarea>
		  </div>
		  <button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>



<?php include("f&cfooter.php"); ?>