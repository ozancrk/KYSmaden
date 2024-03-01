<?php


$paperMeta = metaBildiriYazar($_GET['paperID']);

$bildiriHakemMeta = json_decode(bildiriHakemMeta($_SESSION['UserID'], $_GET['paperID'])['value'], true);

$userMeta = getUserMeta($paperMeta['yazar']);

if (!isset($paperMeta['sunum'])) {
    $paperMeta['sunum'] = 0;
}

/*

todo: Hakem değerlendirme dosyasını ekle,  Hakem Sonuçlarını, atanmış hakemler, timeline, düzenlemeye açık kapalı kısmı forma uygun olacak

 * */


?>

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Bildiri Bilgileri</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Bildiriler</a></li>
                            <li class="breadcrumb-item active">Bildiri Bilgileri</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <?php if (!$paperMeta){ ?>
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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-justified mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab">
                                Yazar ve Bildiri Detayları
                            </a>
                        </li>
                    </ul>

                    <?php


                    ?>

                    <!-- Tab panes -->
                    <div class="tab-content text-muted">
                        <div class="tab-pane active" id="home" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">Bildiri Bilgileri</h5>
                                            <div class="table-responsive">
                                                <table class="table table-borderless mb-0">
                                                    <tbody>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Başlık</th>
                                                        <td class="text-muted">Bildiri Başlığı</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Durum</th>
                                                        <td class="text-muted"><?= bildiriStatus($paperMeta['sonislem']['islem'], $SiteLang) ?></td>
                                                    </tr>
                                                    <?php if ($paperMeta['konu'] == 0) { ?>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Konu</th>
                                                            <td class="text-muted">Konu Seçilmedi!</td>
                                                        </tr>
                                                    <?php } else { ?>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Konu</th>
                                                            <td class="text-muted"><?= getTopicMeta($paperMeta['konu'])[$SiteLang] ?></td>
                                                        </tr>
                                                    <?php } ?>


                                                    <tr>
                                                        <th class="ps-0" scope="row">Son Değerlendirme Tarihi:</th>
                                                        <td class="text-muted"><?= date('d.m.Y', strtotime($bildiriHakemMeta['sure'])) ?></td>
                                                    </tr>

                                                    <?php if ($_SESSION['admin']): ?>

                                                        <tr>
                                                            <th class="ps-0" scope="row">SİL</th>
                                                            <?php createJSObj('sil' . $_GET['paperID'], array('userID' => $_GET['paperID'])); ?>
                                                            <td class="text-muted">
                                                                <button class="btn btn-danger"
                                                                        onclick="processConfirm('bildiriDelete','<?= setFormTokenSession() ?>',<?= 'sil' . $_GET['paperID'] ?>)">
                                                                    SİL
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>
                                <div class="col-12">
                                    <table id="example2"
                                           class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                           style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>İşlem</th>
                                            <th>Ekler</th>
                                            <th>İşlem Tarihi ve Saati</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                        $timeline = $db->from('bildiri_timeline')->
                                        where('bildiri', $_GET['paperID'])->
                                        in('islem', [2, 8, 11, 12])->
                                        orderBy('date', 'DESC')->
                                        all();

                                        foreach ($timeline as $item) {

                                            $Data = json_decode($item['data'], true);
                                            ?>
                                            <tr>
                                                <td><?php echo bildiriStatus($item['islem'], $_SESSION['lang']); ?></td>
                                                <td><?php


                                                    if (isset($Data['file'])) {

                                                        echo islemEkleri('file', ['file' => $Data['file']]);

                                                    }
                                                    if (in_array($item['islem'], [13])) {
                                                        echo islemEkleri('modal', ['modalBody' => $Data['mesaj'], 'btnText' => 'Mesaj']);
                                                    }


                                                    ?></td>
                                                <td data-sort="<?= strtotime($item['date']) ?>"><?= date('d.m.Y h:i:s', strtotime($item['date'])) ?></td>


                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">Değerlendirme</h5>
                                            <?php

                                            include 'sorular.php';

                                            $returnSoruFormElem[] =
                                                ['type' => 'file',
                                                    'name' => 'files',
                                                    'id' => 'files',
                                                    'label' => ' Değerlendirme dosyası (Lütfen *doc,*docx uzantılı dosya ekleyiniz!) ',
                                                    'required' => true,
                                                ];
                                            $returnSoruFormElem[] =
                                                ['type' => 'hidden',
                                                    'name' => 'fileType',
                                                    'id' => 'fileType',
                                                    'value' => 'hakem-degerlendirmesi'
                                                ];
                                            $returnSoruFormElem[] =
                                                ['type' => 'textarea',
                                                    'name' => 'note-editor',
                                                    'id' => 'note-editor',
                                                    'label' => ' Editöre Notlarınız (Yalnızca editör tarafından görülecektir) '
                                                ];
                                            $returnSoruFormElem[] =
                                                ['type' => 'textarea',
                                                    'name' => 'note-yazar',
                                                    'id' => 'note-yazar',
                                                    'label' => '  Yazara Notlarınız  '
                                                ];
                                            $returnSoruFormElem[] =
                                                [
                                                    'type' => 'hidden',
                                                    'name' => 'upload',
                                                    'value' => 'files',
                                                ];
                                            $returnSoruFormElem[] =
                                                [
                                                    'type' => 'hidden',
                                                    'name' => 'bildiriEk',
                                                    'id' => 'bildiriEk',
                                                    'value' => true,
                                                ];
                                            $returnSoruFormElem[] =
                                                [
                                                    'type' => 'hidden',
                                                    'name' => 'bildiri',
                                                    'id' => 'bildiri',
                                                    'value' => $_GET['paperID'],
                                                ];
                                            $returnSoruFormElem[] =
                                                [
                                                    'type' => 'hidden',
                                                    'name' => 'hakem',
                                                    'id' => 'hakem',
                                                    'value' => $_SESSION['UserID'],
                                                ];
                                            $returnSoruFormElem[] =
                                                [
                                                    'type' => 'hidden',
                                                    'name' => 'postUrl',
                                                    'value' => 'bildiri/hakemdegerlendirme',
                                                ];


                                            echo createForm(
                                                [
                                                    'id' => 'serialize',
                                                    'buttonText' => 'Gönder',
                                                    'elements' => $returnSoruFormElem
                                                ]
                                            );
                                            ?>

                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>

                            </div>
                        </div>


                    </div>

                </div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>
    <!--end col-->
</div>

<?php } ?>
</div>
</div>
