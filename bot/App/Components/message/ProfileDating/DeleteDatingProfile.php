<?php

if ($message == $json['buttons']['удалить анкету'] && $cmddating[0] == 'edit_profile_dating') {
    //очищаем кеш
    memcache_set($mem, 'user_info_' . $chatid, NULL, MEMCACHE_COMPRESSED, 30);
    memcache_set($mem, 'user_info_dating_' . $chatid, NULL, MEMCACHE_COMPRESSED, 30);
    $db->setCmd($chatid, '', 'dating_users');
    $db->setCmd($chatid, '');
    $db->deleteUser($chatid);
    $response = $local->getResponse('start.txt');
    $msg->delete();
    $msg->replyHTML($response, $btn_menu);
    exit();
}
