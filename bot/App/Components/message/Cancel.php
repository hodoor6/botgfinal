<?php

if ($message == $json['buttons']['отмена']) {
         if($user_infodating['reg_status'] === 1)
        {
            $db->deleteUser($chatid);
        }

    memcache_set($mem, 'user_info_' . $chatid, NULL, MEMCACHE_COMPRESSED, 30);
    memcache_set($mem, 'user_info_dating_' . $chatid, NULL, MEMCACHE_COMPRESSED, 30);
    $db->setCmd($chatid, '');
    $response = $local->getResponse('start.txt');
    $msg->delete();
    $msg->replyHTML($response, $btn_menu);
    exit();
}
