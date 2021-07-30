<?php

if ($message == $json['buttons']['изменить анкету'] && $cmddating[0] == 'edit_profile_dating') {

    $msg->replyHTML($json['text-dating']['имя'], $keyb_cancel_profile_btn_dating);
    $db->setCmd($chatid, 'edit_name_dating', 'dating_users');
    clearCache($mem, $chatid);
    exit();
}
