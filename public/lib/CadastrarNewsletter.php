<?php
	if (!$_GET['email']) { echo "E-mail não informado";exit; }

	require_once "nusoap-0.9.5/nusoap.php";
	$client = new nusoap_client($_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["SERVER_NAME"].'/lib/ws.php');

	$result = $client->call('cadastrarnewsletter', array($_GET['email']));
	echo $result;
?>