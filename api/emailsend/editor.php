<?php


require_once '../api_include.php';


$Bildiriler = $db->from( 'bildiriler' )->where( 'bildirim', 0 )->all();

$alici = array();

foreach ( listUser( 'editor' ) as $editor ) {

	$alici[] = $editor['username'];

}

foreach ( $Bildiriler as $bildiri ) {

	$db->update( 'bildiriler' )->where( 'id', $bildiri['id'] )->set( [
			'bildirim' => 1
		] );


	$UserMeta = metaUser( $bildiri['yazar'] );

	$bildiridetails = '
		<ul>
		<li>Bildiri Yazarı: ' . $UserMeta["name"] . '</li>
		<li>E-Posta: ' . $UserMeta["username"] . '</li>
		<li>Kurum: ' . $UserMeta["kurum"] . '</li>
		<li>Telefon: ' . $UserMeta["telefon"] . '</li>
		<li>Bildiri Adı: ' . $bildiri["name"] . '</li>
		</ul>
		';

	$emailcontent = $db->from( 'mailsablon' )->where( 'id', 24 )->first();

	$content = str_replace( '##BİLDİRİ BİLGİLERİ##', $bildiridetails, $emailcontent['tr'] );

	//sendmaileditor( $alici, 'UYAK2023 | Yeni Bildiri Yüklendi', $content );

	$db->update( 'bildiriler' )->where( 'id', $bildiri['id'] )->set( [
			'bildirim' => 1
		] );

}


