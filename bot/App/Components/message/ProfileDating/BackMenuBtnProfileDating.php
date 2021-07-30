
<?php

if ($message == $json['buttons']['анкета возврат меню'] && empty($cmd[0]) && empty($cmd[0]) && $user_infodating['reg_status'] === 0) {


    //очищаем кеш
    memcache_set($mem, 'user_info_' . $chatid, NULL, MEMCACHE_COMPRESSED, 30);
    memcache_set($mem, 'user_info_dating_' . $chatid, NULL, MEMCACHE_COMPRESSED, 30);
    $db->setCmd($chatid, 'edit_profile_dating','dating_users');
    clearCache($mem, $chatid);
    $msg->delete();
    $msg->reply("Меню для редактирования анкеты", $profile_btn_dating);
        exit();
}
