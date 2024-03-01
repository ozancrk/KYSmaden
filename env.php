<?php

$scriptConfig = array(
	'rootDIR' => '',
	'baseTitle' => 'OzBilişim | Kongre Yönetim Sistemi',
	'headerTitle' => 'OzBilişim | Kongre Yönetim Sistemi',
	'requestDIR' => 'api',
	'requestURL' => ['api','post','get'],
	'mainURL' => getenv_docker('MAIN_URL', 'http://kys.ozbilisim.net'),
	'status' => getenv_docker('APPSTATUS', 'production'), //develop or production
	'adminDIR' => 'panel',
	'adminURL' => ['admin','hakem','yazar','editor','panel'],
    'KYSID' => 'IMCET'
);

// VERİTABANI BİLGİLERİ config/db.php içinde


function server_root_dir(){
    return getenv_docker('ROOTFOLDER', '/var/www/html');

//	global $scriptConfig;
//	if(!empty($scriptConfig['root_folder'])){
//		return $_SERVER['DOCUMENT_ROOT'] .'/'. $scriptConfig['root_folder'];
//	}else{
//		return $_SERVER['DOCUMENT_ROOT'];
//	}
}

function currentAdminDIR(){

	global $scriptConfig;

	if(isset($_SESSION['CurrentAdminDIR']) AND in_array($_SESSION['CurrentAdminDIR'],$scriptConfig['adminURL'])){
		return $_SESSION['CurrentAdminDIR'];
	}else{
		return $scriptConfig['adminDIR'];
	}


}