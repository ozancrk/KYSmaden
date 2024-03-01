<?php

require_once '../api_include.php';

switch ( $requestMethod ) {
	case 'POST':

		$v = $_POST;

		$yazarcheck = $db->from( 'users' )->where( 'username', $v['email'] )->first();

		if ( $yazarcheck ) {
			if ( $yazarcheck['yazar'] != 1 ) {
				$db->update( 'users' )
				   ->where( 'id', $yazarcheck['id'] )
				   ->set( [
					   'yazar' => 1
				   ] );
			}
			$UserID    = $yazarcheck['id'];
			$ignoreKey = array( 'type', 'userType', 'lang', 'email' );
			foreach ( $v as $key => $value ) {
				if ( in_array( $key, $ignoreKey ) ) {
					continue;
				}
				userMetaCreate( $UserID, $key, $value );
			}

		} else {
			if ( $v['ulke'] == 'TR' ) {
				$lang = 'tr';
			} else {
				$lang = 'en';
			}


			$userPermission = array(
				'admin'  => 0,
				'hakem'  => 0,
				'editor' => 0,
				'yazar'  => 1,
			);


			$UserID = userCreate( $v['email'], $userPermission, $lang );

			$ignoreKey = array( 'email', 'userType', 'lang' );
			foreach ( $v as $key => $value ) {
				if ( in_array( $key, $ignoreKey ) ) {
					continue;
				}
				userMetaCreate( $UserID, $key, $value );
			}


		}

		echo pageReturn( array('site'=>array( 'operation' => 'reload','data' => getUserMeta($UserID) )),'site');

}
