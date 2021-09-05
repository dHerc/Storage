<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{
	$loged = true;
}
else
{
	$loged = false;
	echo '
	<br><button onClick = "login()">Zaloguj sie</button>
	<script>
	function login()
	{
	window.open(window.location.protocol + "//" + window.location.host + "/login.html","_parent");
	}
	</script>';
}