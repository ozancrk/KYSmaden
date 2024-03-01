<?php

require_once '../api_include.php';


if (!isset($_POST['fileID'])) {
    echo json_encode(array(
        'operation' => 'none',
        'hata' => 'Bir Dosya yüklemelisiniz!'
    ));
    die();
}

$stepislem = 9;



$metaupdate = $db->from( 'bildiri_meta' )
    ->where( 'meta', 'hakem' )
    ->where( 'bildiri', $_POST['bildiri'] )
    ->all();




foreach ( $metaupdate as $item ) {

    $data = json_decode( $item['value'], true );

    if ( $data['hakem'] == $_POST['hakem'] ) {


        foreach ($_POST as $key => $value){


            if(strstr($key,'soru-')){

                $data['yanit'][str_replace('soru-','',$key)] = $value;

            }

        }

        $data['degerlendirme'] = 1;
        $data['gorus']         = $data['yanit'][12];
        $data['statusEditor']         = $_POST['note-editor'];
        $data['statusYazar']         = $_POST['note-yazar'];
        $data['status']        = 1;
        $updateid              = $data['hakem'];

        if(isset($_POST['fileID'])){
            $data['file']        = fileMeta($_POST['fileID'])['name'];
        }
        bildiriTimelineStepAdd( $_POST['bildiri'], $data, 9 );
        $db->update( 'bildiri_meta' )
            ->where( 'id', $item['id'] )
            ->set( [
                'value' => json_encode( $data )
            ] );

    }

}






$data = json_encode(array('file' => fileMeta($_POST['fileID'], 'name'), 'note' => $_POST['notes']));

$db->insert('bildiri_timeline')->set([
    'islem' => $stepislem,
    'bildiri' => $_POST['bildiri'],
    'data' => $data,
    'date' => date('Y-m-d H:i:s'),
]);


echo json_encode(array('operation' => 'none', 'sleep' => 3000, 'basari' => 'Kaydınız başarıyla yapılmıştır.'));
