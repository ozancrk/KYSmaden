<?php


function listPages(){
    global $db;

    return $db->from('pages')->where('type','file', '!=')->all();

}

function getPageMeta($pageID){

    global $db;

    $pageMeta = $db->from('pages')->where('id',$pageID)->first();

    foreach ($db->from('pageMeta')->where('page',$pageID)->all() as $item){
        $pageMeta[$item['meta']] = $item['value'];
    }
    return $pageMeta;


}

function getPageMetaByGuid($guid){

    global $db;

    $pageMeta = $db->from('pages')->where('guid_tr',$guid)->or_where('guid_en',$guid)->first();

    if(!$pageMeta){
        return false;
    }

    foreach ($db->from('pageMeta')->where('page',$pageMeta['id'])->all() as $item){
        $pageMeta[$item['meta']] = $item['value'];
    }
    return $pageMeta;


}