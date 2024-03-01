<?php


function seoLink( $s ) {
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

	return $s;
}

function stringToArray( $string ) {
	if ( is_array( $string ) ) {
		return $string;
	} else {
		return array( $string );
	}
}

function URLfolderCheck( $URL, $array ) {
	$urlparts = explode( '/', $URL );
	if ( in_array( $urlparts[0], $array ) ) {
		return true;
	}

	return false;
}

function URLseperateGet( $URL ) {
	$urlparts = explode( '?', $URL );

	return $urlparts[0];
}

function urlCreate( $URL ) {
	return currentAdminDIR() . '/' . $URL;
}

function keyDetails( $key, $type = false ) {
	global $db;
//	$keyDetails = $db->from('keys')->where('label',$key)->where('type',$type)->first();
//
//	if($keyDetails){
//		return $keyDetails;
//	}else{
	$keyDetails = $db->from( 'keys' )->where( 'label', $key )->first();
	if ( $keyDetails ) {
		return $keyDetails;
	} else {
		return array( 'tr' => $key, 'en' => $key );
	}
//	}

}


function sidebarCreate( $userType ) {
	global $menu;
	$SiteLang = $_SESSION['lang'];

	if ( $_SESSION[ $userType ] ) {


		foreach ( $menu[$userType] as $item ) {
			if ( $item['dropdown'] ) {

				$out = '';
				foreach ( $item['SUB'] as $sub ) {

					$out .= ' <li class="nav-item">
                                                                                <a href="' . currentAdminDIR() . '/' . $sub['URL'] . '"
                                                                                   class="nav-link"
                                                                                   data-key="t-utilities">' . $sub['name'][ $SiteLang ] . '</a>
                                                                            </li>';

				}

				echo ' <li class="nav-item">';
				echo '<a class="nav-link menu-link collapsed"
                                                               href="#' . str_replace( ' ', '', $item['name'][ $SiteLang ] ) . '" data-bs-toggle="collapse"
                                                               role="button" aria-expanded="false"
                                                               aria-controls="sidebarUI">
                                                                ' . $item['icon'] . '
                                                                <span data-key="t-base-ui">' . $item['name'][ $SiteLang ] . '</span>
                                                            </a>';
				echo '<div class="collapse menu-dropdown mega-dropdown-menu"
                                                                 id="' . str_replace( ' ', '', $item['name'][ $SiteLang ] ) . '">';
				echo '<div class="row">
                                                                    <div class="col-lg-4">
                                                                        <ul class="nav nav-sm flex-column">';
				echo $out;
				echo '</ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>';


			} else {

				if ( isset( $item['type'] ) and $item['type'] == 'title' ) {

					echo '<li class="menu-title"><span data-key="t-pages">' . $item['name'][ $SiteLang ] . '</span></li>';


				} else {

					echo '<li class="nav-item">
                                                            <a class="nav-link menu-link" href="' . currentAdminDIR() . '/' . $item['URL'] . '">
                                                            ' . $item['icon'] . '
                                                                <span data-key="t-widgets">' . $item['name'][ $SiteLang ] . '</span>
                                                            </a>
                                                        </li>';
				}
			}

		}


	}


}
