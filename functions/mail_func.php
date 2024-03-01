<?php

// MAİL ATAR
function sendmail( $alici, $konu, $mailcontent ) {

	global $mail;
	global $template;

	$mailcontent = $template['header'] . $mailcontent . $template['footer'];

	$mail->IsSMTP();
	$mail->SMTPDebug  = 0;
	$mail->SMTPAuth   = true;
	$mail->SMTPSecure = 'tls';
	$mail->Host       = "smtp.yandex.com";
	$mail->Port       = 587;
	$mail->IsHTML( true );
	$mail->SetLanguage( "tr", "phpmailer/language" );
	$mail->CharSet  = "utf-8";
	$mail->Username = "smtp@uzaktanisgegitimi.com"; // Gönderici adresiniz (e-posta adresiniz)
	$mail->Password = "tK2zU1LG7JKO"; // Mail adresimizin sifresi
	$mail->SetFrom("smtp@uzaktanisgegitimi.com", "USDANISMANLIK"); // Mail atıldığında gorulecek isim ve email
	$mail->AddAddress($alici); // Mailin gönderileceği alıcı adres
	$mail->Subject = $konu;
	$mail->Body    = $mailcontent;
	if ( ! $mail->Send() ) {
		return 0;
	} else {
		return 1;
	}

}
