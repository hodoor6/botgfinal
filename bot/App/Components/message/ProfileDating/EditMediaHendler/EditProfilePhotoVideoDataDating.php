<?php

if ($data[0] == 'edit_profile_media_dating' && ($cmddating[0]) == 'edit_profile_dating') {
    if ($data[1] == 'photo1') {
        $msg->delete();
        $msg->replyHTML($json['text-dating']['изменить фото'], $keyb_cancel_profile_btn_dating);
        $db->setCmd($chatid, 'edit_profile_media_dating/photo1', 'dating_users');
    } else if ($data[1] == 'photo2') {
        $msg->delete();
        $msg->replyHTML($json['text-dating']['изменить фото'], $keyb_cancel_profile_btn_dating);
        $db->setCmd($chatid, 'edit_profile_media_dating/photo2', 'dating_users');
    } else if ($data[1] == 'photo3') {
        $msg->delete();
        $msg->replyHTML($json['text-dating']['изменить фото'], $keyb_cancel_profile_btn_dating);
        $db->setCmd($chatid, 'edit_profile_media_dating/photo3', 'dating_users');
    } else if ($data[1] == 'video') {
        $msg->delete();
        $msg->replyHTML($json['text-dating']['изменить видео'], $keyb_cancel_profile_btn_dating);
        $db->setCmd($chatid, 'edit_profile_media_dating/video', 'dating_users');
    }
    clearCache($mem, $chatid);
    exit();
}







