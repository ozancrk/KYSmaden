<?php


if(empty($URL)){

	include $SiteLang.'/home.php';


}else{

   $URLExplode  = explode('?',$URL);

    $PageMeta = getPageMetaByGuid($URLExplode[0]);

    if($PageMeta['type'] == 'file'){
        include $SiteLang.'/'.$URLExplode[0].'.php';
    }

    echo $SiteLang.'/'.$URLExplode[0].'.php';

}
