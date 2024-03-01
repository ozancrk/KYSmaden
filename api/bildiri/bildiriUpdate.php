<?php

$requestMethod = $_SERVER['REQUEST_METHOD'];

require_once '../api_include.php';

switch ( $requestMethod ) {
	case 'POST':

		$veriable = $_POST;


		if ( $veriable['islem'] == 'status' ) {

			if ( $veriable['status'] == "on" ) {
				$Status = 1;
			} else {
				$Status = 0;
			}

			$db->update( 'bildiriler' )->where( 'id', $veriable['paperID'] )->set( [ 'status' => $Status ] );


			echo json_encode( array( 'operation' => 'none', 'basari' => 'İşlem Başarılı' ) );
		} elseif ( $veriable['islem'] == 'sunum' ) {

			$check = $db->from( 'bildiri_meta' )->where( 'meta', 'sunum' )->where( 'bildiri', $veriable['paperID'] )->cnt();

			if ( $check > 0 ) {
				$db->update( 'bildiri_meta' )->where( 'bildiri', $veriable['paperID'] )->where( 'meta', 'sunum' )->set( [
					'value' => $veriable['sunum'],
					'date'  => date( 'Y-m-d H:i:s', time() )
				] );
			} else {
				$db->insert( 'bildiri_meta' )->set( [
					'meta'    => 'sunum',
					'value'   => $veriable['sunum'],
					'bildiri' => $veriable['paperID'],
					'date'    => date( 'Y-m-d H:i:s', time() )
				] );
			}
			bildiriTimelineStepAdd( $veriable['paperID'], array( 'note' => '' ), 6 );
			echo json_encode( array( 'operation' => 'none', 'basari' => 'İşlem Başarılı' ) );
		} elseif ( $veriable['islem'] == 'editor' ) {


			$db->update( 'bildiriler' )->where( 'id', $veriable['paperID'] )->set( [ 'editor' => $veriable['editor'] ] );

            $db->insert( 'bildiri_timeline' )->set( [
                'islem' => 3,
                'bildiri' => $veriable['paperID'],
                'data' => json_encode(['editor'=>$veriable['editor']]),
                'date'  => date( 'Y-m-d H:i:s', time() )
            ] );

			echo json_encode( array( 'operation' => 'none', 'basari' => 'İşlem Başarılı' ) );


		} elseif ( $veriable['islem'] == 'editorNote' ) {


			$check = $db->from( 'bildiri_meta' )->where( 'meta', 'editorNote' )->where( 'bildiri', $veriable['paperID'] )->cnt();

			if ( $check > 0 ) {
				$db->update( 'bildiri_meta' )->where( 'bildiri', $veriable['paperID'] )->where( 'meta', 'editorNote' )->set( [
					'value' => $veriable['editorNote'],
					'date'  => date( 'Y-m-d H:i:s', time() )
				] );
			} else {
				$db->insert( 'bildiri_meta' )->set( [
					'meta'    => 'editorNote',
					'value'   => $veriable['editorNote'],
					'bildiri' => $veriable['paperID'],
					'date'    => date( 'Y-m-d H:i:s', time() )
				] );
			}

			echo json_encode( array( 'operation' => 'none', 'basari' => 'İşlem Başarılı' ) );


		} elseif ( $veriable['islem'] == 'konu' and $veriable['konu'] != 0 ) {


			$db->update( 'bildiriler' )->where( 'id', $veriable['paperID'] )->set( [ 'konu' => $veriable['konu'] ] );

			echo json_encode( array( 'operation' => 'none', 'basari' => 'İşlem Başarılı' ) );


		} elseif ( $veriable['islem'] == 'hakem' and $veriable['hakem'] != 0 ) {


			if ( empty( $veriable['sure'] ) ) {
				echo json_encode( array(
					'operation' => 'none',
					'hata'      => 'Değerlendirme Süresi Boş Olamaz!'
				) );
				die();
			}

			$data = array(
				'hakem'  => $veriable['hakem'],
				'sure'   => $veriable['sure'],
				'status' => 0
			);

			$hakemcheck = $db->from( 'userMeta' )->where( 'user', $veriable['hakem'] )->where( 'value', $veriable['bildiri'] )->where( 'meta', 'bildiri' )->cnt();

			if ( $hakemcheck < 1 ) {
				$db->insert( 'bildiri_meta' )->set( [
					'meta'    => 'hakem',
					'value'   => json_encode( $data ),
					'bildiri' => $veriable['bildiri'],
					'date'    => date( 'Y-m-d H:i:s', time() )
				] );

				$db->insert( 'userMeta' )->set( [
					'meta'  => 'bildiri',
					'value' => $veriable['bildiri'],
					'user'  => $veriable['hakem']
				] );


				if ( $veriable['mesajgonder'] == 1 ) {
					$v = array(
						'user'    => $veriable['hakem'],
						'bildiri' => $veriable['bildiri'],
					);


					/*
					 *
					 * Todo: Hakeme mesaj gönder
					 *
					 * */


				}

				bildiriTimelineStepAdd( $veriable['bildiri'], array(
					'note'  => 'Bildiri incelenmek üzere hakeme göndedildi. Son değerlendirme tarihi: ' . $veriable['sure'],
					'hakem' => $veriable['hakem']
				), 4 );
				echo json_encode( array( 'operation' => 'none', 'basari' => 'İşlem Başarılı' ) );
			} else {

				echo json_encode( array(
					'operation' => 'none',
					'hata'      => 'Bu hakem ilgili bildiriye daha önce atanmış!'
				) );
				die();

			}


		} elseif ( $veriable['islem'] == 'hakemkaldir' and $veriable['hakem'] != 0 ) {


			$db->delete( 'userMeta' )->where( 'meta', 'bildiri' )->where( 'value', $veriable['bildiri'] )->where( 'user', $veriable['hakem'] )->done();

			$bildirimeta = $db->from( 'bildiri_meta' )->where( 'meta', 'hakem' )->where( 'bildiri', $veriable['bildiri'] )->all();

			foreach ( $bildirimeta as $item ) {

				$data = json_decode( $item['value'], true );

				if ( $data['hakem'] == $veriable['hakem'] ) {

					$db->delete( 'bildiri_meta' )->where( 'id', $item['id'] )->done();
					bildiriTimelineStepAdd( $veriable['bildiri'], array(
						'note'  => 'Atama Editör tarafından kaldırıldı',
						'hakem' => $veriable['hakem']
					), 10 );

				}


			}

			echo json_encode( array( 'operation' => 'reload', 'basari' => 'İşlem Başarılı' ) );


		} elseif ( $veriable['islem'] == 'note' ) {


			$not = $db->from( 'bildiri_meta' )->where( 'meta', 'note' )->where( 'bildiri', $veriable['paperID'] )->cnt();

			if ( $not > 0 ) {
				$db->update( 'bildiri_meta' )->where( 'meta', 'note' )->where( 'bildiri', $veriable['paperID'] )->set( [
						'value' => $veriable['note'],
						'date'  => date( 'Y-m-d H:i:s', time() )
					] );
			} else {
				$db->insert( 'bildiri_meta' )->set( [
						'meta'    => 'note',
						'bildiri' => $veriable['paperID'],
						'value'   => $veriable['note'],
						'date'    => date( 'Y-m-d H:i:s', time() )
					] );
			}


			echo json_encode( array( 'operation' => 'reload', 'basari' => 'İşlem Başarılı' ) );


		}


}

