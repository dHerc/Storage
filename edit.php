<?php
session_start();

require 'login/logincheck.php';
require 'controll/manageItems.php';
require 'data/status.php';

use Storage\Controll\ManageItems as Manage;
use Storage\Data\Status as Status;

if($loged==true)
{
	$manage = unserialize($_SESSION["item_manage"]);
	if(isset($_GET["id"]))
	{
		$status = $manage->getItem($_GET["id"])->status;
		echo
		'<form action="modify.php" method="post">
		Tytuł: '.$manage->getItem($_GET["id"])->title.' -> <input type="text" name="title"><br>'.
		'Opis: '.$manage->getItem($_GET["id"])->description.' -> <input type="text" name="desc"><br>'.
		'Status: '.Status::getStatusName($status).' -> <select name="status" id="status">';
		foreach(Status::getAllStatuses() as $id => $name)
		{
			echo '<option value="'.$id.'"'
			.(($id==$status)?"selected":"").
			'>'.$name.'</option>';
		}
		echo '</select><br>
		<input type="hidden" name="mode" value="edit">
		<input type="hidden" name="id" value="'.$_GET["id"].'">
		<input type="submit" value = Zapisz></form>
		<form action="modify.php" method="post">
		<input type="hidden" name="mode" value="delete">
		<input type="hidden" name="id" value="'.$_GET["id"].'">
		<input type="submit" value = Usuń></form>';
	}
	else
	{
		echo
		'<form action="modify.php" method="post">
		Tytuł: <input type="text" name="title"><br>'.
		'Opis: <input type="text" name="desc"><br>'.
		'Status: <select name="status" id="status">';
		foreach(Status::getAllStatuses() as $id => $name)
		{
			echo '<option value="'.$id.'">'.$name.'</option>';
		}
		echo '</select><br>
		<input type="hidden" name="mode" value="add">
		<input type="submit" value = Dodaj>
		</form>';
	}
}
?>
<button onClick = "goBack()">Wróć</button>
<script>
function goBack()
{
window.open(window.location.protocol + "//" + window.location.host + "/index.php","_parent");
}
</script>