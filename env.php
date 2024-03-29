<?php


function env($meta, $default = '')
{


    if (isset($_ENV[$meta])) {
        return $_ENV[$meta];
    } else {
        return $default;
    }

}


$protocol = $_SERVER['PROTOCOL'] = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https' : 'http';
$scriptConfig = array(
    'rootDIR' => '',
    'baseTitle' => env('BASETITLE','OzBilişim | Kongre Yönetim Sistemi'),
    'headerTitle' => env('HEADERTITLE','OzBilişim | Kongre Yönetim Sistemi'),
    'requestDIR' => 'api',
    'requestURL' => ['api', 'post', 'get'],
    'mainURL' => $protocol . '://' . $_SERVER['HTTP_HOST'],
    'status' => env('STATUS','production'), //develop or production
	'adminDIR' => 'panel',
	'adminURL' => ['admin','hakem','yazar','editor','panel'],
    'KYSID' => env('KYSID','KYSID'),
);

// VERİTABANI BİLGİLERİ config/db.php içinde


function server_root_dir(){
	global $scriptConfig;
	if(!empty($scriptConfig['root_folder'])){
		return $_SERVER['DOCUMENT_ROOT'] .'/'. $scriptConfig['root_folder'];
	}else{
		return $_SERVER['DOCUMENT_ROOT'];
	}
}

function currentAdminDIR(){

	global $scriptConfig;

	if(isset($_SESSION['CurrentAdminDIR']) AND in_array($_SESSION['CurrentAdminDIR'],$scriptConfig['adminURL'])){
		return $_SESSION['CurrentAdminDIR'];
	}else{
		return $scriptConfig['adminDIR'];
	}


}
