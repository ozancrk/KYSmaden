<?php

require_once '../api_include.php';

switch ( $requestMethod ) {
	case 'POST':

		$v = $_POST;

		$userMeta = getUserMeta( $v['userID'] );

		if ( $userMeta['type'] == 'firma') {
			$Template = $db->from( 'mailsablon' )
			               ->where( 'id', 1 )
			               ->first();

			$content = $Template['tr'];
			$content = str_replace( '##FIRMA##', $userMeta['name'], $content );
		} elseif($userMeta['type'] == 'taseron' ) {
			$Template = $db->from( 'mailsablon' )
			               ->where( 'id', 1 )
			               ->first();

			$content = $Template['tr'];
			$content = str_replace( '##FIRMA##', $userMeta['name'], $content );
		}



		$content = str_replace( '##FIRMA##', $userMeta['name'], $content );
		$content = str_replace( '##URL##', $scriptConfig['mainURL'], $content );
		$content = str_replace( '##USERNAME##', $userMeta['username'], $content );
		$content = str_replace( '##PASSWORD##', base64_decode( $userMeta['passbase64'] ), $content );

		$emailstatus = sendmail( $userMeta['username'], 'xxxx', $content );

		if ( $emailstatus ) {
			echo pageReturn( array( 'operation' => 'none', 'sleep' => '0', 'data' => $v ) );
		} else {
			echo pageReturn( array( 'operation' => 'none', 'hata' => 'E-Posta Gönderilemedi!', 'data' => $v ) );
		}


}
