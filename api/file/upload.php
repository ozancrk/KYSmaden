<?php


include '../api_include.php';

switch ( $requestMethod ) {
	case 'POST':

		$dosyaUzantisi = pathinfo( $_FILES['file']['name'], PATHINFO_EXTENSION );

		$fileURL = uploadFile( $_FILES['file'], 'same' );

		$db->insert( 'files' )->
		set( [
			'url'  => $fileURL['fileurl'],
			'name' => $fileURL['fileName'],
			'type' => $fileURL['type'],
			'time' => date( 'Y-m-d H:i:s' )
		] );


		echo pageReturn( array(
			'operation' => 'none',
			'fileUrl'   => $fileURL['fileurl'],
			'fileName'  => $fileURL['fileName'],
			'fileID'    => $db->lastId()
		) );

}
