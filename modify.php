<?php
session_start();
require 'controll/manageItems.php';
use Storage\Controll\ManageItems as Manage;
$manage = unserialize($_SESSION["item_manage"]);
$error = "Na serwerze wystąpił wewnętrzny błąd";
if(strcmp($_POST["mode"],"add")==0)
{
	if(strlen($_POST["title"])>0&&strlen($_POST["desc"]>0))
		$result = $manage->addItem($_POST["title"],$_POST["desc"],$_POST["status"]);
	else
	{
		$result = false;
		$error = "Podałeś niewłaściwe dane";
	}
}
if(strcmp($_POST["mode"],"delete")==0)
{
	$result = $manage->removeItem($_POST["id"]);
}
if(strcmp($_POST["mode"],"edit")==0)
{
	$result = $manage->editItem($_POST["id"],$_POST["title"],$_POST["desc"],$_POST["status"]);
}
if($result)
	echo "Operacja została wykonana pomyslnie";
else
{
	echo "W trakcie wykonywania operacji wystąpił błąd:<br>";
	echo $error;
}
?>
<br><button onClick = "goBack()">Wróć</button>
<script>
function goBack()
{
window.open(window.location.protocol + "//" + window.location.host + "/index.php","_parent");
}
</script>