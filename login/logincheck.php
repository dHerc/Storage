<!DOCTYPE html>
<style>
p {
  font-size: 300%;
  text-align: center;
}
</style>
<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{
	$loged = true;
}
else
{
	$loged = false;
	echo '
	<br><p><button onClick = "login()">Zaloguj sie</button></p>
	<script>
	function login()
	{
	window.open(window.location.protocol + "//" + window.location.host + "/login.html","_parent");
	}
	</script>';
}
?>