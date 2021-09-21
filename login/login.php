<?php
require $_SERVER['DOCUMENT_ROOT'].'/controll/users/manageUsers.php';

use Storage\Controll\Users\ManageUsers as Users;

session_start();

if (!isset($_POST['username'])||!isset($_POST['password']))
{
	echo "Podaj login i hasło";
}
else
{
	if(Users::login($_POST['username'],$_POST['password']))
	{
		$_SESSION["loggedin"]=true;
		echo '<script>window.open(window.location.protocol + "//" + window.location.host + "/index.php","_parent");</script>';
	}
	else
	{
		echo "nieprawidłowy login lub hasło";
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