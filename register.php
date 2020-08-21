<?php
/* User Table SQL Query
Create table user (SNO INT(11) AUTO_INCREMENT PRIMARY KEY,
			UserID varchar(100) NOT NULL UNIQUE,
			Name varchar(100) NOT NULL,
			Password varchar(100) NOT NULL,
			Date_of_Creation varchar(50),
);
*/
$servername = "localhost";
$username = "root";
$password = "";
//$dbname = "sentiment";

$name=$_POST["name"];
$userid=$_POST["userID"];
$pass1=$_POST["pass1"];
$pass2=$_POST["pass2"];
$flag=0;
echo "<div class='container alert alert-danger message'>";
if(isset($name) and $name=='')
{
	echo "<span>Name field is empty</span><br>";
	$flag=1;
}
if(isset($userid) and $userid=='')
{
	echo "<span>User ID field is empty</span><br>";
	$flag=1;
}
if(isset($pass1) and $pass1=='')
{
	echo "<span>Password field is empty</span><br>";
	$flag=1;
}
if(isset($pass2) and $pass2=='')
{
	echo "<span>Password field is empty</span><br>";
	$flag=1;
}

if($pass1!=$pass2)
{
	echo "<span>Passwords do not match</span><br>";
	$flag=1;
}

if($flag==1)
{
	echo "<span> Click below button to reload previous page</span><br>";
	echo "<a href='register.html'><input type='button' value='Registration Page' class='btn btn-primary btn-lg'></input></a>";
}
if($flag==0)
{

	$con=new mysqli($servername,$username,$password,"sentiment");
	
	
	
	$sql1="SELECT count(*) FROM user WHERE UserID='$userid'";
	$result1=$con->query($sql1);
	$row1= $result1->fetch_row();
	
	if($row1[0]==1)
		{
			echo "<span><strong>User ID has already been taken.Please enter a different User ID</strong></span><br>";
			echo "<span> Click below button to reload previous page</span><br>";
			echo "<a href='register.html'><input type='button' class='btn btn-primary btn-lg'>Registration Page</input></a>";
			echo "</div>";
			$result1 -> free_result();
		}
	else	
	{
		$sql="insert into user values(DEFAULT,'$userid','$name','$pass1',SYSDATE())";
		$result=$con->query($sql);
/*
		echo "Connection succesful"."<br>";
		echo "ID"." "."Name"." "."Attendance"."<br>";
		if ($result === true) 
		{ 
			echo "<span style='color:green;'>New User succesfully created</span><br>";
		} 
		else
		{ 
			echo "<span style='color:green;'>Failed to create new user account</span><br>";
		} */
	  
	 
		$con->close();
		echo "<div class='container alert alert-success message'>";
		echo "<span style='color:green;'>New User succesfully created</span><br>";
		echo "<span>Click below to login with the credentials</span><br>";
		echo "<a href='login.html'><button type='button' class='btn btn-primary btn-lg'>Login Page</button></a>";
		echo "</div>";
	}
}

?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="login.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>