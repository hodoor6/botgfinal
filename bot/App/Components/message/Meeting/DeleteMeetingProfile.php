<?php

if ($data[0] == 'delete-meeting' && $cmddating[0] == '') {
    //очищаем кеш
    memcache_set($mem, 'user_info_' . $chatid, NULL, MEMCACHE_COMPRESSED, 30);
    memcache_set($mem, 'user_info_dating_' . $chatid, NULL, MEMCACHE_COMPRESSED, 30);
    $db->setCmd($chatid, '', 'dating_users');
    $db->setCmd($chatid, '');
    $db->deleteUser($chatid,'meeting_users');
  //  $response = $local->getResponse('start.txt');
    $msg->delete();
  //  $msg->replyHTML($response
    //
    //, $btn_menu);
    exit();
}
