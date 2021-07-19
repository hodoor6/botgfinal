<?php

if ($cmddating[0] == 'set_video_dating') {

    if($data[0] == 'skip_upload_video'){;
        $db->setCmd($chatid, '', 'dating_users');
        $db->setVideoProfile($chatid, $video_id,'dating_users');
        $msg->replyHTML($json['text']['сохранено']);
        clearCache($mem, $chatid);
        $db->setRegStatus($chatid, 0);
        $msg->replyHTML($json['text']['рег'], $dating_menu_btn);
        exit();
    }

    if ($cmddating[0] == 'set_video_dating' && !empty($video_id)) {
         $db->setCmd($chatid, '', 'dating_users');
        $db->setVideoProfile($chatid, $video_id,'dating_users');
        $msg->replyHTML($json['text']['сохранено']);
        clearCache($mem, $chatid);
        $db->setRegStatus($chatid, 0);
        $msg->replyHTML($json['text']['рег'], $dating_menu_btn);
        exit();
    }else{
        $msg->replyHTML($json['text-dating']['загрузите приветственное ошибка']);
        exit();
    }
}
