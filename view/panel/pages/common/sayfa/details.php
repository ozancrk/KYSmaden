<?php


$pageMeta = getPageMeta($_GET['pageID']);


$userMeta = getPageMeta($_GET['pageID']);

if ($_GET['pageLang']) {
    $pageLang = $_GET['pageLang'];
} else {
    $pageLang = 'tr';
}

?>

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"><?= $pageMeta[$SiteLang] ?></h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Sayfalar</a></li>
                            <li class="breadcrumb-item active"><?= $pageMeta[$SiteLang] ?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <?php if (!$pageMeta){ ?>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Hatalı Bildiri ID'si</h4>
                        </div><!-- end card header -->
                    </div>
                </div>
            </div>
        <?php }else{ ?>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary" href="/panel/sayfa/details?pageID=<?=$_GET['pageID']?>&pageLang=<?=($pageLang == 'tr'?'en':'tr')?>">
                        <?=($pageLang == 'tr'?'İngilizce İçerik Düzenle':'Türkçe İçerik Düzenle')?>
                    </a>
                    <a target="_blank" class="btn btn-success" href="<?=$scriptConfig['mainURL'] . '/' . $pageMeta['guid_' . $pageLang]?>">
                        Sayfayı Aç
                    </a>
                <div class="card-body">

                    <?php

                    echo createForm(
                        array(
                            'id' => 'serialize',
                            'buttonText' => 'Gönder',
                            'elements' =>
                                array(
                                    array(
                                        'type' => 'text',
                                        'label' => 'Başlık',
                                        'name' => $pageLang,
                                        'value' => $pageMeta[$pageLang]
                                    ),
                                    array(
                                        'type' => 'text',
                                        'label' => 'URL',
                                        'name' => 'url',
                                        'value' => $scriptConfig['mainURL'] . '/' . $pageMeta['guid_' . $pageLang],
                                        'disabled' => true
                                    ),
                                    array(
                                        'type' => 'checkbox',
                                        'label' => 'Sayfa linkini başlığa göre düzenle',
                                        'name' => 'urlChance',
                                        'value' => 0
                                    ),
                                    array(
                                        'type' => 'ckeditor',
                                        'collabel' => '6',
                                        'colinput' => '6',
                                        'id' => 'trPage',
                                        'value' => $pageMeta['content_' . $pageLang]
                                    ),
                                    array(
                                        'type' => 'hidden',
                                        'name' => 'paperID',
                                        'value' => $_GET['paperID']
                                    ),
                                    array(
                                        'type' => 'hidden',
                                        'name' => 'islem',
                                        'value' => 'mesajGonder'
                                    ),
                                    array(
                                        'type' => 'hidden',
                                        'name' => 'ckeditor',
                                        'value' => $pageLang . 'Page'
                                    ),
                                    array(
                                        'type' => 'hidden',
                                        'name' => 'id',
                                        'value' => $_GET['pageID']
                                    ),
                                    array(
                                        'type' => 'hidden',
                                        'name' => 'lang',
                                        'value' => $pageLang
                                    ),
                                    array(
                                        'type' => 'hidden',
                                        'name' => 'postUrl',
                                        'value' => 'pages/page-edit'
                                    )
                                )
                        )
                    );


                    ?>

                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
</div>
