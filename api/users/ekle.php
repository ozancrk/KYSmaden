<?php

require_once '../api_include.php';

switch ( $requestMethod ) {
	case 'POST':
		$v = $_POST;

		if(!userCheck($v['userEmail'] )){
			echo pageReturn(array( 'operation' => 'none', 'hata' => 'E-Posta Kayıtlı!' ));
			die();
		}
		$userPermission = array(
			'admin' => 0,
			'hakem' => 0,
			'editor' => 0,
			'yazar' => 0,
			'delege' => 0,
			'sponsor' => 0,
		);

		$userPermission[$v['userType']] = 1;

		$userID = userCreate($v['userEmail'],$userPermission,$v['ulke']);
		$ignoreKey = array('userEmail','userType','lang');
		foreach ($v as $key => $value){
			if(in_array($key,$ignoreKey)){
				continue;
			}
			userMetaCreate( $userID, $key, $value );
		}
		echo pageReturn(array( 'operation' => 'redirect', 'sleep' => '3000', 'location' => currentAdminDIR().'/'.$v['userType'].'/duzenle?userID='.$userID, 'data' => $v ));

}
