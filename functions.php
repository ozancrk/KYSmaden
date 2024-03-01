<?php


// Sistemde genel olarak kullanılan tüm class ve fonksiyonlar burada include edilir
require_once server_root_dir() . '/vendor/autoload.php';

require_once server_root_dir() . '/config/db.php';
require( server_root_dir() . "/classes/SMTP/PHPMailer.php" );
require( server_root_dir() . "/classes/SMTP/SMTP.php" );
require( server_root_dir() . "/classes/SMTP/Exception.php" );
require( server_root_dir() . "/classes/SMTP/email-template.php" );

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer();

use PhpOffice\PhpSpreadsheet\IOFactory;


// functions klasöründeki tüm dosyaları döngüye alıp include eder
$folder = server_root_dir() . '/functions/*.php';

foreach ( glob( $folder ) as $filename ) {
	include $filename;
}


//SERVER DİZİN VE SİTE ADRESİ
function my_server_url() {
	$server_name = $_SERVER['SERVER_NAME'];

	if ( ! in_array( $_SERVER['SERVER_PORT'], [ 80, 443 ] ) ) {
		$port = ":$_SERVER[SERVER_PORT]";
	} else {
		$port = '';
	}

	if ( ! empty( $_SERVER['HTTPS'] ) && ( strtolower( $_SERVER['HTTPS'] ) == 'on' || $_SERVER['HTTPS'] == '1' ) ) {
		$scheme = 'https';
	} else {
		$scheme = 'http';
	}

	return $scheme . '://' . $server_name . $port . '';
}

function randomPassword() {
	$alphabet    = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	$pass        = array(); //remember to declare $pass as an array
	$alphaLength = strlen( $alphabet ) - 1; //put the length -1 in cache
	for ( $i = 0; $i < 8; $i ++ ) {
		$n      = rand( 0, $alphaLength );
		$pass[] = $alphabet[ $n ];
	}

	return implode( $pass ); //turn the array into a string
}


function listUlke() {
	global $db;

	return $db->from( 'ulkeler' )->all();
}


function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
	$output = NULL;
	if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
		$ip = $_SERVER["REMOTE_ADDR"];
		if ($deep_detect) {
			if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
				$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
	}
	$purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), '', strtolower(trim($purpose)));
	$support    = array("country", "countrycode", "state", "region", "city", "location", "address");
	$continents = array(
		"AF" => "Africa",
		"AN" => "Antarctica",
		"AS" => "Asia",
		"EU" => "Europe",
		"OC" => "Australia (Oceania)",
		"NA" => "North America",
		"SA" => "South America"
	);
	if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
		$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
		if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
			switch ($purpose) {
				case "location":
					$output = array(
						"city"           => @$ipdat->geoplugin_city,
						"state"          => @$ipdat->geoplugin_regionName,
						"country"        => @$ipdat->geoplugin_countryName,
						"country_code"   => @$ipdat->geoplugin_countryCode,
						"continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
						"continent_code" => @$ipdat->geoplugin_continentCode
					);
					break;
				case "address":
					$address = array($ipdat->geoplugin_countryName);
					if (@strlen($ipdat->geoplugin_regionName) >= 1)
						$address[] = $ipdat->geoplugin_regionName;
					if (@strlen($ipdat->geoplugin_city) >= 1)
						$address[] = $ipdat->geoplugin_city;
					$output = implode(", ", array_reverse($address));
					break;
				case "city":
					$output = @$ipdat->geoplugin_city;
					break;
				case "state":
					$output = @$ipdat->geoplugin_regionName;
					break;
				case "region":
					$output = @$ipdat->geoplugin_regionName;
					break;
				case "country":
					$output = @$ipdat->geoplugin_countryName;
					break;
				case "countrycode":
					$output = @$ipdat->geoplugin_countryCode;
					break;
			}
		}
	}
	return $output;
}


function optionGet($meta){
	global $db;
	global $SiteLang;

	$option = $db->from('options')->where('meta',$meta)->first();

	return $option[$SiteLang];
}

function json_validator($data) {
	if (!empty($data)) {
		return is_string($data) &&
		       is_array(json_decode($data, true)) ? true : false;
	}
	return false;
}


