<?php
require $_SERVER['DOCUMENT_ROOT'].'/controll/users/manageUsers.php';

use Storage\Controll\Users\ManageUsers as Users;

session_start();

if (!isset($_POST['username'])||!isset($_POST['password1'])||!isset($_POST['password2']))
{
	echo "Podaj login i hasło";
}
else if (strcmp($_POST['password1'],$_POST['password2'])!=0)
{
	echo "Hasła muszą być takie same";
}
else
{
	if(Users::register($_POST['username'],$_POST['password1']))
	{
		$_SESSION["loggedin"]=true;
		echo '<script>window.open(window.location.protocol + "//" + window.location.host + "/index.php","_parent");</script>';
	}
	else
	{
		echo "użytkownik o takiej nazwie już istnieje";
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