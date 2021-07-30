<?php

if ($message == $json['buttons']['анкета-dating'] && empty($cmd[0]) && $user_infodating['reg_status'] === 0) {

    $db->setCmd($chatid, 'edit_profile_dating', 'dating_users');
    clearCache($mem, $chatid);
    $msg->reply("Меню для редактирования анкеты", $profile_btn_dating);
    exit();
}
