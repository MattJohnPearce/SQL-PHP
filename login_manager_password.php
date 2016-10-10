<?php
$MUser = $_POST['InsertUser'];
$MPassword = $_POST['InsertPassword'];
$username = 'root';
$password = '1234';

	if(($password != $MPassword) && ($username))
	{
		echo "Login eror";
		
	}
	else
	{
		header('Location:managers.html');
	}
?>