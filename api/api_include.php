<?php

session_start();

require_once '../../env.php';

require_once server_root_dir().'/config/db.php';

require_once server_root_dir().'/functions.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];

switch ( $requestMethod ) {
	case 'POST':
		if(!isset($_FILES)){
			//checkFormTokenSession($_POST['token']);
		}

		unset($_POST['postUrl']);
		if(isset($_POST['captha'])){
			if ( $_POST['captha'] != $_SESSION['captcha'] ) {
				echo json_encode( array( 'operation' => 'none', 'cc'=>$_POST['captha'], 'data'=>$_SESSION['captcha'], 'hata' => langTranslate( 'Güvenlik Kodu Hatalı!' ) ) );
				die();
			}
		}
		unset($_POST['captha']);
}

