<?php
	require_once("lib/iugu-php/lib/Iugu.php");

	Iugu::setApiKey("15653a119791039173c8d28f6628b790");
	$customers = Iugu_Customer::search()->results();

	echo "</pre><h1>Lista de clientes</h1><pre>";
	var_dump($customers);
exit;

