<?php
	session_start();
	use PHPMailer\PHPmailer\PHPMailer;
		$successMessage = "";
		$fetchfb['fb_email'] = "";
		$fetchfb['content'] = "";
		$error = "";
	if(array_key_exists("feedback",$_POST)){
		
		$link = mysqli_connect("localhost","root","","project_website");
		
		//$varemail = $_POST['email'];
		//$varfbarea = $_POST['fbarea'];
		//$varrsparea = $_POST['responsearea'];
		
		$getfbquery = "SELECT * FROM `feedback` LIMIT 1";
		$getfb = mysqli_query($link,$getfbquery);
		$fetchfb = mysqli_fetch_array($getfb);
		//$_SESSION['fetchemail'] = $fetchfb['fb_email'];
		//$_SESSION['fetchid'] = $fetchfb['fb_id'];
	}
		if(array_key_exists("submit",$_POST)){
			$link = mysqli_connect("localhost","root","","project_website");
			$getfbquery = "SELECT * FROM `feedback` LIMIT 1";
			$getfb = mysqli_query($link,$getfbquery);
			$fetchfb = mysqli_fetch_array($getfb);
			$query = $fetchfb['content'];
			$feedid = $fetchfb['fb_id'];
			$adminid = $_SESSION['a_id'];
			//$varemail = $_POST['email'];
			//$varfbarea = $_POST['fbarea'];
			$varrsparea = $_POST['responsearea'];
		
			$emailTo = $fetchfb['fb_email'];
			$content = $varrsparea;
			$emailFrom = "xyz.com"//(YOUR EMAIL);
			
			require_once "PHPMailer/PHPmailer.php";
			require_once "PHPMailer/SMTP.php";
			require_once "PHPMailer/Exception.php";
			
			$mail = new PHPMailer();
			
			//SMTP Settings
			$mail->isSMTP();
			$mail->Host = "smtp.gmail.com";
			$mail->SMTPAuth = true;
			$mail->Username = "xyz.com"//(YOUR EMAIL);
			$mail->Password = 'xyz'//(YOUR PASSWORD);
			$mail->Port = 587;
			$mail->SMTPSecure = "tls";
			
			//Email Settings
			$mail->isHTML(true);
			$mail->setFrom($emailFrom);
			$mail->addAddress($emailTo);
			$mail->Body = $content;
			if(!$varrsparea){
				$error = "Response area should not be empty";
			}else{
				if($mail->send()){
					
					$insreplyquery = "INSERT INTO `response`(`res_id`,`a_id`,`reply_email`,`query`,`reply`) VALUES ('','$adminid','$emailTo','$query','$content')";
					$insreply = mysqli_query($link,$insreplyquery);
					
					$delfeedquery = "DELETE FROM `feedback` WHERE fb_id = $feedid";
					$delfeed = mysqli_query($link,$delfeedquery);
					$fetchfb['fb_email']="";
					$fetchfb['content']="";
					
					//session_destroy();
					$successMessage = '<div class="alert alert-success" role="alert">
					<p><strong>Response sent successfully!</strong></p></div>';
				}else{
					echo "Error<br><br>".$mail->ErrorInfo;
				}
			}
		}



?>




<?php include("f&cheader.php"); ?>

	<div><h3 id="fbhead">Respond to feeback or queries of users.</h3></div>
	<div id="maincontent-container">
		
		<div><?php echo $successMessage; ?></div>
		<div id="error"><?php if($error != ""){
			echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';} ?></div>
			<form method="post">
		<form method="post">
		  <div class="form-group">
			<label>User's Email address</label>
			<input type="email" class="form-control" name="email" placeholder="<?php echo $fetchfb['fb_email']; ?>" readonly>
		  </div>
		  <div class="form-group">
			<label>User feedback</label>
			<textarea class="form-control" rows="3" name="fbarea" placeholder="<?php echo $fetchfb['content']; ?>" readonly></textarea>
		  </div>
		  <div class="form-group">
			<label>Admin Response</label>
			<textarea class="form-control" rows="10" name="responsearea"></textarea>
		  </div>
		  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
		  <button type="submit" class="btn btn-primary" name="feedback">Get feedback</button>
		</form>
		<p class="font">Generate statistical record<a class="toggle-link" href="generatedata.php">Click here</a></p>
	</div>



<?php include("f&cfooter.php"); ?>