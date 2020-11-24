<?php
session_start();
$userid=$_POST["login"];
$_SESSION['userid']=$userid;
$pass=$_POST["pass"];
$flag=0;
echo "<div class='container alert alert-danger message'>";
if(isset($userid) and $userid=='')
{
	echo "<span><strong>User ID field is empty</strong></span><br>";
	$flag=1;
}

if(isset($pass) and $pass=='')
{
	echo "<span><strong>Password field is empty</strong></span><br>";
	$flag=1;
}
if($flag==0)
{
	$servername="localhost";
	$uname="root";
	$pwd="";
	$con=new mysqli($servername,$uname,$pwd,"sentiment");
	$sql="select * from user where UserID='$userid'";
	$result=$con->query($sql);
	//echo "Connection succesful"."<br>";
	//echo "Sno"." "."ID"." "."Name"." "."Password"." "."Date"." "."<br>";
	$row=$result->fetch_assoc();
	if($row["Password"]!=$pass)
	{
		echo "<span><strong>Incorrect Password</strong></span><br>";
		$flag=1;
	
	}
	else
	{
		$_SESSION['Name']=$row["Name"];
		header( 'Location:sentiment_analyzer.php' ) ;
	}
	$con->close();
}
if($flag==1)
{
	echo "<span style='text-align:center;'> Click below button to reload previous page</span><br>";
	echo "<a href='login.html'><input type='button' value='Login Page' class='btn btn-primary btn-lg'></input></a>";
}
	echo "</div>";
?>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="login.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
