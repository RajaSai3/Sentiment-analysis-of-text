<?php
	session_start();
	$uid=$_SESSION['userid'];
	$servername = "localhost";
	$username = "root";
	$password = "";
	echo "<center><h2>Welcome ".$_SESSION['Name'].".These are your previous transactions</h2></center>";
	$con=new mysqli($servername,$username,$password,"sentiment");
		
	$sql="select * from transaction where UserID='$uid'";
	$result=$con->query($sql);
	echo "<div class='container table-responsive'><table class='table table-striped table-bordered table-hover table-condensed'>";
	echo "<tr><th>Transaction ID</th><th>User ID</th><th>Sentence</th><th>Negative</th><th>Neutral</th><th>Positive</th><th>Compound</th><th>Date</th></tr>";
	
		$counter=0;
	while($row=$result->fetch_assoc())
	{
		
		foreach((array)$row as $row1)
		{
			if($counter%8==0)
			{
				echo "<tr>";
			}
			echo "<td>".$row1."</td>";
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
<center>
<a href="hello.php"><button type="button" value="Previous Page">Previous Page</button></a>
<input type="Submit" value="LogOut"></input>
</center>
</form>

</html>