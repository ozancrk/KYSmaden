<?php

$requestMethod = $_SERVER['REQUEST_METHOD'];

require_once '../api_include.php';

switch ( $requestMethod ) {
	case 'GET':

		$veriable = $_GET;

		$temp = $db->from('mailsablon')->where('id',$_GET['id'])->first();

		echo json_encode($temp);


}

