<?php

require_once '../api_include.php';


if (!isset($_POST['fileID'])) {
    echo json_encode(array(
        'operation' => 'none',
        'hata' => 'Bir Dosya yüklemelisiniz!'
    ));
    die();
}


if ($_POST['fileType'] == 'ozet-revize') {

    $stepislem = 11;

} elseif ($_POST['fileType'] == 'tam-metin-revize') {
    $stepislem = 12;

} elseif ($_POST['fileType'] == 'tam-metin') {
    $stepislem = 8;

}

$data = json_encode(array('file' => fileMeta($_POST['fileID'], 'name'), 'note' => $_POST['notes']));

$db->insert('bildiri_timeline')->set([
    'islem' => $stepislem,
    'bildiri' => $_POST['bildiri'],
    'data' => $data,
    'date' => date('Y-m-d H:i:s'),
]);


echo json_encode(array('operation' => 'reload', 'sleep' => 3000, 'basari' => 'Kaydınız başarıyla yapılmıştır.'));
