<?php

if ($cmddating[0] == 'edit_profile_media_dating') {

    if ($cmddating[1] == 'photo1') {
        //изменение фото 1 анкети знакомств
        if ($cmddating[1] == 'photo1' && !empty($photo_id)) {

            $db->setCmd($chatid, 'edit_profile_dating', 'dating_users');
            $db->setPhotoProfile($chatid, $photo_id, 'dating_users');
            $msg->replyHTML($json['text']['сохранено'], $profile_btn_dating);
            clearCache($mem, $chatid);
            exit();
        } else {
            $msg->replyHTML($json['text-dating']['загрузите фото ошибка']);
            exit();
        }
    } //изменение фото 2 анкети знакомств

    elseif ($cmddating[1] == 'photo2') {
        if ($cmddating[1] == 'photo2' && !empty($photo_id)) {
            $db->setCmd($chatid, 'edit_profile_dating', 'dating_users');
            $db->setPhotoProfileTwo($chatid, $photo_id, 'dating_users');
            $msg->replyHTML($json['text']['сохранено'], $profile_btn_dating);
            clearCache($mem, $chatid);
            exit();
        } else {
            $msg->replyHTML($json['text-dating']['загрузите фото ошибка']);
            exit();
        }
    } //изменение фото 3 анкети знакомств
    elseif ($cmddating[1] == 'photo3') {
        if ($cmddating[1] == 'photo3' && !empty($photo_id)) {
            $db->setCmd($chatid, 'edit_profile_dating', 'dating_users');
            $db->setPhotoProfileThree($chatid, $photo_id, 'dating_users');
            $msg->replyHTML($json['text']['сохранено'], $profile_btn_dating);
            clearCache($mem, $chatid);
            exit();
        } else {
            $msg->replyHTML($json['text-dating']['загрузите фото ошибка']);
            exit();
        }
    } //изменение видео анкети знакомств
    elseif ($cmddating[1] == 'video') {
        if ($cmddating[1] == 'video' && !empty($video_id)) {
            $db->setCmd($chatid, 'edit_profile_dating', 'dating_users');
            $db->setVideoProfile($chatid, $video_id);
            $msg->replyHTML($json['text']['сохранено'], $profile_btn_dating);
            clearCache($mem, $chatid);
            exit();
        } else {
            $msg->replyHTML($json['text-dating']['загрузите приветственное ошибка']);
            exit();
        }
    }
    clearCache($mem, $chatid);
    exit();
}





