<?php


include '../api_include.php';

switch ( $requestMethod ) {
	case 'POST':


        $dosyaUzantisi = pathinfo( $_FILES['file']['name'], PATHINFO_EXTENSION );


        $filename = $scriptConfig['KYSID'].'-'.$_POST['bildiriID'].'-'.metaBildiriYazar($_POST['bildiriID'])['title'].'-'.$_POST['fileType'];

		$fileURL = uploadFile( $_FILES['file'], $filename );

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
			'fileName'  => $filename,
			'fileID'    => $db->lastId()
		) );

}
