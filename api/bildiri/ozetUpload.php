<?php

require_once '../api_include.php';

switch ( $requestMethod ) {
	case 'POST':

		$v = $_POST;

		$bildiriID = bildiriCreate( $v['yazar'], $v['title'] );

		$data = array(
			'note' => $v['note'],
			'fileID' => $v['fileID'],
		);


		bildiriTimelineStepAdd($bildiriID,$data,2);

		echo pageReturn( array( 'site' => array( 'operation' => 'reload', 'data' =>  metaBildiriYazar($bildiriID) ) ), 'site' );
}
