<?php

require_once '../api_include.php';

switch ( $requestMethod ) {
	case 'POST':

		$v = $_POST;

		$usermeta = getUserMeta( $v['userID'] );

		$db->delete( 'userMeta' )
		   ->where( 'user', $v['userID'] )
		   ->done();

		$db->delete( 'users' )
		   ->where( 'id', $v['userID'] )
		   ->done();

		/*todo: tüm kullanıcı tipleri için ayarla admin için iptal et*/

		echo pageReturn( array( 'operation' => 'none', 'sleep' => '3000', 'data' => $v ) );


}
