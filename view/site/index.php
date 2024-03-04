<?php

$URLExplode = explode('?', $URL);

if (empty($URLExplode[0])) {

    include $SiteLang . '/home.php';


} else {


    $PageMeta = getPageMetaByGuid($URLExplode[0]);

    if ($PageMeta) {
        if ($PageMeta['type'] == 'file') {
            include $SiteLang . '/' . $URLExplode[0] . '.php';
        } else {

            include $SiteLang . '/page.php';


        }


    }else{
        include $SiteLang . '/404.php';
    }


}
