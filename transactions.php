<?php
	session_start();
	$uid=$_SESSION['userid'];
	$servername = "localhost";
	$username = "root";
	$password = "";
	echo "<h1 style='text-align:center'>Welcome ".$_SESSION['Name']."</h1>";
	print "<h3 style='text-align:center'>These are your previous queries and their results.</h3>";
	$con=new mysqli($servername,$username,$password,"sentiment");
		
	$sql="select * from transaction where UserID='$uid'";
	$result=$con->query($sql);
	echo "<div class='container table-responsive'><table class='table table-striped table-bordered table-hover table-condensed'>";
	echo "<tr>
			<th class='text-center'>Transaction ID</th>
			<th class='text-center'>User ID</th>
			<th class='text-center'>Sentence</th>
			<th class='text-center'>Negative</th>
			<th class='text-center'>Neutral</th>
			<th class='text-center'>Positive</th>
			<th class='text-center'>Compound</th>
			<th class='text-center'>Date</th>
		</tr>";
	
		$counter=0;
	while($row=$result->fetch_assoc())
	{
		
		foreach((array)$row as $row1)
		{
			if($counter%8==0)
			{
				echo "<tr>";
			}
			echo "<td class='text-center'>".$row1."</td>";
			if($counter%8==7)
			{
				echo "</tr>";
			}
			$counter++;
		}
	}
	$con->close();
	echo "</table></div>";
?>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<form action="logout.php" method="POST">
<br><br><br>
<div class="text-center">
<a href="sentiment_analyzer.php"><button type="button" value="Previous Page" class="btn btn-light">Previous Page</button></a>
<input type="Submit" value="LogOut" class="btn btn-danger"></input>
</div>
</form>

</html>