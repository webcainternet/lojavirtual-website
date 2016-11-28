<?php
	if (!$_GET['telefone']) { echo "Telefone não informado";exit; }

	require_once "nusoap-0.9.5/nusoap.php";
	$client = new nusoap_client($_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["SERVER_NAME"].'/lib/ws.php');

	$result = $client->call('solicitacontato', array($_GET['telefone']));
	echo $result;
?>