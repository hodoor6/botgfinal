<?php

if ($cmddating[0] == 'set_video_meeting') {



    if ($cmddating[0] == 'set_video_meeting' && !empty($video_id)) {
        $db->setCmd($chatid, '', 'dating_users');
        $db->setVideoProfile($chatid, $video_id, 'meeting_users');
        $msg->replyHTML($json['text']['сохранено']);
        clearCache($mem, $chatid);
        $db->setRegStatus($chatid, 0, 'meeting_users');
        //  $msg->replyHTML($json['text-meeting']['рег объявление'],  $meeting_btn_dating);
        $msg->replyHTML($json['text-meeting']['после регистрации'], $meeting_btn_dating);
        exit();

    }elseif ($cmddating[0] == 'set_video_meeting' && !empty($photo_id)) {
         $db->setCmd($chatid, '', 'dating_users');
        $db->setPhotoProfile($chatid, $photo_id,'meeting_users');
        $msg->replyHTML($json['text']['сохранено']);
        clearCache($mem, $chatid);
        $db->setRegStatus($chatid, 0,'meeting_users');
      //  $msg->replyHTML($json['text-meeting']['рег объявление'],  $meeting_btn_dating);
        $msg->replyHTML($json['text-meeting']['после регистрации'],  $meeting_btn_dating);
        exit();
    }else{
        $msg->replyHTML($json['text-dating']['загрузите приветственное ошибка']." или фото только в формате .jpg");
        exit();
    }
}
