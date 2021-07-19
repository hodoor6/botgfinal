<?php

if ($cmddating[0] == 'set_photo_dating') {

    if ($cmddating[0] == 'set_photo_dating' && !empty($photo_id)) {
        $db->setCmd($chatid, 'set_photo_two_dating', 'dating_users');
        $db->setPhotoProfile($chatid, $photo_id, 'dating_users');
        $msg->replyHTML($json['text']['сохранено']);
        clearCache($mem, $chatid);
        $msg->replyHTML($json['text-dating']['загрузите фото 2'], $skip_upload_photos_btn_dating);
        exit();
    } else {
        $msg->replyHTML($json['text-dating']['загрузите фото ошибка']);
        exit();
    }
}