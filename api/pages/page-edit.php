<?php

require_once '../api_include.php';

switch ($requestMethod) {
    case 'POST':
        $v = $_POST;


        $pageMeta = getPageMeta($v['id']);

        if (isset($pageMeta['content_' . $v['lang']])) {
            $db->update('pageMeta')
                ->where('page', $v['id'])
                ->where('meta', 'content_' . $v['lang'])
                ->set([
                    'value' => $v['pageContent']
                ]);
        } else {
            $db->insert('pageMeta')
                ->set([
                    'value' => $v['pageContent'],
                    'page' => $v['id'],
                    'meta' => 'content_' . $v['lang'],
                ]);
        }

        $db->update('pages')
            ->where('id', $v['id'])
            ->set([
                $v['lang'] => $v[$v['lang']],
            ]);

        if($v['urlChance'] == 'on'){
            $db->update('pages')
                ->where('id', $v['id'])
                ->set([
                    'guid_'.$v['lang'] => seoLink($v[$v['lang']])
                ]);

        }


        echo pageReturn(array('operation' => 'reload', 'data' => $v));

}
