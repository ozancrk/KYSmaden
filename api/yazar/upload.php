<?php

require_once '../api_include.php';

$target_dir = server_root_dir() . '/uploads/';

$dosyaUzantisi = pathinfo( $_FILES['file']['name'], PATHINFO_EXTENSION );

if ( $dosyaUzantisi != 'doc' and $dosyaUzantisi != 'docx' and $dosyaUzantisi != 'pdf' ) {
	echo json_encode( array(
		'operation' => 'none',
		'hata'      => 'Yalnızca doc, docx ve pdf uzantılı dosya yükleyiniz.' . $dosyaUzantisi
	) );
	die();

}

if ( isset( $_POST['author'] ) ) {

	$db->insert( 'bildiriler' )->set( [
		'title'     => $_POST['title'],
		'yazar'    => $_POST['author'],
		'editor'   => 0,
		'konu'   => $_POST['konu'],
		'status'   => 0,
		'bildirim' => 0,
		'deleteStatus' => 0,
	] );

	$BildiriID = $db->lastId();


	$userMeta = getUserMeta( $_POST['author'] );

	$s = $scriptConfig['KYSID'].'-'. $BildiriID . '-' . $_POST['title'];

	$s = str_replace( $dosyaUzantisi, '', $s );

	$tr  = array( 'ş', 'Ş', 'ı', 'I', 'İ', 'ğ', 'Ğ', 'ü', 'Ü', 'ö', 'Ö', 'Ç', 'ç', '(', ')', '/', ' ', ',', '?' );
	$eng = array( 's', 's', 'i', 'i', 'i', 'g', 'g', 'u', 'u', 'o', 'o', 'c', 'c', '', '', '-', '-', '', '' );
	$s   = str_replace( $tr, $eng, $s );
	$s   = strtolower( $s );
	$s   = preg_replace( '/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s );
	$s   = preg_replace( '/\s+/', '-', $s );
	$s   = preg_replace( '|-+|', '-', $s );
	$s   = preg_replace( '/#/', '', $s );
	$s   = str_replace( '.', '', $s );
	$s   = trim( $s, '-' );

	$file = $s . '-' . date( "d.m.Y-H:i:s" );

	$file = substr($file,'0','30') . '.' . $dosyaUzantisi;

	$target_file = $target_dir . basename( $file );

	if ( move_uploaded_file( $_FILES["file"]["tmp_name"], $target_dir . $file ) ) {

		$db->insert( 'bildiri_timeline' )->set( [
			'islem'   => 2,
			'bildiri' => $BildiriID,
			'data'    => json_encode( array( 'file' => $file, 'note' => $_POST['note'] ) ),
			'date'    => date( 'Y-m-d H:i:s' ),
		] );


		$location = 'bildiri-gonderimi?step=3&author=' . $_POST['author'];

		//TODO:email_send( $_POST['writer'], 1 );

		echo json_encode( array( 'operation' => 'redirect', 'location' => $location, 'editorbildirim' => false ) );


	} else {


		echo json_encode( array( 'operation' => 'none', 'hata' => 'Dosya Yüklenemedi!2' ) );
		die();


	}
} else {

	echo json_encode( array( 'operation' => 'none', 'hata' => 'Dosya Yüklenemedi!1' ) );
	die();

}


