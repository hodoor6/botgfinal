<?php

if ($message == $json['buttons']['назад'] && $cmd[0] == '') {
    //очищаем кеш
    memcache_set($mem, 'user_info_' . $chatid, NULL, MEMCACHE_COMPRESSED, 30);

    $db->setCmd($chatid, '');
    $response = $local->getResponse('start.txt');
    $msg->delete();
    $msg->replyHTML($response, $btn_menu);
    exit();
}
