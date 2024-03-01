<?php

require_once '../api_include.php';

switch ( $requestMethod ) {
	case 'POST':

		$v = $_POST;

		$delete = $db->update( 'bildiriler' )->where( 'id', $v['bildiriID'] )->set( [ 'deleteStatus' => 1 ] );



		echo json_encode( array( 'operation' => 'redirect', 'location'=>'admin/bildiri/list', 'basari' => 'İşlem Başarılı' ) );


}
