<?php
ob_start();
/*
	ENV ile temel ayar bilgileri
	functions ile de site genelinde kullanılabilir
	tüm içerik fonksiyorunları devreye alınyor
*/

session_start();
require_once 'env.php';
require_once 'functions.php';

/*
	ENV dosyasında status bilgisi
	develop ise hata gösterimi açılıyor
*/
if ( $scriptConfig['status'] == 'develop' ) {
        ini_set( 'display_errors', 'on' );
        error_reporting( E_WARNING   );
}

/*
	URL'yi yönlendirme ayarları
	için parçalıyoruz
*/

if ( ! empty( $scriptConfig['rootDIR'] ) ) {
	$URL = str_replace( '/' . $scriptConfig['rootDIR'] . '/', '', $_SERVER['REQUEST_URI'] );
} else {
	$URL = ltrim( $_SERVER['REQUEST_URI'], "/" );
}

$URL = explode('?', $URL)[0];

$URL = rtrim( $URL, "/" );

/*
	Site dili kontrol ediliyor
	yoksa oluşturuluyor
*/

if ( empty( $_SESSION['lang'] ) or ! isset( $_SESSION['lang'] ) or $_SESSION['lang'] == '' ) {

	$lang = substr( $_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2 );

	if ( $lang != 'tr' ) {
		$_SESSION['lang'] = 'en';
		$SiteLang         = $_SESSION['lang'];
	} else {
		$_SESSION['lang'] = 'tr';
		$SiteLang         = $_SESSION['lang'];
	}

} else {
	$SiteLang = $_SESSION['lang'];
}

// DİL
if ( isset($_GET['lang']) ) {
	$_SESSION['lang'] = $_GET['lang'];
	$SiteLang         = $_SESSION['lang'];
}
// DİL

// LOGOUT
if ( strstr( $URL, 'logout' ) ) {
	$url = 'Location: /' . currentAdminDIR();
	session_destroy();
	header( $url );
}
// LOGOUT

$URLParts = explode( '/', $URL );
if ( URLfolderCheck( $URL, $scriptConfig['adminURL'] ) ) {
	$_SESSION['CurrentAdminDIR'] = $URLParts[0];
	if ( isset( $_SESSION['UserID'] ) and ! empty( $_SESSION['UserID'] ) and ! userCheck( $_SESSION['UserName'] ) ) {
		include 'view/' . $scriptConfig['adminDIR'] . '/index.php';
	} else {
		include 'view/' . $scriptConfig['adminDIR'] . '/login.php';
	}
} else {

	include 'view/site/index.php';

}

