<?php

require_once '../api_include.php';

switch ( $requestMethod ) {
	case 'POST':

		$v = $_POST;

		$yazar = 0;
		$editor = 0;
		$hakem = 0;
		$admin = 0;

		if ( $v['hakem'] == 'on' ) {
			$hakem = 1;
		}

		if ( $v['editor'] == 'on' ) {
			$editor = 1;
		}

		if ( $v['yazar'] == 'on' ) {
			$yazar = 1;
		}

		if ( $v['admin'] == 'on' ) {
			$admin = 1;
		}

		$db->update( 'users' )
		   ->where( 'id', $v['userID'] )
		   ->set( [
			   'hakem' => $hakem,
			   'editor' => $editor,
			   'yazar' => $yazar,
			   'admin' => $admin
		   ] );

		echo pageReturn( array( 'operation' => 'reload','data' => $v ) );


}
