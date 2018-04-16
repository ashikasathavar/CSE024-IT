<html>
<head>	<title></title>
<style>
body
{
background-color:lightblue;
}

</style>
</head>
<body>
	<?php
	SESSION_START();/*session starts*/
	$db_host= "localhost";
	$db_user= "root";
	$db_password= "tiger";
	$db_name= "lab";
	$dbh= mysqli_connect($db_host,$db_user,$db_password,$db_name) or die("error while connecting to the databse");/*connection with the database*/
		$username=$_POST['username'];
		$password=$_POST['password'];/*contents of the form is bought for processing*/
	$query="select * from login where std_id=\"$username\"";
	$result=mysqli_query($dbh,$query)or die("error querying the database");
	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
	$_SESSION['u_name']=$username;/*session created for username to be used later to increment voted value*/
	if($row['voted']==1)
		{
			
			header("location:final1.php");/*if voted==1 then do not allow the user to login , already voted*/
		}
	else
	if($row['role']== "admin")
		{
			header("location:admin.php");
		}
	else
	if($row['role']=="user")
	{
		if($row['std_id']==$username)
			{
				if($row['std_password']==$password)
				{
					$_SESSION['sec']=$row['std_section'];
					header("location:main.html");/*else compare the  form password with the database password and allow the user to main page*/
				}
				else
				{
				
					header("location:login.html");/*when enters wrong password*/
				}
	
			
		}

	?>
</body>
</html>
