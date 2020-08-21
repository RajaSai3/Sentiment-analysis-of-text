<?php
session_start();
echo "<span style='float:right;'>Hello, ".$_SESSION['Name']."</span><br>";
?>
<html>
<form action="logout.php">
<input type="Submit" value="LogOut" style="float:right;"></input>
</form>
<head>
<h1 style="text-align:center"> Sentiment Analysis</h1>
</head>
<body>
<center>
<div>
<form action="hello.php" method="POST">
<textarea placeholder="Enter your text here" rows="20" cols="100" name="text"></textarea><br><br>
<input type="Submit" style="text-align:center" value="Submit"></input>
</form>
<form action="transactions.php" method="POST">
<input type="Submit" value="View your previous transactions"></input>
</form>
</center><br><br>
<center>
<img style="color:red" src="https://www.glyphicons.com/img/glyphicons/smileys/2x/glyphicons-smileys-2-beaming-smiling-eyes@2x.png">
<label>Positive</label>
<span id="positive"></span>

<img src="https://www.glyphicons.com/img/glyphicons/smileys/2x/glyphicons-smileys-25-neutral@2x.png">
<label>Neutral</label>
<span id="neutral"></span>


<img src="https://www.glyphicons.com/img/glyphicons/smileys/2x/glyphicons-smileys-50-frowning@2x.png">
Negative
<span id="negative"></span>
</center>

</body>
</html>
<?php
$name=isset($_POST['text'])?$_POST['text']:'';
if($name!='')
{
	$sentence="";
	$negative="";
	$neutral="";
	$positive="";
	$compound="";
	$inputfile=fopen("input.txt","w");
	fwrite($inputfile,$name);
	fwrite($inputfile,"\r\n");
	fclose($inputfile);
	echo "<div class='container table-responsive'><table class='table table-striped table-bordered table-hover table-condensed'>";
	echo "<tr><th>Sentence</th><th>Negative</th><th>Neutral</th><th>Positive</th><th>Compound</th></tr>";
	#!/Path to python.exe 'C:\Users\rajas\Anaconda3\python.exe'
	$filename = exec('C:\Users\rajas\Anaconda3\python.exe sentiment_analyzer.py',$output);


	$counter=0;
	foreach((array)$output as $row)
	{
		if($counter%5==0)
		{
			echo "<tr>";
			$sentence=$row;
		}
		if($counter%5==1)
		{
			$negative=$row;
		}
		if($counter%5==2)
		{
			$neutral=$row;
		}
		if($counter%5==3)
		{
			$positive=$row;
		}
		echo "<td><center>".$row."</center></td>";
		if($counter%5==4)
		{
			$compound=$row;
			echo "</tr>";
		}
		$counter++;
	}
	echo "</table></center>";
	$uid=$_SESSION['userid'];
	//echo "User Id = ".$_SESSION['userid'];
	//echo $sentence." ".$negative." ".$neutral." ".$positive." ".$compound."<br>";
	$servername = "localhost";
	$username = "root";
	$password = "";

	$con=new mysqli($servername,$username,$password,"sentiment");
		
	$sql="insert into transaction values(DEFAULT,'$uid','$sentence','$negative','$neutral','$positive','$compound',SYSDATE());";
	$result=$con->query($sql);
	/*if($result===true)
	{
		echo "Inserted Succesfully";
	}*/
	$con->close();
}
?>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
