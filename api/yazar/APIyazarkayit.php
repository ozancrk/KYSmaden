<?php

$requestMethod = $_SERVER['REQUEST_METHOD'];

require_once '../api_include.php';

switch ( $requestMethod ) {
	case 'POST':

		$veriable = $_POST;


		$yazarcheck = $db->from( 'users' )->where( 'username', $veriable['email'] )->first();

		if ( $yazarcheck ) {
			$YazarID = $yazarcheck['id'];
            $db->update('users')->where('id',$YazarID)->set(['yazar'=>1]);
		} else {

            if ( $veriable['password2'] != $veriable['password'] ) {

                echo json_encode( array( 'operation' => 'none', 'hata' => langTranslate( 'Şifreler aynı değil' ) ) );
                die();

            }



			if ( $veriable['ulke'] == 'TR' ) {
				$lang = 'tr';
			} else {
				$lang = 'en';
			}
            // todo: şifre iptal edilecek
			$db->insert( 'users' )->set( [
				'username'     => $veriable['email'],
				'create_date' => date( 'Y-m-d H:i:s' ),
				'password'     => md5( $veriable['password'] ),
				'admin'         => 0,
				'hakem'         => 0,
				'editor'         => 0,
				'yazar'         => 1,
				'delege'         => 0,
				'sponsor'         => 0,
				'lang'         => $lang,
				'passbase64'   => base64_encode( $veriable['password'] )
			] );

			$YazarID = $db->lastId();

			foreach ( $veriable as $key => $value ) {

				if ( $key == 'type' or $key == 'email' or $key == 'captha' ) {
					continue;
				}

				$db->insert( 'userMeta' )->set( [
					'meta'  => $key,
					'value' => $value,
					'user' => $YazarID
				] );
			}
		}

		$_SESSION['authorID'] = $YazarID;

		$location = 'bildiri-gonderimi?step=2&authorID=' . $YazarID;

		sleep( 1 );

		echo json_encode( array( 'operation' => 'redirect', 'location' => $location ) );

}

