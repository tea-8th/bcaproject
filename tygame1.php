<?php

	session_start();
	if(array_key_exists("time",$_GET)){
		if(array_key_exists("user_id",$_SESSION)){
			include("regandsignconnection.php");
			
			$selectquery = "SELECT `rapid_reaction` FROM `game_stats` WHERE user_id='".$_SESSION['user_id']."'";
			$selectdata = mysqli_query($link,$selectquery);
			$select = mysqli_fetch_array($selectdata);
			$add = $select['rapid_reaction'] + $_GET['time'];
			
			if(array_key_exists("update",$_POST)){
				$statchangequery = "UPDATE `game_stats` SET `rapid_reaction` = '$add' WHERE user_id='".$_SESSION['user_id']."'";
				$statchange = mysqli_query($link,$statchangequery);
				header("Location: signupform.php");
			}
		}
	}





?>





<?php include("regandsignformheader.php"); ?>

	<form method="post">
		<div>
			<h1><font color="White">Thankyou for trying our game</font></h1>
				<button type="submit" class="btn btn-primary" name="update">Go back to games</button>
		</div>
	</form>
<?php include("regandsignformfooter.php"); ?>