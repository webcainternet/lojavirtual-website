<?php
	require_once "nusoap-0.9.5/nusoap.php";
	$client = new nusoap_client($_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["SERVER_NAME"].'/lib/ws.php');

	$result = $client->call('criarloja', array($_GET['email'],$_GET['nome'],$_GET['telefone'],$_GET['url']));
	echo $result;
?>