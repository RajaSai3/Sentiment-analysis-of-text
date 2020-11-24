<!-- <?php
session_start();
// echo "<span style='float:right;' class='nav-heading'>Hello, ".$_SESSION['Name']."</span><br>";
?> -->

<html>
<body>

	<nav class="nav" style="position:sticky">

		<div class="row">

			<div class="col-md-9">
				<h1 class="navbar-text"> Sentiment Analysis</h1>
			</div>

			<div class="col-md-2">
				<form action="transactions.php" method="POST">
					<input type="Submit" value="View my previous queries" class="btn btn-success" style="margin:16px 4px ;"></input>
				</form>
			</div>

			<div class="col-md-1">
				<form action="logout.php">
					<input type="Submit" value="LogOut" class="btn btn-danger" style="margin:16px 4px;"></input>
				</form>
			</div>

			
		</div>
	</nav>

	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="sentiment_provider.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<div class="container first-section">
		
		<h2 style="text-align:center; font-weight:bold; font-color:green;">Hello, <?= $_SESSION['Name'] ?>.</h2>
		<form action="sentiment_analyzer.php" method="POST">
			<div class="row">	

				<label><h4>Enter the text line by line or as a paragraph in the textbox</h4></label>
				<textarea class="form-control" placeholder="Enter your text here" rows="25" cols="50" name="text"></textarea><br><br>
			</div>
			<input type="Submit" style="margin:2% 50%" value="Submit" class="btn btn-primary mx-auto"></input>
		</form>


	</div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	</body>
</html>

<?php
	$name=isset($_POST['text'])?$_POST['text']:'';
	$uid=$_SESSION['userid'];
	$servername = "localhost";
	$username = "root";
	$password = "";
	$con=new mysqli($servername,$username,$password,"sentiment");
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
		echo "<tr>
				<th class='text-center'>Sentence</th>
				<th class='text-center'>Negative</th>
				<th class='text-center'>Neutral</th>
				<th class='text-center'>Positive</th>
				<th class='text-center'>Compound</th>
			</tr>";

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
			echo "<td class='text-center'>".$row."</td>";
			if($counter%5==4)
			{
				$compound=$row;
				echo "</tr>";
				$sql="insert into transaction values(DEFAULT,'$uid','$sentence','$negative','$neutral','$positive','$compound',SYSDATE());";
				$result=$con->query($sql);
			}
			$counter++;
		}
		echo "</table>";

			

		$con->close();
	}
?>