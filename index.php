<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css"/>
</head>
<body>
<?php
session_start();
require 'users/logincheck.php';
require 'controll/manageItems.php';
use Storage\Data\AllItems as Items;
use Storage\Controll\ManageItems as Manage;
if($loged==true)
{
	$items = new Items();
	$manage =new Manage($items);
	$manage->updateItems();
	$products = $manage->getItems();
	echo '<button type="button" onClick = add()>Dodaj przedmiot</button>';
	$_SESSION["item_manage"] = serialize($manage);
	echo'<table id="example" class="table table-striped table-bordered" style="width:100%" data-display-length="-1">
			<thead>
			<tr>
				<th style="width:30%">Tytuł</th>
				<th style="width:50%">Opis</th>
				<th style="width:20%">Status</th>
			</tr>
			</thead>
			<tbody>
			';
	foreach ($products as $item) {
		echo '<tr id="' . $item->id . '" onClick=edit(this.id)>
		<td style="width:33%">' . $item->title . '</td>
		<td style="width:33%">'.  $item->description .'</td>
		<td style="width:33%">' . $item->status . '</td></tr>';
	}
}
?>
<script>
function edit(id)
{
window.open(window.location.protocol + "//" + window.location.host + "/edit.php?id="+id,"_parent");
}
function add()
{
window.open(window.location.protocol + "//" + window.location.host + "/edit.php","_parent");
}
</script>
</body>
</html>