<?php


include '../api_include.php';

switch ($requestMethod) {
    case 'POST':

        $dosyaUzantisi = pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION);

        $fileURL = uploadFile($_FILES['upload'], 'same');

        $db->insert('files')->
        set([
            'url' => $fileURL['fileurl'],
            'name' => $fileURL['fileName'],
            'type' => $fileURL['type'],
            'time' => date('Y-m-d H:i:s')
        ]);

        echo json_encode([
            'url' => $scriptConfig['mainURL'] . '/' . $fileURL['fileurl'],
            'uploaded' => 'true'
        ]);

}
