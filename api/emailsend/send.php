<?php

$requestMethod = $_SERVER['REQUEST_METHOD'];

require_once '../api_include.php';

switch ( $requestMethod ) {
	case 'POST':

		$v       = $_POST;
		$mesaj   = $v['mesaj'];


		$bildiri = metaBildiriYazar( $v['paperID'] );
        $alici   = getUserMeta( $bildiri['yazar'] );


        $mesaj = str_replace( '##BİLDİRİ BAŞLIK##', $bildiri['title'], $mesaj );

		if ( $v['editorMesajID'] == 'yazarmesaj' ) {
			$mesaj = str_replace( '##BİLDİRİ YAZAR SAHİBİ##', $alici['name'], $mesaj );
			$mesaj = str_replace( '##BİLDİRİ YÖNETİM SİSTEMİ##', $scriptConfig['adminurl'], $mesaj );
			$mesaj = str_replace( '##YAZAR KULLANICI ADI##', $alici['username'], $mesaj );
			$mesaj = str_replace( '##YAZARSİFRE##', base64_decode( $alici['passbase64'] ), $mesaj );
		}

		if ( $alici['type'] == 'hakem' ) {

			$red = '<a target="_blank" href="'.$scriptConfig['mainurl'].'/feedback/?status=red&bildiri='.$v['bildiri'].'&hakem='.$v['user'].'">REDDET</a>';
			$kabul = '<a target="_blank" href="'.$scriptConfig['mainurl'].'/feedback/?status=kabul&bildiri='.$v['bildiri'].'&hakem='.$v['user'].'">KABUL ET</a>';


			$mesaj = str_replace( '##HAKEM ADI##', $alici['name'], $mesaj );

			$mesaj = str_replace( '##BİLDİRİ KABUL##', $kabul, $mesaj );
			$mesaj = str_replace( '##BİLDİRİ RED##', $red, $mesaj );

			$mesaj = str_replace( '##BİLDİRİ YÖNETİM SİSTEMİ##', $scriptConfig['adminurl'], $mesaj );
			$mesaj = str_replace( '##HAKEM KULLANICI ADI##', $alici['username'], $mesaj );
			$mesaj = str_replace( '##HAKEM ŞİFRE##', base64_decode( $alici['passbase64'] ), $mesaj );
			$mesaj = str_replace( '##BİLDİRİ LİSTE## ', '', $mesaj );
		}

		$mesaj = str_replace( '##ETKİNLİK ADI##', $scriptConfig['header_title'], $mesaj );


		$hakemFile = stringToArray( $v['hakemFile'] );






		$mesajStatus = sendmail( $alici['username'], $scriptConfig['header_title'], $mesaj,$hakemFile );


        if($mesajStatus == 1){
            if($v['yazar_mesaj'] == 15){
                $data = ['note'=>'Bildiri Özeti Kabul Edildi','mesaj'=>$mesaj];
                bildiriTimelineStepAdd($v['paperID'],$data,13);
                $islem = $db->update( 'bildiriler' )->where( 'id', $v['paperID'] )->set( [ 'status' => 1 ] );
            }
            if($v['yazar_mesaj'] == 25){
                $data = json_encode(array('note'=>'Bildiri Özeti Reddedildi','mesaj'=>$mesaj));
                bildiriTimelineStepAdd($v['paperID'],$data,14);

            }

            if($v['yazar_mesaj'] == 9 OR $v['yazar_mesaj'] == 7){

                $db->update('bildiriler')
                    ->where('id',$v['paperID'])
                    ->set([
                        'view' => 1
                    ]);


            }
        }

        echo $mesajStatus;



}
