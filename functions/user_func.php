<?php

function userCreate( $email, $type, $lang = 'tr' ) {

	global $db;


	$password    = randomPassword();
	$firmaCreate = $db->insert( 'users' )->
	set( [
		'username'    => $email,
		'password'    => md5( $password ),
		'passbase64'  => base64_encode( $password ),
		'create_date' => date( 'Y-m-d H:i:s' ),
		'lang' => $lang,
		'admin' => $type['admin'],
		'hakem' => $type['hakem'],
		'editor' => $type['editor'],
		'yazar' => $type['yazar'],
		'delege' => $type['delege'],
		'sponsor' => $type['sponsor'],
	] );

	return $db->lastId();
}


function userMetaCreate( $userID, $meta, $value ) {

	global $db;

	if ( $meta == 'token' or $meta == 'postUrl' ) {
		return false;
	}

	$userMeta = getUserMeta( $userID );

	if ( isset( $userMeta[ $meta ] ) ) {
		$MetaEdit = $db->update( 'userMeta' )
		               ->where( 'user', $userID )
		               ->where( 'meta', $meta )
		               ->set( [
			               'value' => $value,
		               ] );
	} else {
		$MetaCreate = $db->insert( 'userMeta' )
		                ->set( [
			                'meta'  => $meta,
			                'value' => $value,
			                'user'  => $userID
		                ] );
	}

	return true;


}

function userMetaRemove( $userID, $meta, $value ) {

	global $db;

	$db->delete( 'userMeta' )
	   ->where( 'user', $userID )
	   ->where( 'meta', $meta )
	   ->where( 'value', $value )
	   ->done();

	return true;

}


function userMetaEdit( $userID, $meta, $value ) {

	global $db;

	if ( $meta == 'token' or $meta == 'postUrl' ) {
		return false;
	}

	$userMeta = userMeta( $userID );

	if ( isset( $userMeta[ $meta ] ) ) {
		$MetaEdit = $db->update( 'userMeta' )
		               ->where( 'user', $userID )
		               ->where( 'meta', $meta )
		               ->set( [
			               'value' => $value,
		               ] );
	} else {
		userMetaCreate( $userID, $meta, $value );
	}

	return true;

}

function userCheck( $username ) {

	global $db;
	$userCheck = $db->from( 'users' )
	                ->where( 'username', $username )
	                ->cnt();

	if ( $userCheck > 0 ) {
		return false;
	}

	return true;

}


function getUserList( $UserType  ) {

	global $db;

	$PerID = array();

	$Users = $db->from( 'users' )->where( $UserType, 1 )->all();

	$return = array();
	$i      = 0;
	foreach ( $Users as $User ) {

		$tableName = 'userMeta';

		$UserMeta = $db->from( $tableName )->where( 'user', $User['id'] )->all();

		foreach ( $UserMeta as $meta ) {
			if ( isset( $User[ $meta['meta'] ] ) and ! is_array( $User[ $meta['meta'] ] ) ) {
				$gecici                  = $User[ $meta['meta'] ];
				$User[ $meta['meta'] ]   = array();
				$User[ $meta['meta'] ][] = $gecici;
				$User[ $meta['meta'] ][] = $meta['value'];
			} elseif ( isset( $User[ $meta['meta'] ] ) ) {
				if ( is_array( $User[ $meta['meta'] ] ) ) {
					$User[ $meta['meta'] ][] = $meta['value'];
				}
			} else {
				$User[ $meta['meta'] ] = $meta['value'];
			}
		}

		$return[ $i ] = $User;
		$i ++;
	}


	return $return;


}

function getUserMeta( $UserID, $single = null ) {

	global $db;

	$User = $db->from( 'users' )->where( 'id', $UserID )->first();

	$tableName = 'userMeta';

	$UserMeta = $db->from( $tableName )->where( 'user', $UserID )->all();

	foreach ( $UserMeta as $meta ) {
		if ( isset( $User[ $meta['meta'] ] ) and ! is_array( $User[ $meta['meta'] ] ) ) {
			$gecici                  = $User[ $meta['meta'] ];
			$User[ $meta['meta'] ]   = array();
			$User[ $meta['meta'] ][] = $gecici;
			$User[ $meta['meta'] ][] = $meta['value'];
		} elseif ( isset( $User[ $meta['meta'] ] ) ) {
			if ( is_array( $User[ $meta['meta'] ] ) ) {
				$User[ $meta['meta'] ][] = $meta['value'];
			}
		} else {
			$User[ $meta['meta'] ] = $meta['value'];
		}
	}

	if ( $single != null ) {
		return $User[ $single ];
	} else {
		return $User;
	}


}

function checkUserPermission( $PerID ) {

	global $db;
	$Per = $db->from( 'permission' )->where( 'id', $PerID )->first();

	$PerList = json_decode( $Per['permission'], true );

	if ($_SESSION['UserType'] != 'admin' AND ! in_array( $_SESSION['UserType'], $PerList ) ) {
		include server_root_dir() . '/view/' . $scriptConfig['adminDIR'] . '/404.php';
	}
}
