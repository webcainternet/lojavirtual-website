<?php
	require_once "nusoap-0.9.5/nusoap.php";
	$server = new soap_server;
	
	$server->register('hello');
	$server->register('solicitacontato');
	$server->register('cadastrarnewsletter');

	function hello($nome) {
		return 'Olá '.$nome;
	}

	function solicitacontato($telefone) {
		require 'phpmailer/PHPMailerAutoload.php';

		$mail = new PHPMailer;

		//$mail->SMTPDebug = 3;                               // Enable verbose debug output

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'fernando.mendes@webca.com.br';                 // SMTP username
		$mail->Password = 'lV1rtFm3%1';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		/* $mail->smtpConnect(array(
			        "ssl" => array(
			            "verify_peer" => false,
			            "verify_peer_name" => false,
			            "allow_self_signed" => true
			        )
			    )
			); */

		$mail->setFrom('fernando.mendes@lojavirtual.digital', 'Fernando de Figueiredo Mendes');
		$mail->addAddress('fernando.mendes@webca.com.br');     // Add a recipient
		$mail->addAddress('support@webca.zendesk.com');        // Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = utf8_decode('Contato solicitado - '.$telefone);
		$mail->Body    = utf8_decode('<p>Olá,</p><p>Um contato foi solicitado!</p><p>'.$telefone.'</p>');
		$mail->AltBody = utf8_decode('Olá, Um contato foi solicitado! '.$telefone);

		// Slack message
		require 'slack/slack.php';

		if(!$mail->send()) {
		    $err = 'Mailer Error: ' . $mail->ErrorInfo;
		    slack('Ocorreu um erro na solicitação de contato. '.$err.' >> Ligue: '.$telefone, 'lojavirtual', 'Contato Solicitado (ERRO)');
		    return "Ocorreu um erro!";
		} else {
			slack('Ligue: '.$telefone, 'lojavirtual', 'Contato Solicitado');
		    return 1;
		}
	}

	//Cadastrar newsletter
	function cadastrarnewsletter($email) {
		require 'phpmailer/PHPMailerAutoload.php';

		$mail = new PHPMailer;

		//$mail->SMTPDebug = 3;                               // Enable verbose debug output

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'fernando.mendes@webca.com.br';                 // SMTP username
		$mail->Password = 'lV1rtFm3%1';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		/* $mail->smtpConnect(array(
			        "ssl" => array(
			            "verify_peer" => false,
			            "verify_peer_name" => false,
			            "allow_self_signed" => true
			        )
			    )
			); */

		$mail->setFrom('fernando.mendes@lojavirtual.digital', 'Fernando de Figueiredo Mendes');
		$mail->addAddress('fernando.mendes@webca.com.br');     // Add a recipient
		$mail->addAddress('support@webca.zendesk.com');        // Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = utf8_decode('Entrar na newsletter solicitado - '.$email);
		$mail->Body    = utf8_decode('<p>Olá,</p><p>Um email foi cadastrado na newsletter!</p><p>'.$email.'</p>');
		$mail->AltBody = utf8_decode('Olá, Um email foi cadastrado na newsletter! '.$email);

		// Slack message
		require 'slack/slack.php';

		if(!$mail->send()) {
		    $err = 'Mailer Error: ' . $mail->ErrorInfo;
		    slack('Ocorreu um erro no cadastro da newsletter. '.$err.' >> E-mail: '.$email, 'lojavirtual', 'Cadastro newsletter (ERRO)');
		    return "Ocorreu um erro!";
		} else {
			slack('E-mail: '.$email, 'lojavirtual', 'Cadastro newsletter');
		    return 1;
		}
	}
	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
	$server->service($HTTP_RAW_POST_DATA);
?>