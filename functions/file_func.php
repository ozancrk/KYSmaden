<?php



function fileList( $type = array() ) {
	global $db;
	if ( $type == null ) {
		return $db->from( 'files' )->all();
	} else {
		$files  = $db->from( 'files' )->all();
		$return = array();
		$i      = 0;
		foreach ( $files as $file ) {

			if ( in_array( $file['type'], $type ) ) {
				$return[ $i ] = $file;
				$i ++;
			}

		}

		return $return;

	}

}

function fileMeta( $fileID, $single = null ) {
	global $db;

	$file = $db->from( 'files' )->where( 'id', $fileID )->first();

	if ( $single == null ) {
		return $file;
	} elseif ( isset( $file[ $single ] ) ) {
		return $file[ $single ];
	} else {
		return false;
	}

}
