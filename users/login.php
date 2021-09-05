<?php
require $_SERVER['DOCUMENT_ROOT'].'/data/database/databaseAccess.php';
use Storage\Data\Database\DatabaseAccess as DBAccess;
session_start();
if (!isset($_POST['username'])||!isset($_POST['password']))
{
	echo "Podaj login i hasło";
}
else
{
	$user =  DBAccess::getUser($_POST['username']);
	if($user)
	{
		$password = $user['password'];
		echo $password;
		if($password&&password_verify($_POST['password'],$password))
		{
			$_SESSION["loggedin"]=true;
			echo '<script>window.open(window.location.protocol + "//" + window.location.host + "/index.php","_parent");</script>';
		}
		else
		{
			echo "Nieprawidłowe hasło";
		}
	}
	else
	{
		echo "nieprawidłowy login";
	}
}
?>
<br><button onClick = "goBack()">Wróć</button>
<script>
function goBack()
{
window.open(window.location.protocol + "//" + window.location.host + "/index.php","_parent");
}
</script>