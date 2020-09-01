

<?php 
	$link = mysqli_connect("localhost","root","","project_website");

	$selectquery = "SELECT * FROM `registration`";
	$select = mysqli_query($link,$selectquery);
	$selectstat = "SELECT * FROM `game_stats`";
	$stat = mysqli_query($link,$selectstat);
?>







<?php include("f&cheader.php"); ?>

	<table align="center" border="5px" style="width:1000px" id="stattable">
		<tr>
			<th colspan="3"><h2 align="center">Statistical Data</h2></th>
		</tr>
		<tr>
			<td align="center"><b>User ID</b></td>
			<td align="center"><b>Username</b></td>
			<td align="center"><b>Rapid reaction</b></td>
		</tr>
		<?php
			while($rows = mysqli_fetch_assoc($select)){

		?>
			<tr>
			
				<td align="center"><?php echo $rows['user_id']; ?></td>
				<td align="center"><?php echo $rows['username']; ?></td>
				<?php if($stats = mysqli_fetch_assoc($stat)){ ?>
				<td align="center"><?php echo $stats['rapid_reaction']; ?></td> <?php } ?>
			</tr>
		<?php
			}
		?>
		
	</table>


<?php include("f&cfooter.php"); ?>