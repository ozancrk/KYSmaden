<?php

function listBildiriYazar($YazarID)
{

    global $db;
    $Bildiriler = $db->from('bildiriler')->where('deleteStatus', 0)->where('yazar', $YazarID)->all();

    $return = array();
    $i = 0;
    foreach ($Bildiriler as $Bildiri) {

        $BildiriMeta = $db->from('bildiri_meta')->where('bildiri', $Bildiri['id'])->all();
        $Bildiri['meta'] = $BildiriMeta;

        $BildiriTimeline = $db->from('bildiri_timeline')->where('bildiri', $Bildiri['id'])->orderBy('date', 'DESC')->first();

        $Bildiri['sonislem'] = $BildiriTimeline;
        $BildiriTimeline2 = $db->from('bildiri_timeline')->where('bildiri', $Bildiri['id'])->where('islem', 2)->first();
        if (!$BildiriTimeline2) {
            $BildiriTimeline2 = $db->from('bildiri_timeline')->where('bildiri', $Bildiri['id'])->where('islem', 8)->first();
        }
        $Bildiri['ekleme'] = $BildiriTimeline2;
        $return[$i] = $Bildiri;
        $i++;
    }


    return $return;


}

function listBildiriler($editor = null)
{

    global $db;

    if ($editor == null) {
        $Bildiriler = $db->from('bildiriler')
            ->where('deleteStatus', 0)->all();

    } else {
        $Bildiriler = $db->from('bildiriler')->
        where('editor', $editor)
            ->where('deleteStatus', 0)->
            all();

    }


    $return = array();
    $i = 0;
    foreach ($Bildiriler as $Bildiri) {

        $BildiriMeta = $db->from('bildiri_meta')->where('bildiri', $Bildiri['id'])->all();
        $Bildiri['meta'] = $BildiriMeta;

        $BildiriTimeline = $db->from('bildiri_timeline')->where('bildiri', $Bildiri['id'])->orderBy('date', 'DESC')->first();

        $Bildiri['sonislem'] = $BildiriTimeline;
        $BildiriTimeline2 = $db->from('bildiri_timeline')->where('bildiri', $Bildiri['id'])->where('islem', 2)->first();
        if (!$BildiriTimeline2) {
            $BildiriTimeline2 = $db->from('bildiri_timeline')->where('bildiri', $Bildiri['id'])->where('islem', 8)->first();
        } else {
            $Bildiri['step'] = 'ozet';
        }
        $Bildiri['ekleme'] = $BildiriTimeline2;

        $BildiriTamMetin = $db->from('bildiri_timeline')->where('bildiri', $Bildiri['id'])->where('islem', 8)->first();

        if ($BildiriTamMetin) {
            $Bildiri['step'] = 'tammetin';
        }

        $return[$i] = $Bildiri;
        $i++;
    }


    return $return;


}


function metaBildiriYazar($BildiriID)
{

    global $db;
    $Bildiri = $db->from('bildiriler')->where('deleteStatus', 0)->where('id', $BildiriID)->first();


    $BildiriMeta = $db->from('bildiri_meta')->where('bildiri', $Bildiri['id'])->all();

    foreach ($BildiriMeta as $meta) {

        if (isset($Bildiri[$meta['meta']]) and !is_array($Bildiri[$meta['meta']])) {
            $gecici = $Bildiri[$meta['meta']];
            $Bildiri[$meta['meta']] = array();
            $Bildiri[$meta['meta']][] = $gecici;
            $Bildiri[$meta['meta']][] = $meta['value'];
        } elseif (isset($Bildiri[$meta['meta']])) {
            if (is_array($Bildiri[$meta['meta']])) {
                $Bildiri[$meta['meta']][] = $meta['value'];
            }
        } else {
            $Bildiri[$meta['meta']] = $meta['value'];
        }


    }
    $BildiriTimeline = $db->from('bildiri_timeline')->where('bildiri', $Bildiri['id'])->orderBy('date', 'DESC')->first();

    $Bildiri['sonislem'] = $BildiriTimeline;
    $BildiriTimeline2 = $db->from('bildiri_timeline')->where('bildiri', $Bildiri['id'])->where('islem', 2)->first();
    if (!$BildiriTimeline2) {
        $BildiriTimeline2 = $db->from('bildiri_timeline')->where('bildiri', $Bildiri['id'])->where('islem', 8)->first();

    }
    $Bildiri['ekleme'] = $BildiriTimeline2;


    return $Bildiri;


}

function bildiriTimeline($BildiriID)
{

    global $db;

    $BildiriTimeline = $db->from('bildiri_timeline')->where('bildiri', $BildiriID)->orderBy('date', 'DESC')->all();

    return $BildiriTimeline;


}


function bildiriStatusWithEdit($StatusCode, $Lang, $editCode = 0)
{

    global $db;
    $Bildiriler = $db->from('bildiri_status')->where('id', $StatusCode)->first();

    if ($editCode == 0) {
        $editMessage = langTranslate('Düzenlemeye Kapalı', $Lang);
    } elseif ($editCode == 1) {
        $editMessage = langTranslate('Düzenlemeye Açık', $Lang);
    }

    return $Bildiriler[$Lang] . ' / ' . $editMessage;


}


function bildiriStatus($StatusCode, $Lang)
{

    global $db;
    $Bildiriler = $db->from('bildiri_status')->where('id', $StatusCode)->first();

    return $Bildiriler[$Lang];


}

function bildiriTimelineStepAdd($BildiriID, $data, $islem)
{

    global $db;
    $Bildiriler = $db->from('bildiri_status')->where('id', $islem)->first();


    $db->insert('bildiri_timeline')
        ->set([
            'islem' => $islem,
            'bildiri' => $BildiriID,
            'data' => json_encode($data),
            'date' => date('Y-m-d H:i:s'),
        ]);


}

function bildiriCreate($yazar, $title)
{

    global $db;
    $db->insert('bildiriler')->set([
        'title' => $title,
        'yazar' => $yazar,
        'editor' => 0,
        'status' => 0,
        'bildirim' => 0,
    ]);

    return $db->lastId();
}

function getTopicList($parent = 0)
{
    global $db;
    if ($parent == 0) {
        return $db->from('topics')->all();

    } else {
        return $db->from('topics')->where('parent', $parent)->all();
    }
}

function getTopicMeta($topicID, $withBildiri = false)
{
    global $db;
    $TopicMeta = $db->from('topics')->where('id', $topicID)->first();
    if ($withBildiri) {
        $TopicMeta['bildilriler'] = $db->from('bildiriler')->where('deleteStatus', 0)->where('konu', $topicID)->all();
    }
    return $TopicMeta;
}


function islemEkleri($type, $data = [])
{

    if ($type == 'file') {
        return '<a href="/uploads/' . $data['file'] . '" class="btn btn-success">İNDİR</a>';
    } elseif ($type == 'modal') {

        $rand = rand(10, 1000);
        return  '

<!-- Default Modals -->
<button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#dg-'.$rand.'">'.$data['btnText'].'</button>
<div id="dg-'.$rand.'" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
               '.$data['modalBody'].'</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Kapat</button>
                
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

';


    }


}



function bildiriHakemMeta($hakemID,$PaperID){

    global $db;

    return $db->from('bildiri_meta')->where('bildiri',$PaperID)->like('value','hakem\":\"'.$hakemID)->first();


}