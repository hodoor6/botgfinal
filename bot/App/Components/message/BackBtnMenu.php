<?php

if ($message == $json['buttons']['анонимное общение'] && $cmd[0] == '') {
    //очищаем кеш
    memcache_set($mem, 'user_info_' . $chatid, NULL, MEMCACHE_COMPRESSED, 30);
    memcache_set($mem, 'user_info_dating_' . $chatid, NULL, MEMCACHE_COMPRESSED, 30);

    $db->setCmd($chatid, '');
    $db->setCmd($chatid, '','dating_users');
    $response = $local->getResponse('start.txt');
    $msg->delete();
    $msg->replyHTML($response, $btn_menu);
    exit();
}
