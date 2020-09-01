<?php

use PHPMailer\PHPmailer\PHPMailer;
$error = "";
$successMessage = "";
if(array_key_exists("submit",$_POST)){
	
		include("regandsignconnection.php");
		
			$varemail = $_POST['email'];
			$varanswer = $_POST['answer'];
			if(!$varemail){
				$error .= "Email is required.<br>";
			}
			if(!$varanswer){
				$error .= "Answer is required.<br>";
			}
			if($error != ""){
				$error = "<p>There are error(s) in your form:</p>".$error;
			}else{
				$query = "SELECT * FROM `registration` WHERE backupemail='".$varemail."'";
				$result = mysqli_query($link,$query);
				$row = mysqli_fetch_array($result);
				if(isset($row)){
					if($varanswer == $row['question']){
						$username = $row['username'];
						$newpasschar = substr($username,0,3);
						$newpassnos = rand(10000,99999);
						$emailid = $row['email'];
						
						$newpass = $newpasschar.$newpassnos;
						$emailTo = $row['backupemail'];
						$content = "Your login email id:".$emailid."<br>Your new password is:".$newpass;
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
						
						if($mail->send()){
						
							$varhashedpassword = md5(md5($newpass));
							$changequery = "UPDATE `registration` SET `password`= '$varhashedpassword'";	
							$change = mysqli_query($link,$changequery);
							$successMessage = '<div class="alert alert-success" role="alert">
											<p><strong>Your login email and new password is sent to your backup email.</strong></p></div>';
						}
					}else{
					$error = "Email id or answer is incorrect";
					}
				}else{
					$error = "Email id or answer is incorrect";
				}
			}
	}






?>





<?php include("regandsignformheader.php"); ?>
		<p class="font  font-heading" id="p-spacing">You need to login to access our website games.</p>
		<div class="sign-form-container">
			<p class="font font-heading">Account retrieval details</p>
			<div><?php echo $successMessage; ?></div>
			<div id="error"><?php if($error != ""){
			echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';} ?></div>
			<form method="post">
				<div class="form-group">
					<label class="font">Backup Email address specified during registration</label>
					<input type="email" class="form-control" name="email">
				</div>
				<div class="form-group">
					<label class="font">Type your favourtie fruit</label>
					<input type="text" class="form-control" name="answer">
				</div>
				<button type="submit" class="btn btn-primary" name="submit">Submit</button>
			</form>
		</div>
		
<?php include("regandsignformfooter.php"); ?>