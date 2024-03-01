<?php


$paperMeta = metaBildiriYazar($_GET['paperID']);

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
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#options" role="tab">
                                Bildiri Ayarları
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#timeline" role="tab">
                                Zaman Çizelgesi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#editor" role="tab">
                                Editör İşlemleri
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#hakem" role="tab">
                                Hakem İşlemleri
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#yazar" role="tab">
                                Yazar İşlemleri
                            </a>
                        </li>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content text-muted">
                        <div class="tab-pane active" id="home" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">Yazar Bilgileri</h5>
                                            <div class="table-responsive">
                                                <table class="table table-borderless mb-0">
                                                    <tbody>
                                                    <?php
                                                    foreach ($userMeta as $key => $value) {
                                                        $keyDetails = keyDetails($key, 'user');
                                                        if ($keyDetails['tr'] == '0') {
                                                            continue;
                                                        }
                                                        ?>
                                                        <tr>
                                                            <th class="ps-0"
                                                                scope="row"><?= $keyDetails[$SiteLang] ?></th>
                                                            <td class="text-muted"><?= $value ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>
                                <div class="col-md-6 col-12">
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
                                                        <th class="ps-0" scope="row">Son Güncelleme</th>
                                                        <td class="text-muted"><?= date("d.m.Y H:i:s", strtotime($paperMeta['sonislem']['date'])); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Oluşturma Tarihi</th>
                                                        <td class="text-muted"><?= date("d.m.Y H:i:s", strtotime($paperMeta['ekleme']['date'])); ?></td>
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
                                    <table id="example"
                                           class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                           style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>Hakem</th>
                                            <th>e-Posta</th>
                                            <th>Durum</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                        $hakemler = $db->from('bildiri_meta')->where('bildiri', $_GET['paperID'])->where('meta', 'hakem')->all();

                                        foreach ($hakemler as $item) {

                                            $Data = json_decode($item['value'], true);
                                            ?>
                                            <tr>
                                                <td><?php echo getUserMeta($Data['hakem'], 'name'); ?></td>
                                                <td><?php echo getUserMeta($Data['hakem'], 'username'); ?></td>
                                                <td><?php

                                                    if ($Data['status'] == 0) {

                                                        echo 'Beklemede';

                                                    } else {
                                                        if (isset($Data['note'])) {
                                                            echo $Data['note'];
                                                        }
                                                        if (isset($Data['gorus'])) {
                                                            echo $Data['gorus'];
                                                        }
                                                        if (!isset($Data['note']) and !isset($Data['gorus'])) {
                                                            echo $Data['status'];
                                                        }
                                                    }


                                                    ?></td>
                                                <td>

                                                    <?php createJSObj('data' . $Data['hakem'], array('hakem' => $Data['hakem'], 'bildiri' => $_GET['paperID'])); ?>
                                                    <button onclick="processConfirm('hakematamakaldir','<?= setFormTokenSession() ?>',<?= 'data' . $Data['hakem'] ?>)"
                                                            class="btn btn-primary">
                                                        <i class="la la-check-square-o"></i> <?= langTranslate('Atamayı kaldır', $SiteLang) ?>
                                                    </button>
                                                </td>


                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="timeline" role="tabpanel">
                            <div class="row">
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
                            </div>
                        </div>
                        <div class="tab-pane" id="options" role="tabpanel">
                            <div class="row">
                                <div class="col-12">
                                    <table id="example2"
                                           class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                           style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>İşlem</th>
                                            <th>Dosya</th>
                                            <th>İşlem Tarihi ve Saati</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                        $timeline = $db->from('bildiri_timeline')->
                                        where('bildiri', $_GET['paperID'])->
                                        orderBy('date', 'DESC')->
                                        in('islem', [2, 8, 11, 12])->
                                        all();

                                        foreach ($timeline as $item) {

                                            $Data = json_decode($item['data'], true);
                                            ?>
                                            <tr>
                                                <td><?php echo bildiriStatus($item['islem'], $_SESSION['lang']); ?></td>
                                                <td><a href="/uploads/<?= $Data['file'] ?>" class="btn btn-success">İNDİR</a>
                                                </td>
                                                <td><?= date('d.m.Y h:i:s', strtotime($item['date'])) ?></td>


                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">Düzenleme Ayarları</h5>
                                            <?php
                                            echo createForm(array('id' => 'serialize', 'buttonText' => 'Kaydet', 'elements' => array(array('type' => 'checkbox', 'collabel' => '6', 'colinput' => '6', 'id' => 'id', 'name' => 'status', 'label' => ($paperMeta['status'] == 1 ? 'DÜZENLENEBİLİR' : 'DÜZENLENEMEZ'), 'value' => $paperMeta['status'],), array('type' => 'hidden', 'name' => 'paperID', 'value' => $_GET['paperID'],), array('type' => 'hidden', 'name' => 'islem', 'value' => 'status',), array('type' => 'hidden', 'name' => 'postUrl', 'value' => 'bildiri/bildiriUpdate',))));
                                            ?>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">Sunum Tercihi</h5>
                                            <?php echo createForm(array('id' => 'serialize', 'buttonText' => 'Kaydet', 'elements' => array(array('type' => 'select', 'collabel' => '6', 'colinput' => '6', 'name' => 'sunum', 'label' => 'Sunum Tercihi', 'option' => [['id' => '0', 'name' => '---'], ['id' => '1', 'name' => 'Sözlü Sunum'], ['id' => '2', 'name' => 'Poster Sunumu']], 'value' => $paperMeta['sunum']), array('type' => 'hidden', 'name' => 'paperID', 'value' => $_GET['paperID'],), array('type' => 'hidden', 'name' => 'islem', 'value' => 'sunum',), array('type' => 'hidden', 'name' => 'postUrl', 'value' => 'bildiri/bildiriUpdate',))));
                                            ?>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">Editör</h5>
                                            <?php

                                            $editor = getUserList('editor');
                                            array_unshift($editor, ['id' => 0, 'name' => '---']);

                                            echo createForm(array('id' => 'serialize', 'buttonText' => 'Kaydet', 'elements' => array(array('type' => 'select', 'collabel' => '6', 'colinput' => '6', 'name' => 'editor', 'label' => 'Editör', 'optionValue' => 'id', 'optionText' => 'name', 'option' => $editor, 'value' => $paperMeta['editor']), array('type' => 'hidden', 'name' => 'paperID', 'value' => $_GET['paperID'],), array('type' => 'hidden', 'name' => 'islem', 'value' => 'editor',), array('type' => 'hidden', 'name' => 'postUrl', 'value' => 'bildiri/bildiriUpdate',))));
                                            ?>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">Konu Başlığı</h5>
                                            <?php echo createForm(array('id' => 'serialize', 'buttonText' => 'Kaydet', 'elements' => array(array('type' => 'select', 'collabel' => '6', 'colinput' => '6', 'name' => 'konu', 'optionValue' => 'id', 'optionText' => $SiteLang, 'label' => 'Konu Başlığı', 'option' => getTopicList()), array('type' => 'hidden', 'name' => 'paperID', 'value' => $_GET['paperID'],), array('type' => 'hidden', 'name' => 'islem', 'value' => 'konu',), array('type' => 'hidden', 'name' => 'postUrl', 'value' => 'bildiri/bildiriUpdate',))));
                                            ?>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="hakem" role="tabpanel">
                            <div class="row">

                                <div class="col-md-12 col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">Hakeme Mesaj</h5>

                                            <?php

                                            $hakemler = $db->from('userMeta')->where('meta', 'bildiri')->where('value', $_GET['paperID'])->all();
                                            $paperHakem = [];
                                            foreach ($hakemler as $item) {
                                                $paperHakem[] = ['id' => $item['user'], 'name' => getUserMeta($item['user'], 'name')];
                                            }

                                            $timeline = $db->from('bildiri_timeline')->where('bildiri', $_GET['paperID'])->where('islem', 7)->all();
                                            $paperHakemDeger = '<ul><h3>Hakem değerlendirme dosyasını ekle</h3>';
                                            foreach ($timeline as $item) {

                                                $datas = json_decode($item['data'], true);


                                                $paperHakemDeger .= '<li><input type="checkbox" id="h-' . $item['id'] . '" name="hakemFile" value="' . $datas['file'] . '" style="margin-right:5px;">
                                                        <label for="h-' . $item['id'] . '">' . getUserMeta($datas['hakem'], 'name') . ' - ' . $datas['yanit'][12] . '</label></li>';

                                            }
                                            $paperHakemDeger = '</ul>';

                                            echo createForm(array('id' => 'serialize', 'buttonText' => 'Gönder', 'elements' => array(array('type' => 'select', 'collabel' => '6', 'colinput' => '6', 'id' => 'hakem', 'class' => 'mesaj', 'name' => 'hakem', 'optionValue' => 'id', 'optionText' => 'name', 'label' => 'Hakem Seç', 'option' => $paperHakem), array('type' => 'select', 'collabel' => '6', 'colinput' => '6', 'id' => 'hakem', 'class' => 'mesaj', 'name' => 'hakem_mesaj', 'optionValue' => 'id', 'optionText' => 'aciklama', 'label' => 'Hazır Mesaj', 'option' => $db->from('mailsablon')->where('kime', 'hakem')->all()), array('type' => 'editor', 'collabel' => '6', 'colinput' => '6', 'id' => 'hakemmesaj'), array('type' => 'custom', 'value' => $paperHakemDeger), array('type' => 'hidden', 'name' => 'paperID', 'value' => $_GET['paperID'],), array('type' => 'hidden', 'name' => 'islem', 'value' => 'mesajGonder',), array('type' => 'hidden', 'name' => 'postUrl', 'value' => 'emailsend/send',))));
                                            ?>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">Hakem Ataması</h5>
                                            <table id="example1"
                                                   class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                                   style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th>İsim</th>
                                                    <th>Uzmanlık Alanı</th>
                                                    <th>Kurum</th>
                                                    <th>Değerlendirme Süresi</th>
                                                    <th>Bildirim Gönder</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach (getUserList('hakem') as $User): ?>
                                                    <tr>
                                                        <td><?= $User['unvan'] . ' ' . $User['name'] ?></td>
                                                        <td><?= $User['uzmanlık'] ?></td>
                                                        <td><?= $User['kurum'] ?></td>
                                                        <td><input type="date" class="form-control"
                                                                   name="sure_<?php echo $User['id']; ?>"
                                                                   id="sure_<?php echo $User['id']; ?>"
                                                                   required></td>
                                                        <td>
                                                            <select name="mesajgonder_<?php echo $User['id']; ?>"
                                                                    id="mesajgonder_<?php echo $User['id']; ?>"
                                                                    class="form-control">
                                                                <option value="0">MESAJ GÖNDERME</option>
                                                                <option value="1">MESAJ GÖNDER</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <?php createJSObj('data' . $User['id'], array('hakem' => $User['id'], 'bildiri' => $_GET["paperID"])); ?>
                                                            <button onclick="processConfirm('hakemata','<?= setFormTokenSession() ?>',<?= 'data' . $User['id'] ?>)"
                                                                    class="btn btn-primary">
                                                                <i class="la la-check-square-o"></i> <?= langTranslate('Gönder', $SiteLang) ?>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane" id="editor" role="tabpanel">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <?php echo createForm(array('id' => 'serialize', 'buttonText' => 'Kaydet', 'elements' => array(array('type' => 'select', 'collabel' => '6', 'colinput' => '6', 'name' => 'editor', 'value' => $paperMeta['editor'], 'optionValue' => 'id', 'optionText' => 'name', 'label' => 'Editör', 'option' => getUserList('editor')), array('type' => 'hidden', 'name' => 'paperID', 'value' => $_GET['paperID'],), array('type' => 'hidden', 'name' => 'islem', 'value' => 'editor',), array('type' => 'hidden', 'name' => 'postUrl', 'value' => 'bildiri/bildiriUpdate',))));
                                    ?>
                                </div>
                                <div class="col-12 col-md-6">
                                    <?php echo createForm(array('id' => 'serialize', 'buttonText' => 'Kaydet', 'elements' => array(array('type' => 'textarea', 'collabel' => '6', 'colinput' => '6', 'id' => 'editorNote', 'name' => 'editorNote', 'value' => $paperMeta['editorNote'], 'optionValue' => 'id', 'label' => 'Editör Notu (Sadece Editörler görebilir)', 'option' => getUserList('editor')), array('type' => 'hidden', 'name' => 'paperID', 'value' => $_GET['paperID'],), array('type' => 'hidden', 'name' => 'islem', 'value' => 'editorNote',), array('type' => 'hidden', 'name' => 'postUrl', 'value' => 'bildiri/bildiriUpdate',))));
                                    ?>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane" id="yazar" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">Yazara Mesaj</h5>

                                            <?php echo createForm(
                                                array(
                                                    'id' => 'serialize',
                                                    'buttonText' => 'Gönder',
                                                    'elements' =>
                                                        array(
                                                            array('type' => 'select',
                                                                'collabel' => '6',
                                                                'colinput' => '6',
                                                                'id' => 'yazar',
                                                                'class' => 'mesaj',
                                                                'name' => 'yazar_mesaj',
                                                                'optionValue' => 'id',
                                                                'optionText' => 'aciklama',
                                                                'label' => 'Hazır Mesaj',
                                                                'option' => $db->from('mailsablon')->where('kime', 'yazar')->all()
                                                            ),
                                                            array(
                                                                'type' => 'editor',
                                                                'collabel' => '6',
                                                                'colinput' => '6',
                                                                'id' => 'yazarmesaj'
                                                            ),
                                                            array(
                                                                'type' => 'hidden',
                                                                'name' => 'paperID',
                                                                'value' => $_GET['paperID'],),
                                                            array(
                                                                'type' => 'hidden',
                                                                'name' => 'islem',
                                                                'value' => 'mesajGonder',
                                                            ),
                                                            array(
                                                                'type' => 'hidden',
                                                                'name' => 'postUrl',
                                                                'value' => 'emailsend/send'
                                                            ),
                                                            array(
                                                                'type' => 'hidden',
                                                                'name' => 'editorMesajID',
                                                                'value' => 'yazarmesaj'
                                                            )
                                                        )
                                                )
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
