<?php

if ($cmddating[0] == 'set_photo_three_dating') {

    if ($data[0] == 'skip_upload_photos') {
        $db->setCmd($chatid, 'set_video_dating', 'dating_users');
        $msg->replyHTML($json['text-dating']['загрузите приветственное видео'],$skip_upload_video_btn_dating);
        clearCache($mem, $chatid);
        exit();
    }
    if ($cmddating[0] == 'set_photo_three_dating' && !empty($photo_id)) {
        $db->setCmd($chatid, 'set_video_dating', 'dating_users');
        $db->setPhotoProfileThree($chatid, $photo_id, 'dating_users');
        $msg->replyHTML($json['text']['сохранено']);
        clearCache($mem, $chatid);
        $msg->replyHTML($json['text-dating']['загрузите приветственное видео'],$skip_upload_video_btn_dating);
        exit();
    } else {
        $msg->replyHTML($json['text-dating']['загрузите фото ошибка']);
        exit();
    }
}