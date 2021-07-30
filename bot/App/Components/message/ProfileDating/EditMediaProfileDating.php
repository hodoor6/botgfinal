<?php

if ($message == $json['buttons']['изменить фото'] && $cmddating[0] == 'edit_profile_dating') {

    $btn = $bt->inlineButtons([
        [
            $json['inline-dating']['изменить фото 1'] => 'edit_profile_media_dating/photo1',
            $json['inline-dating']['изменить фото 2'] => 'edit_profile_media_dating/photo2',
            $json['inline-dating']['изменить фото 3'] => 'edit_profile_media_dating/photo3'
        ],
        [
            $json['inline-dating']['изменить видео'] => 'edit_profile_media_dating/video'
        ]
    ]);
    $msg->replyHTML("Изменить фото", $btn);
    exit();
}
