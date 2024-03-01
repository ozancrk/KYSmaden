<?php

require_once '../api_include.php';

if ($_POST) {

    $veri = $_POST['query'];
    $usercode = $veri['usercode'];
    $password = md5($veri['password']);
    $usercode = trim($usercode);

	$LoginCheck = $db->from('users')
        ->where('username',$usercode)
        ->where('password',$password)
        ->all();

    if (count($LoginCheck) > 0) {

        foreach ($LoginCheck as $item) {
            $_SESSION['UserID'] = $item['id'];

	        $_SESSION['admin'] = $item['admin'];
	        $_SESSION['hakem'] = $item['hakem'];
	        $_SESSION['yazar'] = $item['yazar'];
	        $_SESSION['editor'] = $item['editor'];


            $_SESSION['UserName'] = $item['username'];
            $_SESSION['name'] = $item['Name'];
        }
        echo $_SESSION['UserID'];
    } else {
        echo 0;
    }
}
